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
class CustomerWritePublisherPlugin extends AbstractPlugin implements PublisherPluginInterface
{
    /**
     * @param array $eventEntityTransfers
     * @param $eventName
     *
     * @return void
     */
    public function handleBulk(array $eventEntityTransfers, $eventName): void
    {
        $this->getFacade()->writeCollectionByCustomerEvents($eventEntityTransfers);
    }

    /**
     * @return array<string>
     */
    public function getSubscribedEvents(): array
    {
        return [
            CustomerStorageConfig::PUBLISH_CUSTOMER_WRITE,
            CustomerStorageConfig::ENTITY_SPY_CUSTOMER_CREATE,
            CustomerStorageConfig::ENTITY_SPY_CUSTOMER_UPDATE,
        ];
    }
}
