<?php

namespace App\Console\Commands\Proxy;

use App\Contracts\Repositories\Proxy\ProxyIpContract;
use Illuminate\Console\Command;

class Validate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proxy:validate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command validates existing proxy ips';

    protected $proxyIpRepo;

    /**
     * Create a new command instance.
     *
     * @param ProxyIpContract $proxyIpContract
     */
    public function __construct(ProxyIpContract $proxyIpContract)
    {
        $this->proxyIpRepo = $proxyIpContract;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $proxyIps = $this->proxyIpRepo->all();
        $proxyIps->each(function ($proxyIp) {
            $isValid = $this->proxyIpRepo->test($proxyIp);
            if ($isValid === false) {
                $proxyIp->setActive(false);
            } else {
                $proxyIp->setActive();
            }
        });
    }
}
