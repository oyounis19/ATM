<?php
abstract class User {
    protected $name;

    public function __construct($name = null) {
      if($name)
        $this->name = $name;
    }

    public function getName() {
      return $this->name;
    }
    public function setName(string $name) {
      $this->name = $name;
    }
    abstract public function login($user, $pass);
    abstract public function logout();
}
?>