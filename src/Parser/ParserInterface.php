<?php

namespace Smartconnect\Http\FileServer\Parser;

interface ParserInterface
{
    public function parse(string $content):string;
}
