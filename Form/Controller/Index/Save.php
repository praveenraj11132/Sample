<?php
namespace Praveen\Form\Controller\Index;

    use Magento\Framework\App\Action\Action;
    use Magento\Framework\App\Action\Context;
    use Magento\Framework\Exception\CouldNotSaveException;
    use Magento\Framework\Exception\LocalizedException;
    use Magento\Framework\Exception\NoSuchEntityException;
    use Magento\Framework\View\Result\PageFactory;

    use Praveen\Form\Api\ModelRepositoryInterface;
    use Praveen\Form\Api\Data\ModelInterface;

    class Save extends Action

    {
        protected $_pageFactory;
        protected $_ModelRepository;
        protected $_Model;


        public function __construct(
            Context $context,
            PageFactory $pageFactory,
            ModelRepositoryInterface $ModelRepository,
            ModelInterface $ModelInterface
        ) {
            $this->_pageFactory = $pageFactory;
            $this->_ModelRepository=$ModelRepository;
            $this->_Model = $ModelInterface;
            return parent::__construct($context);
        }

        public function execute()
        {
           
            $data = $this->getRequest()->getParams();
            // $EmpId =$data['emp_id'];
            $Name =$data['name'];
            $Email =$data['email'];
            $Mobile =$data['mobile'];
            
            $Model = $this->_Model;
        // $this->_Model->setEmpId($EmpId);
      $val1=   $this->_Model->setName($Name);
      $val2= $this->_Model->setEmail($Email);
      $val3=  $this->_Model->setMobile($Mobile);

        try {
          
            /* Use the resource model to save the model in the DB */
            $this->_ModelRepository->save($Model);
            $this->messageManager->addSuccessMessage("data saved successfully!");
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
            die;
            $this->messageManager->addErrorMessage(__("Error saving data"));
        }
    
        /* Redirect back to cars page */
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('data');
        return $redirect;

        }
    }
        ?>