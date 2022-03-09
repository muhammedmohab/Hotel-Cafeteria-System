<?php
include "./DatabaseConnectionModel.php";

class TablesModel{

    private $USER_QUERY = "CREATE TABLE IF NOT exists user(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        email VARCHAR(30) NOT NULL,
        password VARCHAR(30) NOT NULL,
        roomNumber VARCHAR(50),
        image varchar(50),
        admin boolean
        )";

    private $CATEGORY_QUERY = "CREATE TABLE IF NOT EXISTS category(
        id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name varchar(30)
    )";

    private $PRODUCT_QUERY= "CREATE TABLE IF NOT EXISTS product(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        categoryId INT(6),
        name varchar(30) not null,
        price double,
        image varchar(50),
        available boolean,
        foreign key(categoryId) references category(id)
        )";

    private $ORDER_QUEREY = "CREATE TABLE IF NOT EXISTS order(
        id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        userId int,
        totalPrice double,
        status varchar(50),
        foreign key(userId) references user(id)
    )";

// $orderId, $productId, $productCount
    private $ORDER_PRODUCT_QUERY = "CREATE TABLE IF NOT EXISTS orderProduct(
        orderId int,
        productId int,
        count int,
        primary key(orderId, productId),
        foreign key(orderId) references order(id),
        foreign key(productId) references product(id)
    )";

}