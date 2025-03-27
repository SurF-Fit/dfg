<h1>Список номеров абонентов</h1>
<ol>
    <?php foreach ($numberPhones as $phone): ?>
        <?php foreach ($subscribers as $sub): ?>
            <li value="">
                <?= $sub->Surname ?> <?= $sub->Name ?> <?= $phone->number_phone ?> <?= $phone->subscriber_id?>
            </li>
        <?php endforeach; ?>
    <?php endforeach; ?>
</ol>




