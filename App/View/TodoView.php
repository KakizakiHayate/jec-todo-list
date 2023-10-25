<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <div class="container">
        <header id="header-wrapper">
            <h1>タスク一覧</h1>
        </header>

        <main id="main-wrapper">
            <table border="1">
                <tr>
                    <th>id</th>
                    <th>概要</th>
                    <th>詳細</th>
                    <th>期限</th>
                    <th>担当者</th>
                    <th>削除フラグ</th>
                    <th>登録日時</th>
                    <th>更新日時</th>
                </tr>
                <?php
                use Controller\TodoController;
                require_once('../Controller/TodoController.php');
                try {
                        $todoController = new TodoController();
                        $stmt = $todoController->fetchTasks();
                        foreach ( $stmt as $row ) {
                            echo "<tr>
                                     <td>{$row['id']}</td>
                                     <td>{$row['overview']}</td>
                                     <td>{$row['detail']}</td>
                                     <td>{$row['limit_date']}</td>
                                     <td>{$row['assigner_name']}</td>
                                     <td>{$row['is_deleted']}</td>
                                     <td>{$row['created_at']}</td>
                                     <td>{$row['updated_at']}</td>
                                  </tr>";
                        }
                    } catch ( Exception $e ) {
                        echo 'エラーメッセージ' . $e -> getMessage();
                    }
                ?>
            </table>
        </main>
    </div>
</body>
</html>