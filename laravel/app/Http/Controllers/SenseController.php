<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SenseData;

class SenseController extends Controller
{
    public function insertPlantData ($token, $plantId, $temp, $humidity) {
        $senseMdl = new SenseData;

        $senseMdl->temprature = $temp;
        $senseMdl->humidity = $humidity;
        $senseMdl->created_at = date("Y-m-d H:i:s");
        $senseMdl->plant_id = $plantId;
        $senseMdl->sunhours = 0;

        $senseMdl->save();
    }
}
