<?php

namespace app\controllers;

use app\core\Controller;
use app\core\View;

class Todo extends Controller
{
    private $sort = 'id';
    private $orderNext = 1;
    private $orderCurrent = 0;
    private $orderBy = 'ASC';
    private $admin = false;

    private function sortBy()
    {
        $sort = filter_input(INPUT_GET, 'sort');

        switch ($sort)
        {
            case 'id':
                $this->sort = 'id';
            break;

            case 'user':
                $this->sort = 'user';
            break;

            case 'email':
                $this->sort = 'email';
            break;

            case 'status':
                $this->sort = 'status';
            break;
        }
    }

    private function orderBy()
    {
        $order = filter_input(INPUT_GET, 'order');

        switch ($order) {
            case '0':
                $this->orderNext = 1;
                $this->orderCurrent = 0;
                $this->orderBy = 'ASC';
            break;

            case '1':
                $this->orderNext = 0;
                $this->orderCurrent = 1;
                $this->orderBy = 'DESC';
            break;
        }
    }

    public function list()
    {
        session_start();

        if (isset($_SESSION['admin']))
        {
            $this->admin = true;
        }

        // find out how many items are in the table
        $totalItems = $this->model->countTodos();

        // how many items to list per page
        $limitItems = 3;

        // how many pages will there be
        $allPages = ceil($totalItems / $limitItems);

        // what page are we currently on?
        $currentPage = min($allPages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, ['options' => ['default' => 1, 'min_range' => 1]]));

        // calculate the offset for the query
        $offset = ($currentPage - 1) * $limitItems;

        $this->sortBy();

        $this->orderBy();

        $data = $this->model->getTodos($this->sort, $this->orderBy, $limitItems, $offset);

        $this->view->render([
            'title' => 'TODO List',
            'data' => $data,
            'currentPage' => $currentPage,
            'allPages' => $allPages,
            'sort' => $this->sort,
            'orderNext' => $this->orderNext,
            'orderCurrent' => $this->orderCurrent,
            'admin' => $this->admin
        ]);
    }

    public function create()
    {
        $this->view->render(['title' => 'TODO Create']);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['user'] && $_POST['email'] && $_POST['text']))
        {
            if (!preg_match('/^[a-zA-Z]+$/', $_POST['user']))
            {
                View::msg([
                    'title' => 'Error',
                    'description' => 'Invalid <b>user</b> format',
                    'button_text' => 'Back',
                    'button_link' => '/todo/create'
                ]);
            }

            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            {
                View::msg([
                    'title' => 'Error',
                    'description' => 'Invalid <b>email</b> format',
                    'button_text' => 'Back',
                    'button_link' => '/todo/create'
                ]);
            }

            $text = trim($_POST['text']);
            $text = stripslashes($text);
            $text = htmlspecialchars($text);

            $this->model->storeTodos($_POST['user'], $_POST['email'], $text);

            View::msg([
                'title' => 'Success',
                'button_text' => 'Go to TODO list',
                'button_link' => '/todo/list'
            ]);
        }
        else
        {
            View::msg([
                'title' => 'Error',
                'description' => 'All fields are required',
                'button_text' => 'Back',
                'button_link' => '/todo/create'
            ]);
        }
    }
}
