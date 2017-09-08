<?php
namespace models;
use core\Model; 
  class MainModel extends Model
  {

    public function loginCheck()
    {
       $login = isset($_POST['login']) && $_POST['login'] !== '' ? trim(htmlspecialchars(stripslashes($_POST['login']))) : false;
       $password = isset($_POST['password']) && $_POST['password'] !== '' ? trim(htmlspecialchars(stripslashes($_POST['password']))) : false;

       if ( ! $login || ! $password) {
         exit ("You should check your login or password");
       }


       $result = self::$query->queryRow("SELECT * FROM users WHERE name='$login'");
       //print_r($result);
       if($login == $result['name']){
         if($password == $result['password']){
           header('Location:/MVC');
           session_start();
           $_SESSION['user'] = $login;
         }
         else{
           echo 'Password incorrect';
         }
       }
       else{
         echo 'неправильный логин';
       }
    }


    public function logOut(){
      session_start();
      unset($_SESSION['user']);
      header('Location:/MVC');
    }
  }

 ?>
