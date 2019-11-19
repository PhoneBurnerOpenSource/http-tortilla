Burrito - HTTP Message (PSR-7) Wrapper
======================================

This library provides a simple set of traits to allow wrapping (or 
decoration) of various PSR-7 classes. Wrapping the classes allows easy
addition of convenience methods while maintaining compatibility with
code that relies on the underlying PSR interfaces.

Usage
-----
To add behaviour to a PSR7 object that implements `MessageInterface` or
one of its subclasses `use` the matching wrapper trait, and call
`setMessage($message)` to wrap the target object.

Once `setMessage($message)` is called all interface methods will be
proxied to the original object. Any of those methods can be redefined,
however, most usage will probably be adding _additional_ convenience
methods to the object.

Because most `with*()` methods will likely evolve the _wrapped_ object
as the method is proxied to that underlying object. To maintain the
wrapping through various calls to `with*()`, `setFactory($callable)`
allows a callable that returns a wrapped object when given the product
of the underlying `with*()` message.

If the underlying object needs to be accessed, `getMessage()` may be
used.

```php
class Request implements ServerRequestInterface
{
    use ServerRequestWrapper;
    
    public function __construct(ServerRequestInterface $request) 
    {
        // wrap this object, and proxy all the interface methods to it
        $this->setMessage($request); 
        
        // wrap all proxied `with*` methods in this function 
        $this->setFactory(function(ServerRequestInterface $request){
            // now `with*` will return an instnace of the current class
            return new self($request); 
        });
    }
}
```

Example
-------
Perhaps it would be convenient to access query parameters as a
collection (and not the interface's `array`):

```php
class Request implements ServerRequestInterface
{
    use ServerRequestWrapper;
    
    public function __construct(ServerRequestInterface $request) 
    {
        // wrap this object, and proxy all the interface methods to it
        $this->setMessage($request); 
        
        // wrap all proxied `with*` methods in this function 
        $this->setFactory(function(ServerRequestInterface $request){
            // now `with*` will return an instnace of the current class
            return new self($request); 
        });
    }
    
    public function getQueryCollection()
    {
        return new Collection($this->getQueryParams());
    }
}
```

Or perhaps the underlying library doesn't handle parsing JSON requests:

```php
class Request implements ServerRequestInterface
{
    use ServerRequestWrapper;
    
    public function __construct(ServerRequestInterface $request) 
    {
        // wrap this object, and proxy all the interface methods to it
        $this->setMessage($request); 
        
        // wrap all proxied `with*` methods in this function 
        $this->setFactory(function(ServerRequestInterface $request){
            // now `with*` will return an instnace of the current class
            return new self($request); 
        });
    }
    
    public function getParsedBody()
    {
        if ($parsed = $this->getMessage()->getParsedBody()) {
            return $parsed;
        }
        
        $decoded = json_decode($this->getBody(), true);

        if (json_last_error() == JSON_ERROR_NONE) {
            return $decoded;
        }
        
        return $parsed;
    }
}
```