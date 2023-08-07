<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage\Communication\Plugin\Customer;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherPluginInterface;
use ValanticSpryker\Zed\CustomerStorage\CustomerStorageConfig;

/**
 * @method \ValanticSpryker\Zed\CustomerStorage\Business\CustomerStorageFacadeInterface getFacade()
 * @method \ValanticSpryker\Zed\CustomerStorage\CustomerStorageConfig getConfig()
 * @method \ValanticSpryker\Zed\CustomerStorage\Persistence\CustomerStorageEntityManagerInterface getEntityManager()
 * @method \ValanticSpryker\Zed\CustomerStorage\Persistence\CustomerStorageRepositoryInterface getRepository()
 */
class CustomerDeletePublisherPlugin extends AbstractPlugin implements PublisherPluginInterface
{
    /**
     * @inheritDoc
     */
    public function handleBulk(array $eventEntityTransfers, $eventName)
    {
        $this->getFacade()->deleteCustomerStorageCollectionByCustomerEvents($eventEntityTransfers);
    }

    /**
     * @return array<string>
     */
    public function getSubscribedEvents(): array
    {
        return [
            CustomerStorageConfig::ENTITY_SPY_CUSTOMER_DELETE,
        ];
    }
}
