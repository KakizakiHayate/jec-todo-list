<?php

namespace Controller;
use Model\TodoModel;
use mysqli_result;

require_once('../Model/TodoModel.php');

$model = new TodoModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $overview = $_POST['overview'];
    $detail = $_POST['detail'];
    $limitDate = $_POST['limit-date'];
    $assigner = $_POST['assign'];

    $model->createTasks($overview, $detail, $limitDate, $assigner);
    include '../View/TodoView.php';
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
}

$model->close();