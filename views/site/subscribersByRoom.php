<h1>Абоненты по помещениям</h1>

<?php foreach ($rooms as $room): ?>
    <div style="margin-bottom: 30px; padding: 15px; border: 1px solid #ddd; border-radius: 5px;">
        <h2>
            <?= $room->Name ?>
            <small>(<?= $room->Type_of_room ?>)</small>
        </h2>

        <?php if ($room->subdivision): ?>
            <p><strong>Подразделение:</strong> <?= htmlspecialchars($room->subdivision->Name) ?></p>
        <?php endif; ?>

        <h4>Абоненты:</h4>

        <?php if ($room->attachedUsers->isNotEmpty()): ?>
            <ul style="list-style-type: none; padding-left: 0;">
                <?php foreach ($room->attachedUsers as $attached): ?>
                    <li style="padding: 8px; margin-bottom: 5px; background: #f5f5f5; border-radius: 3px;">
                        <?php if ($attached->subscriber): ?>
                            <strong>
                                <?= htmlspecialchars($attached->subscriber->surname) ?>
                                <?= htmlspecialchars($attached->subscriber->name) ?>
                                <?= htmlspecialchars($attached->subscriber->surnamesecond) ?>
                            </strong>
                        <?php else: ?>
                            <span style="color: #999;">Абонент не указан</span>
                        <?php endif; ?>

                        <?php if ($attached->phone): ?>
                            <div style="margin-top: 3px;">
                                Телефон:
                                <a href="tel:<?= htmlspecialchars($attached->phone->number_phone) ?>">
                                    <?= htmlspecialchars($attached->phone->number_phone) ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p style="color: #999;">Нет привязанных абонентов</p>
        <?php endif; ?>

        <div style="margin-top: 10px;">
            <small>Всего абонентов: <?= $room->attachedUsers->count() ?></small>
        </div>
    </div>
<?php endforeach; ?>