<?php
namespace application\controllers;

use application\core\Controller;
use application\lib\Db;

class MainController extends Controller{

    public function indexAction(){

        if(!isset($_SESSION['max_record'])){
            $_SESSION['max_record']=3;
        }
        $all_tasks=$this->model->allGet();
        //кількість завдань
        $count_records=count($all_tasks);

        //кількість сторінок
        $count_page=ceil($count_records/3);




        $record=[];

        foreach ($all_tasks as $item){


            $qaz=[
                'name'=>iconv('cp1251', 'utf-8', preg_replace_callback('/\\\\u([a-f0-9]{4})/i', create_function('$m', 'return chr(hexdec($m[1])-1072+224);'), $item['name'])),
                'email_creator'=>$item['email_creator'],
                'email'=>$item['email'],
                'description'=>iconv('cp1251', 'utf-8', preg_replace_callback('/\\\\u([a-f0-9]{4})/i', create_function('$m', 'return chr(hexdec($m[1])-1072+224);'), $item['description'])),
                'status'=>$item['status'],
                'name_img'=>iconv('cp1251', 'utf-8', preg_replace_callback('/\\\\u([a-f0-9]{4})/i', create_function('$m', 'return chr(hexdec($m[1])-1072+224);'), $item['name_img'])),

            ];
            array_push($record,$qaz);

        }

        $record=json_encode($record, JSON_UNESCAPED_UNICODE);



        $vars=[
            'record'=>$record,
            'count_records'=>$count_records,
            'count_page'=>$count_page,
        ];

        $this->view->render('index',$vars);

    }



    public function save_tasksAction(){
        $_POST = json_decode(file_get_contents('php://input'), true);

        //створюємо нове завдання
        $a=$this->model->setNewTasks($_POST['name'],$_POST['email'],$_POST['name_img'],$_POST['description'],$_POST['email_creator']);
        $tasks=json_encode($a, JSON_UNESCAPED_UNICODE);
        echo $tasks;
    }


    public function next_pageAction(){
        $_POST = json_decode(file_get_contents('php://input'), true);

        if(isset($_POST['page'])){
            $_SESSION['max_record']=$_POST['page']*3;
            echo 'go';
        }
    }







    public function downloadAction(){


        if ( 0 < $_FILES['file']['error'] ) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';

        }
        else {
//

                    $final_width_of_image = 700 ; //Размер изображения которые Вы хотели бы получить (И ШИРИНА И ВЫСОТА)
                    $path_to_image_directory = 'public/img/'; //Папка, куда будут загружаться полноразмерные изображения
                    $path_to_thumbs_directory = 'public/img/';//Папка, куда будут загружаться миниатюры


                    function createThumbnail($filename)
                    {
                        $final_width_of_image = 700; //Размер изображения которые Вы хотели бы получить (И ШИРИНА И ВЫСОТА)
                        $path_to_image_directory ='public/img/'; //Папка, куда будут загружаться полноразмерные изображения
                        $path_to_thumbs_directory = 'public/img/';//Папка, куда будут загружаться миниатюры


                        if (preg_match('/[.](jpg)$/', $filename)) {
                            $im = imagecreatefromjpeg($path_to_image_directory . $filename);
                        } else if (preg_match('/[.](gif)$/', $filename)) {
                            $im = imagecreatefromgif($path_to_image_directory . $filename);
                        } else if (preg_match('/[.](png)$/', $filename)) {
                            $im = imagecreatefrompng($path_to_image_directory . $filename);
                        } //Определяем формат изображения

                        $ox = 320;
                        $oy = 240;

                        $nx = $final_width_of_image;
                        $ny = floor($oy * ($final_width_of_image / $ox));

                        $nm = imagecreatetruecolor($nx, $ny);

                        imagecopyresized($nm, $im, 0, 0, 0, 0, $nx, $ny, $ox, $oy);


                        imagejpeg($nm, $path_to_thumbs_directory . $filename);
                        $tn = '<img src="' . $path_to_thumbs_directory . $filename . '" alt="image" />';
                        $tn .= '<br />Поздравляем! Ваше изображение успешно загружено и его миниатюра удачно выполнена. Выше Вы можете просмотреть результат:';

                    }//Сжимаем изображение, если есть оишибки, то говорим о них, если их нет, то выводим получившуюся миниатюру
                    if (isset($_FILES['file'])) {

                        if (preg_match('/[.](jpg)|(gif)|(png)$/', //Ставим допустимые форматы изображений для загрузки
                            $_FILES['file']['name'])) {
                            $type = explode('.', $_FILES['file']['name']);
                            $type = $type[count($type) - 1];

                            $b = md5_file($_FILES['file']['tmp_name']) . '.' . $type;
                            $filename = md5_file($_FILES['file']['tmp_name']) . '.' . $type;
                            $source = $_FILES['file']['tmp_name'];
                            $target = $path_to_image_directory . $filename;

                            move_uploaded_file($source, $target);

                            createThumbnail($filename);
                        }
                    }





echo 'public/img/'.$b;

$_SESSION['name_img']=$b;





        }

    }

}