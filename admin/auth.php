<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin')
{
    header("Location: ../login.php");
    exit();
}

$timeout = 900; // 15 minutes

if(isset($_SESSION['LAST_ACTIVITY']))
{
    if(time() - $_SESSION['LAST_ACTIVITY'] > $timeout)
    {
        session_destroy();

        header("Location: ../login.php?expired=1");
        exit();
    }
}

$_SESSION['LAST_ACTIVITY'] = time();
?>