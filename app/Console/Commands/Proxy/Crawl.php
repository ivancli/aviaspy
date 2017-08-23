<?php

namespace App\Console\Commands\Proxy;

use App\Contracts\Repositories\Proxy\ProxyIpContract;
use Illuminate\Console\Command;
use IvanCLI\ProxyCrawler\Repositories\DefaultCrawler;
use IvanCLI\ProxyCrawler\Repositories\IdCloak;
use IvanCLI\ProxyCrawler\Repositories\XRoxy;

class Crawl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proxy:crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command crawl proxy IP from various webpages';

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
     * @return void
     */
    public function handle()
    {
        $idCloak = app()->make(IdCloak::class);
        $this->crawlOneSite($idCloak);

        $xRoxy = app()->make(XRoxy::class);
        $this->crawlOneSite($xRoxy);
    }

    /**
     * crawl proxy ips from single website
     * @param DefaultCrawler $crawler
     */
    protected function crawlOneSite(DefaultCrawler $crawler)
    {
        $proxies = $crawler->getProxies();
        foreach ($proxies as $proxy) {
            $proxy->provider = get_class($crawler);
            $this->proxyIpRepo->store((array)$proxy);
        }
    }
}
