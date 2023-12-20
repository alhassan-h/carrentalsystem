<?php

require_once 'connection.php';

function isAdminLoggedIn()
{
    return (isset($_SESSION['loggedInAdminId']))?true:false;
}

function isUserLoggedIn()
{
    return (isset($_SESSION['loggedInUserId']))?true:false;
}

function checkAdminLogin()
{
    if( !isAdminLoggedIn() ){
        header('location: ../admin_login.php');exit;
    }
}

function checkLogin()
{
    if( !isUserLoggedIn() ){
        header('location: ../login.php');exit;
    }
}

function getUsername($id)
{
    global $dbc;
    $sql = "SELECT `username` FROM `users` WHERE `id`='$id'";
    $result = $dbc->query( $sql );
    $username = '';
    if( $dbc->affected_rows > 0 )
        $username = $result->fetch_assoc()['username'];
    return $username;
}

function getEmail($id)
{
    global $dbc;
    $sql = "SELECT `email` FROM `users` WHERE `id`='$id'";
    $result = $dbc->query( $sql );
    $email = '';
    if( $dbc->affected_rows > 0 )
        $email = $result->fetch_assoc()['email'];
    return $email;
}