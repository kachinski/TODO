<?php

namespace app\core;

use PDO;

class Db
{
    public $db;

    public function __construct()
    {
        $config = require_once 'app/config/db.php';
        $this->db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['db'] . '', $config['user'], $config['password']);
    }

    public function row($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);

        if (!empty($params))
        {
            $i = 0;
            foreach ($params as $value)
            {
                $i++;
                $stmt->bindValue($i, $value);
            }
        }

        if ($stmt->execute())
        {
            return $stmt;
        }
        else
        {
            View::msg([
                'title' => 'Error',
                'description' => 'Something is wrong with <b>db</b>',
                'button_text' => 'Go to TODO list',
                'button_link' => '/todo/list'
            ]);
        }
    }

    public function column($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchColumn();
    }

    public function insert($sql, $params)
    {
        return $this->query($sql, $params);
    }

    public function update($sql, $params)
    {
        return $this->query($sql, $params);
    }
}
