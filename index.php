<?php
$title="Главная страница"; // название формы
require __DIR__ . '/vender/header.php'; // подключаем шапку проекта
require __DIR__.'\vender\connect.php';// подключаем файл для соединения с БД
?>
    <!-- Если авторизован выведет приветствие -->
    <?php if(isset($_SESSION['logged_user'])) : ?>
        Привет, <?php echo $_SESSION['logged_user']->login; ?></br>

    <!-- Пользователь может нажать выйти для выхода из системы -->
    <a href="logout.php">Выйти</a> <!-- файл logout.php создадим ниже -->
    <?php else : ?>

    <!-- Если пользователь не авторизован выведет ссылки на авторизацию и регистрацию -->
    <a href="access.php">Авторизоваться</a><br>
    <a href="register.php">Регистрация</a>
    <?php endif; ?>
<?php require __DIR__ . '/vender/footer.php'; ?> <!-- Подключаем подвал проекта -->

