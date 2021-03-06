<?php
namespace Frissrmod\EvaluationForm\Controller\Index;
use Magento\Framework\App\Action\Action;

class Post extends Index{

    public $save;

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

            if (!\Zend_Validate::is(trim($post['firstname']), 'NotEmpty')) {
                $error = true;
            }
            if (!\Zend_Validate::is(trim($post['lastname']), 'NotEmpty')) {
                $error = true;
            }
            if (!\Zend_Validate::is(trim($post['email']), 'EmailAddress')) {
                $error = true;
            }
            if (!\Zend_Validate::is(trim($post['understood']), 'NotEmpty')) {
                $error = true;
            }
            if (!\Zend_Validate::is(trim($post['help_asked']), 'NotEmpty')) {
                $error = true;
            }
            if (!\Zend_Validate::is(trim($post['helper']), 'NotEmpty')) {
                $error = true;
            }
            if (!\Zend_Validate::is(trim($post['questions']), 'NotEmpty')) {
                $error = true;
            }
            if (\Zend_Validate::is(trim($post['hideit']), 'NotEmpty')) {
                $error = true;
            }
            if ($error) {
                throw new \Exception();
            }
            
            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $websiteScope = \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE;
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
                ->addCC($post['email'])
                ->setReplyTo($post['email'])
                ->getTransport();

            $transport->sendMessage();

            $model = $this->_objectManager->create('Frissrmod\EvaluationForm\Model\UserDatabase');
            $model->setData('firstname', $post['firstname']);
            $model->setData('lastname', $post['lastname']);
            $model->setData('email', $post['email']);
            $model->setData('sector', $post['sector']);
            $model->setData('direction', $post['direction']);
            $model->setData('pace', $post['pace']);
            $model->setData('materials', $post['materials']);
            $model->setData('unclear', $post['understood']);
            $model->setData('help_asked', $post['help_asked']);
            $model->setData('helper', $post['helper']);
            $model->setData('questions', $post['questions']);

            $model->save();

            $this->inlineTranslation->resume();
            $this->messageManager->addSuccess(
                __('Thanks for contacting us with your comments and questions. We\'ll respond to you very soon.')
            ); 
            $this->_redirect('EvaluationForm/index');
            return;
        } catch (\Exception $e) {
            print($e);
            die();
            $this->inlineTranslation->resume();
            $this->messageManager->addError(
                __('We can\'t process your request right now. Sorry, that\'s all we know.')
            );
            $this->_redirect('EvaluationForm/index');
            return;
        }
    }
}
?>
