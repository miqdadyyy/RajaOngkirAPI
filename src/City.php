<?php

namespace Miqdadyyy\RajaOngkirApi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Miqdadyyy\RajaOngkirApi\RajaOngkirApi;

class City
{
    public $city_id, $province_id, $province, $type, $city_name, $postal_code;

    /**
     * City constructor.
     * @param $city_id
     * @param $province_id
     * @param $province
     * @param $type
     * @param $city_name
     * @param $postal_code
     */

    public function __construct($city_id, $province_id, $province, $type, $city_name, $postal_code)
    {
        $this->city_id = $city_id;
        $this->province_id = $province_id;
        $this->province = $province;
        $this->type = $type;
        $this->city_name = $city_name;
        $this->postal_code = $postal_code;
    }

    /*
     *
     * Static method to get all city from raja ongkir
     *
     * */

    public static function all(){
        $response = (new RajaOngkirApi)->all(self::class);
        return collect($response);
    }

    /*
     *
     * Static method to find city by id from raja ongkir
     *
     * */

    public static function find($id){
        $response = (new RajaOngkirApi)->find(self::class, $id);
        return $response;
    }

    public function __toString()
    {
        return json_encode((array)$this);
    }
}