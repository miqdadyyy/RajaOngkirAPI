<?php

namespace Miqdadyyy\RajaOngkirApi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Miqdadyyy\RajaOngkirApi\RajaOngkirApi;

class Courier
{
    public $code, $name, $costs;

    /**
     * Courier constructor.
     * @param $code
     * @param $name
     * @param $costs
     */
    public function __construct($code, $name, $costs)
    {
        $this->code = $code;
        $this->name = $name;
        $this->costs = $costs;
    }

    public function __toString()
    {
        return json_encode((array)$this);
    }
}