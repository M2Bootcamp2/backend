<?php
namespace Frissrmod\EvaluationForm\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class UserDatabase extends AbstractDb{
    /**
    * init resource model
    * @return void
    */
    protected function _construct(){
    
        $this->_init('EvaluationForm', 'id');
    }
}
