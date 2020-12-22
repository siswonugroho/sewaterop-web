<?php

class Session
{
    public static function isLoggedIn()
    {
        if (isset($_SESSION['username'])) return true;
        else return false;
    }

    public static function startSession()
    {
        if (!session_id()){
            session_start();
        }
    }
}
