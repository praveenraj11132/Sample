<?php
namespace Praveen\Form\Model;
use Praveen\Form\Api\ModelRepositoryInterface;
use Praveen\Form\Api\Data\ModelInterface;

class Model extends \Magento\Framework\Model\AbstractModel implements \Praveen\Form\Api\Data\ModelInterface
{

    const Id = "ID";
    const Name = "Name";
    const Email= "Email";
    const Mobile = "Mobile";

    protected function _construct()
    {
        $this->_init('Praveen\Form\Model\ResourceModel\Model');
    }

    public function getId()
    {
        return $this->_getData('ID');
    }

  
    public function getName()
    {
        return $this->_getData('name');
    }

    public function setName($Name)
    {
        $this->setData('name', $Name);
    }


    public function getEmail()
    {
        return $this->_getData('email');
    }

   
    public function setEmail($Email)
    {
        $this->setData('email', $Email);
    }

 
    public function getMobile()
    {
        return $this->_getData('mobile');
    }

  
    public function setMobile($Mobile)
    {
        $this->setData('mobile', $Mobile);
    }
}