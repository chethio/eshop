<?php
session_start();
require "connection.php";



if (isset($_SESSION["a"])) {
    $text = $_GET["t"];

    if (empty($text)) {
        echo "Please enter a category name";
    } else {

        $categoryrs = database::search("SELECT * FROM `category` WHERE `name`='" . $text . "' ");
        $num = $categoryrs->num_rows;

        if ($num >= 1) {
            echo "Category already exist";
        } else {
            database::iud("INSERT INTO `category`(`name`) VALUES('$text')");
            echo "success";
        }
    }
}