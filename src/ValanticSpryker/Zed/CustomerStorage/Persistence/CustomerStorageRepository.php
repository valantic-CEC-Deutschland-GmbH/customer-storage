<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage\Persistence;

use Generated\Shared\Transfer\FilterTransfer;
use Orm\Zed\Customer\Persistence\SpyCustomer;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \ValanticSpryker\Zed\CustomerStorage\Persistence\CustomerStoragePersistenceFactory getFactory()
 */
class CustomerStorageRepository extends AbstractRepository implements CustomerStorageRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findCustomerStorageEntitiesByCustomerIds(array $customerIds): array
    {
        return $this->getFactory()
            ->createVsyCustomerStorageQuery()
            ->filterByFkCustomer_In($customerIds)
            ->find()
            ->getData();
    }

    /**
     * @param array $customerIds
     *
     * @return array<\Generated\Shared\Transfer\SpyCustomerEntityTransfer>
     */
    public function getCustomerByIds(array $customerIds): array
    {
        $customers = $this->getFactory()
            ->getCustomerQuery(true)
            ->filterByIdCustomer_In($customerIds)
            ->find();

        if ($customers instanceof SpyCustomer) {
            return $this->getFactory()->createCustomerMapper()->mapSpyCustomerToCustomerEntityTransfers($customers);
        }

        return $this->getFactory()->createCustomerMapper()->mapCustomerEntitiesToCustomerEntityTransfers($customers);
    }

    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer[]
     */
    public function findCustomersByFilter(FilterTransfer $filterTransfer): array
    {
        $query = $this->getFactory()->getCustomerQuery();
        $customerEntities = $this->buildQueryFromCriteria($query, $filterTransfer)
            ->setFormatter(ModelCriteria::FORMAT_OBJECT)
            ->find();

        return $this->getFactory()->createCustomerMapper()->mapCustomerEntitiesToCustomerTransfers($customerEntities);
    }
}
