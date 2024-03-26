<?php
//the main page is app/public/index.php

require_once "router.php";

// Create a new router instance
$router = new Router();
$router->addRoute("GET","","");
$router->addRoute("GET","login", function(){
    header("Location: login.html");
});
$router->addRoute("GET","/","");
$router->addRoute("GET","/login", function(){
    header("Location: login.html");
});

//define routes
$router->get("/", function () {
    require_once "index.php";
});
$router->get("/login", function () {
    require_once "login.html";
});
//run
$router->run();
?>
