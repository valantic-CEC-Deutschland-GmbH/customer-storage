<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage\Persistence;

interface CustomerStorageRepositoryInterface
{
    /**
     * @param array $customerIds
     *
     * @return array<\Generated\Shared\Transfer\VsyCustomerStorageEntityTransfer>
     */
    public function findCustomerStorageEntitiesByCustomerIds(array $customerIds): array;

    /**
     * @param array $customerIds
     *
     * @return array<\Generated\Shared\Transfer\SpyCustomerEntityTransfer>
     */
    public function getCustomerByIds(array $customerIds): array;
}
