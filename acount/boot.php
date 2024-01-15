<?php

// Инициализируем сессию
session_start();

// Простой способ сделать глобально доступным подключение в БД
function pdo(): PDO
{
    static $pdo;

    if (!$pdo) {
        if (file_exists(__DIR__ . '/config.php')) {
            $config = include __DIR__.'/config.php';
        } else {
            $msg = 'Ошибка, настройте конфиг';
            trigger_error($msg, E_USER_ERROR);
        }
        // Подключение к БД
        $dsn = 'mysql:dbname='.$config['db_name'].';host='.$config['db_host'];
        $pdo = new PDO($dsn, $config['db_user'], $config['db_pass']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    return $pdo;
}

/*Данная функция предназначена для "одноразовых" сообщений. Если вызвать её со строковым параметром, 
то она сохранит эту строку в сессии, а если вызвать без параметров, 
то выведет из сессии сохранённое сообщение и затем удалит его в сессии.
*/
function flash(?string $message = null)
{
    if ($message) {
        $_SESSION['flash'] = $message;
    } else {
        if (!empty($_SESSION['flash'])) { ?>
          <div class="alert alert-danger mb-3">
              <?=$_SESSION['flash']?>
          </div>
        <?php }
        unset($_SESSION['flash']);
    }
}


function check_auth(): bool
{
    return !!($_SESSION['user_id'] ?? false);
}

?>