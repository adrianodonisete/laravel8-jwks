<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([
            'id' => '23a21df654asd321f',
            'username' => 'adrianodonsite'
        ], 200);
    }
}
