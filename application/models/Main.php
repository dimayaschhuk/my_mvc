<?php

namespace  application\models;

use application\core\Model;
class Main extends Model{

    public function gerNews($a)
    {
        $result=$this->db->row("insert into users(name, first_name,email,password) values ('$a', '1','12','1')");
        return $result ;
    }
    public function setName($name,$password)
    {
        $result=$this->db->row("SELECT `name` FROM `users` WHERE  `email`='$name' AND `password`='$password'");
        return $result ;
    }

    public function allGet()
    {
        $result=$this->db->row("SELECT * FROM `test2` ");
        return $result ;
    }

    public function setNewTasks($name,$email,$name_img,$description,$email_creator)
    {
        $password=md5($password);
        $result=$this->db->row("insert into test2(name, email,name_img,description,email_creator,status) values ('$name', '$email','$name_img','$description','$email_creator','')");
        $result=$this->db->row("SELECT * FROM `test2` WHERE  `name`='$name' AND `description`='$description'");
        return $result ;

    }

}