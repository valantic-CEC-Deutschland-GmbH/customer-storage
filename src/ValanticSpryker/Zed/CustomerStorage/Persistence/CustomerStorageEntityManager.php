<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \ValanticSpryker\Zed\CustomerStorage\Persistence\CustomerStoragePersistenceFactory getFactory()
 */
class CustomerStorageEntityManager extends AbstractEntityManager implements CustomerStorageEntityManagerInterface
{
    /**
     * @inheritDoc
     */
    public function saveCustomerStorageEntities(array $customerStorageEntityTransfers): void
    {
        foreach ($customerStorageEntityTransfers as $customerStorageEntityTransfer) {
            $vsyCustomerStorageEntity = $this->getFactory()
                ->createCustomerStorageQuery()
                ->filterByFkCustomer($customerStorageEntityTransfer->getFkCustomer())
                ->filterByCustomerReference($customerStorageEntityTransfer->getCustomerReference())
                ->findOneOrCreate();

            $vsyCustomerStorageEntity->fromArray($customerStorageEntityTransfer->toArray());

            $vsyCustomerStorageEntity->save();
        }
    }

    /**
     * @param int $fkCustomer
     *
     * @return void
     */
    public function deleteCustomerStorageEntity(int $fkCustomer): void
    {
        $this->getFactory()->createCustomerStorageQuery()->findOneByFkCustomer($fkCustomer)?->delete();
    }

    /**
     * @inheritDoc
     */
    public function deleteCustomerStorageCollection(array $customerIds): void
    {
        foreach ($customerIds as $idCustomer) {
            $this->deleteCustomerStorageEntity($idCustomer);
        }
    }
}
