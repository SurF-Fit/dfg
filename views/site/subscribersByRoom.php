<h1>Абоненты по помещениям</h1>

<?php foreach ($rooms as $room): ?>
    <div style="margin-bottom: 20px; padding: 10px; border: 1px solid #eee;">
        <h3>
            <?= $room->Name ?>
        </h3>

        <p><strong>Количество абонентов:</strong> <?= $room->phones->count() ?></p>
    </div>
<?php endforeach; ?>