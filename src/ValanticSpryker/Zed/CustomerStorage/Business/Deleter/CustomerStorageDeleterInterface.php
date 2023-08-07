<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage\Business\Deleter;

interface CustomerStorageDeleterInterface
{
    /**
     * @param array $eventEntityTransfers
     *
     * @return void
     */
    public function deleteCollectionByCustomerEvents(array $eventEntityTransfers): void;

    /**
     * @param array $eventEntityTransfers
     *
     * @return void
     */
    public function deleteCollectionByCustomerGroupToCustomerEvents(array $eventEntityTransfers): void;
}
