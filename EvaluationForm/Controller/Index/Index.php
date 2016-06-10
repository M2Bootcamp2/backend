<?php 
namespace Frissrmod\EvaluationForm\Controller\Index; 

class Index extends \Frissrmod\EvaluationForm\Controller\Index{ 
    
    public function execute(){
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
