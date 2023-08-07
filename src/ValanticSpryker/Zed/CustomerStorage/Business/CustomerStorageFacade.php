<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \ValanticSpryker\Zed\CustomerStorage\Business\CustomerStorageBusinessFactory getFactory()
 * @method \ValanticSpryker\Zed\CustomerStorage\Persistence\CustomerStorageEntityManagerInterface getEntityManager()
 * @method \ValanticSpryker\Zed\CustomerStorage\Persistence\CustomerStorageRepositoryInterface getRepository()
 */
class CustomerStorageFacade extends AbstractFacade implements CustomerStorageFacadeInterface
{
    /**
     * @inheritDoc
     */
    public function writeCollectionByCustomerEvents(array $eventEntityTransfers): void
    {
        $this->getFactory()->createCustomerStorageWriter()->writeCollectionByCustomerEvents($eventEntityTransfers);
    }

    /**
     * @inheritDoc
     */
    public function writeCollectionByCustomerGroupToCustomerEvents(array $eventTransfers): void
    {
        $this->getFactory()->createCustomerStorageWriter()->writeCollectionByCustomerGroupToCustomerEvents($eventTransfers);
    }

    /**
     * @inheritDoc
     */
    public function deleteCustomerStorageCollectionByCustomerEvents(array $eventEntityTransfers): void
    {
        $this->getFactory()->createCustomerStorageDeleter()->deleteCollectionByCustomerEvents($eventEntityTransfers);
    }

    /**
     * @inheritDoc
     */
    public function writeCustomerStorageCollectionByCustomerAddressEvents(array $eventEntityTransfers): void
    {
        $this->getFactory()->createCustomerStorageWriter()->writeCustomerStorageCollectionByCustomerAddressEvents($eventEntityTransfers);
    }

    /**
     * @inheritDoc
     */
    public function deleteCustomerStorageCollectionByCustomerGroupToCustomerEvents(array $eventEntityTransfers): void
    {
        $this->getFactory()->createCustomerStorageDeleter()->deleteCollectionByCustomerGroupToCustomerEvents($eventEntityTransfers);
    }
}
