<h2>Связка номера телефона с абонентом</h2>
<?php use Helpers\HelperResponse; ?>
<?= HelperResponse::displayFlashMessage() ?>
<?= $message ?? '' ?>

<form method="POST">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>

    <div class="form-group">
        <label>Номер телефона:</label>
        <select name="phone_id" class="form-control" required>
            <option value="">Выберите номер телефона</option>
            <?php foreach ($phones as $phone): ?>
                <option value="<?= $phone->id ?>" <?= $phone->subscriber_id ? 'disabled' : '' ?>>
                    <?= $phone->number_phone ?>
                    <?= $phone->subscriber_id ? '(уже привязан)' : '' ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Абонент:</label>
        <select name="subscriber_id" class="form-control" required>
            <option value="">Выберите абонента</option>
            <?php foreach ($subscribers as $sub): ?>
                <?php if (!$sub->phone_id): ?>
                    <option value="<?= $sub->id ?>">
                        <?= $sub->Surname ?> <?= $sub->Name ?> <?= $sub->SurnameSecond ?>
                    </option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Помещение:</label>
        <select name="room_id" class="form-control" required>
            <option value="">Выберите помещение</option>
            <?php foreach ($rooms as $room): ?>
                <option value="<?= $room->id ?>">
                    <?= $room->Name ?> (<?= $room->Type_of_room ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Прикрепить</button>
</form>