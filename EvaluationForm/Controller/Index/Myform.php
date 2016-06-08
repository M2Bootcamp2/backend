<?php
namespace Frissrmod\EvaluationForm\Controller\Index;
use Magento\Framework\App\Action\Action;

class Myform extends Index{

    public function execute(){

        $post = $this->getRequest()->getPostValue();
        if (!$post) {
            $this->_redirect('*/*/');
            return;
        }

        $this->inlineTranslation->suspend();
        try{
            $postObject = new \Magento\Framework\DataObject();
            $postObject->setData($post);

            $error = false;

            if (!\Zend_Validate::is(trim($post['name']), 'NotEmpty')) {
                $error = true;
            }
            if (!\Zend_Validate::is(trim($post['understood']), 'NotEmpty')) {
                $error = true;
            }
            if (!\Zend_Validate::is(trim($post['help']), 'EmailAddress')) {
                $error = true;
            }
            if (\Zend_Validate::is(trim($post['person']), 'NotEmpty')) {
                $error = true;
            }
            if ($error) {
                throw new \Exception();
            }
            
	
		
            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $transport = $this->_transportBuilder
                ->setTemplateIdentifier($this->scopeConfig->getValue(self::XML_PATH_EMAIL_TEMPLATE, $storeScope))
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Backend\App\Area\FrontNameResolver::AREA_CODE,
                        'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                    ]
                )
                ->setTemplateVars(['data' => $postObject])
                ->setFrom($this->scopeConfig->getValue(self::XML_PATH_EMAIL_SENDER, $storeScope))
                ->addTo($this->scopeConfig->getValue(self::XML_PATH_EMAIL_RECIPIENT, $storeScope))
                ->setReplyTo($post['email'])
                ->getTransport();

            $transport->sendMessage();
            $this->inlineTranslation->resume();
            $this->messageManager->addSuccess(
                __('Thanks for contacting us with your comments and questions. We\'ll respond to you very soon.')
            );
            $this->_redirect('EvaluationForm/index');
            return;
        } catch (\Exception $e) {
            $this->inlineTranslation->resume();
            $this->messageManager->addError(
                __('We can\'t process your request right now. Sorry, that\'s all we know.')
            );
            $this->_redirect('EvaluationForm/index');
            return;
        }

        $username = "magento";
        $password = "password";
        $dbname = "myDB";

         //create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if($conn->connect_error){
            die($conn->connect_error);
        }

        echo "test3";
        $frontname = $_POST['frontname'];
        $lastname = $_POST['lastname'];
        $sector = $_POST['sector'];
        $direction = $_POST['direction'];
        $speed = $_POST['speed'];
        $content = $_POST['content'];
        $understood = $_POST['understood'];
        $help = $_POST['help'];
        $person = $_POST['person'];
        $comments = $_POST['comments'];

        $sql = "INSERT INTO Frissrmod_EvaluationForm (frontname, lastname, sector, direction, speed, content, understood, help, person, comment) VALUES ($frontname, $lastname, $sector, $direction, $speed, $content, $understood, $help, $person, $comments)";

        if($conn->query($sql) === TRUE){
            echo "Success";
        } else {
            "error: " . $sql . "<br>" . $conn->error;
        }

        echo "submission";
        $conn->close();
    }
}
?>
