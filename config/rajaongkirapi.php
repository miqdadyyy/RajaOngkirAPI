<?php

return [
    /*
     * --------------------------------------------
     * Base URL API :
     * --------------------------------------------
     * Starter : http://rajaongkir.com/api/starter
     * Basic : http://rajaongkir.com/api/basic
     * Pro : http://pro.rajaongkir.com/api
     *
     * */

    'rajaongkir_baseurl' => env('RAJAONGKIR_BASEURL', 'http://rajaongkir.com/api/starter/'),

    /*
     * --------------------------------------------
     * API Key : API key should match as base URL
     * --------------------------------------------
     *
     * */

    'rajaongkir_key' => env('RAJAONGKIR_API_KEY', ''),

    /*
     * --------------------------------------------
     * Origin to calculate your courier from your location
     * --------------------------------------------
     *
     * */
    'rajaongkir_origin' => env('RAJAONGKIR_ORIGIN', '')
];