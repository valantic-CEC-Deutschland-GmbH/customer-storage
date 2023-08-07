<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class CustomerStorageConfig extends AbstractBundleConfig
{
    public const ENTITY_SPY_CUSTOMER_CREATE = 'Entity.spy_customer.create';

    public const ENTITY_SPY_CUSTOMER_UPDATE = 'Entity.spy_customer.update';

    public const ENTITY_SPY_CUSTOMER_DELETE = 'Entity.spy_customer.delete';

    public const ENTITY_SPY_CUSTOMER_GROUP_TO_CUSTOMER_CREATE = 'Entity.spy_customer_group_to_customer.create';

    public const ENTITY_SPY_CUSTOMER_GROUP_TO_CUSTOMER_UPDATE = 'Entity.spy_customer_group_to_customer.update';

    public const ENTITY_SPY_CUSTOMER_GROUP_TO_CUSTOMER_DELETE = 'Entity.spy_customer_group_to_customer.delete';

    public const ENTITY_SPY_CUSTOMER_ADDRESS_CREATE = 'Entity.spy_customer_address.create';

    public const ENTITY_SPY_CUSTOMER_ADDRESS_UPDATE = 'Entity.spy_customer_address.update';
    public const SYNC_CUSTOMER_STORAGE = 'sync.storage.customer';
    public const PUBLISH_CUSTOMER = 'publish.customer';

    public const SYNC_CUSTOMER_STORAGE_ERROR = 'sync.storage.customer.error';
    /**
     * Event name for publishing a customer used during data import.
     */
    public const PUBLISH_CUSTOMER_WRITE = 'Customer.publish';
}
