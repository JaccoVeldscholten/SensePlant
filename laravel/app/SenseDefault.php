<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SenseDefault extends Model
{
    protected $table = 'senseplant';

    protected $fillable = [
        'id_plants', 'name', 'ideal_humidity', 'ideal_temprature', 'ideal_sunhours'
    ];
}
