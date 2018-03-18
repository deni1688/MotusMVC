<?php

class Posts extends Controller
{
    public function __construct()
    {
        if (!isAuthenticated()) {
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/index', $data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_error' => '',
                'body_error' => '',
            ];

            // validate title
            if (empty($data['title'])) {
                $data['title_error'] = 'Title cannot be empty';
            }

            // validate body
            if (empty($data['body'])) {
                $data['body_error'] = 'Please add content to your post';
            }

            if (empty($data['title_error']) && empty($data['body_error'])){
                if($this->postModel->addPost($data)){
                    flash('general_notification', 'Post Added');
                    redirect('posts/index');
                }else{
                    die('Could not add post to database');
                }
            }else{
                $this->view('posts/add', $data);
            }

        }else{
            $data = [
                'title' => '',
                'body' => '',
            ];
            $this->view('posts/add', $data);
        }
    }

    public function edit($id){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'title_error' => '',
                'body_error' => '',
                'id' => $id
            ];

            // validate title
            if (empty($data['title'])) {
                $data['title_error'] = 'Title cannot be empty';
            }

            // validate body
            if (empty($data['body'])) {
                $data['body_error'] = 'Please add content to your post';
            }

            if (empty($data['title_error']) && empty($data['body_error'])){
                if($this->postModel->updatePost($data)){
                    flash('general_notification', 'Post Edited');
                    redirect('posts/index');
                }else{
                    die('Could not edit post in database');
                }
            }else{
                $this->view('posts/edit', $data);
            }

        }else{
            $post = $this->postModel->getPostById($id);
            // check if post owner
            if($post->user_id != $_SESSION['user_id']){
                flash('general_notification', 'You are not authorized to edit that post', 'alert alert-warning');
                redirect('posts/index');
            }else{
                $data = [
                    'id' => $id,
                    'title' => $post->title,
                    'body' => $post->body,
                ];
                $this->view('posts/edit', $data);
            }
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $post = $this->postModel->getPostById($id);
            // check if post owner
            if($post->user_id != $_SESSION['user_id']){
                flash('general_notification', 'You are not authorized to edit that post', 'alert alert-warning');
                redirect('posts/index');
            }else{
                if($this->postModel->deletePost($id)){
                    flash('general_notification', 'Post Deleted');
                    redirect('posts/index');
                }else{
                    die('Clould not delete post from database');
                }
            }
        }else{
            redirect('posts/index');
        }
    }

    public function show($id){
        $post = $this->postModel->getPostById($id);
        $author = $this->userModel->getUserById($post->user_id);
        $data = [
            'post' => $post,
            'author' => $author
        ];
        $this->view('posts/single', $data);
    }
}