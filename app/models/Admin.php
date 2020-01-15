<?php

namespace app\models;

use app\core\Model;

class Admin extends Model
{
    public function getData($id)
    {
        return $this->db->row("SELECT * FROM `todos` WHERE `id` = ?", [$id]);
    }

    public function getComment($id)
    {
        return $this->db->column("SELECT `todo` FROM `todos` WHERE `id` = ?", [$id]);
    }

    public function updateData($id, $user, $email, $text, $status, $admin)
    {
        return $this->db->update("UPDATE `todos` SET `user` = ?, `email` = ?, `todo` = ?, `status` = $status, `admin` = $admin WHERE `id` = ?", [$user, $email, $text, $id]);
    }
}
