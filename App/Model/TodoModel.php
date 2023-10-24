<?php

namespace Model;
require '../../vendor/autoload.php';
use mysqli;
use Dotenv;

class TodoModel
{
    private $db;

    public function __construct()
    {
        // TODO user = admin, pass = adminpass,でやると失敗する
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->safeLoad();

        $host   = $_ENV['MYSQL_HOST'];
        $user   = $_ENV['MYSQL_USER'];
        $pass   = $_ENV['MYSQL_PASS'];
        $dbName = $_ENV['MYSQL_DB'];

        $this->db = new mysqli($host, $user, $pass, $dbName);
        if (mysqli_connect_errno()) {
            die('データベース接続エラー: ' . mysqli_connect_errno());
        }
        if (!$this->db->set_charset("utf8")) {
            die("Error loading character set utf8: %s\n" . $this->db->error);
        }
    }

    /**
     * @param $overview
     * @param $detail
     * @param $limitDate
     * @param $assigner
     * @return void
     */
    public function createTasks($overview, $detail, $limitDate, $assigner)
    {
        $sql = "INSERT INTO tasks (overview, detail, limit_date, assigner_name, is_deleted, created_at, updated_at)
                VALUES ('$overview', '$detail', '$limitDate', '$assigner', 0, NOW(), NOW());";
        if ($this->db->query($sql) === true) {
            $this->crudAlert('タスクが正常に登録されました。');
        } else {
            die ('タスクの登録中に問題が発生しました。');
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

    /**
     * @return void
     */
    public function close()
    {
        $this->db->close();
    }

    /**
     * @param $alertText
     * @return void
     */
    private function crudAlert($alertText)
    {
        echo "<script type='text/javascript'>alert('{$alertText}');</script>";
    }
}