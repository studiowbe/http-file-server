<?php

namespace Smartconnect\Http\FileServer\Resolver;

use Psr\Http\Message\ServerRequestInterface;

interface ResolverInterface
{
    public function resolve(ServerRequestInterface $request):?string;
}
