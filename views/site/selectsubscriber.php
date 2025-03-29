<h1>Список абонентов (Абонентов <?= count($subscribers) ?> чел.)</h1>
<ol>
    <?php foreach ($subscribers as $sub): ?>
        <li>
            <?php if ($sub->image_path): ?>
                <img src="<?= '/' . $sub->image_path?>" alt="Фото абонента" style="max-width: 200px;">
                <br>
            <?php else: ?>
                <p>Фото отсутствует</p>
            <?php endif; ?>
            <?= $sub->Surname ?> <?= $sub->Name ?> <?= $sub->SurnameSecond ?> ( <?= date('d.m.Y', strtotime($sub->Date_of_birth)) ?> )
        </li>
    <?php endforeach; ?>
</ol>
