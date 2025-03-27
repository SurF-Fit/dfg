<h2>Создание подразделения</h2>
<?php use Helpers\HelperResponse; ?>
<?= HelperResponse::displayFlashMessage() ?>
<?= $message ?? '' ?>
<form method="post">
    <label>Название <input type="text" name="Name"></label>
    <label>Тип подразделения <input type="text" name="type_of_unit"></label>
    <button>Добавить</button>
</form>

