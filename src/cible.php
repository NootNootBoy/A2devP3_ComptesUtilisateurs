<?php

    if(checkPseudo() && checkMail() && verifyPassword()){
        echo "yes ";
        $password = $_POST['password'];
        $hashPassWord = password_hash($password, PASSWORD_BCRYPT);
        echo $hashPassWord;
    }
    
    function checkPseudo() {

        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = htmlspecialchars($_POST['password']);

        if(strlen($pseudo) >= 3 && strlen($pseudo) <= 16){
        echo 'ok ';
        return true;
        }
        else{
            echo "no";
            return false;
        }
    }

    function checkMail() {

        $mail = htmlspecialchars($_POST['mail']);
        
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
            echo 'ok ';
            return true;
            }
            else{
                echo "no";
                exit;
            }
    }

    function verifyPassword(){

        $password = $_POST['password'];
        if(strlen($password) >= 12){
            echo "ok "; 
            return $password;
        }
        else{
            echo "no";
            return false;
        }

    }
      
   