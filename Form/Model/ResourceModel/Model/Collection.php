<?php
namespace Praveen\Form\Model\ResourceModel\Model;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Praveen\Form\Model\Model as Model;
use Praveen\Form\Model\ResourceModel\Model as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}