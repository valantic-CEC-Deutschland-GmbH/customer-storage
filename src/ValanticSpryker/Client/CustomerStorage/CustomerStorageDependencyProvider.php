<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\CustomerStorage;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class CustomerStorageDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_STORAGE = 'CLIENT_STORAGE';
    public const SERVICE_SYNCHRONIZATION = 'SERVICE_SYNCHRONIZATION';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);
        $container = $this->addStorageClient($container);
        $container = $this->addSynchronizationService($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    private function addStorageClient(Container $container): Container
    {
        $container->set(
            static::CLIENT_STORAGE,
            fn (Container $container) => $container->getLocator()->storage()->client(),
        );

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    private function addSynchronizationService(Container $container): Container
    {
        $container->set(
            static::SERVICE_SYNCHRONIZATION,
            fn (Container $container) => $container->getLocator()->synchronization()->service(),
        );

        return $container;
    }
}
