<?php
namespace App\Controllers;

Class Main {
    function getHi(){
        $user = s()->db()::get('user',1);
        return s()->t()->render('hello',['user'=>$user->name]);
    }
}