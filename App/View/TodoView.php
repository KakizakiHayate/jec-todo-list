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
        <section id="register">
            <div class="register-wrapper">
                <button onclick="location.href='index.php'">登録する</button>
            </div>
        </section>
        <section id="task-list-wrapper">
            <?php
            use Controller\TodoController;
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
                            <a href='TodoViewDetail.php?id={$row['id']}'>
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