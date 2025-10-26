<?php
// 1.デーベース接続
function dbConnect(){
    $dsn = 'mysql:host=localhost;dbname=login.app;charset=utf8';
    $user ='login_user';
    $pass = 'yuuya0501';

    try{
        $dbh = new PDO($dsn,$user,$pass,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    }catch(PDOException $e){
        echo '接続失敗'.$e->getMessage();
        exit();
    };
    return $dbh;
}
//2.教習生情報 
function getlogininfomation(){
    $dbh = dbConnect();
        // ①SQLの準備
        $sql = 'SELECT * FROM login';
        //②sqlの実行
        $stmt = $dbh->query($sql);
        //③sqlの結果を受け取る
        $result = $stmt->fetchall(PDO::FETCH_ASSOC);
        return $result;
        $dbh = null;
}
 $yuuyas = getlogininfomation();
      
//予約情報のデータベースに接続
function reservationDb(){
    $dsn = 'mysql:host=localhost;dbname=login.app;charset=utf8';
    $user ='login_user';
    $pass = 'yuuya0501';

    try{
        $dbh = new PDO($dsn,$user,$pass,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,]     
        );
    }catch(PDOException $e){
        echo '予約場所のDB接続失敗',$e->getMessage();
        exit();
    };
    return $dbh;
}
//データベース接続
function getReservationInfomation(){
    $dbh = reservationDb();
        // ①SQLの準備
        $sql = 'SELECT * FROM reservation';
        //②sqlの実行
        $stmt = $dbh->query($sql);
        //③sqlの結果を受け取る
        $result = $stmt->fetchall(PDO::FETCH_ASSOC);
        return $result;
        }
?>

