<form method="post">
    <label>Номер телефона:
        <select name="phone_id" required>
            <option value="">Выберите номер телефона</option>
            <?php foreach ($numberPhones as $phone): ?>
                <option value="<?= $phone->id ?>">
                    <?= $phone->number_phone ?>
                    <?= $phone->subscriber_id ? '(привязан)' : '' ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>
    <label>Абонент:
        <select name="subscriber_id" required>
            <option value="">Выберите абонента</option>
            <?php foreach ($subscribers as $sub): ?>
                <option value="<?= $sub->id ?>">
                    <?= $sub->Surname ?> <?= $sub->Name ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <button type="submit">Прикрепить</button>
</form>