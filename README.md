# Resolve Strategy Interface

A strategy allows you to resolve a dependency through a user-defined process.  

For example, if there are multiple request classes (```CreateUserRequest```, ```DeletePostRequest```, ...) that inherit from ```Request``` and are created in the same way  
(for example using the ```::createFromEnvironment``` method), you can do the following with a ResolveStrategy:

```php
use \Hartmann\ResolveStrategy\ResolveStrategyInterface

class ResolveRequestStrategy implements ResolveStrategyInterface
{
    /**
     * Checks wether the given class can be resolved by this strategy
     *
     * @param string $class The fully qualified namespace of the class to be resolved
     *
     * @return bool
     */
    public function suitable(string $class): bool
    {
        return method_exists($class, 'createFromEnvironment') && preg_match('/^.+?Request$/') === 1;
    }

    /**
     * A strategy allows you to resolve a dependency through a user-defined process.
     * For example, if a class is instantiated by a static method (e.g. ::createFromEnvironment), this can be resolved by a strategy.
     *
     * @param \Psr\Container\ContainerInterface $container The instance of the PSR-11 container
     * @param string                            $class     The fully qualified namespace of the class to be resolved
     *
     * @return object The instance of the requested class
     */
    public function resolve(\Psr\Container\ContainerInterface $container, string $class)
    {
        return call_user_func([$class, 'createFromEnvironment'], $container->get('environment'));
    }
}
```