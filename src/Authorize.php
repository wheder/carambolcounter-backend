<?php

class Authorize {

    private $username;
    private $token;

    public function __construct($username, $token)
    {
        if ( isset($username) && isset($token)) {
            echo $username . ' and ' . $token;
            $this->username = $username;
            $this->token = $token;
        } else {
            throw new Exception("ani hovno");
        }
    }

    public function isAuthorized()
    {
        if ( true ) {

            return true;
        } 
        return false;
    }
}
