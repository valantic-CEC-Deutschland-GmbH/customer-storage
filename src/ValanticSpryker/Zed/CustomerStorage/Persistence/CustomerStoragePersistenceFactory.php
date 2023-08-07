<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage\Persistence;

use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Orm\Zed\CustomerStorage\Persistence\VsyCustomerStorageQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use ValanticSpryker\Zed\CustomerStorage\Persistence\Mapper\CustomerMapper;
use ValanticSpryker\Zed\CustomerStorage\Persistence\Mapper\CustomerMapperInterface;

/**
 * @method \ValanticSpryker\Zed\CustomerStorage\CustomerStorageConfig getConfig()
 * @method \ValanticSpryker\Zed\CustomerStorage\Persistence\CustomerStorageEntityManagerInterface getEntityManager()
 * @method \ValanticSpryker\Zed\CustomerStorage\Persistence\CustomerStorageRepositoryInterface getRepository()
 */
class CustomerStoragePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CustomerStorage\Persistence\VsyCustomerStorageQuery
     */
    public function createVsyCustomerStorageQuery(): VsyCustomerStorageQuery
    {
        return VsyCustomerStorageQuery::create();
    }

    /**
     * @param bool $withAnonymized
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function getCustomerQuery(bool $withAnonymized = false): SpyCustomerQuery
    {
        return SpyCustomerQuery::create(withAnonymized: $withAnonymized);
    }

    /**
     * @return \Orm\Zed\CustomerStorage\Persistence\VsyCustomerStorageQuery
     */
    public function createCustomerStorageQuery(): VsyCustomerStorageQuery
    {
        return VsyCustomerStorageQuery::create();
    }

    /**
     * @return \ValanticSpryker\Zed\CustomerStorage\Persistence\Mapper\CustomerMapperInterface
     */
    public function createCustomerMapper(): CustomerMapperInterface
    {
        return new CustomerMapper();
    }
}
