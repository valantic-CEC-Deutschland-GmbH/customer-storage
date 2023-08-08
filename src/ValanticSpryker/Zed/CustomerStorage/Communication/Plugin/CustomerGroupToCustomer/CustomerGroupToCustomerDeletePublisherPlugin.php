<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage\Communication\Plugin\CustomerGroupToCustomer;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherPluginInterface;
use ValanticSpryker\Zed\CustomerStorage\CustomerStorageConfig;

/**
 * @method \ValanticSpryker\Zed\CustomerStorage\Business\CustomerStorageFacadeInterface getFacade()
 * @method \ValanticSpryker\Zed\CustomerStorage\CustomerStorageConfig getConfig()
 * @method \ValanticSpryker\Zed\CustomerStorage\Persistence\CustomerStorageEntityManagerInterface getEntityManager()
 * @method \ValanticSpryker\Zed\CustomerStorage\Persistence\CustomerStorageRepositoryInterface getRepository()
 */
class CustomerGroupToCustomerDeletePublisherPlugin extends AbstractPlugin implements PublisherPluginInterface
{
    /**
     * @inheritDoc
     */
    public function handleBulk(array $eventEntityTransfers, $eventName)
    {
        $this->getFacade()->writeCollectionByCustomerGroupToCustomerEvents($eventEntityTransfers);
    }

    /**
     * @inheritDoc
     */
    public function getSubscribedEvents(): array
    {
        return [
            CustomerStorageConfig::ENTITY_SPY_CUSTOMER_GROUP_TO_CUSTOMER_DELETE,
        ];
    }
}
