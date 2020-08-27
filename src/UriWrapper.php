<?php

namespace PhoneBurner\Http\Message;

use Psr\Http\Message\UriInterface;

trait UriWrapper
{
    private $uri;
    private $uriFactory;

    protected function setFactory(callable $factory)
    {
        $this->uriFactory = $factory;
    }

    private function viaFactory(UriInterface $uri)
    {
        if (!$this->uriFactory) {
            return $uri;
        }

        return call_user_func($this->uriFactory, $uri);
    }

    protected function setUri(UriInterface $uri)
    {
        $this->uri = $uri;
    }

    private function getUri(): UriInterface
    {
        if (!($this->uri instanceof UriInterface)) {
            throw new \UnexpectedValueException('must `setUri` before using it');
        }

        return $this->uri;
    }

    public function getScheme(): string
    {
        return $this->getUri()->getScheme();
    }

    public function getAuthority(): string
    {
        return $this->getUri()->getAuthority();
    }

    public function getUserInfo(): string
    {
        return $this->getUri()->getUserInfo();
    }

    public function getHost(): string
    {
        return $this->getUri()->getHost();
    }

    public function getPort(): ?int
    {
        return $this->getUri()->getPort();
    }

    public function getPath(): string
    {
        return $this->getUri()->getPath();
    }

    public function getQuery(): string
    {
        return $this->getUri()->getQuery();
    }

    public function getFragment(): string
    {
        return $this->getUri()->getFragment();
    }

    public function withScheme($scheme): UriInterface
    {
        return $this->viaFactory($this->getUri()->withScheme($scheme));
    }

    public function withUserInfo($user, $password = null): UriInterface
    {
        return $this->viaFactory($this->getUri()->withUserInfo($user, $password));
    }

    public function withHost($host): UriInterface
    {
        return $this->viaFactory($this->getUri()->withHost($host));
    }

    public function withPort($port): UriInterface
    {
        return $this->viaFactory($this->getUri()->withPort($port));
    }

    public function withPath($path): UriInterface
    {
        return $this->viaFactory($this->getUri()->withPath($path));
    }

    public function withQuery($query): UriInterface
    {
        return $this->viaFactory($this->getUri()->withQuery($query));
    }

    public function withFragment($fragment): UriInterface
    {
        return $this->viaFactory($this->getUri()->withFragment($fragment));
    }

    public function __toString(): string
    {
        return $this->getUri()->__toString();
    }
}