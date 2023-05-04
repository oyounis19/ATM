<?php
abstract class User
{
  private string $name;
  public function getName()
  {
    return $this->name;
  }

  public function setName(string $name)
  {
    $this->name = $name;
    return $this;
  }
  abstract public function login($_userName, $_passWord);
  abstract public function logout();
}
