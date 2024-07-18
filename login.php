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
    <title>PTS Giriş</title>
    <link rel="stylesheet" href="css/styles.css">
    <script>
        function showError(message) {
            if (message) {
                alert(message);
            }
        }
    </script>
</head>
<body>
    <div class="login-container">
        <h2>Personel Kayıt Takip Sistemi</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Kullanıcı Adı:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Şifre:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <input class="loginBtn" type="submit" name="login" value="Giriş Yap">
        </form>
    </div>
    <?php if ($error_message): ?>
        <script>
            showError('<?php echo $error_message; ?>');
        </script>
    <?php endif; ?>
</body>
</html>

