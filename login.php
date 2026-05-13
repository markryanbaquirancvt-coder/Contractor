<!DOCTYPE html>
<html lang="en">
<head><title>System Entry</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        <?php if(isset($_GET['success'])): ?>
            <h1>Login</h1>
            <form action="core/handleForms.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" name="loginUserBtn" value="Login">
            </form>
        <?php else: ?>
            <h1>Register</h1>
            <form action="core/handleForms.php" method="POST">
                <input type="text" name="username" placeholder="Choose Username" required>
                <input type="password" name="password" placeholder="Choose Password" required>
                <input type="submit" name="registerUserBtn" value="Register Account">
            </form>
            <p><a href="login.php?success=1">Already registered? Login</a></p>
        <?php endif; ?>
    </div>
</body>
</html>