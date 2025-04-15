<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use App\Models\Offer;

class GetOffers extends Command
{
    protected $signature = 'app:get-offers';
    protected $description = 'Get offers from Metro Makro site';

    public function handle()
    {
        Log::info('Starting offer fetch...');

        Offer::truncate();

        $clientKey = Config::get('metro.client_id');
        $secretKey = Config::get('metro.signature');

        if (!$clientKey || !$secretKey) {
            Log::error('Metro API credentials not configured.');
            return Command::FAILURE;
        }

        $host = 'https://app-seller-inventory.prod.de.metro-marketplace.cloud/openapi/v2/offers';
        $limit = 1000;
        $offset = 0;
        $sort = 'DESC';
        $status = 'active';

        $allOffers = [];
        $hasMore = true;

        while ($hasMore) {
            $queryParams = http_build_query([
                'limit' => $limit,
                'offset' => $offset,
                'sort[createdAt]' => $sort,
                'filter[status]' => $status
            ]);

            $url = "{$host}?{$queryParams}";
            $timestamp = time();
            $message = "GET\n{$url}\n\n{$timestamp}";
            $signature = hash_hmac('sha256', $message, $secretKey);

            $response = Http::withHeaders([
                'X-Client-Id' => $clientKey,
                'X-Timestamp' => $timestamp,
                'X-Signature' => $signature,
                'Accept' => 'application/json',
            ])->get($url);

            if (!$response->successful()) {
                Log::error('API request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'offset' => $offset,
                ]);
                return Command::FAILURE;
            }

            $data = $response->json();

            if (empty($data['items'])) {
                Log::warning("No items found at offset: $offset");
                break;
            }

            $total = $data['totalCount'] ?? null;
            Log::info("Fetched " . count($data['items']) . " offers at offset {$offset}" . ($total ? " of total $total" : ""));

            $offersToInsert = [];

            foreach ($data['items'] as $offer) {
                // Remove the 'businessModel' element as it is not coming with value compatible with post data; coming with numeric need to send string like 'B2B/B2C'
                unset($offer['businessModel']);

                $offersToInsert[] = [
                    'productKey' => $offer['productKey'],
                    'offer_price' => $offer['netPrice']['amount'],
                    'productName' => substr($offer['productName'] ?? '', 0, 255),
                    'mid' => $offer['mid'] ?? '',
                    'sku' => $offer['sku'] ?? '',
                    'destination' => $offer['destination'] ?? '',
                    'quantity' => $offer['quantity'],
                    'internal_status' => $offer['offerStatus']['internalStatus'] ?? '',
                    'offer_json' => json_encode($offer),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Insert in chunks for performance
            $chunks = array_chunk($offersToInsert, 1000);
            foreach ($chunks as $chunk) {
                Offer::insert($chunk);
            }

            $offset += $limit;
            if ($total !== null && $offset >= $total) {
                $hasMore = false;
            }
        }

        Log::info('Offers fetched and stored successfully.');

        return Command::SUCCESS;
    }
}
