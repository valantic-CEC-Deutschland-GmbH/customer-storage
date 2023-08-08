<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage\Business\Mapper;

use Generated\Shared\Transfer\SpyCustomerEntityTransfer;
use Generated\Shared\Transfer\VsyCustomerStorageEntityTransfer;

class CustomerStorageMapper implements CustomerStorageMapperInterface
{
    /**
     * @inheritDoc
     */
    public function mapCustomerEntityTransferToCustomerStorageEntityTransfer(SpyCustomerEntityTransfer $customerEntityTransfer): VsyCustomerStorageEntityTransfer
    {
        $customerStorageEntityTransfer = new VsyCustomerStorageEntityTransfer();
        $customerStorageEntityTransfer->setFkCustomer($customerEntityTransfer->getIdCustomer());
        $customerStorageEntityTransfer->setCustomerReference($customerEntityTransfer->getCustomerReference());

        $data = $this->getCustomerStorageData($customerEntityTransfer);
        $customerStorageEntityTransfer->setData(json_encode($data) ?: null);

        return $customerStorageEntityTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\SpyCustomerEntityTransfer $customerEntityTransfer
     *
     * @return array
     */
    protected function getCustomerStorageData(SpyCustomerEntityTransfer $customerEntityTransfer): array
    {
        $data = [];
        $data['idCustomer'] = $customerEntityTransfer->getIdCustomer();
        $data['customerGroup'] = ($customerEntityTransfer->getSpyCustomerGroupToCustomers()->count() > 0) ? ($customerEntityTransfer->getSpyCustomerGroupToCustomers()[0]->getCustomerGroup()?->getName()) : null;
        $data['country'] = $customerEntityTransfer->getBillingAddress()?->getCountry()?->getName();
        $data['zipCode'] = $customerEntityTransfer->getBillingAddress()?->getZipCode();

        return $data;
    }
}
