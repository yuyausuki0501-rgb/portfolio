<?php 
require_once __DIR__ . '/../config/db_connect.php';

class UserLogic
{
    /**
     * ユーザを登録する
     * @param array $userData
     * @return bool $result 
     */
    public static function createUser($userData){
        $result = false;
        $sql = 'INSERT INTO login (name , studentNumber ,password) VALUES (?, ?, ?)';
        
        //ユーザーデータを配列に入れる
        $arr = [];
        $arr[]= $userData['name'];
        $arr[]= $userData['studentNumber'];
        $arr[]= password_hash($userData['password'],
                PASSWORD_DEFAULT);
        try{
            $stmt = dbConnect()->prepare($sql);
            $result = $stmt->execute($arr);
        return $result;
        }catch(\Exeption $e){
            echo '登録失敗';
        }
        
    } 


     /**
     * ログイン照会　
     * @param string $number 
     * @param string $password 
     * @return bool $result 
     */
    public static function login($number,$password){ 

       $result = false;
       //ユーザー取得
       $user = self::getUserByStudentNumber($number);

       if(!$user){
        $_SESSION['msg'] = '教習生番号が違います。';
        return false;
       }

       if(!password_verify($password,$user['password'])){
        $_SESSION['msg'] = 'パスワードが違います。';
        return false;
       }

       //ログイン成功時
       session_regenerate_id(true);
       $_SESSION['loginUser'] = $user;
       return true;
       
    }

     /**
     * 教習生番号からユーザーを取得　　
     * @param string $number 
     * @return array|bool $user|false
     */
    public static function getUserByStudentNumber($number)
    {
      $sql = "SELECT * FROM login WHERE studentNumber = ?";
        
      //ユーザーデータを配列に入れる
        $arr = [];
        $arr[]= $number;
        
      try{
             //sqlの準備
            $stmt = dbConnect()->prepare($sql); 
             //sqlの実行
            $stmt->execute($arr);
            //SQLの結果を返す
            $user = $stmt->fetch();
             return $user;
        }catch(\Exception $e){
            return false;
        }
    }
    /**
     *DBから教習生の名前を取得
     */
    public static function getStudentName($name)
    {
        $sql = "SELECT * FROM login WHERE name = ?";
        
    try{
        $stmt = dbConnect()->prepare($sql);
        $stmt->execute([$name]);
        $userName = $stmt->fetch();
        return $userName;
    }catch(\Exception $e){
        echo "エラー: " . $e->getMessage();
        return null; // エラー時はnullを返すようにする
    }
    }
}

class Reservation{
    public static function getCity($city){
        $sql = "SELECT * FROM reservation WHERE City = :city";

        try{
            $stmt = dbConnect()->prepare($sql);
            $stmt->bindParam(':city',$city);
            $stmt->execute();
            $location = $stmt->fetchAll();
            return $location;
        }catch(\Exception $e){
            echo 'エラーが発生しました。'.$e->getMessage();
            return null;
        }
    }
    /**送迎場所を出力
     *@param array
     *  
     */
    public static function getLocationName($location){
        $spots = [];
        $spots = $location['location_name'];
        return $spots ;
    }

    public static function getLocationSpot($id){
        $sql = 'SELECT location_name,address,notes FROM reservation WHERE id = :id';

        try{
            $stmt = dbConnect()->prepare($sql);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->execute();
            $spotContent = $stmt->fetch(PDO::FETCH_ASSOC);
            return $spotContent;
        }catch(\Exception $e){
            echo 'エラーが発生しました'.$e->getMessage();
            return null;
        }
    }
}
?>