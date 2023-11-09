<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<!-- 先にphpを書いちゃって後からhtmlを書いた方がパフォーマンス上がる。phpとhtmlを混同させないで分ける -->
    <div class="container">
        <header id="header">
            <div class="title">
                <?php
                use Controller\TodoController;
                require_once('../Controller/TodoController.php');
                isset($_GET['id']) ? $taskText = '更新' : $taskText = '登録';

                echo "<h1>タスク{$taskText}</h1>"
                ?>
            </div>
        </header>

        <main id="main">
            <section class="user-input">
                <form action="../Controller/TodoController.php" method="post">
                    <?php
                    require_once('../Controller/TodoController.php');
                    $overview = "";
                    $detail = "";
                    $limitDate = "";
                    $assign = "";
                    if ( isset($_GET['id']) ) {
                        try {
                            $id = $_GET['id'];
                            $todoController = new TodoController();
                            $stmt = $todoController->fetchTask($id);
                            foreach ($stmt as $row) {
                                $overview = $row['overview'];
                                $detail = $row['detail'];
                                $limitDate = $row['limit_date'];
                                $assign = $row['assigner_name'];
                            }
                        } catch ( Exception $e ) {
                            echo '詳細内容を取得できませんでした' . $e->getMessage();
                        }
                    }
                    if ( isset($_GET['id']) ) {
                        echo "<div class='id-wrapper'>
                            <label for='id'>id</label>
                            <input type='text' name='id' id='id' value='$id' readonly>
                        </div>";
                    }
                    echo "
                    <div class='overview-wrapper'>
                        <label for='overview'>概要：</label>
                        <input type='text' name='overview' id='overview' value='$overview'>
                    </div>
                    <div class='detail-wrapper'>
                        <label for='detail'>詳細：</label>
                        <textarea id='detail' name='detail'>{$detail}</textarea>
                    </div>
                    <div class='limit-date-wrapper'>
                        <label for='limit-date'>期限：</label>
                        <input type='date' name='limit-date' id='limit-date' value='{$limitDate}'>
                    </div>
                    <div class='assign-wrapper'>
                        <label for='assign'>担当者：</label>
                        <input type='text' name='assign' id='assign' value='{$assign}'>
                    </div>
                    <div class='register-wrapper'>
                        <input class='register-button' type='submit' value='{$taskText}'>
                    </div>";
                    ?>
                </form>
            </section>
        </main>
    </div>
</body>
</html>