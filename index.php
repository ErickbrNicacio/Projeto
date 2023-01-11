<?php
session_start();

require_once("vendor/autoload.php");
require_once("vendor/hcodebr/src/DB/Sql.php");
require_once("vendor/hcodebr/src/DB/page.php");
require_once("vendor/hcodebr/src/DB/pageAdmin.php");

require_once("vendor/hcodebr/src/Model.php");


use \Slim\Slim;
use \Hcode\Page; 
use \Hcode\PageAdmin;
use \Hcode\Model\User;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function(){

    $page = new Page;

    $page->setTpl("index");

});

$app->get('/admin', function(){

    User::verifyLogin();

    $page = new PageAdmin;

    $page->setTpl("index");

});

$app->get('/admin/login', function(){

    $page = new PageAdmin([

        "header"=>false,
        "footer"=>false

    ]);

    $page->setTpl("login");

});

$app->post('/admin/login', function(){

    echo "1";
/*    User::login($_POST["login"], $_POST["password"]);
    
    header("Location: /admin");
    exit;
*/
});

$app->get('/admin/logout', function(){

    User::logout();

    header("Location: /admin/login");

});

$app->get('/admin/index', function(){

    $page = new Page;

    $page->setTpl("index");

});

$app->run();