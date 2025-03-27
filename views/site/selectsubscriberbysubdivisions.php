<h1>Абоненты по подразделниям</h1>
<?php foreach ($subdivisions as $subdivision): ?>
    <?php if ($subdivision->subscribers->isNotEmpty()): ?>
        <h2>Подразделение: <?= $subdivision->Name ?> </h2><span>Абонентов: <?= count($subdivision->subscribers) ?> чел.</span>
        <ol>
        <?php foreach ($subdivision->subscribers as $subscriber): ?>

                <li>
                    <h3>
                        <?= $subscriber->Surname ?>
                        <?= $subscriber->Name ?>
                    </h3>

                    <p><strong>Дата рождения:</strong>
                        <?= date('d.m.Y', strtotime($subscriber->Date_of_birth)) ?>
                    </p>
                </li>
        <?php endforeach; ?>
        </ol>
    <?php endif; ?>
<?php endforeach; ?>





