<?php

namespace Praveen\Form\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface ModelSearchResultsInterface extends SearchResultsInterface
{
   
    public function getItems();

   
    public function setItems(array $items);
}