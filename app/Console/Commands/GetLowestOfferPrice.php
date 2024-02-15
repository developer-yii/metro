<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Offer;
use DOMDocument;

class GetLowestOfferPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-update-lowest-offer-price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find and update the lowest price for offers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $api_key = config('metro.scraper_key');
        $offers = Offer::all();

        foreach ($offers as $offer) {

            $productKey = $offer->productKey;
            $url = 'http://api.scraperapi.com?api_key=' . $api_key . '&url=https://www.makro.es/marketplace/product/' . $productKey;

            $response = Http::get($url);

            if ($response->failed()) {
                \Log::error('Failed to fetch data from the marketplace API.:' . $productKey);
                continue;
            }

            // Get lowestPrice from provided response
            $lowestPrice = $this->extractLowestPrice($response->body());

            // if we get lowest price and it is less than offer price then we need to update our offer price accordingly
            if ($lowestPrice && $lowestPrice > 0 && $lowestPrice < $offer->offer_price) {
                \Log::info('inside');
                $this->updateLowestPriceToMetro($lowestPrice, $offer);
            }
            \Log::info('handle end');
        }
    }

    private function extractLowestPrice($htmlContent)
    {
        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML($htmlContent);

        $scripts = $dom->getElementsByTagName('script');
        $pattern = '/"lowPrice":"([\d\.]+)"/';
        $price = null;

        foreach ($scripts as $script) {
            $text = $script->nodeValue;

            if (preg_match($pattern, $text, $matches)) {
                $price = $matches[1]; // $price will now contain the lowest price
                break;
            }
        }

        \Log::info('lowestPrice: ' . $price);
        return $price;
    }

    private function updateOfferJson($offerJson, $updatedPrice)
    {
        $offerData = json_decode($offerJson, true);
        $offerData['netPrice']['amount'] = number_format($updatedPrice, 2, '.', '');
        return $offerData;
    }

    private function removeBusinessModel($offerJson)
    {
        $offerData = json_decode($offerJson, true);
        unset($offerData['businessModel']);
        return json_encode($offerData);
    }

    private function updateLowestPriceToMetro($lowestPrice, Offer $offer)
    {
        // Get HMAC signature from config
        $hmacSignature = config('metro.signature');

        // Calculate updated price (subtract 0.10 EUR)
        $updatedPrice = $lowestPrice - 0.10;

        // Update offer JSON with the new price
        $updatedOfferJson = $this->updateOfferJson($offer->offer_json, $updatedPrice);

        // Endpoint URL for updating offers
        $urlPost = 'https://app-seller-inventory.prod.de.metro-marketplace.cloud/openapi/v2/offers';

        // Construct the message for HMAC signature
        $timestamp = time();
        $message = "POST\n$urlPost\n" . json_encode($updatedOfferJson) . "\n$timestamp";

        // Generate HMAC signature
        $signature = hash_hmac('sha256', $message, $hmacSignature);

        // Initialize cURL session
        $curl = curl_init();

        // Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $urlPost,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($updatedOfferJson),
            CURLOPT_HTTPHEADER => array(
                'X-Client-Id: ' . config('metro.client_id'),
                'X-Timestamp: ' . time(),
                'X-Signature: ' . $signature,
                'Accept: application/json',
                'Accept-Language: en',
                'Content-Type: application/json'
            ),
        ));

        // Execute cURL request
        $response = curl_exec($curl);

        // Close cURL session
        curl_close($curl);

        if ($response) {
            \Log::info('successful');
            // Decode the JSON response
            $responseData = json_decode($response, true);

            if (isset($responseData['offerNumber'])) {
                $updatedOfferJson = $this->removeBusinessModel($response);
                \Log::info('updated removed');
                \Log::info($updatedOfferJson);
                $offer->offer_json = $updatedOfferJson;
                $offer->offer_price = $updatedPrice;
                $offer->save();
                return true;
            } else {
                if (isset($responseData['status'])) {
                    \Log::error('Offer update failed. Status: ' . $responseData['status']);
                }
                return false;
            }
        } else {
            return false;
        }
    }
}
