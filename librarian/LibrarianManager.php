<?php

require_once ('../config/DatabaseConnection.php');

class LibrarianManager extends DatabaseConnection
{
    function __construct()
    {
        parent::__construct();
    }

    function logout()
    {
        session_destroy();
        header('Location:../userLogin.php');
    }


}


?>