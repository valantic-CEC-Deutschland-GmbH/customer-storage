<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\CustomerStorage;

use Generated\Shared\Transfer\CustomerStorageTransfer;

interface CustomerStorageClientInterface
{
    /**
     * Specification:
     * - Returns customer data by customer reference string from storage.
     *
     * @api
     *
     * @param string $customerReference
     *
     * @return \Generated\Shared\Transfer\CustomerStorageTransfer|null
     */
    public function getCustomerByReference(string $customerReference): ?CustomerStorageTransfer;
}
