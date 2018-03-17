<?php


// default controller
class Pages extends Controller
{
    public function __construct()
    {
    }

    // default method
    public function index()
    {
        $data = [
            'title' => 'Welcome to the MotusMVC',
            ];
        $this->view('pages/index', $data);
    }
}