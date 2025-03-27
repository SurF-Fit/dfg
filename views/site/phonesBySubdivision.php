<h1>Абоненты по подразделниям</h1>
<?php foreach ($subdivisions as $subdivision): ?>
    <?php if ($subdivision->subscribers->isNotEmpty()): ?>
        <h2>подразделение: <?= $subdivision->Name ?></h2>
        <?php foreach ($subdivision->subscribers as $subscriber): ?>
            <div>
                <h3>
                    <?= $subscriber->Surname ?>
                    <?= $subscriber->Name ?>
                </h3>

                <p><strong>Дата рождения:</strong>
                    <?= date('d.m.Y', strtotime($subscriber->Date_of_birth)) ?>
                </p>

                <h4>Телефоны:</h4>
                <?php if ($subscriber->phones->isNotEmpty()): ?>
                    <?php foreach ($subscriber->phones as $phone): ?>
                        <a href="tel:<?= ($phone->number_phone) ?>"><?= ($phone->number_phone) ?></a> <br>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="color: #999;">(нет привязанных телефонов)</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endforeach; ?>
