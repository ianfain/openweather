<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Cache;
class WindController extends Controller
{
    //
    public function index($zipcode)
    {

        if (!is_numeric($zipcode) || strlen($zipcode) != 5) return response()->json(['error' => 'Invalid zipcode.']);

        if (Cache::has($zipcode)) return response(Cache::get($zipcode));

            $url = "https://api.openweathermap.org/data/2.5/weather?zip=" . request('zipcode') . '&APPID=' . config('openweather.API_KEY');
            $client = new Client(['http_errors' => false]);
            $data = $client->get($url);
            $response = json_decode($data->getBody()->getContents(), true);

            if ($response['cod'] == '404') return response()->json(['error' => 'Invalid zipcode.']);

            $response = ['wind' => ['speed' => $response['wind']['speed'], 'direction' => $response['wind']['deg']]];

            Cache::put($zipcode, json_encode($response), 15);
            return response()->json($response);


    }

}
