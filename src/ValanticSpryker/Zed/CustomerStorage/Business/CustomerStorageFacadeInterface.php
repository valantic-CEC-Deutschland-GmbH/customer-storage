<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage\Business;

interface CustomerStorageFacadeInterface
{
    /**
     * @param array $eventEntityTransfers
     *
     * @return void
     */
    public function writeCollectionByCustomerEvents(array $eventEntityTransfers): void;

    /**
     * @param array $eventTransfers
     *
     * @return void
     */
    public function writeCollectionByCustomerGroupToCustomerEvents(array $eventTransfers): void;

    /**
     * @param array $eventEntityTransfers
     *
     * @return void
     */
    public function deleteCustomerStorageCollectionByCustomerEvents(array $eventEntityTransfers): void;

    /**
     * @param array $eventEntityTransfers
     *
     * @return void
     */
    public function writeCustomerStorageCollectionByCustomerAddressEvents(array $eventEntityTransfers): void;

    /**
     * @param array $eventEntityTransfers
     *
     * @return void
     */
    public function deleteCustomerStorageCollectionByCustomerGroupToCustomerEvents(
        array $eventEntityTransfers
    ): void;
}
