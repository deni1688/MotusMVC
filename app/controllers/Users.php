<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $data = [
            'title' => 'Welcome to SharePosts',
            'desc' => 'Simple social network built on the MotusMVC PHP framework.'
        ];
        $this->view('pages/404', $data);
    }

    // goes to register form and handles registration submission
    public function register()
    {
        if (isAuthenticated()) {
            redirect('posts/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process form

            // sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // validate email
            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter a email address';
            } else {
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_error'] = 'Email is already taken';
                }
            }

            // validate name
            if (empty($data['name'])) {
                $data['name_error'] = 'Please enter your name';
            }

            // validate password
            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter your password';
            } else if (strlen($data['password']) < 6) {
                $data['password_error'] = 'Please enter a password with 6 or more characters';
            }

            // validate confirm_password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_error'] = 'Please confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_error'] = 'Passwords do not match';
                }
            }
            // make sure no errors are present in the data
            if (empty($data['email_error']) && empty($data['name_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {
                // hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                // register user
                if ($this->userModel->register($data)) {
                    flash('auth_notification', 'Your are registered and can login');
                    redirect('users/login');
                } else {
                    die('Something went wrong. Failed to register user.');
                }
            } else {
                $this->view('users/register', $data);
            }


        } else {
            // init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'consfirm_password_error' => ''
            ];
            // get register view
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        if (isAuthenticated()) {
            redirect('posts/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process form

            // sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'password_error' => ''
            ];

            // validate email
            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter a email address';
            }

            // validate password
            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter your password';
            }

            // check for user email
            if ($this->userModel->findUserByEmail($data['email'])) {

            } else {
                $data['email_error'] = 'No user found with that email';
            }

            // make sure no errors are present in the data
            if (empty($data['email_error']) && empty($data['password_error'])) {
                // validated
                // check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if ($loggedInUser) {
                    // create session variables
                    $this->createUSerSession($loggedInUser);
                } else {
                    $data['password_error'] = 'Password not valid';
                    $this->view('users/login', $data);
                }
            } else {
                $this->view('users/login', $data);
            }

        } else {
            // init data
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => '',
            ];
            // get login view
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['email'] = $user->email;
        $_SESSION['name'] = $user->name;
        redirect('posts/index');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['email']);
        unset($_SESSION['name']);
        session_destroy();
        flash('auth_notification', 'You are logged out');
        redirect('users/login');
    }
}