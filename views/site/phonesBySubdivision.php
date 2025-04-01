<h1>Телефоны по подразделениям</h1>

<?php foreach ($subdivisions as $subdivision): ?>
    <div style="margin-bottom: 30px; border: 1px solid #ddd; padding: 15px;">
        <h2><?= htmlspecialchars($subdivision->Name) ?></h2>

        <?php foreach ($subdivision->rooms as $room): ?>
            <div style="margin: 15px 0; padding: 10px; background: #f5f5f5;">
                <h3>Помещение: <?= htmlspecialchars($room->Name) ?></h3>

                <?php if ($room->attachedUsers->isNotEmpty()): ?>
                    <ul>
                        <?php foreach ($room->attachedUsers as $attached): ?>
                            <li>
                                <?php if ($attached->subscriber): ?>
                                    <?= htmlspecialchars($attached->subscriber->Surname ?? '') ?>
                                    <?= htmlspecialchars($attached->subscriber->Name ?? '') ?>
                                <?php else: ?>
                                    Абонент не найден
                                <?php endif; ?>

                                -

                                <?php if ($attached->phone): ?>
                                    <a href="tel:<?= htmlspecialchars($attached->phone->number_phone) ?>">
                                        <?= htmlspecialchars($attached->phone->number_phone) ?>
                                    </a>
                                <?php else: ?>
                                    Телефон не указан
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p style="color: #999;">Нет привязанных абонентов</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>