<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\Proxy\ProxyIpContract;
use App\Models\ProxyIp;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $request;
    protected $proxyIpRepo;

    public function __construct(Request $request, ProxyIpContract $proxyIpContract)
    {
        $this->request = $request;
        $this->proxyIpRepo = $proxyIpContract;
    }

    public function index()
    {
        $proxyIps = $this->proxyIpRepo->all();
        dd($proxyIps);
    }
}
