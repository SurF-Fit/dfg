<h2>Регистрация нового пользователя</h2>
<?php use Helpers\HelperResponse; ?>
<?= HelperResponse::displayFlashMessage() ?>
<?= $message ?? ''; ?>
<form method="post">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <label>Имя <input type="text" name="name"></label>
    <label>Логин <input type="text" name="login"></label>
    <label>Пароль <input type="password" name="password"></label>
    <button>Зарегистрироваться</button>
</form>
