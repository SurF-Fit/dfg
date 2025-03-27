<h2>Создание абонента</h2>
<?php use Helpers\HelperResponse; ?>
<?= HelperResponse::displayFlashMessage() ?>
<?= $message ?? '' ?>

<form method="post">
    <label>Фамилия: <input type="text" name="Surname" value="<?= $request->Surname ?? '' ?>"></label>

    <label>Имя: <input type="text" name="Name" required></label>

    <label>Отчество: <input type="text" name="SurnameSecond" required></label>

    <label>День рождения: <input type="date" name="Date_of_birth" required></label>

    <label>Подразделение:
        <select name="subdivision_id" required>
            <option value=""> Выберите подразделение </option>
            <?php foreach ($subdivisions as $subdiv): ?>
                <option value="<?= $subdiv->id ?>">
                    <?= $subdiv->name ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <button type="submit">Добавить</button>
</form><?php
