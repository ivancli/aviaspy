<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 23/08/2017
 * Time: 11:56 PM
 */

namespace App\Repositories\Proxy;


use App\Contracts\Repositories\Proxy\ProxyIpContract;
use App\Models\ProxyIp;

class ProxyIpRepository implements ProxyIpContract
{
    const WAIT_TIMEOUT = 3;

    protected $proxyIpModel;

    public function __construct(ProxyIp $proxyIp)
    {
        $this->proxyIpModel = $proxyIp;
    }

    /**
     * load all proxy ips
     * @return mixed
     */
    public function all()
    {
        return $this->proxyIpModel->all();
    }

    /**
     * create a new proxy ip
     * @param array $data
     * @return ProxyIp
     */
    public function store(array $data)
    {
        $proxyIp = $this->proxyIpModel
            ->where('ip', array_get($data, 'ip'))
            ->where('port', array_get($data, 'port'))->first();
        if (is_null($proxyIp)) {
            $proxyIp = $this->proxyIpModel->create($data);
        }
        return $proxyIp;
    }

    /**
     * delete proxy ip
     * @param ProxyIp $proxyIp
     * @return void
     */
    public function destroy(ProxyIp $proxyIp)
    {
        $proxyIp->delete();
    }

    /**
     * Test provided proxy ip validity
     * @param ProxyIp $proxyIp
     * @return boolean
     */
    public function test(ProxyIp $proxyIp)
    {
        if (@fsockopen($proxyIp->ip, $proxyIp->port, $errCode, $errStr, self::WAIT_TIMEOUT) !== false) {
            return true;
        }
        return false;
    }
}