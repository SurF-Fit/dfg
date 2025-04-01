<h2>Создание номера телефона</h2>
<?php use Helpers\HelperResponse; ?>
<?= HelperResponse::displayFlashMessage() ?>
<?= $message ?? '' ?>
<form method="post">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <label>Номер телефона <input type="tel" name="number_phone" placeholder="80004004040"></label>
    <button>Добавить</button>
</form>
