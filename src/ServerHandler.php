<?php

namespace Smartconnect\Http\FileServer;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Smartconnect\Http\FileServer\Finder\FinderInterface;
use Smartconnect\Http\FileServer\Parser\ParserInterface;
use Smartconnect\Http\FileServer\Resolver\ResolverInterface;
use Studiow\Http\Exceptions\ClientError\NotFoundException;

class ServerHandler implements RequestHandlerInterface
{
    private $resolver;

    private $finder;

    private $parser;

    private $responseFactory;

    public function __construct(
        ResolverInterface $resolver,
        FinderInterface $finder,
        ParserInterface $parser,
        ResponseFactoryInterface $responseFactory
    ) {
        $this->resolver = $resolver;
        $this->finder = $finder;
        $this->parser = $parser;
        $this->responseFactory = $responseFactory;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = $this->responseFactory->createResponse();
        $identifier = $this->resolver->resolve($request);

        if (is_null($identifier)) {
            throw new NotFoundException();
        }

        $info = $this->finder->find($identifier);
        if (is_null($info)) {
            throw new NotFoundException();
        }

        $response->getBody()->write(
            $this->parser->parse(
                $info->getContent()
            )
        );

        return $response->withAddedHeader('Content-Type', $info->getMime());
    }
}
