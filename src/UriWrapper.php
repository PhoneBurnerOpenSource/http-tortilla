<?php

namespace PhoneBurner\Http\Message;

use Psr\Http\Message\UriInterface;

trait UriWrapper
{
    private $wrapped;
    private $factory;

    protected function setFactory(callable $factory)
    {
        $this->factory = $factory;
    }

    private function viaFactory(UriInterface $uri)
    {
        if (!$this->factory) {
            return $uri;
        }

        return call_user_func($this->factory, $uri);
    }

    protected function setWrapped(UriInterface $uri)
    {
        $this->wrapped = $uri;
    }

    private function getWrapped(): UriInterface
    {
        if (!($this->wrapped instanceof UriInterface)) {
            throw new \UnexpectedValueException('must `setUri` before using it');
        }

        return $this->wrapped;
    }

    public function getScheme(): string
    {
        return $this->getWrapped()->getScheme();
    }

    public function getAuthority(): string
    {
        return $this->getWrapped()->getAuthority();
    }

    public function getUserInfo(): string
    {
        return $this->getWrapped()->getUserInfo();
    }

    public function getHost(): string
    {
        return $this->getWrapped()->getHost();
    }

    public function getPort(): ?int
    {
        return $this->getWrapped()->getPort();
    }

    public function getPath(): string
    {
        return $this->getWrapped()->getPath();
    }

    public function getQuery(): string
    {
        return $this->getWrapped()->getQuery();
    }

    public function getFragment(): string
    {
        return $this->getWrapped()->getFragment();
    }

    public function withScheme($scheme): UriInterface
    {
        return $this->viaFactory($this->getWrapped()->withScheme($scheme));
    }

    public function withUserInfo($user, $password = null): UriInterface
    {
        return $this->viaFactory($this->getWrapped()->withUserInfo($user, $password));
    }

    public function withHost($host): UriInterface
    {
        return $this->viaFactory($this->getWrapped()->withHost($host));
    }

    public function withPort($port): UriInterface
    {
        return $this->viaFactory($this->getWrapped()->withPort($port));
    }

    public function withPath($path): UriInterface
    {
        return $this->viaFactory($this->getWrapped()->withPath($path));
    }

    public function withQuery($query): UriInterface
    {
        return $this->viaFactory($this->getWrapped()->withQuery($query));
    }

    public function withFragment($fragment): UriInterface
    {
        return $this->viaFactory($this->getWrapped()->withFragment($fragment));
    }

    public function __toString(): string
    {
        return $this->getWrapped()->__toString();
    }
}