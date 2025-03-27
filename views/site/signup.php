<h2>Регистрация нового пользователя</h2>
<?php use Helpers\HelperResponse; ?>
<?= HelperResponse::displayFlashMessage() ?>
<?= $message ?? ''; ?>
<form method="post">
    <label>Имя <input type="text" name="name" value="<?= $request->name ?? '' ?>"></label>
    <?= isset($errors['name']) ? '<span class="error">'.$errors['name'].'</span>' : '' ?>

    <label>Логин <input type="text" name="login" value="<?= $request->login ?? '' ?>"></label>
    <?= isset($errors['login']) ? '<span class="error">'.$errors['login'].'</span>' : '' ?>

    <label>Пароль <input type="password" name="password"></label>
    <?= isset($errors['password']) ? '<span class="error">'.$errors['password'].'</span>' : '' ?>

    <button>Зарегистрироваться</button>
</form>