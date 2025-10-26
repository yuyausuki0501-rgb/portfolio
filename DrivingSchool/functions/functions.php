<?php   
    /**
     * XSS対策：エスケープ処理
     * @param string  $str対象の文字列
     * @return string 処理された文字列
     */
    function h($str){
       return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
    }

    /**
     * CSRF対策
     * @param void 
     * @return string $csrf_token 
     */
    function setToken() {
        if(empty($_SESSION['csrf_token'])){
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }