
<?php
    include_once'psl-config.php';
    function sec_session_start(){
    
        $session_name = 'sec_session_id';
    
    $secure = SECURE;

    $httponly = true;

    if(ini_set('session.use_only_cookies',1)===FALSE){
        header("location:../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
    $cookieParams["path"],
    $cookieParams["domains"],
    $secure,
    $httponly);

    session_name($session_name);
    session_start();
    session_regenerate_id();
}

function login ($email, $password, $mysqli){
    if($stmt = $mysqli->prepare("SELECT id, username, password, salt
    FROM members
    WHERE email=?
    LIMIT 1")){
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id, $username, $db_password, $salt);
        $stmt->fetch();
        $password = hash('sha512',$password.$salt);
        if($stmt->num_rows==1){
            if(checkbrute($user_id,$mysqli)==true){
                return false (false);
            }else{
                if($db_password==$password){
                    $user_browser=$_SERVER['HTTP_USER_AGENT'];
                    $user_id=preg_replace("/[^0-9]+/","",$user_id);
                    $_SESSION['user_id']=$user_id;
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/","",$username);
                    $_SESSION['username']=$username;
                    $_SESSION['login_string']=hash('sha512',$password . $user_browser);
                    return true;
                    }else{
                        $now = time();
                        $mysqli->query("INSERT INTO login_attempts(user_id,time)
                        VALUE('$user_id','$now'))");
                        return false;
                    }
                }
            }else{
                
                return false;
            }
        }
    }
    
     function esc_url($url){ 

        if(''==$url) {
            return $url;
        }
        

   $url=preg_replacee('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);

   $strip = array('%0d','%0a','%0D','%0A');
   url = (string)$url;

   $count=1;
   while($count){
    $url = str_replace($strip,'',$url,$count);
   }

   $url = str_replace(';//', '://', $url);
   $url = htmlentities($url);

   $url = str_replace('&amp;', '&#038;', $url);    
   $url = str_replace("'", '&#039;', $url);

   if ($url[0] !== '/'){
    $_SERVER['PHP_SELF']
    return'';
   }else{
    return $url;
    } 
   }