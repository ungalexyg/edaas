<?php




/**
 * --------------------------------------------------------------------------
 *  Objects Reader
 * --------------------------------------------------------------------------
 * 
 * Help to access any property in any object (including private/protected).
 * Used as utility to extends vendors by hacking properties visabilty. 
 *   https://ocramius.github.io/blog/accessing-private-php-class-members-without-reflection/
 */

class Foo
{
    private $bar = 'baz';
}

$reader = function & ($object, $property) {
    $value = & \Closure::bind(function & () use ($property) { 
        return $this->$property; 
    }, $object, $object)->__invoke();

    return $value;
};

$foo = new Foo();
$bar = & $reader($foo, 'bar');
$bar = 'tab';

var_dump($foo);