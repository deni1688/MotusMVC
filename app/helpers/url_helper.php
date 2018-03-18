<?php

// simple page redirect
function redirect($page){
    return header('location: ' . URLROOT . '/' . $page);
}