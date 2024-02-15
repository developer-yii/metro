<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DOMDocument;

class ScrapController extends Controller
{
    public function scrap()
    {
        $api_key = 'a9de9d79833e6aeaaf909019ef167676';
        $productKey = 'efbd781c-e75c-44dd-8209-04dcb24f7ef3';
        $url = 'http://api.scraperapi.com?api_key=' . $api_key . '&url=https://www.makro.es/marketplace/product/'.$productKey;

        // Initialize cURL session
        $curl = curl_init();

        // Set cURL options
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ]);

        // Execute cURL request
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $result = $response;
        // Close cURL session
        curl_close($curl);
        
        libxml_use_internal_errors(true); 
        $dom = new DOMDocument();
        $dom->loadHTML($result);

        $scripts = $dom->getElementsByTagName('script');
        $pattern = '/"lowPrice":"([\d\.]+)"/';
        $price = '';
        
        foreach ($scripts as $script) {
            $text = $script->nodeValue;
            
            if (preg_match($pattern, $text, $matches)) {
                $price = $matches[1]; // $price will now contain "3971"
                echo $price;die;
                //this price need to store at lowest_price
            } else {
                // Handle the case where there's no match
                continue;
            }
        }        
    }
}
