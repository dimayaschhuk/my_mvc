<?php
namespace application\controllers;

use application\core\Controller;
class AccountController extends Controller{

    public function loginAction(){
        $this->view->render('login');

    }

    public function registerAction(){
//        $this->view->redirect('/');
//        echo '11';
        $this->view->render('register');
    }

    public function register_postAction(){
//

        $_POST = json_decode(file_get_contents('php://input'), true);

        $a=$this->model->setNewUser($_POST['email'],$_POST['password'],$_POST['email']);
        $_SESSION['user_name']=$a[0]['name'];
        $_SESSION['user_id']=$a[0]['id'];
        $_SESSION['user_status']=$a[0]['status'];
        $_SESSION['user_email']=$a[0]['email'];
        echo 'go';


      
    }

    public function login_postAction(){
//

        $_POST = json_decode(file_get_contents('php://input'), true);

        $a=$this->model->getUser($_POST['login'],$_POST['password']);
        $_SESSION['user_name']=$a[0]['name'];
        $_SESSION['user_id']=$a[0]['id'];
        $_SESSION['user_status']=$a[0]['status'];
        $_SESSION['user_email']=$a[0]['email'];

        echo 'run';



    }
    public function good_tasksAction(){

        $_POST = json_decode(file_get_contents('php://input'), true);

        if(isset($_POST)){

            $name=$_POST['name'];
            $email_creator=$_POST['email_creator'];


            $a=$this->model->goodTasks($name,$email_creator);
            echo $a;
        }
    }
}