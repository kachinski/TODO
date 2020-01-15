<?php

namespace app\models;

use app\core\Model;
use PDO;

class Todo extends Model
{
    public function getTodos($sort, $order, $limit, $offset)
    {
        $stmt = $this->db->db->prepare("SELECT * FROM `todos` ORDER BY $sort $order LIMIT ? OFFSET ?");

        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countTodos()
    {
        return $this->db->column("SELECT COUNT(*) FROM `todos`");
    }

    public function storeTodos($user, $email, $text)
    {
        return $this->db->insert("INSERT INTO `todos` (`user`, `email`, `todo`) VALUES (?, ?, ?)", [$user, $email, $text]);
    }
}
