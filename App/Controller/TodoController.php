<?php

use Model\TodoModel;

require_once('../Model/TodoModel.php');

$model = new TodoModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $overview = $_POST['overview'];
    $detail = $_POST['detail'];
    $limitDate = $_POST['limit-date'];
    $assigner = $_POST['assign'];

    $model->createTasks($overview, $detail, $limitDate, $assigner);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

}

$model->close();