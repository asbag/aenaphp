<?php
//call_user_func() usando un nombre de espacios de nombres
namespace Foobar;

class Foo {
    static public function prueba() {
        print "¡Hola mundo!\n";
    }
}

call_user_func(__NAMESPACE__ .'\Foo::prueba'); // A partir de PHP 5.3.0
call_user_func(array(__NAMESPACE__ .'\Foo', 'prueba')); // A partir de PHP 5.3.0

?>

