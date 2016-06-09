<?php 
namespace backend\EvaluationForm\Controller\Index; 

class Index extends \backend\EvaluationForm\Controller\Index{ 
    
    public function execute(){
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
