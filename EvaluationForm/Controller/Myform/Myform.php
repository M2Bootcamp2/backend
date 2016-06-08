<?php
namespace Frissrmod\EvaluationForm\Controller\Myform;
use Magento\Framework\App\Action\Action;

class Myform extends Action{
    public function execute(){
    $this->_redirect('index/*/');
    
    $this->getRequest()->getParams();
    $servername = "localhost";
    $username = "magento";
    $password = "password";
    $dbname = "myDB";

    //create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if($conn->connect_error){
        die($conn->connect_error);
    }

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
