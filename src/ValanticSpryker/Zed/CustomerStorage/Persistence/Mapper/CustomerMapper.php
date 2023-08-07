<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage\Persistence\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\SpyCountryEntityTransfer;
use Generated\Shared\Transfer\SpyCustomerAddressEntityTransfer;
use Generated\Shared\Transfer\SpyCustomerEntityTransfer;
use Generated\Shared\Transfer\SpyCustomerGroupEntityTransfer;
use Generated\Shared\Transfer\SpyCustomerGroupToCustomerEntityTransfer;
use Generated\Shared\Transfer\SpyStoreEntityTransfer;
use Orm\Zed\Customer\Persistence\SpyCustomer;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Map\TableMap;

class CustomerMapper implements CustomerMapperInterface
{
    /**
     * @inheritDoc
     */
    public function mapCustomerEntitiesToCustomerEntityTransfers(Collection $customers): array
    {
        $customerEntityTransfers = [];

        /** @var \Orm\Zed\Customer\Persistence\SpyCustomer $customer */
        foreach ($customers as $customer) {
            $customerEntityTransfers[] = $this->getCustomerEntityTransferForSpyCustomer($customer);
        }

        return $customerEntityTransfers;
    }

    /**
     * @param \Orm\Zed\Customer\Persistence\SpyCustomer $customer
     *
     * @return \Generated\Shared\Transfer\SpyCustomerEntityTransfer
     */
    protected function getCustomerEntityTransferForSpyCustomer(SpyCustomer $customer): SpyCustomerEntityTransfer
    {
        $customerEntityTransfer = (new SpyCustomerEntityTransfer())->fromArray($customer->toArray(), true);

        $customerEntityTransfer->setSpyStore((new SpyStoreEntityTransfer())->fromArray($customer->getSpyStore()->toArray(TableMap::TYPE_CAMELNAME), true));
        if ($customer->getBillingAddress()) {
            $customerEntityTransfer->setBillingAddress((new SpyCustomerAddressEntityTransfer())->fromArray($customer->getBillingAddress()->toArray(TableMap::TYPE_CAMELNAME), true));
            $customerEntityTransfer->getBillingAddress()->setCountry((new SpyCountryEntityTransfer())->fromArray($customer->getBillingAddress()->getCountry()->toArray(TableMap::TYPE_CAMELNAME), true));
        }
        if ($customer->getSpyCustomerGroupToCustomers()->count() > 0) {
            $spyCustomerGroupToCustomer = $customer->getSpyCustomerGroupToCustomers()[0];
            $spyCustomerGroupToCustomerEntityTransfer = (new SpyCustomerGroupToCustomerEntityTransfer())->fromArray($spyCustomerGroupToCustomer->toArray(TableMap::TYPE_CAMELNAME), true);
            if ($spyCustomerGroupToCustomer->getCustomerGroup()) {
                $spyCustomerGroupToCustomerEntityTransfer->setCustomerGroup((new SpyCustomerGroupEntityTransfer())->fromArray($spyCustomerGroupToCustomer->getCustomerGroup()->toArray(TableMap::TYPE_CAMELNAME), true));
            }
            $spyCustomerGroupToCustomerArrayObject = new ArrayObject();
            $spyCustomerGroupToCustomerArrayObject->append($spyCustomerGroupToCustomerEntityTransfer);
            $customerEntityTransfer->setSpyCustomerGroupToCustomers($spyCustomerGroupToCustomerArrayObject);
        }

        return $customerEntityTransfer;
    }

    /**
     * @inheritDoc
     */
    public function mapSpyCustomerToCustomerEntityTransfers(SpyCustomer $customer): array
    {
        return [
            $this->getCustomerEntityTransferForSpyCustomer($customer),
        ];
    }
}
