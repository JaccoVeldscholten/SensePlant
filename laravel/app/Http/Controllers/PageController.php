<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SenseData;
use App\SenseDefault;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index() {
        return view('index');
    }

    public function dashboard() {
        return view('dashboard');
    }

    public function plantdata($id) {
        $senseMdl = DB::table('sensedata')->where('plant_id', '=', $id)->get() ;
        if (empty(json_decode($senseMdl))) {
            return json_encode("Not Found");
        }
        return json_encode($senseMdl);
    }

    public function plantdefault ($id) {

    }
}
