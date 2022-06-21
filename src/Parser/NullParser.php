<?php

namespace Smartconnect\Http\FileServer\Parser;

class NullParser implements ParserInterface
{
    public function parse(string $content): string
    {
        return $content;
    }
}
