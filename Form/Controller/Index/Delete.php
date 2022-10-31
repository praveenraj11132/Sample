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

    class Delete extends Action

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
        $ID = $_GET;
       
        try {
         $this->_ModelRepository->deleteById($ID);
         echo "delete";
            // echo "Deleted the record with id = $ID" . "<br>" . "Go to database and check.";
            $this->messageManager->addSuccessMessage(__("Data Deleted Successfully."));
        } catch (NoSuchEntityException $e) {
            echo "No such entity exception - " . $e->getMessage();
        } catch (LocalizedException $e) {
            echo "Localized Exception" . $e->getMessage();
        }

        // $resultPage = $this->_resultPageFactory->create();
        // return $resultPage;
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('data');
        return $resultRedirect;

        
    }
}