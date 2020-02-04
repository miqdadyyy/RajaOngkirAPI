<?php

namespace Miqdadyyy\RajaOngkirApi;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\MessageBag;

class RajaOngkirApi
{
    protected $baseurl;
    protected $apikey;
    protected $origin;

    public function __construct()
    {
        $this->baseurl = config('rajaongkirapi.rajaongkir_baseurl', 'http://rajaongkir.com/api/starter/');
        $this->apikey = config('rajaongkirapi.rajaongkir_key', '');
        $this->origin = config('rajaongkirapi.rajaongkir_origin', '');
    }

    public function all($class)
    {
        $arr = [];
        $endpoint = strtolower(last(explode('\\', $class)));
        foreach (json_decode($this->requestData($endpoint))->rajaongkir->results as $result) {
            array_push($arr, new $class(...array_values((array)$result)));
        }
        return $arr;
    }

    public function query($class, $query)
    {
        $arr = [];
        $endpoint = strtolower(last(explode('\\', $class))) . "?" . http_build_query($query);
        foreach (json_decode($this->requestData($endpoint))->rajaongkir->results as $result) {
            array_push($arr, new $class(...array_values((array)$result)));
        }
        return $arr;
    }

    public function find($class, $id)
    {
        $endpoint = strtolower(last(explode('\\', $class))) . "?id=$id";
        $result = json_decode($this->requestData($endpoint))->rajaongkir->results;
        return $result === [] ? null : new $class(...array_values((array)$result));
    }

    public static function calculateCost($destination, $weight, $courier)
    {
        $rajaongkir = new RajaOngkirApi;
        $origin = $rajaongkir->origin;
        $response = json_decode($rajaongkir->requestData('cost', 'POST', compact('destination', 'weight', 'courier', 'origin')))->rajaongkir;
        if($response->status->code === 200){
            $origin_detail = new City(...array_values((array)$response->origin_details));
            $destination_detail = new City(...array_values((array)$response->destination_details));
            $costs = [];
            foreach ($response->results[0]->costs as $cost) {
                array_push($costs, new CourierCost(
                    $cost->service,
                    $cost->description,
                    $cost->cost[0]->value,
                    $cost->cost[0]->etd,
                    $cost->cost[0]->note
                ));
            }
            $courier = new Courier($response->results[0]->code, $response->results[0]->name, $costs);
            return new Cost($origin_detail, $destination_detail, $courier);
        } else {
            $errors = new MessageBag();
            $errors->add('rajaongkir', $response->status->description);
            return $errors;
        }
    }

    public static function waybill($waybill, $courier)
    {
        $rajaongkir = new RajaOngkirApi;
        $response = $rajaongkir->requestData('waybill', 'POST', compact('waybill', 'courier'));
        return $response;
    }

    public function requestData($endpoint, $method = 'GET', $params = [])
    {
        $client = new Client();
        try {
            $response = $client->request($method, $this->baseurl . $endpoint, [
                'headers' => [
                    'key' => $this->apikey
                ],
                'connect_timeout' => 5,
                'form_params' => $params
            ]);

            if ($response->getStatusCode() === 200) {
                return $response->getBody()->getContents();
            }
        } catch (\Exception $exception){
            return explode("\n", $exception->getMessage())[1] ?? null;
        }
    }
}