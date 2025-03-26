<h2>Добавление системного администратора</h2>

<ol class="sis">
    <?php
    foreach ($users as $user) {
        echo '<form method="post">';
        echo '<input type="hidden" name="user_id" value="' . $user->id . '">';
        echo '<li>' . $user->name . '</li>';

        if($user->role === 0):
            echo '<span style="color: red">(требует подтверждение)</span>';
        elseif($user->role === 1):
            echo '<span>(админ)</span>';
        elseif($user->role === 2):
            echo '<span>(системный администратор)</span>';
        endif;

        echo '<label><input type="checkbox" name="make_admin" value="1"' . ($user->role === 1 ? ' checked' : '') . '> Админ</label>';
        echo '<label><input type="checkbox" name="make_sysadmin" value="1"' . ($user->role === 2 ? ' checked' : '') . '> Системный админ</label>';

        echo '<button type="submit">Применить</button>';
        echo '</form>';
    }
    ?>
</ol>