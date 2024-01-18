<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

function getLangaugesDomainAndCountries()
{
    return [
        ['code' => 'en', 'name' => 'English', 'google_domain' => 'google.com', 'country_code' => 'us', 'country' => 'United States'],
        ['code' => 'es', 'name' => 'Spanish', 'google_domain' => 'google.es', 'country_code' => 'es', 'country' => 'Spain'],
        ['code' => 'fr', 'name' => 'French', 'google_domain' => 'google.fr', 'country_code' => 'fr', 'country' => 'France'],
        ['code' => 'de', 'name' => 'German', 'google_domain' => 'google.de', 'country_code' => 'de', 'country' => 'Germany'],
        ['code' => 'it', 'name' => 'Italian', 'google_domain' => 'google.it', 'country_code' => 'it', 'country' => 'Italy'],
        ['code' => 'pt', 'name' => 'Portuguese', 'google_domain' => 'google.pt', 'country_code' => 'pt', 'country' => 'Portugal'],
        ['code' => 'ja', 'name' => 'Japanese', 'google_domain' => 'google.co.jp', 'country_code' => 'jp', 'country' => 'Japan'],
        ['code' => 'ko', 'name' => 'Korean', 'google_domain' => 'google.co.kr', 'country_code' => 'kr', 'country' => 'South Korea'],
        ['code' => 'zh', 'name' => 'Chinese', 'google_domain' => 'google.cn', 'country_code' => 'cn', 'country' => 'China'],
        ['code' => 'ru', 'name' => 'Russian', 'google_domain' => 'google.ru', 'country_code' => 'ru', 'country' => 'Russia'],
        ['code' => 'ar', 'name' => 'Arabic', 'google_domain' => 'google.com.sa', 'country_code' => 'sa', 'country' => 'Saudi Arabia'],
        ['code' => 'hi', 'name' => 'Hindi', 'google_domain' => 'google.co.in', 'country_code' => 'in', 'country' => 'India'],
        ['code' => 'tr', 'name' => 'Turkish', 'google_domain' => 'google.com.tr', 'country_code' => 'tr', 'country' => 'Turkey'],
        ['code' => 'nl', 'name' => 'Dutch', 'google_domain' => 'google.nl', 'country_code' => 'nl', 'country' => 'Netherlands'],
        ['code' => 'sv', 'name' => 'Swedish', 'google_domain' => 'google.se', 'country_code' => 'se', 'country' => 'Sweden'],
        ['code' => 'fi', 'name' => 'Finnish', 'google_domain' => 'google.fi', 'country_code' => 'fi', 'country' => 'Finland'],
        ['code' => 'pl', 'name' => 'Polish', 'google_domain' => 'google.pl', 'country_code' => 'pl', 'country' => 'Poland'],
        ['code' => 'vi', 'name' => 'Vietnamese', 'google_domain' => 'google.com.vn', 'country_code' => 'vn', 'country' => 'Vietnam'],
        ['code' => 'th', 'name' => 'Thai', 'google_domain' => 'google.co.th', 'country_code' => 'th', 'country' => 'Thailand'],
        ['code' => 'id', 'name' => 'Indonesian', 'google_domain' => 'google.co.id', 'country_code' => 'id', 'country' => 'Indonesia'],
    ];
}


function getLocations($location = "delhi")
{
    try {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->get('https://api.valueserp.com/locations', [
            'api_key' => 'AB24CF8E725F4553B3B08BC9D5092A27',
            'q' => $location
        ]);
        $response->throw();
        return $data = $response->json();
    } catch (\Exception $e) {
        Log::info("Error" . $e->getMessage());
    }
}


function locationList()
{
    return [
        'Delhi,India',
        'New Delhi,Delhi,India',
        '110001,Delhi,India',
        '110092,Delhi,India',
        '110002,Delhi,India',
        '110037,Delhi,India',
        '110006,Delhi,India',
        '110010,Delhi,India',
        '110021,Delhi,India',
        '110003,Delhi,India'
    ];
}
