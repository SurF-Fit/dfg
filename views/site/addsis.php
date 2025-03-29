<h2>Добавление системного администратора</h2>
<?php use Helpers\HelperResponse; ?>
<?= HelperResponse::displayFlashMessage() ?>
<?= $message ?? '' ?>
<ol class="sis">
    <?php
    foreach ($users as $user) {
        echo '<form method="post">';
        ?>
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <?php
        echo '<input type="hidden" name="user_id" value="' . $user->id . '">';
        echo '<li>' . $user->login . '</li>';

        if($user->role === 0):
            echo '<span style="color: red">(требует подтверждение)</span>';
        elseif($user->role === 1):
            echo '<span>(админ)</span>';
        elseif($user->role === 2):
            echo '<span>(системный администратор)</span>';
        endif;


        echo '<label><input type="radio" name="role" value="make_admin"' . ($user->role === 1 ? ' checked' : '') . '> Админ</label>';
        echo '<label><input type="radio" name="role" value="make_sysadmin"' . ($user->role === 2 ? ' checked' : '') . '> Системный админ</label>';
        echo '<label><input type="radio" name="role" value="make_user"' . ($user->role === 0 ? ' checked' : '') . '> Пользователь</label>';

        echo '<button type="submit">Применить</button>';
        echo '</form>';
    }
    ?>
</ol>