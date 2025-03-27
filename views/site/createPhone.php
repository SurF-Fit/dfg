<h2>Создание номера телефона</h2>
<?php use Helpers\HelperResponse; ?>
<?= HelperResponse::displayFlashMessage() ?>
<?= $message ?? '' ?>
<form method="post">
    <label>Номер телефона <input type="tel" name="number_phone" placeholder="80004004040"></label>
    <label>Помещения:
        <select name="room_id" required>
            <option value=""> Выберите Помещение </option>
            <?php foreach ($rooms as $room): ?>
                <option value="<?= $room->id ?>">
                    <?= $room->name ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>
    <button>Добавить</button>
</form>
