<?php

namespace Model;
require '../../vendor/autoload.php';
use mysqli;
use Dotenv;
use mysqli_result;

class TodoModel
{
    private $db;

    public function __construct()
    {
        // ToDo: user = admin, pass = adminpass,でやると失敗する, mysql -u root -pでコンテナに入ってるから？
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->safeLoad();

        $host   = $_ENV['MYSQL_HOST'] ?? null;
        $user   = $_ENV['MYSQL_USER'] ?? null;
        $pass   = $_ENV['MYSQL_PASS'] ?? null;
        $dbName = $_ENV['MYSQL_DB'] ?? null;

        if ( !($host && $user && $pass && $dbName) ) {
            die('環境変数を読み込めませんでした');
        }
        $this->db = new mysqli($host, $user, $pass, $dbName);
        if ( mysqli_connect_errno() ) {
            die('データベース接続エラー: ' . mysqli_connect_errno());
        }
        if ( !$this->db->set_charset("utf8") ) {
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
        
        if (!$this->db->query($sql)) {
            die ('タスクの登録中に問題が発生しました。');
        }
    }

    /**
     * @return mysqli_result
     */
    public function fetchTasks(): mysqli_result
    {
        $query = 'SELECT * FROM tasks WHERE is_deleted != 1';
        return $this->db->query($query);
    }

    /**
     * @param $id
     * @return mysqli_result
     */
    public function fetchTask($id): mysqli_result
    {
        $query = "SELECT * FROM tasks WHERE id='$id'";
        return $this->db->query($query);
    }

    /**
     * Undocumented function
     *
     * @param String $number
     * @param String $overview
     * @param String $detail
     * @param String $limitDate
     * @param String $assigner
     * @return void
     */
    public function updateTasks($number, $overview, $detail, $limitDate, $assigner)
    {
        $query = "UPDATE tasks
                  SET overview='$overview',
                  detail='$detail',
                  limit_date='$limitDate',
                  assigner_name='$assigner',
                  is_deleted=0,
                  updated_at=NOW()
                  WHERE id='$number'";
        if (!$this->db->query($query)) {
            die('タスクの更新中に問題が発生しました。');
        }
    }

    /**
     * Undocumented function
     *
     * @param String $id
     * @return void
     */
    public function deleteTasks($id)
    {
        $query = "UPDATE tasks
                  SET is_deleted = '1'
                  WHERE id = '$id'";

        if (!$this->db->query($query)) {
            die ('タスクの削除中に問題が発生しました。');
        }
    }

    /**
     * @return void
     */
    public function close()
    {
        $this->db->close();
    }
}