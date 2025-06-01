<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @see https://symfony.com/doc/current/deployment/proxies.html 
     */
    protected $headers =
        \Illuminate\Http\Middleware\TrustProxies::HEADER_X_FORWARDED_FOR |
        \Illuminate\Http\Middleware\TrustProxies::HEADER_X_FORWARDED_HOST |
        \Illuminate\Http\Middleware\TrustProxies::HEADER_X_FORWARDED_PORT |
        \Illuminate\Http\Middleware\TrustProxies::HEADER_X_FORWARDED_PROTO |
        \Illuminate\Http\Middleware\TrustProxies::HEADER_X_FORWARDED_AWS_ELB;
}