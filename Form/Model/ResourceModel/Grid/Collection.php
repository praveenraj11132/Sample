<?php

namespace Praveen\Form\Model\ResourceModel\Grid;


use Praveen\Form\Model\Grid;
use Praveen\Form\Model\ResourceModel\Grid as GridResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    
protected $_idFieldName = 'id';
    protected function _construct()
    {
       
       $this->_init(Grid::class, GridResourceModel::class);
    }
}