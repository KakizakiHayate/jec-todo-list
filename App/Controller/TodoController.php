<?php
namespace Controller;

use Model\TodoModel;
use mysqli_result;
use FastRoute;
require_once('../Model/TodoModel.php');
require '../../vendor/autoload.php';

function fetchTodos()
{
    header('Location: ../View/TodoView.php');
}

$model = new TodoModel();


if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    header('Location: ../View/TodoView.php');
    echo 'gdffdfd';
    parse_str(file_get_contents('php://input'), $parameter);
    $number = $_REQUEST['number'];
    $overview = $_REQUEST['overview'];
    $detail = $_REQUEST['detail'];
    $limitDate = $_REQUEST['limit-date'];
    $assigner = $_REQUEST['assign'];

    $model->updateTasks($number, $overview, $detail, $limitDate, $assigner);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Location: ../View/TodoView.php');
    $id = $_POST['id'];
    $overview = $_POST['overview'];
    $detail = $_POST['detail'];
    $limitDate = $_POST['limit-date'];
    $assigner = $_POST['assign'];
    isset( $_POST['id'] )
    // 以下はupdateにする
        ? $model->createTasks($overview, $detail, $limitDate, $assigner)
        : $model->createTasks($overview, $detail, $limitDate, $assigner);
}
 class TodoController {
    private $todoModel;
    public function __construct()
    {
        $this->todoModel = new TodoModel();
    }

     /**
      * @return mysqli_result
      */
    public function fetchTasks(): mysqli_result
    {
        return $this->todoModel->fetchTasks();
    }

     public function fetchTask($id): mysqli_result
     {
         return $this->todoModel->fetchTask($id);
     }
}

$model->close();