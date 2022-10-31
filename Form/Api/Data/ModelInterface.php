<?php

namespace Praveen\Form\Api\Data;

// use Magento\Framework\Api\ExtensibleDataInterface;

interface ModelInterface
{
    
    public function getId();

    
    public function getName();

   
    public function setName($Name);

    
    public function setEmail($Email);

   
    public function getEmail();

   
    public function setMobile($Mobile);

    
    public function getMobile();

}