<?php
session_start();
include('code/DbQuerries.php');

$error_message = '';

if(isset($_POST['login'])) {
    $user = new User(0, $_POST['username'], $_POST['password']);
    if(authorizeUser($user)) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user->getUsername();
        header("Location: pages/home.php");
        exit();
    } else {
        $error_message = 'Kullanıcı adı veya şifre hatalı!';
    }
}    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <script>
        function showError(message) {
            if (message) {
                alert(message);
            }
        }
    </script>
</head>
<body>
    <div class="container-fluid">
    <form class="mx-auto" action="" method="POST">
        <h4 class="text-center">Personel Kayıt Takip Sistemi</h4>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label mt-3">Kullanıcı Adı</label>
          <input type="text" class="form-control" name="username">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label mt-3">Şifre</label>
          <input type="password" class="form-control" name="password">
        </div>
        <input type="submit" class="btn" name="login" value="Giriş">
    </form>
    </div>
    <?php if ($error_message): ?>
        <script>
            showError('<?php echo $error_message; ?>');
        </script>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>