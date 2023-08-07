<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\CustomerStorage\Reader;

use Generated\Shared\Transfer\CustomerStorageTransfer;

interface CustomerStorageReaderInterface
{
    /**
     * @param string $customerReference
     *
     * @return \Generated\Shared\Transfer\CustomerStorageTransfer|null
     */
    public function getCustomerByReference(string $customerReference): ?CustomerStorageTransfer;
}
