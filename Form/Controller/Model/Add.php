<?php

namespace Praveen\Form\Controller\Model;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Praveen\Form\Model\Model;
use Praveen\Form\Model\ResourceModel\Model as ModelResource;

class Add extends Action
{
    
    private $model;
    
    private $modelResource;

   
    public function __construct(
        Context $context,
        Model $model,
        ModelResource $modelResource
    )
    {
        parent::__construct($context);
        $this->model = $model;
        $this->modelResource = $modelResource;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        /* Get the post data */
        $data = $this->getRequest()->getParams();

        /* Set the data in the model */
        $modelModel = $this->model;
        $modelModel->setData($data);

        try {
            /* Use the resource model to save the model in the DB */
            $this->modelResource->save($modelModel);
            $this->messageManager->addSuccessMessage("Data saved successfully!");
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__("Error saving data"));
        }

        /* Redirect back to cars page */
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('Form');
        return $redirect;
    }


}
