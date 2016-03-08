<?php
require_once 'API.php';
class MyAPI extends API
{
    protected $User;

    public function __construct($request, $origin) {
        parent::__construct($request);
    }

    protected function fail() {
       if ($this->method == 'GET') {
          return "Your name is vandal";
        } else {
            return "Only accepts GET requests";
        }
     }
}
