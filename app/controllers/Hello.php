<?php
//Hello.php
namespace App\Controllers;

class Hello {

public function getIndex($name){
// $user = s()->db()->create( 'wall' );
// $user->user = 'Pranjal';
// $user->dop = '10/10/2020';
// $user->status= 'ljksnlksdjnfklsjnsfknfds';
// $id = s()->db()->save($user);
return 'Hello '.$name;
}

}
