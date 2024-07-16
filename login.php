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
        $error_message = 'Hatalı kullanıcı adı veya parola!';
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
</head>
<body>
    <div class="login-container">
        <h2>Personel Takip Sistemine Hoşgeldiniz</h2>
        <?php if ($error_message): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Kullanıcı Adı:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Parola:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <input class="loginBtn" type="submit" name="login" value="Giriş Yap">
        </form>
    </div>
</body>
</html>
