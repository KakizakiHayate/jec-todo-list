<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link href="css/reset.css" rel="stylesheet"/>
    <link href="css/todo-view-style.css" rel="stylesheet"/>
    <title>Title</title>
</head>
<body>
<div class="container">
    <header id="header-wrapper">
        <h1>タスク一覧</h1>
    </header>

    <main id="main-wrapper">
        <form action="../Controller/TodoController.php" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input class="update-button" type="submit" value="更新する">
            <!--                <input class="delete-button" type="submit" value="削除する">-->
            <div class="id-wrapper">
                <label for="number">id選択:</label>
                <select name="number" id="number">
                    <option>選択する</option>
                    <?php

                    use Controller\TodoController;

                    require_once('../Controller/TodoController.php');
                    try {
                        $todoController = new TodoController();
                        $stmt = $todoController->fetchTasks();
                        $rowCount = $stmt->num_rows;
                        for ($i = 1; $i <= $rowCount; $i++) {
                            echo "<option>$i</option>";
                        }
                        echo "<option>$rowCount</option>";
                    } catch (Exception $e) {
                        echo 'エラーメッセージ' . $e->getMessage();
                    }
                    ?>
                </select>
            </div>
            <div class="overview-wrapper">
                <label for="overview">概要：</label>
                <input type="text" name="overview" id="overview">
            </div>
            <div class="detail-wrapper">
                <label for="detail">詳細：</label>
                <textarea id="detail" name="detail"></textarea>
            </div>
            <div class="limit-date-wrapper">
                <label for="limit-date">期限：</label>
                <input type="date" name="limit-date" id="limit-date">
            </div>
            <div class="assign-wrapper">
                <label for="assign">担当者：</label>
                <input type="text" name="assign" id="assign">
            </div>
        </form>

        <section id="task-list-wrapper">
            <?php
            require_once('../Controller/TodoController.php');
            try {
                $todoController = new TodoController();
                $stmt = $todoController->fetchTasks();
                foreach ($stmt as $row) {
                    echo "<div class='task-content'>
                        <div class='task-content-text-section'>
                            <div class='task-content-overview'>
                                <h4>概要</h4>
                                <p>{$row['overview']}</p>
                            </div>
                            <div class='task-content-detail'>
                                <h4>詳細</h4>
                                <p>{$row['detail']}</p>
                            </div>
                        </div>
                        <div class='task-content-detail-img'>
                            <a href='TodoViewDetail.php'>
                                <svg version='1.1' id='_x32_' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' viewBox='0 0 512 512' xml:space='preserve'>
                                    <style type='text/css'>
                                        .st0{ fill: #2449ff; }
                                    </style>
                                    <g>
                                        <polygon class='st0' points='163.916,0 92.084,71.822 276.258,255.996 92.084,440.178 163.916,512 419.916,255.996' style='fill: #2449ff;'></polygon>
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </div>";
                }
            } catch (Exception $e) {
                echo 'エラーメッセージ' . $e->getMessage();
            }
            ?>
        </section>
    </main>
</div>
</body>
</html>