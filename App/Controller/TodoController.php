<?php
namespace Controller;

use Model\TodoModel;
use mysqli_result;
use FastRoute;
require_once('../Model/TodoModel.php');
require '../../vendor/autoload.php';

$model = new TodoModel();

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    header('Location: ../View/TodoView.php');
    if ( isset($_POST['id']) ) $id = $_POST['id'];
    if ( isset($_POST['overview']) ) $overview = $_POST['overview'];
    if ( isset($_POST['detail']) ) $detail = $_POST['detail'];
    if ( isset($_POST['limit-date']) ) $limitDate = $_POST['limit-date'];
    if ( isset($_POST['assign']) ) $assigner = $_POST['assign'];

    if ( !isset($id) ) {
        $model->createTasks($overview, $detail, $limitDate, $assigner);
    }
    if ( isset($id) && isset($_POST['update-button']) ) {
        $model->updateTasks($id, $overview, $detail, $limitDate, $assigner);
    }
    if ( isset($id) && isset($_POST['delete-button']) ) {
        $model->deleteTasks($id);
    }
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