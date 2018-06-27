<?php
namespace  application\models;

use application\core\Model;
class Account extends Model{

    public function gerNews($name,$password)
    {
        $result=$this->db->row("SELECT into users(name, first_name,email,password) values ('$a', '1','12','1')");
        return $result ;
    }
    public function setNewUser($name,$email,$password)
    {
        $password=md5($password);
        $result=$this->db->row("insert into test(name, email,password,status) values ('$name', '$email','$password','user')");
        $result=$this->db->row("SELECT * FROM `test` WHERE  `name`='$name' AND `password`='$password'");
        return $result ;

    }

    public function getUser($name,$password)
    {
        $password=md5($password);
        $result=$this->db->row("SELECT * FROM `test` WHERE  `name`='$name' AND `password`='$password'");
        return $result ;
    }

    public function goodTasks($name,$email_creator)
    {

        $result=$this->db->row("UPDATE test2
      SET status='true'
      WHERE `name`='$name' AND  `email_creator`='$email_creator'");

        $result=$this->db->row("SELECT * FROM `test2` WHERE  `name`='$name' AND `email_creator`='$email_creator'");

        return $result ;
    }
}