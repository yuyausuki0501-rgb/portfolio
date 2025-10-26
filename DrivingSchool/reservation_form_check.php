<?php 
session_name('DrivingSchool');
session_start();

require_once __DIR__.'/functions/functions.php';
require_once __DIR__.'/config/db_connect.php';


$err = [];


//未入力チェック

    if(!isset($_POST['departure_datetime'])){
        $err['departure'] ='行きの送迎バス時間を入力してください';
    };

    if(!isset($_POST['return_datetime'])){
        $err['return']  = '帰りの送迎バス時間を入力してください';
    }


?>