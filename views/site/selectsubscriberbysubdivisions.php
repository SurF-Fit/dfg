<?php foreach ($subdivisions as $subdivision): ?>
    <h3><?= $subdivision->Name ?></h3>
    <?php foreach ($subdivision->rooms as $room): ?>
        <div>
            <strong><?= $room->Name ?> (<?= $room->Type_of_room ?>)</strong>
            <?php foreach ($room->attachedUsers as $attachedUser): ?>
                <div>
                    <?= $attachedUser->subscriber->Surname ?>
                    <?= $attachedUser->subscriber->Name ?>
                    <?= $attachedUser->subscriber->SurnameSecond ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
<?php endforeach; ?>

    <h3>Непривязанные абоненты</h3>
<?php foreach ($unattachedSubscribers as $subscriber): ?>
    <div>
        <?= $subscriber->Surname ?>
        <?= $subscriber->Name ?>
        <?= $subscriber->SurnameSecond ?>
    </div>
<?php endforeach; ?>