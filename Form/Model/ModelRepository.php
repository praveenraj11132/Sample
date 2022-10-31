<?php
namespace Praveen\Form\Model;

    use \Praveen\Form\Api\Data\ModelInterface;
    use \Praveen\Form\Model\ResourceModel\Model as ObjectResourceModel;
    use \Magento\Framework\Api\SearchCriteriaInterface;
    use \Magento\Framework\Exception\CouldNotSaveException;
    use \Magento\Framework\Exception\NoSuchEntityException;
    use \Magento\Framework\Exception\CouldNotDeleteException;

    class ModelRepository implements \Praveen\Form\Api\ModelRepositoryInterface
    {
        protected $objectFactory;

        protected $objectResourceModel;

        protected $collectionFactory;

        protected $searchResultsFactory;

        public function __construct(
            \Praveen\Form\Model\ModelFactory $objectFactory,
            ObjectResourceModel $objectResourceModel,
            \Praveen\Form\Model\ResourceModel\Model\CollectionFactory $collectionFactory,
            \Magento\Framework\Api\SearchResultsInterfaceFactory $searchResultsFactory
        ) {
            $this->objectFactory        = $objectFactory;
            $this->objectResourceModel  = $objectResourceModel;
            $this->collectionFactory    = $collectionFactory;
            $this->searchResultsFactory = $searchResultsFactory;
        }

        public function save(ModelInterface $object)
        {
            $Name = $object->getName();
            // $hasSpouse = $object->getSpouse();
            // if ($Name == true) {
            //     $Name = " " . $Name;
            // } else {
            //     $Name = " " . $Name;
            // }
            $object->setName($Name);
            try {
                $this->objectResourceModel->save($object);
            } catch (\Exception $e) {
                throw new CouldNotSaveException(__($e->getMessage()));
            }
            return $object;
        }

       
        public function getById($ID)
        {
            $object = $this->objectFactory->create();
            $this->objectResourceModel->load($object, $ID);
            if (!$object->getId()) {
                throw new NoSuchEntityException(__('Object with id "%1" does not exist.', $ID));
            }
            return $object;
        }

        public function delete(ModelInterface $object)
        {
            try {
                $this->objectResourceModel->delete($object);
            } catch (\Exception $exception) {
                throw new CouldNotDeleteException(__($exception->getMessage()));
            }
            return true;
        }

        public function deleteById($ID)
        {
            
            return $this->delete($this->getById($ID));
        }

        public function getList(SearchCriteriaInterface $criteria)
        {
            $searchResults = $this->searchResultsFactory->create();
            $searchResults->setSearchCriteria($criteria);
            $collection = $this->collectionFactory->create();
            foreach ($criteria->getFilterGroups() as $filterGroup) {
                $fields = [];
                $conditions = [];
                foreach ($filterGroup->getFilters() as $filter) {
                    $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                    $fields[] = $filter->getField();
                    $conditions[] = [$condition => $filter->getValue()];
                }
                if ($fields) {
                    $collection->addFieldToFilter($fields, $conditions);
                }
            }
            $searchResults->setTotalCount($collection->getSize());
            $sortOrders = $criteria->getSortOrders();
            if ($sortOrders) {
                /** @var SortOrder $sortOrder */
                foreach ($sortOrders as $sortOrder) {
                    $collection->addOrder(
                        $sortOrder->getField(),
                        ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                    );
                }
            }
            $collection->setCurPage($criteria->getCurrentPage());
            $collection->setPageSize($criteria->getPageSize());
            $objects = [];
            foreach ($collection as $objectModel) {
                $objects[] = $objectModel;
            }
            $searchResults->setItems($objects);
            return $searchResults;
        }
    }