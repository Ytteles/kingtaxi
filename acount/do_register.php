<?php

require_once __DIR__.'/boot.php';

$stmt = pdo()->prepare("SELECT * FROM `users` WHERE `username` = :username");
$stmt->execute(['username' => $_POST['username']]);

// обарботка ошибок email
if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i",  $_POST['username'])) {
    flash('Адрес указан неверно.');
    header('Location: account.php');
    die;
 }
if ($stmt->rowCount() > 0) {
    flash('Это имя пользователя уже занято.');
    header('Location: account.php');
    die;
}


//Получаем номер из базы данных
$stmt = pdo()->prepare("SELECT * FROM `users` WHERE `phone` = :phone");
$stmt->execute(['phone' => $_POST['phone']]);

//обработка ошибок номера телефона
if (!preg_match("~^(?:\+7|8)\d{10}$~", $_POST['phone'])) {
    flash('Номер телефона указан неверно');
    header('Location: account.php');
    die;
}
if ($stmt->rowCount() > 0) {
    flash('Это номер уже занят.');
    header('Location: account.php');
    die;
}

$stmt = pdo()->prepare("INSERT INTO `users` (`username`, `password`, `phone`) VALUES (:username, :password, :phone)");
$stmt->execute([
    'username' => $_POST['username'],
    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
    'phone' => $_POST['phone'],
]);

header('Location: login.php');
