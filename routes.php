<?php

const ROUTES = [
    "/" => [
        "CONTROLLER" => "HomeController",
        "METHOD" => "index",
        "HTTP_METHODS" => "GET",
    ],
    "/home" => [
        "CONTROLLER" => "HomeController",
        "METHOD" => "home",
        "HTTP_METHODS" => "GET",
    ],
    "/login" => [
        "CONTROLLER" => "AuthController",
        "METHOD" => "login",
        "HTTP_METHODS" => ["GET", "POST"],
    ],
    "/register" => [
        "CONTROLLER" => "AuthController",
        "METHOD" => "register",
        "HTTP_METHODS" => ["GET", "POST"],
    ],
];
