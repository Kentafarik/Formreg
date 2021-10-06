
<?php 
    $title = "Форма регистрации";
    require __DIR__.'\vender\header.php'; 
    require __DIR__.'\vender\connect.php';

    $data = $_POST; //Создаем переменную для сбора данных

    if(isset($data['do_register'])){
        $errors = array(); // создаем массив для сбора данных

        // делаем проверку введеных данных
        if(trim($data['login'] == '')){
            $errors[] = "Введите логин!";
        }
        if(trim($data['email'] == '')){
            $errors[] = "Введите почту!";
        }
        if(trim($data['password'] == '')){
            $errors[] = "Неверный пароль!";
        }
        if(trim($data['password-conf'] != $data['password'])){
            $errors[] = "Пароли не совпадают";
        }

        if(mb_strlen($data['login']) < 5 || mb_strlen($data['login']) > 90){
            $errors[] = 'Недопустимая длина логина';
       }
       if (mb_strlen($data['password']) < 2 || mb_strlen($data['password']) > 8){
        $errors[] = 'Недопустимая длина пароля';
        }
        if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $data['email'])) {

            $errors[] = 'Неверно введен е-mail';
        
        }

        // проверки на уникальность

        if(R::count('users', "email = ?", array($data['email'])) > 0) {

            $errors[] = "Пользователь с таким Email существует!";
        }

        //регистрируем

        if(empty($errors)){
            $user = R::dispense('users');

            $user->login = $data['login'];
            $user->email = $data['email'];
            //хешируем пароль
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);

            //сохраняем в таблицу
            R::store($user);
            echo '<div style="color:green;">Вы успешно зарегистрированны! Можно <a href="access.php">авторизоваться</a>.</div><hr>';
        }
        else{
            echo '<div style="color:red;">' . array_shift($errors). '</div><hr>';
        }
    }
?>
 <div class="register_form_container">
        <div class="default-header">Регистрация</div>
        <form action="register.php" method="post">
            <div class="form-input">
                <div class="input_container">
                    <input type="text" placeholder="Ваш логин" name="login">
                </div>
            </div>
            <div class="form-input">
                <div class="form-input">
                    <div class="input_container">
                        <input type="email" placeholder = "Ваша почта" name="email">
                    </div>
                </div>
            </div>
            <div class="form-input">
                <div class="form-input">
                    <div class="input_container">
                        <input type="password" placeholder = "Ваш пароль" name="password" >
                    </div>
                </div>
            </div>
            <div class="form-input">
                <div class="form-input">
                    <div class="input_container">
                        <input type="password" placeholder = "Подтверждение пароля" name="password-conf">
                    </div>
                </div>
            </div>
            <button class="submit" name="do_register">Зарегистрироваться</button>
            <p>Если у вас есть аккаунт <a href="access.php">Войти</a></p>
<?php 
    require __DIR__.'\vender\footer.php';
?>