<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage\Persistence;

use Generated\Shared\Transfer\FilterTransfer;

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

    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer[]
     */
    public function findCustomersByFilter(FilterTransfer $filterTransfer): array;
}
