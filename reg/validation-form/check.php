<?php
    
    $login = filter_var(trim($_POST['login']),
    FILTER_SANITIZE_STRING);
    $name = filter_var(trim($_POST['name']),
    FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']),
    FILTER_SANITIZE_STRING);

    if(mb_strlen($login) < 5 || mb_strlen($login) > 90) {
        echo "Недопустимая длина логина";
        exit();
    } else if(mb_strlen($name) < 3 || mb_strlen($name) > 50) {
        echo "Недопустимая длина имени";
        exit();
    } else if(mb_strlen($pass) < 5 || mb_strlen($pass) > 16) {
        echo "Недопустимая длина пароля (от 5 до 16 символов)";
        exit();
    }

    $pass = md5($pass."samfajhnfl4341");

    require "../blocks/connect.php";

    $result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login'");
    $user = $result->fetch_assoc(); // Конвертируем в массив
    if(!empty($user)){
        echo "Данный логин уже используется!";
        exit();
    }

    

    $mysql->query("INSERT INTO `users` (`login`, `pass`, `name`)
        VALUES('$login', '$pass', '$name')");
        echo "Вы успешно зарегистрировались";
        exit();
    $mysql->close();

    header('Location: http://localhost/reg/index.php');
?>