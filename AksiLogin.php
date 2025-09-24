<?php
require 'database.php';
require 'Login.php';
require 'Form.php';

$login = new Login($conn);
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_user = trim($_POST['username_user'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($login->authenticate($username_user, $password)) {
        header("Location: AksiKamar.php");
        exit();
    } else {
        $error = "Username atau password salah.";
    }
}
$formLogin = new Form('AksiLogin.php', 'Login Form', 'Login');
$formLogin->addField("username_user", 'Username', 'text', ['placeholder' => 'Masukkan Username']);
$formLogin->addField("password", 'Password', 'password', ['placeholder' => 'Masukkan Password']);
?>

<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="text-center">
            <?php if ($error): ?>
                <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
        </div>
        <br>

        <?php
        $formLogin->displayForm();
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>
</html>