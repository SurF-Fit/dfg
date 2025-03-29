<h2>Связка номера телефона с абонентом</h2>
<?php use Helpers\HelperResponse; ?>
<?= HelperResponse::displayFlashMessage() ?>
<?= $message ?? '' ?>
<form method="post">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <label>Номер телефона:
        <select name="phone_id">
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
        <select name="subscriber_id"    >
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