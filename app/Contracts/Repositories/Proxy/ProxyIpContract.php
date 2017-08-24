<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 23/08/2017
 * Time: 11:54 PM
 */

namespace App\Contracts\Repositories\Proxy;


use App\Models\ProxyIp;

interface ProxyIpContract
{
    /**
     * load all proxy ips
     * @return mixed
     */
    public function all();

    /**
     * create a new proxy ip
     * @param array $data
     * @return ProxyIp
     */
    public function store(array $data);

    /**
     * delete proxy ip
     * @param ProxyIp $proxyIp
     * @return void
     */
    public function destroy(ProxyIp $proxyIp);

    /**
     * Test provided proxy ip validity
     * @param ProxyIp $proxyIp
     * @return boolean
     */
    public function test(ProxyIp $proxyIp);
}