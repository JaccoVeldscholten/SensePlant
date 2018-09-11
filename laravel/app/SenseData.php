<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SenseData extends Model
{
    protected $table = 'sensedata';

    protected $fillable = [
        'created_at', 'updated_at', 'temprature', 'humidity', 'plant_id', 'sunhours'
    ];
}
