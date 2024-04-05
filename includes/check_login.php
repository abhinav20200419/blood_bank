<?php 
    session_start();

    $is_h_login = 0;
    $is_u_login = 0;

    if(isset($_SESSION['hospital_id']))
    {
        $is_h_login = 1;
    }

    if(isset($_SESSION['user_id']))
    {
        $is_u_login = 1;
    }


?>