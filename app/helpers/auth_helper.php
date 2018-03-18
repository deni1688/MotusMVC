<?php


function isAuthenticated()
{
    if (isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}