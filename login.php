<?php
require_once __DIR__ . '/config/config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Username and password are required';
    } else {
        if (login($username, $password)) {
            redirect(base_url('admin/dashboard.php'));
        } else {
            $error = 'Invalid credentials';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Barangay Sto. Angel Payroll</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            font-family: Arial, sans-serif;
            background-color: #f0fff4;
        }
        .login-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }
        .left-side {
            flex: 1;
            display: flex;
                flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            min-height: 100vh;
        }
        .logo-container {
            margin-bottom: 2rem;
            margin-left: 6rem;
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .logo-container img {
            max-width: 100%;
            height: auto;
            max-height: 700px;
            width: auto;
            object-fit: contain;
        }
        .right-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }
        .welcome-text {
            max-width: 500px;
            text-align: center;
        }
        .welcome-text h1 {
            font-size: 2.5rem;
            color: #2d3748;
            margin-bottom: 1rem;
        }
        .welcome-text p {
            font-size: 1.1rem;
            color: #4a5568;
            line-height: 1.6;
        }
        .auth-card {
            width: 100%;
            max-width: 400px;
            padding: 2.5rem;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .heading {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
            text-align: center;
            margin-bottom: 0.5rem;
        }
        .subtext {
            color: #4a5568;
            text-align: center;
            margin-bottom: 2rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: #4a5568;
            font-weight: 500;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solidrgb(0, 0, 0);
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: border-color 0.2s;
        }
        .form-input:focus {
            outline: none;
            border-color:rgb(253, 253, 253);
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2);
        }
        .primary-btn {
            background-color: #4299e1;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.2s;
        }
        .primary-btn:hover {
            background-color: #3182ce;
        }
        .secondary-btn {
            display: block;
            text-align: center;
            color: #4299e1;
            padding: 0.75rem 1.5rem;
            border: 1px solid #4299e1;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }
        .secondary-btn:hover {
            background-color: #ebf8ff;
        }
        .alert.error {
            background-color: #fff5f5;
            color: #e53e3e;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #fed7d7;
            font-size: 0.875rem;
        }
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            .left-side, .right-side {
                padding: 2rem 1rem;
            }
            .welcome-text {
                text-align: center;
                margin-bottom: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="left-side">
            <div class="logo-container">
                <img src="img/logonatics.png" alt="Barangay Sto. Angel Logo">
            </div>
            <div class="welcome-text">
                <h1></h1>
                <p></p>
            </div>
        </div>
        <div class="right-side">
            <div class="auth-card">
                <h1 class="heading">Admin Login</h1>
                <p class="subtext">Barangay Sto. Angel Payroll System</p>

                <?php if ($error): ?>
                    <div class="alert error">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="" style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <div>
                        <label for="username" class="form-label">
                            Username
                        </label>
                        <input
                            id="username"
                            type="text"
                            name="username"
                            required
                            class="form-input"
                            placeholder="Enter your username"
                        />
                    </div>

                    <div>
                        <label for="password" class="form-label">
                            Password
                        </label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            class="form-input"
                            placeholder="Enter your password"
                        />
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        <button
                            type="submit"
                            class="primary-btn"
                        >
                            Sign In
                        </button>
                        <a
                            href="register.php"
                            class="secondary-btn"
                        >
                            Register
                        </a>
                    </div>
                    <div style="text-align: center; margin-top: 1rem;">
                        <a href="forgot-password.php" style="color: #4299e1; text-decoration: none; font-size: 0.875rem;">
                            Forgot Password?
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>