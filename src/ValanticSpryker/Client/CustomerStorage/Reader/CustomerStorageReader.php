<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\CustomerStorage\Reader;

use Generated\Shared\Transfer\CustomerStorageTransfer;
use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Spryker\Client\Storage\StorageClientInterface;
use Spryker\Service\Synchronization\SynchronizationServiceInterface;
use ValanticSpryker\Shared\CustomerStorage\CustomerStorageConstants;

class CustomerStorageReader implements CustomerStorageReaderInterface
{
    /**
     * @param \Spryker\Client\Storage\StorageClientInterface $storageClient
     * @param \Spryker\Service\Synchronization\SynchronizationServiceInterface $synchronizationService
     */
    public function __construct(
        private StorageClientInterface $storageClient,
        private SynchronizationServiceInterface $synchronizationService
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getCustomerByReference(string $customerReference): ?CustomerStorageTransfer
    {
        $key = $this->generateKey($customerReference);

        $customerStorageData = $this->storageClient->get($key);

        if (!$customerStorageData) {
            return null;
        }
        $customerStorageTransfer = (new CustomerStorageTransfer())->fromArray($customerStorageData, true);
        $customerStorageTransfer->setCustomerReference($customerReference);

        return $customerStorageTransfer;
    }

    /**
     * @param string $customerReference
     *
     * @return string
     */
    private function generateKey(string $customerReference): string
    {
        $keyBuilder = $this->synchronizationService->getStorageKeyBuilder(CustomerStorageConstants::CUSTOMER_RESOURCE_NAME);

        return $keyBuilder->generateKey((new SynchronizationDataTransfer())->setReference($customerReference));
    }
}
