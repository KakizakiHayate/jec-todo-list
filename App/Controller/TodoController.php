<?php

use Model\TodoModel;

require_once('../Model/TodoModel.php');

$model = new TodoModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $overview = $_POST['overview'];
    $detail = $_POST['detail'];
    $limitDate = $_POST['limit-date'];
    $assigner = $_POST['assign'];

    if ($model->createTasks($overview, $detail, $limitDate, $assigner)) {
        echo 'タスクが正常に登録されました。';
    } else {
        echo 'タスクの登録中に問題が発生しました。';
    }
}

$model->close();