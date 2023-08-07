<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage\Persistence\Mapper;

use Orm\Zed\Customer\Persistence\SpyCustomer;
use Propel\Runtime\Collection\Collection;

interface CustomerMapperInterface
{
    /**
     * @param \Propel\Runtime\Collection\Collection $customers
     *
     * @return array<\Generated\Shared\Transfer\SpyCustomerEntityTransfer>
     */
    public function mapCustomerEntitiesToCustomerEntityTransfers(Collection $customers): array;

    /**
     * @param \Orm\Zed\Customer\Persistence\SpyCustomer $customer
     *
     * @return array<\Generated\Shared\Transfer\SpyCustomerEntityTransfer>
     */
    public function mapSpyCustomerToCustomerEntityTransfers(SpyCustomer $customer): array;

    /**
     * @param \Propel\Runtime\Collection\Collection $customers
     *
     * @return array
     */
    public function mapCustomerEntitiesToCustomerTransfers(Collection $customers): array;
}
