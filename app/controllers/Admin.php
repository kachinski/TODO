<?php

namespace app\controllers;

use app\core\Controller;
use app\core\View;

class Admin extends Controller
{
    public function edit()
    {
        session_start();

        if (!isset($_SESSION['admin']))
        {
            View::msg([
                'title' => 'Forbidden',
                'button_text' => 'Go to TODO list',
                'button_link' => '/todo/list'
            ], 403);
        }
        else
        {
            if (isset($_GET['id']) && $_GET['id'] > 0)
            {
                $id = $_GET['id'];

                $data = $this->model->getData($id);

                $this->view->render(['title' => 'Edit TODO', 'data' => $data[0]]);
            }
            else
            {
                View::msg([
                    'title' => 'ID not specified',
                    'button_text' => 'Go to TODO list',
                    'button_link' => '/todo/list'
                ], 403);
            }
        }
    }

    public function login()
    {
        session_start();

        if (isset($_SESSION['admin']))
        {
            header('Location: ' . $this->host . '/todo/list');
        }
        else
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                if ($_POST['login'] === 'admin' && $_POST['password'] === '123')
                {
                    $_SESSION['admin'] = true;
                    header('Location: ' . $this->host . '/todo/list');
                }
                else
                {
                    View::msg([
                        'title' => 'Error',
                        'description' => 'Wrong <b>username</b> or <b>password</b>',
                        'button_text' => 'Go to TODO list',
                        'button_link' => '/todo/list'
                    ]);
                }
            }
            else
            {
                $this->view->render(['title' => 'Control Panel']);
            }
        }
    }

    public function logout()
    {
        session_start();

        if (isset($_SESSION['admin']))
        {
            unset($_SESSION['admin']);

            session_destroy();

            header('Location: ' . $this->host . '/todo/list'); die;
        }

        View::msg([
            'title' => 'Forbidden',
            'button_text' => 'Go to TODO list',
            'button_link' => '/todo/list'
        ], 403);
    }

    public function update()
    {
        session_start();

        if (isset($_SESSION['admin']))
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['id'] && $_POST['user'] && $_POST['email'] && $_POST['text']))
            {
                if (!preg_match('/^[^0]+\d*$/', $_POST['id']))
                {
                    View::msg([
                        'title' => 'Error',
                        'description' => 'Invalid <b>id</b> format',
                        'button_text' => 'Go to TODO list',
                        'button_link' => '/todo/list'
                    ]);
                }

                if (!preg_match('/^[a-zA-Z]+$/', $_POST['user']))
                {
                    View::msg([
                        'title' => 'Error',
                        'description' => 'Invalid <b>user</b> format',
                        'button_text' => 'Go to TODO list',
                        'button_link' => '/todo/list'
                    ]);
                }

                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
                {
                    View::msg([
                        'title' => 'Error',
                        'description' => 'Invalid <b>email</b> format',
                        'button_text' => 'Go to TODO list',
                        'button_link' => '/todo/list'
                    ]);
                }

                $text = trim($_POST['text']);
                $text = stripslashes($text);
                $text = htmlspecialchars($text);

                if (isset($_POST['toggle']))
                {
                    $toggle = 1;
                }
                else
                {
                    $toggle = 0;
                }

                // only if text edited by admin
                $oldData = $this->model->getComment($_POST['id']);

                if ($oldData === $text)
                {
                    $admin = 0;
                }
                else
                {
                    $admin = 1;
                }
                // ===

                $this->model->updateData($_POST['id'], $_POST['user'], $_POST['email'], $text, $toggle, $admin);

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
                    'description' => 'The form cannot be empty',
                    'button_text' => 'Go to TODO list',
                    'button_link' => '/todo/list'
                ]);
            }
        }
        else
        {
            View::msg([
                'title' => 'Forbidden',
                'button_text' => 'Go to TODO list',
                'button_link' => '/todo/list'
            ], 403);
        }
    }
}
