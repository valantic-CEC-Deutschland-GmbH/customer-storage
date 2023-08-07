<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\CustomerStorage;

use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Storage\StorageClientInterface;
use Spryker\Service\Synchronization\SynchronizationServiceInterface;
use ValanticSpryker\Client\CustomerStorage\Reader\CustomerStorageReader;
use ValanticSpryker\Client\CustomerStorage\Reader\CustomerStorageReaderInterface;

class CustomerStorageFactory extends AbstractFactory
{
    /**
     * @return \ValanticSpryker\Client\CustomerStorage\Reader\CustomerStorageReaderInterface
     */
    public function createCustomerStorageReader(): CustomerStorageReaderInterface
    {
        return new CustomerStorageReader(
            $this->getStorageClient(),
            $this->getSynchronizationService(),
        );
    }

    /**
     * @return \Spryker\Client\Storage\StorageClientInterface
     */
    private function getStorageClient(): StorageClientInterface
    {
        return $this->getProvidedDependency(CustomerStorageDependencyProvider::CLIENT_STORAGE);
    }

    /**
     * @return \Spryker\Service\Synchronization\SynchronizationServiceInterface
     */
    private function getSynchronizationService(): SynchronizationServiceInterface
    {
        return $this->getProvidedDependency(CustomerStorageDependencyProvider::SERVICE_SYNCHRONIZATION);
    }
}
