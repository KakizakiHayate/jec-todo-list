<?php
class TodoModel {
    private $db;

    public function __contruct()
    {
        $host = 'localhost';
        $user = 'user1';
        $pass = 'rootpassword';
        $dbName = 'TodoListDB';
        $this->db = new mysqli($host, $user, $pass, $dbName);
        if ($this->db->connect_error) {
            die('データベース接続エラー: ' . $this->db->connect_error);
        }
    }

    public function createTasks($overview, $detail, $limitDate, $assigner)
    {

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