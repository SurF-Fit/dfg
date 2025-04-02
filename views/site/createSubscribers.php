<h2>Создание абонента</h2>
<?php use Helpers\HelperResponse; ?>
<?= HelperResponse::displayFlashMessage() ?>
<?= $message ?? '' ?>

<form method="post" enctype="multipart/form-data">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>

    <label>Фамилия: <input type="text" name="surname" value="<?= $request->surname ?? '' ?>"></label>

    <label>Имя: <input type="text" name="name" value="<?= $request->name ?? '' ?>"></label>

    <label>Отчество: <input type="text" name="surnamesecond" value="<?= $request->surnamesecond ?? '' ?>"></label>

    <label>День рождения: <input type="date" name="date_of_birth" value="<?= $request->date_of_birth ?? '' ?>"></label>

    <label>Фотография: </label>
    <input type="file" name="image" accept="image/jpeg,image/png,image/gif">

    <button type="submit">Добавить</button>
</form>