<?php
namespace Frissrmod\EvaluationForm\Block;

use Magento\Framework\View\Element\Template;

class EvaluationForm extends Template{

   // public function __construct(Template\Context $context, array $data = []){
   //     parent::__construct($context, $data);
   //     $this->_isScopePrivate = true;

   // }

    public function getFormActionUrl(){
        return $this->getUrl('EvaluationForm/index/post', ['_secure' => true]);
    }
}
