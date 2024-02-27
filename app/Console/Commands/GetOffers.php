<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Offer;

class GetOffers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-offers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get offers from metro makro site';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Truncate offers table
        Offer::truncate();

        // Get configuration values
        $hmacSignature = config('metro.signature');
        $clientKey = config('metro.client_id');        

        // Build API URL
        $host = 'https://app-seller-inventory.prod.de.metro-marketplace.cloud/openapi/v2/offers';
        $limit = 1500;
        $offset = 0;
        $sort = 'DESC';
        $url = $host . '?limit=' . $limit . '&offset=' . $offset . '&sort%5BcreatedAt%5D=' . $sort;

        // Generate HMAC signature
        $timestamp = time();
        $message = "GET\n$url\n\n$timestamp";
        $hmacSignature = hash_hmac('sha256', $message, $hmacSignature);

        // Make API request
        $response = Http::withHeaders([
            'X-Client-Id' => $clientKey,
            'X-Timestamp' => $timestamp, // timestamp
            'X-Signature' => $hmacSignature,  // signature
            'Accept' => 'application/json'
        ])->get($url);

        // Check if API request was successful
        if ($response->successful()) {
            $offersData = $response->json();

            // Check if 'items' key exists in response
            if (!isset($offersData['items'])) {
                \Log::info('no items');
                return 0;
            }

            // Log number of items
            \Log::info('count: ' . count($offersData['items']));

            // Process and insert offers
            foreach ($offersData['items'] as $offer) {

                // Remove the 'businessModel' element as it is not coming with value compatible with post data; coming with numeric need to send string like 'B2B/B2C'
                unset($offer['businessModel']);

                // Create the Offer record
                Offer::create([
                    'productKey' => $offer['productKey'],
                    'offer_price' => $offer['netPrice']['amount'],
                    'productName' => $offer['productName'],
                    'mid' => $offer['mid'],
                    'quantity' => $offer['quantity'],
                    'internal_status' => $offer['offerStatus']['internalStatus'],
                    'offer_json' => json_encode($offer), // Store modified offer as JSON                    
                ]);
            }

            \Log::info('Offers retrieval and processing successful.');
        } else {
            \Log::error('API request failed with status code: ' . $response->status());
        }

        return 0;
    }
}
