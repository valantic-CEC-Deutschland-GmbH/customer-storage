<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage\Communication\CustomerGroup;

use Generated\Shared\Transfer\EventEntityTransfer;
use Orm\Zed\CustomerGroup\Persistence\SpyCustomerGroupToCustomer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use ValanticSpryker\Zed\CustomerGroup\Dependency\Plugin\CustomerGroupDeleteEventPluginInterface;

/**
 * @method \ValanticSpryker\Zed\CustomerStorage\Business\CustomerStorageFacadeInterface getFacade()
 * @method \ValanticSpryker\Zed\CustomerStorage\CustomerStorageConfig getConfig()
 * @method \ValanticSpryker\Zed\CustomerStorage\Persistence\CustomerStorageEntityManagerInterface getEntityManager()
 * @method \ValanticSpryker\Zed\CustomerStorage\Persistence\CustomerStorageRepositoryInterface getRepository()
 */
class CustomerGroupDeleteEventPlugin extends AbstractPlugin implements CustomerGroupDeleteEventPluginInterface
{
    /**
     * @param \Orm\Zed\CustomerGroup\Persistence\SpyCustomerGroupToCustomer $customerGroupToCustomer
     *
     * @return void
     */
    public function raiseEvent(SpyCustomerGroupToCustomer $customerGroupToCustomer): void
    {
        $eventTransfers = [];

        $eventTransfers[] = (new EventEntityTransfer())->setId($customerGroupToCustomer->getFkCustomer());

        $this->getFacade()->writeCollectionByCustomerEvents($eventTransfers);
    }
}
