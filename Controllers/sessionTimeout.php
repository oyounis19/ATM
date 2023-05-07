<?php
class Session{
    private $sessionTimeout;
    public function __construct(){
        $this->sessionTimeout = 3;
    }
    public function checkSessionTimeout($last_activity, $redirect_url, $refresh_delay = 0) {
        if ((time() - $last_activity) > $this->sessionTimeout) {
            // Session has expired, log out the user
            session_unset();
            session_destroy();
            // Redirect the user to the right page with desired delay
            header("refresh:$refresh_delay;url=$redirect_url");
            exit();
        }
    }
    
}


?>