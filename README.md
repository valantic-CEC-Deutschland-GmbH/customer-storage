# customer-storage

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%208.0-8892BF.svg)](https://php.net/)

# Description
 - Allows to publish non privacy related customer data into storage.

# Install
 - `composer require valantic-spryker/customer-storage`
 - register publisher plugins
```php
    // PublisherDependencyProvider.php
    /**
     * @return array
     */
    private function getCustomerStoragePlugins(): array
    {
        return [
            CustomerStorageConfig::PUBLISH_CUSTOMER => [
                new CustomerWritePublisherPlugin(),
                new CustomerDeletePublisherPlugin(),
                new CustomerGroupToCustomerWritePublisherPlugin(),
                new CustomerGroupToCustomerDeletePublisherPlugin(),
                new CustomerAddressWritePublisherPlugin(),
            ],
        ];
    }
```
 - create customer storage queues
```php
 // Client/RabbitMq/RabbitMqConfig.php
     /**
     * @return array
     */
    protected function getPublishQueueConfiguration(): array
    {
        return [
            [...]
            CustomerStorageConfig::PUBLISH_CUSTOMER,
            [...]
        ];
    }

    /**
     * @return array
     */
    protected function getSynchronizationQueueConfiguration(): array
    {
        return [
            [...]
            CustomerStorageConfig::SYNC_CUSTOMER_STORAGE,
            [...]
        ];
    }

    /**
     * @return \ArrayObject
     */
    protected function getQueueOptions(): ArrayObject
    {
        $queueOptionCollection = parent::getQueueOptions();

        $queueOptionCollection->append($this->createQueueOptionTransfer(CustomerStorageConfig::SYNC_CUSTOMER_STORAGE, CustomerStorageConfig::SYNC_CUSTOMER_STORAGE_ERROR));
    
        return $queueOptionCollection;
    }
```
 - add processor to queue:worker command
```php
    // Zed/Queue/QueueDependencyProvider.php
        /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return array<\Spryker\Zed\Queue\Dependency\Plugin\QueueMessageProcessorPluginInterface>
     */
    protected function getProcessorMessagePlugins(Container $container): array
    {
        [...]
            CustomerStorageConfig::PUBLISH_CUSTOMER => new EventQueueMessageProcessorPlugin(),
            CustomerStorageConfig::SYNC_CUSTOMER_STORAGE => new SynchronizationStorageQueueMessageProcessorPlugin(),
        [...]
    }
    

```
 - if you use default customer importer, ensure customer-storage publisher event is triggered
```php
    // Zed\CustomerImport\Business\Model\CustomerImporterPlugin
    public function import(array $data): void
    {
        [...]
            QueueImporterPublisher::addEvent(
                CustomerStorageConfig::PUBLISH_CUSTOMER_WRITE,
                $idCustomer,
            );
        [...]
    }
            
```


# HowTos Cli

PHP Container: `docker run -it --rm --name my-running-script -v "$PWD":/data spryker/php:latest bash`

Run Tests: `codecept run --env standalone`

Fixer: `vendor/bin/phpcbf --standard=phpcs.xml --report=full src/ValanticSpryker/`

Disable opcache: `mv /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini /usr/local/etc/php/conf.d/docker-php-ext-opcache.iniold`

XDEBUG:
- `ip addr | grep '192.'`
- `$docker-php-ext-enable xdebug`
- configure phpstorm (add 127.0.0.1 phpstorm server with name valantic)
- `$PHP_IDE_CONFIG=serverName=valantic php -dxdebug.mode=debug -dxdebug.client_host=192.168.87.39 -dxdebug.start_with_request=yes ./vendor/bin/codecept run --env standalone`

- Run Tests with coverage: `XDEBUG_MODE=coverage vendor/bin/codecept run --env standalone --coverage --coverage-xml --coverage-html`

# use nodejs
 - docker run -it --rm --name my-running-script -v "$PWD":/data node:18 bash
