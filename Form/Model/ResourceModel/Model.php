<?php
namespace Praveen\Form\Model\ResourceModel;

class Model extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $_idFieldName = 'Id';

    protected function _construct()
    {
        $this->_init('student','ID');
    }
}