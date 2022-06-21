<?php

namespace Smartconnect\Http\FileServer\Test\Finder;

use PHPUnit\Framework\TestCase;
use Smartconnect\Http\FileServer\Finder\Disk\FileInfo;
use Smartconnect\Http\FileServer\Finder\Disk\Finder;

class DiskFinderTest extends TestCase
{
    public function test_it_finds_file()
    {
        $finder = new Finder(__DIR__.'/bin/');

        $expected = new FileInfo('text/css', __DIR__.'/bin/test.css');
        $this->assertEquals($expected, $finder->find('test.css'));
    }
}
