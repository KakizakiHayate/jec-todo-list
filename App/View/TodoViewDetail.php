<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <div class="task-content-container">
        <h2>TodoList詳細</h2>
        <?php
        use Controller\TodoController;
        require_once('../Controller/TodoController.php');
        try {
            $id = $_GET['id'];
            $todoController = new TodoController();
            $stmt = $todoController->fetchTask($id);
            foreach ($stmt as $row) {
                echo "<div class='task-content'>
            <h3>概要</h3>
            <p>{$row['overview']}</p>
            <h3>詳細</h3>
            <p>{$row['detail']}</p>
            <h3>期限</h3>
            <p>{$row['limit_date']}</p>
            <h3>担当者</h3>
            <p>{$row['assigner_name']}</p>
        </div>
                <div class='update-button'>
        <a href='index.php?id={$row['id']}'>
            更新する
        </a>
    </div>";
            }
        } catch ( Exception $e ) {
            echo '詳細にエラーが発生しました' . $e;
        }

        ?>
    </div>

</body>
</html>