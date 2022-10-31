<?php
namespace Praveen\Form\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use Praveen\Form\Model\ResourceModel\Model\CollectionFactory as ModelCollectionFactory;
use Praveen\Form\Model\ModelFactory;
use Praveen\Form\Api\ModelRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\FilterBuilder;

class Hello extends \Magento\Framework\View\Element\Template
{
    protected $searchCriteriaBuilder;
    protected $filterBuilder;
    protected $_ModelCollectionFactory = null;
    protected $ModelFactory;
    protected $_ModelRepository;


    public function __construct(
        Context $context,
        ModelCollectionFactory $ModelCollectionFactory,ModelRepositoryInterface $ModelRepository,
        FilterBuilder $filterBuilder,SearchCriteriaBuilder $searchCriteriaBuilder,
        ModelFactory $ModelFactory,
        array $data = []
    ) {
        $this->ModelFactory = $ModelFactory;
        $this->_ModelRepository=$ModelRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->_ModelCollectionFactory  = $ModelCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getAddModelPostUrl()  {

        return $this->getUrl('data/index/save');
    }
    public function getDeleteModelPostUrl() {

     
        return $this->getUrl('data/index/delete');
    }

    public function getCollection()
    {
        
        $ModelCollection = $this->_ModelCollectionFactory ->create();
        $ModelCollection->addFieldToSelect('*')->load();
        return $ModelCollection->getItems();
    }
    public function getAllCars()
    {
        $searchCriteriaBuilder = $this->searchCriteriaBuilder->create();
        $list = $this->_ModelRepository->getList($searchCriteriaBuilder);
        return $list->getItems();
    }
}