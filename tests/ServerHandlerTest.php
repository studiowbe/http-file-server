<?php

namespace Smartconnect\Http\FileServer\Test;

use Http\Factory\Guzzle\ResponseFactory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Smartconnect\Http\FileServer\Finder\FileInfoInterface;
use Smartconnect\Http\FileServer\Finder\FinderInterface;
use Smartconnect\Http\FileServer\Parser\ParserInterface;
use Smartconnect\Http\FileServer\Resolver\ResolverInterface;
use Smartconnect\Http\FileServer\ServerHandler;

class ServerHandlerTest extends TestCase
{
    public function test_it_handles_request()
    {
        $identifier = 'my-file';
        $mime = 'my-mime';
        $content = 'my-content';

        $resolver = $this->createMock(ResolverInterface::class);
        $finder = $this->createMock(FinderInterface::class);
        $parser = $this->createMock(ParserInterface::class);
        $request = $this->createMock(ServerRequestInterface::class);
        $fileInfo = $this->createMock(FileInfoInterface::class);
        $fileInfo->expects($this->once())->method('getMime')->willReturn($mime);
        $fileInfo->expects($this->once())->method('getContent')->willReturn($content);

        $resolver->expects($this->once())->method('resolve')->with($request)->willReturn($identifier);
        $finder->expects($this->once())->method('find')->with($identifier)->willReturn($fileInfo);
        $parser->expects($this->once())->method('parse')->with($content)->willReturn($content);

        $handler = new ServerHandler(
            $resolver, $finder, $parser, new ResponseFactory()
        );

        $response = $handler->handle($request);

        $this->assertEquals([$mime], $response->getHeader('Content-Type'));
        $response->getBody()->rewind();
        $this->assertEquals($content, $response->getBody()->getContents());
    }
}
