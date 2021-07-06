<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class fileController extends Controller
{
    public function getFiles($type) {
        dd($type);
    }
}
