<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerStorage\Business\Writer;

use Orm\Zed\Customer\Persistence\Map\SpyCustomerAddressTableMap;
use Orm\Zed\CustomerGroup\Persistence\Map\SpyCustomerGroupToCustomerTableMap;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;
use ValanticSpryker\Zed\CustomerStorage\Business\Mapper\CustomerStorageMapperInterface;
use ValanticSpryker\Zed\CustomerStorage\Persistence\CustomerStorageEntityManagerInterface;
use ValanticSpryker\Zed\CustomerStorage\Persistence\CustomerStorageRepositoryInterface;

class CustomerStorageWriter implements CustomerStorageWriterInterface
{
    /**
     * @param \ValanticSpryker\Zed\CustomerStorage\Persistence\CustomerStorageEntityManagerInterface $customerStorageEntityManager
     * @param \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface $eventBehaviorFacade
     * @param \ValanticSpryker\Zed\CustomerStorage\Persistence\CustomerStorageRepositoryInterface $customerStorageRepository
     * @param \ValanticSpryker\Zed\CustomerStorage\Business\Mapper\CustomerStorageMapperInterface $customerStorageMapper
     */
    public function __construct(
        private CustomerStorageEntityManagerInterface $customerStorageEntityManager,
        private EventBehaviorFacadeInterface $eventBehaviorFacade,
        private CustomerStorageRepositoryInterface $customerStorageRepository,
        private CustomerStorageMapperInterface $customerStorageMapper
    ) {
    }

    /**
     * @inheritDoc
     */
    public function writeCollectionByCustomerEvents(array $eventEntityTransfers): void
    {
        $customerIds = $this->eventBehaviorFacade->getEventTransferIds($eventEntityTransfers);

        $this->writerCustomerStorageCollection($customerIds);
    }

    /**
     * @inheritDoc
     */
    public function writeCollectionByCustomerGroupToCustomerEvents(array $eventTransfers): void
    {
        $customerIds = $this->eventBehaviorFacade->getEventTransferForeignKeys($eventTransfers, SpyCustomerGroupToCustomerTableMap::COL_FK_CUSTOMER);

        $this->writerCustomerStorageCollection($customerIds);
    }

    /**
     * @inheritDoc
     */
    public function writeCustomerStorageCollectionByCustomerAddressEvents(array $eventEntityTransfers): void
    {
        $customerIds = $this->eventBehaviorFacade->getEventTransferForeignKeys($eventEntityTransfers, SpyCustomerAddressTableMap::COL_FK_CUSTOMER);

        $this->writerCustomerStorageCollection($customerIds);
    }

    /**
     * @param array $customerIds
     *
     * @return void
     */
    private function writerCustomerStorageCollection(array $customerIds): void
    {
        $customerEntityTransfers = $this->customerStorageRepository->getCustomerByIds($customerIds);

        [$customerInactiveEntityTransfer, $customerEntityTransfers] = $this
            ->filterInactiveAndEmptyStorageEntityTransfers(
                $customerEntityTransfers,
            );

        /** @var \Generated\Shared\Transfer\SpyCustomerEntityTransfer $spyCustomerEntityTransfer */
        foreach ($customerInactiveEntityTransfer as $spyCustomerEntityTransfer) {
            $this->customerStorageEntityManager->deleteCustomerStorageEntity((int)$spyCustomerEntityTransfer->getIdCustomer());
        }

        $this->storeData($customerEntityTransfers);
    }

    /**
     * @param array<\Generated\Shared\Transfer\SpyCustomerEntityTransfer> $customerEntityTransfers
     *
     * @return void
     */
    private function storeData(array $customerEntityTransfers): void
    {
        $customerStorageEntityTransfers = [];

        foreach ($customerEntityTransfers as $customerEntityTransfer) {
            $customerStorageEntityTransfers[] = $this->customerStorageMapper->mapCustomerEntityTransferToCustomerStorageEntityTransfer($customerEntityTransfer);
        }

        $this->customerStorageEntityManager->saveCustomerStorageEntities($customerStorageEntityTransfers);
    }

    /**
     * @param array $customerEntityTransfers
     *
     * @return array
     */
    private function filterInactiveAndEmptyStorageEntityTransfers(array $customerEntityTransfers): array
    {
        $inactiveCustomerStorageEntities = [];
        foreach ($customerEntityTransfers as $id => $customerEntityTransfer) {
            if ($customerEntityTransfer->getAnonymizedAt() !== null) {
                $inactiveCustomerStorageEntities[] = $customerEntityTransfer;
                unset($customerEntityTransfers[$id]);
            }
        }

        return [$inactiveCustomerStorageEntities, $customerEntityTransfers];
    }
}
