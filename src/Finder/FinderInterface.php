<?php

namespace Smartconnect\Http\FileServer\Finder;

interface FinderInterface
{
    public function find(string $identifier):?FileInfoInterface;
}
