<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\CustomerStorage;

use Generated\Shared\Transfer\CustomerStorageTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \ValanticSpryker\Client\CustomerStorage\CustomerStorageFactory getFactory()
 */
class CustomerStorageClient extends AbstractClient implements CustomerStorageClientInterface
{
    /**
     * @inheritDoc
     */
    public function getCustomerByReference(string $customerReference): ?CustomerStorageTransfer
    {
        return $this->getFactory()
            ->createCustomerStorageReader()
            ->getCustomerByReference($customerReference);
    }
}
