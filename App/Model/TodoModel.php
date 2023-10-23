<?php

namespace Model;
use mysqli;

class TodoModel
{
    private $db;

    public function __construct()
    {
        // TODO user = admin, pass = adminpass,でやると失敗する
        $host = 'mysql';
        $user = 'root';
        $pass = 'rootpassword';
        $dbName = 'TodoListDB';
        $this->db = new mysqli($host, $user, $pass, $dbName);

        if (mysqli_connect_errno()) {
            echo('データベース接続エラー: ' . mysqli_connect_errno());
            exit();
        }
        echo("Initial character set: %s\n" . $this->db->character_set_name());
        if (!$this->db->set_charset("utf8")) {
            echo("Error loading character set utf8: %s\n" . $this->db->error);
            exit();
        } else {
            echo("Current character set: %s\n" . $this->db->character_set_name());
        }

    }

    public function createTasks($overview, $detail, $limitDate, $assigner)
    {
        $sql = "INSERT INTO tasks (overview, detail, limit_date, assigner_name, is_deleted, created_at, updated_at)
                VALUES ('$overview', '$detail', '$limitDate', '$assigner', 0, NOW(), NOW());";
        echo $sql;
        if ($this->db->query($sql) === true) {
            echo 'タスクが正常に登録されました。';
        } else {
            echo 'タスクの登録中に問題が発生しました。';
        }
    }

    public function fetchTasks()
    {
        // select文でテーブル全部の中身を持ってくる
        return $this->db->query('SELECT * FROM tasks');
    }

    public function updateTasks()
    {

    }

    public function close()
    {
        $this->db->close();
    }
}