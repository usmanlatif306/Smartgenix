<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ExchangeRateService
{
    public function symbols()
    {
        return $this->request('symbols');
    }

    public function convert($currency)
    {
        $url = 'convert?to=' . $currency . '&from=GBP&amount=1';
        return $this->request($url);
    }

    public function request($url)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'text/plain"',
            'apikey' => config('services.exchange_rate_key')
        ])->get("https://api.apilayer.com/exchangerates_data/" . $url);

        return $response->json();

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => "https://api.apilayer.com/exchangerates_data/" . $url,
        //     CURLOPT_HTTPHEADER => array(
        //         "Content-Type: text/plain",
        //         "apikey: " . config('services.exchange_rate_key')
        //     ),
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "GET"
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);

        // return json_decode($response, true);
    }
}
