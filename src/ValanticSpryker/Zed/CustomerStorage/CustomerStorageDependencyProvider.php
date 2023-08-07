<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage;

use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \ValanticSpryker\Zed\CustomerStorage\CustomerStorageConfig getConfig()
 */
class CustomerStorageDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_EVENT_BEHAVIOR = 'FACADE_EVENT_BEHAVIOR';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addEventBehaviorFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    private function addEventBehaviorFacade(Container $container): Container
    {
        $container->set(
            static::FACADE_EVENT_BEHAVIOR,
            fn (Container $container): EventBehaviorFacadeInterface => $container->getLocator()->eventBehavior()->facade(),
        );

        return $container;
    }
}
