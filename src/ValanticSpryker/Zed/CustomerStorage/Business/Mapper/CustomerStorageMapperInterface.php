<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage\Business\Mapper;

use Generated\Shared\Transfer\SpyCustomerEntityTransfer;
use Generated\Shared\Transfer\VsyCustomerStorageEntityTransfer;

interface CustomerStorageMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\SpyCustomerEntityTransfer $customerEntityTransfer
     *
     * @return \Generated\Shared\Transfer\VsyCustomerStorageEntityTransfer
     */
    public function mapCustomerEntityTransferToCustomerStorageEntityTransfer(SpyCustomerEntityTransfer $customerEntityTransfer): VsyCustomerStorageEntityTransfer;
}
