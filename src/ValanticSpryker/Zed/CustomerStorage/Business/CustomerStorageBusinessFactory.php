<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage\Business;

use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use ValanticSpryker\Zed\CustomerStorage\Business\Deleter\CustomerStorageDeleter;
use ValanticSpryker\Zed\CustomerStorage\Business\Deleter\CustomerStorageDeleterInterface;
use ValanticSpryker\Zed\CustomerStorage\Business\Mapper\CustomerStorageMapper;
use ValanticSpryker\Zed\CustomerStorage\Business\Mapper\CustomerStorageMapperInterface;
use ValanticSpryker\Zed\CustomerStorage\Business\Writer\CustomerStorageWriter;
use ValanticSpryker\Zed\CustomerStorage\Business\Writer\CustomerStorageWriterInterface;
use ValanticSpryker\Zed\CustomerStorage\CustomerStorageDependencyProvider;

/**
 * @method \ValanticSpryker\Zed\CustomerStorage\Persistence\CustomerStorageEntityManagerInterface getEntityManager()
 * @method \ValanticSpryker\Zed\CustomerStorage\Persistence\CustomerStorageRepositoryInterface getRepository()
 * @method \ValanticSpryker\Zed\CustomerStorage\CustomerStorageConfig getConfig()
 */
class CustomerStorageBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \ValanticSpryker\Zed\CustomerStorage\Business\Writer\CustomerStorageWriterInterface
     */
    public function createCustomerStorageWriter(): CustomerStorageWriterInterface
    {
        return new CustomerStorageWriter(
            $this->getEntityManager(),
            $this->getEventBehaviorFacade(),
            $this->getRepository(),
            $this->createCustomerStorageMapper(),
        );
    }

    /**
     * @return \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    private function getEventBehaviorFacade(): EventBehaviorFacadeInterface
    {
        return $this->getProvidedDependency(CustomerStorageDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }

    /**
     * @return \ValanticSpryker\Zed\CustomerStorage\Business\Deleter\CustomerStorageDeleterInterface
     */
    public function createCustomerStorageDeleter(): CustomerStorageDeleterInterface
    {
        return new CustomerStorageDeleter(
            $this->getEntityManager(),
            $this->getEventBehaviorFacade(),
        );
    }

    /**
     * @return \ValanticSpryker\Zed\CustomerStorage\Business\Mapper\CustomerStorageMapperInterface
     */
    private function createCustomerStorageMapper(): CustomerStorageMapperInterface
    {
        return new CustomerStorageMapper();
    }
}
