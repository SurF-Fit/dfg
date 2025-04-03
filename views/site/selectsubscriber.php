<h1>Список абонентов (Абонентов <?= count($subscribers) ?> чел.)</h1>
<ol>
    <?php foreach ($subscribers as $sub): ?>
        <li>
            <?php if ($sub->image_path): ?>
                <img src="<?= '/' . $sub->image_path?>" alt="Фото абонента" style="max-width: 200px; border: 1px solid black">
            <?php else: ?>
                <img style="max-width: 200px; border: 1px solid black" src="/public/img/utya-utya-duck.gif" alt="Заглушка">
            <?php endif; ?>
            <?= $sub->surname ?> <?= $sub->name ?> <?= $sub->surnamesecond ?> ( <?= date('d.m.Y', strtotime($sub->Date_of_birth)) ?> )
        </li>
    <?php endforeach; ?>
</ol>
