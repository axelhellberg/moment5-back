<?php 
// error_reporting(-1);
// ini_set("display_errors", 1);

spl_autoload_register(function ($class) { // automatically load classes from classes folder
    include "classes/" . $class . ".class.php";
});

if (session_status() == PHP_SESSION_NONE) { // start session
    session_start();
}

// DATABASE

// create database my_curriculum;
// use my_curriculum;

// create user 'user'@'localhost' identified by 'password';
// grant all privileges on my_curriculum.* to 'user'@'localhost';

// create table course (
//     id          int(11) not null auto_increment,
//     code        varchar(16) not null,
//     name        varchar(64) not null,
//     progress    varchar(4),
//     syllabus    varchar(512),
//     primary key (id)
// );


// database variables
define("DBHOST", "localhost");
define("DBUSER", "user");
define("DBPASS", "password");
define("DBNAME", "my_curriculum");

?>
