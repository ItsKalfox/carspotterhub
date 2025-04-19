<?php
require_once __DIR__ . '/../db/config.php';

session_start();

function isLoggedIn() {
    return isset($_SESSION['admin_id']);
}

function isMainAdmin() {
    return isset($_SESSION['admin_role']) && $_SESSION['admin_role'] === 'main_admin';
}

session_unset();
session_destroy();

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        $_SESSION['admin_role'] = $admin['role'];
        header('Location: admin_panel.php');
        exit();
    } else {
        $error = "Invalid username or password";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require __DIR__ . '/../includes/header.php';?>
    <title>Admin Login</title>
    <link rel="icon" href="images/logo-white.png" type="image/png">
    <style>
    :root {
        --primary-color: #6366f1;
        --primary-hover: #4f46e5;
        --bg-color: #111827;
        --card-bg: #1f2937;
        --text-color: #f3f4f6;
        --border-color: #374151;
        --input-bg: #374151;
        --input-border: #4b5563;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        background-color: var(--bg-color);
        color: var(--text-color);
        line-height: 1.5;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-container {
        background-color: var(--card-bg);
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        margin: 1rem;
    }

    h2 {
        margin-bottom: 1.5rem;
        text-align: center;
        color: var(--text-color);
        font-size: 1.5rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--text-color);
    }

    input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid var(--input-border);
        border-radius: 0.375rem;
        background-color: var(--input-bg);
        color: var(--text-color);
        font-size: 1rem;
    }

    input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
    }

    button {
        width: 100%;
        padding: 0.75rem;
        margin-top: 25px;
        margin-bottom: 15px;
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 0.375rem;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    button:hover {
        background-color: var(--primary-hover);
    }

    .error {
        background-color: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.2);
        color: #ef4444;
        padding: 0.75rem;
        border-radius: 0.375rem;
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }
    </style>
</head>

<body style="line-height: 1.5; min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if (isset($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>