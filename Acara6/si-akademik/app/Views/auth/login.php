<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Form Login</h2>

    <!-- Alert Flash Message Logout / Error -->
    <?php if (!empty($flash)): ?>
        <div style="padding: 10px; background-color: #f8d7da; color: #721c24; margin-bottom: 10px;">
            <?= htmlspecialchars($flash); ?>
        </div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/login" method="POST">
        <div>
            <label>Username:</label>
            <input type="text" name="username" required>
        </div>
        <br>
        <div>
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>