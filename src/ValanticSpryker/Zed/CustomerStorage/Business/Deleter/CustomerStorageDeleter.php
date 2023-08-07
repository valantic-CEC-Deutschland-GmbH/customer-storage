<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage\Business\Deleter;

use Orm\Zed\CustomerGroup\Persistence\Map\SpyCustomerGroupToCustomerTableMap;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;
use ValanticSpryker\Zed\CustomerStorage\Persistence\CustomerStorageEntityManagerInterface;

class CustomerStorageDeleter implements CustomerStorageDeleterInterface
{
    /**
     * @param \ValanticSpryker\Zed\CustomerStorage\Persistence\CustomerStorageEntityManagerInterface $entityManager
     * @param \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface $eventBehaviorFacade
     */
    public function __construct(private CustomerStorageEntityManagerInterface $entityManager, private EventBehaviorFacadeInterface $eventBehaviorFacade)
    {
    }

    /**
     * @param array $eventEntityTransfers
     *
     * @return void
     */
    public function deleteCollectionByCustomerEvents(array $eventEntityTransfers): void
    {
        $customerIds = $this->eventBehaviorFacade->getEventTransferIds($eventEntityTransfers);

        $this->entityManager->deleteCustomerStorageCollection($customerIds);
    }

    /**
     * @inheritDoc
     */
    public function deleteCollectionByCustomerGroupToCustomerEvents(array $eventEntityTransfers): void
    {
        $customerIds = $this->eventBehaviorFacade->getEventTransferForeignKeys($eventEntityTransfers, SpyCustomerGroupToCustomerTableMap::COL_FK_CUSTOMER);

        $this->entityManager->deleteCustomerStorageCollection($customerIds);
    }
}
