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
            'title' => 'Welcome to the MotusMVC',
            ];
        $this->view('pages/index', $data);
    }
}