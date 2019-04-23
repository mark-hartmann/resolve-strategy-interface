# Resolve Strategy Interface

A strategy allows you to resolve a dependency through a user-defined process.  
For example, if a class is instantiated by a static method (e.g. ```::createFromEnvironment)```, this can be resolved by a strategy.

If this is combined with certain conditions such as:
- inherits ```\Request``` or any other class 
- has a certain prefix/suffix
- ...

### Example
```php
use \Hartmann\ResolveStrategy\ResolveStrategyInterface

class ResolveRequestStrategy implements ResolveStrategyInterface
{
    public function resolve(\Psr\Container\ContainerInterface $container, string $class)
    {
        return call_user_func([$class, 'createFromEnvironment'], $container->get('environment'));
    }
}
```