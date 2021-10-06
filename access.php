
<?php 
    $title = "Авторизация";
    require __DIR__.'\vender\header.php'; 
    require __DIR__.'\vender\connect.php';

    $data = $_POST;
    // при нажатии на кнопку выполняется следующий код
    if (isset($data['do_access'])){
        $errors = array(); // создаем массив ошибок

        $user = R::findOne('users','login = ?', array($data['login'])); //ищем в таблице пользователя
        // если нашли то проверяем пароль
        if($user){
            if(password_verify($data['password'], $user->password)){
                $_SESSION['logged_user'] = $user; //пускаем пользователя

                header('Location: index.php'); // переносим пользователя на главную страницу
            }
            else{
                $errors[] = 'Неверный пароль';
            }
        }
        else{
            $errors[] = 'Пользователь с таким логином не найден!';
        }
        if(!empty($errors)) {

            echo '<div style="color: red; ">' . array_shift($errors). '</div><hr>';
    
        }
    }
?>
 <div class="register_form_container">
        <div class="default-header">Авторизация</div>
        <form action="access.php" method="post">
            <div class="form-input">
                <div class="input_container">
                    <input type="text" placeholder="Ваш логин" name="login">
                </div>
            </div>
            <div class="form-input">
                <div class="form-input">
                    <div class="input_container">
                        <input type="text" placeholder = "Ваш пароль" name="password" >
                    </div>
                </div>
            </div>

            <button class="submit" name = "do_access">Вход</button>
            <p>Если у вас нет аккаунта <a href="register.php">Зарегистрироваться</a></p>
<?php 
    require __DIR__.'\vender\footer.php';
?>