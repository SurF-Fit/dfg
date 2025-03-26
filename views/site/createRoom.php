<h2>Создание комнаты</h2>
<form method="post">
    <label>Название: <input type="text" name="name" required></label>

    <label>Тип комнаты: <input type="text" name="Type_of_room" required></label>

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
</form>