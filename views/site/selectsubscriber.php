<h1>Список абонентов (Всего абонентов <?= count($subscribers) ?>)</h1>
<ol>
    <?php foreach ($subscribers as $sub): ?>
        <li>
            <?= $sub->Surname ?> <?= $sub->Name ?> <?= $sub->SurnameSecond ?> ( <?= date('d.m.Y', strtotime($sub->Date_of_birth)) ?> )
        </li>
    <?php endforeach; ?>
</ol>
