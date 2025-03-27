<h1>Абоненты по помещениям</h1>

<?php foreach ($rooms as $room): ?>
    <div style="margin-bottom: 20px; padding: 10px; border: 1px solid #eee;">
        <h3>
            <?= htmlspecialchars($room->Name) ?>
            <small>(ID: <?= $room->id ?>)</small>
        </h3>

        <?php
        // Получаем уникальных абонентов для этого помещения
        $roomSubscribers = $room->phones
            ->pluck('subscriber')
            ->unique('id')
            ->filter();
        ?>

        <p><strong>Количество абонентов:</strong> <?= $room->phones->count() ?></p>
    </div>
<?php endforeach; ?>