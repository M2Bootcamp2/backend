<?php
namespace Frissrmod\EvaluationForm\Model;
use Magento\Framework\Model\AbstractModel;

class UserDatabase extends AbstractModel{
    /**
    * Init resource model
    * @return void
    */
    protected function _construct(){
        $this->_init('Frissrmod\EvaluationForm\Model\ResourceModel\UserDatabase');
    }
}
