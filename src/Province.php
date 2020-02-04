<?php

namespace Miqdadyyy\RajaOngkirApi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Miqdadyyy\RajaOngkirApi\RajaOngkirApi;

class Province
{
    public $province_id, $province;

    /**
     * Province constructor.
     * @param $province_id
     * @param $province
     */

    public function __construct($province_id, $province)
    {
        $this->province_id = $province_id;
        $this->province = $province;
    }

    /*
     *
     * Static method to get all province from raja ongkir
     *
     * */

    public static function all(){
        $response = (new RajaOngkirApi)->all(self::class);
        return collect($response);
    }

    /*
     *
     * Static method to find province by id from raja ongkir
     *
     * */

    public static function find($id){
        $response = (new RajaOngkirApi)->find(self::class, $id);
        return $response;
    }

    /*
     *
     * Static method to get all cities in province
     *
     * */

    public static function cities($province){
        $response = (new RajaOngkirApi)->query(City::class, compact('province'));
        return $response;
    }

    public function __toString()
    {
        return json_encode((array)$this);
    }
}