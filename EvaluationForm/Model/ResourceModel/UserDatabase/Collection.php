<?php
namespace Frissrmod\EvaluationForm\Model\ResourceModel\UserDatabase;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection{
    /**
    * @var string
    */
    protected $_idFieldName = 'id';

    /**
    * Define resource model
    * @return void
    */
    protected function _construct(){
        $this->_init('Frissrmod\EvaluationForm\Model\UserDatabase', 'Frissrmod\EvaluationForm\Model\Resourcemodel\UserDatabase');
    }
}
