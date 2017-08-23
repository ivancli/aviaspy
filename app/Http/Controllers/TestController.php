<?php

namespace App\Http\Controllers;

use App\Models\ProxyIp;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {

    }
}
