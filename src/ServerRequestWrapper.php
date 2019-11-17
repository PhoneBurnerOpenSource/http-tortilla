<?php
namespace PhoneBurner\Http\Message;

use Psr\Http\Message\ServerRequestInterface;

trait ServerRequestWrapper
{
    use RequestWrapper;

    private $message;

    protected function setMessage(ServerRequestInterface $message): void
    {
        $this->message = $message;
    }

    private function getMessage(): ServerRequestInterface
    {
        if (!($this->message instanceof ServerRequestInterface)) {
            throw new \UnexpectedValueException('must `setMessage` before using it');
        }

        return $this->message;
    }

    public function getServerParams()
    {
        return $this->getMessage()->getServerParams();
    }

    public function getCookieParams()
    {
        return $this->getMessage()->getCookieParams();
    }

    public function withCookieParams(array $cookies)
    {
        return $this->viaFactory($this->getMessage()->withCookieParams($cookies));
    }

    public function getQueryParams()
    {
        return $this->getMessage()->getQueryParams();
    }

    public function withQueryParams(array $query)
    {
        return $this->viaFactory($this->getMessage()->withQueryParams($query));
    }

    public function getUploadedFiles()
    {
        return $this->getMessage()->getUploadedFiles();
    }

    public function withUploadedFiles(array $uploadedFiles)
    {
        return $this->viaFactory($this->getMessage()->withUploadedFiles($uploadedFiles));
    }

    public function getParsedBody()
    {
        return $this->getMessage()->getParsedBody();
    }

    public function withParsedBody($data)
    {
        return $this->viaFactory($this->getMessage()->withParsedBody($data));
    }

    public function getAttributes()
    {
        return $this->getMessage()->getAttributes();
    }

    public function getAttribute($name, $default = null)
    {
        return $this->getMessage()->getAttribute($name, $default);
    }

    public function withAttribute($name, $value)
    {
        return $this->viaFactory($this->getMessage()->withAttribute($name, $value));
    }

    public function withoutAttribute($name)
    {
        return $this->viaFactory($this->getMessage()->withoutAttribute($name));
    }
}
