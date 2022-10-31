<?php
namespace Praveen\Form\Api;

use \Praveen\Form\Api\Data\ModelInterface;
use \Magento\Framework\Api\SearchCriteriaInterface;

interface ModelRepositoryInterface
{
    public function save(ModelInterface $model);

    public function delete(ModelInterface $model);

    public function deleteById($ID);

    public function getById($ID);

    public function getList(SearchCriteriaInterface $criteria); 
     
}