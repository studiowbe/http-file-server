<?php

namespace Smartconnect\Http\FileServer\Resolver;

use Psr\Http\Message\ServerRequestInterface;

class AttributeResolver implements ResolverInterface
{
    private $attributeName;

    public function __construct(string $attributeName)
    {
        $this->attributeName = $attributeName;
    }

    public function resolve(ServerRequestInterface $request): ?string
    {
        $attr = $request->getAttribute($this->attributeName, null);

        return empty($attr) ? null : $attr;
    }
}
