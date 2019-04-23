<?php

namespace Hartmann\ResolveStrategy;


use Psr\Container\ContainerInterface;

interface ResolveStrategyInterface
{
    /**
     * Checks wether the given class can be resolved by this strategy
     *
     * @param string $class The fully qualified namespace of the class to be resolved
     *
     * @return bool
     */
    public function suitable(string $class): bool;

    /**
     * A strategy allows you to resolve a dependency through a user-defined process.
     * For example, if a class is instantiated by a static method (e.g. ::createFromEnvironment), this can be resolved by a strategy.
     *
     * @param \Psr\Container\ContainerInterface $container The instance of the PSR-11 container
     * @param string                            $class     The fully qualified namespace of the class to be resolved
     *
     * @return object The instance of the requested class
     */
    public function resolve(ContainerInterface $container, string $class);
}