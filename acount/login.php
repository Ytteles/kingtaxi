<?php

require_once __DIR__.'/boot.php';

if (check_auth()) {
    header('Location: /');
    die;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Авторизация</title>
  <link rel="stylesheet" href="cssb/bootstrap.css">
</head>
<body>

<div class="container">
  <div class="row py-5 justify-content-md-center">
    <div class="col-lg-6">
      <div class="icon__auth text-center mb-3">
        <img src="/img/icon__human__auth.png" alt="">
      </div>
      <h1 class="mb-3 text-center">Авторизация</h1>

        <?php flash() ?>

      <form method="post" action="do_login.php">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-primary">Войти</button>
          <a class="btn btn-outline-primary" href="account.php">Зарегистрироваться</a>
        </div>
      </form>

    </div>
  </div>
</div>

</body>
</html>
