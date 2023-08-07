<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage\Persistence;

interface CustomerStorageEntityManagerInterface
{
    /**
     * @param int $fkCustomer
     *
     * @return void
     */
    public function deleteCustomerStorageEntity(int $fkCustomer): void;

    /**
     * @param array $customerStorageEntityTransfers
     *
     * @return void
     */
    public function saveCustomerStorageEntities(array $customerStorageEntityTransfers): void;

    /**
     * @param array $customerIds
     *
     * @return void
     */
    public function deleteCustomerStorageCollection(array $customerIds): void;
}
