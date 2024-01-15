<?php
require_once __DIR__.'/boot.php';

$user = null;

if (check_auth()) {
    // Получим данные пользователя по сохранённому идентификатору
    $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user'] = $user ;
}

if ($user['username'] == 'admin@mail.ru') {
  header('location: adminka.php');
} else if ($user) {
  header('location: usercab.php');
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Регистарция</title>
  <link rel="stylesheet" href="cssb/bootstrap.css">
 
</head>
<body>



<div class="container">
  <div class="row py-5 justify-content-md-center">
    <div class="col-lg-6">
        <!-- проверяем,если зашел юзер -->
      
          <div class="icon__auth text-center mb-3">
            <img src="/img/icon__human__auth.png" alt="">
          </div>
          <h1 class="mb-3 text-center">Регистарция</h1>

            <?php flash(); ?>
          

          <form method="post" action="do_register.php">
            <div class="mb-3">
              <label for="username" class="form-label">Email</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Phone</label>
              <input type="phone" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="d-flex justify-content-between">
              <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
              <a class="btn btn-outline-primary" href="login.php">Вход</a>
            </div>
            
          </form>

        

    </div>
  </div>
</div>

</body>
</html>
