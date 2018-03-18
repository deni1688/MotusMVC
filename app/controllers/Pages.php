<?php


// default controller set in Controller Class
class Pages extends Controller
{
    public function __construct()
    {
    }

    // default method set in Controller Class
    public function index()
    {
        $data = [
            'title' => 'Welcome to SharePosts',
            'desc' => 'Simple social network built on the MotusMVC PHP framework.'
        ];
        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About',
            'desc' => 'App to share posts between users.'
        ];
        $this->view('pages/about', $data);
    }
}