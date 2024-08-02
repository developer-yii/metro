<?php

namespace App\Services;

use App\Models\User;
use App\Models\Offer;
use App\Models\CustomOffer;
use App\Models\PriceUpdateLog;
use Illuminate\Support\Facades\Http;
use DOMDocument;
use Exception;
use Illuminate\Support\Facades\Storage;

class OfferService
{
	public function offerSync($offerId){
		\Log::info('offerSync');
		$api_key = config('metro.scraper_key');
		$offer = Offer::find($offerId);

		$defaultPercentage = 10; // Default percentage if custom offer percentage is not available
            $interested = true;
            $percentage = $defaultPercentage;

            if ($offer->customOffer) {
                if ($offer->customOffer->percentage) {
                    $percentage = $offer->customOffer->percentage;
                }

                $interested = $offer->customOffer->is_interested_product;
            }

            if ($interested) {
                // Product key for API request
                $productKey = $offer->productKey;
                \Log::info($productKey);

                if($offer->internal_status == 'active'){
                    // API Url to scrape website
                    $url = 'http://api.scrape.do?token=' . $api_key . '&url=https://www.makro.es/marketplace/product/' . $productKey;

                    // call API and get response
                    $response = Http::get($url);

                    if ($response->failed()) {
                        \Log::error('Failed to fetch data from the marketplace API.:');
                        $result = [ 'status' => false, 'message' => 'Failed to fetch data from the marketplace'];
            			return $result;
                    }

                    // Get lowestPrice from provided response
                    $lowestPrice = $this->extractLowestPrice($response->body());
                    \Log::info($lowestPrice);

                    // if we get lowest price and it is less than offer price then we need to update our offer price accordingly
                    if ($lowestPrice && $lowestPrice > 0 && $lowestPrice < $offer->offer_price) {
                        \Log::info('inside');

                        // Calculate factor based on percentage
                        $factor = round(1 - ($percentage / 100), 2);
                        \Log::info($factor);

                        // Calculate the price below which we would consider updating the offer
                        $percentLowerOfferPrice = round($offer->offer_price * $factor, 2);

                        // Log the calculated price for debugging
                        \Log::info('ten lowest: ' . $percentLowerOfferPrice);

                        // Check if the lowest price is lower than the calculated offer price
                        if ($lowestPrice > $percentLowerOfferPrice) {
                            \Log::info('Updating offer price...');
                            $r = $this->updateLowestPriceToMetro($lowestPrice, $offer);
                            if($r){
                            	$result = [ 'status' => true, 'message' => 'Product price has been synced'];
            					return $result;
                            }
                        } else {
                            \Log::info('Lowest price is significantly lower than offer price.');
                            $result = [ 'status' => false, 'message' => 'Lowest price is significantly lower than offer price.'];
            				return $result;
                        }
                    }else{
                    	$result = [ 'status' => false, 'message' => 'offer price already lowest or lowest price not found'];
            			return $result;
                    }
                }else{
                    \Log::info('product internal status not active');
            		$result = [ 'status' => false, 'message' => 'Product internal status not active'];
            		return $result;
                }
            } else {
                \Log::info('not interested: ' . $offer->productKey);
            	$result = [ 'status' => false, 'message' => 'Product not interested'];
            	return $result;
            }

            \Log::info('handle end');
	}

	private function extractLowestPrice($htmlContent)
    {
        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML($htmlContent);

        $scripts = $dom->getElementsByTagName('script');
        $pattern = '/"lowPrice":"([\d\.]+)"/';
        $price = null;

        // foreach ($scripts as $script) {
        //     $text = $script->nodeValue;

        //     if (preg_match($pattern, $text, $matches)) {
        //         $price = $matches[1]; // $price will now contain the lowest price
        //         break;
        //     }
        // }
        foreach ($scripts as $script) {
            if ($script->getAttribute('id') === '__NEXT_DATA__') {
                $jsonData = json_decode($script->nodeValue, true);

                if (isset($jsonData['props']['pageProps']['product']['result']['offers']) &&
                    is_array($jsonData['props']['pageProps']['product']['result']['offers'])) {

                    foreach ($jsonData['props']['pageProps']['product']['result']['offers'] as $offer) {
                        if (isset($offer['originRegionInfo']['price']['net'])) {
                            $netPrice = floatval($offer['originRegionInfo']['price']['net']);

                            if ($price === null || $netPrice < $price) {
                                $price = $netPrice;
                            }
                        }
                    }
                }
                break;
            }
        }

        \Log::info('lowestPrice: ' . $price);
        return $price;
    }

    private function updateLowestPriceToMetro($lowestPrice, Offer $offer)
    {
        // Get HMAC signature from config
        $hmacSignature = config('metro.signature');

        // Calculate updated price (subtract 0.01 EUR)
        $updatedPrice = $lowestPrice - 0.01;

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

                if ($offer->offer_price != $updatedPrice) {
                    // update price change log
                    $this->updatePriceChangeLog($offer, $offer->offer_price, $updatedPrice);
                }

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

    private function updateOfferJson($offerJson, $updatedPrice)
    {
        $offerData = json_decode($offerJson, true);
        $offerData['netPrice']['amount'] = number_format($updatedPrice, 2, '.', '');
        return $offerData;
    }

    private function sendOfferPriceChangedEmail($offer, $oldPrice, $newPrice)
    {
        $email = config('mail.to.address');
        \Log::info($email);
        Mail::to($email)->queue(new OfferPriceChanged($offer, $oldPrice, $newPrice));
    }

    private function updatePriceChangeLog(Offer $offer, $oldPrice, $newPrice){
    	$r = PriceUpdateLog::create([
    		'productName' => $offer->productName,
    		'mmid' => $offer->mid,
    		'new_price' => $newPrice,
    		'old_price' => $oldPrice,
    		'type' => PriceUpdateLog::TYPE_MANUAL
    	]);

    	if($r){
    		return true;
    	}

    	return false;
    }

    private function removeBusinessModel($offerJson)
    {
        $offerData = json_decode($offerJson, true);
        unset($offerData['businessModel']);
        return json_encode($offerData);
    }
}