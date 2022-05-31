<?php

include './app/Router.php';
include './app/API.php';

$router = new Router($_SERVER['REQUEST_URI']);