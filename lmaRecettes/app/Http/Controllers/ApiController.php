<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    public function getApiKey()
    {
        $api_Key = env('API_KEY', 'default_key');
        return Response::json(['api_Key' => $api_Key]);
    }
}
