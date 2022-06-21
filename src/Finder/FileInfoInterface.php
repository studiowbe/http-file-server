<?php

namespace Smartconnect\Http\FileServer\Finder;

interface FileInfoInterface
{
    public function getMime():string;

    public function getContent():string;
}
