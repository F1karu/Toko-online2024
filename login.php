<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Morotuku</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url(assets/foto/animek.jpg) no-repeat;
            background-size: cover;
            background-position: center;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 900px;
            position: relative;
        }
        .wrapper {
            width: 420px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .10);
            backdrop-filter: blur(15px);
            color: #fff;
            border-radius: 20px;
            padding: 30px 40px;
            position: absolute;
            transition: transform 0.6s ease;
        }
        .wrapper h1 {
            font-size: 36px;
            text-shadow: #333;
            text-align: center;
        }
        .input-box {
            position: relative;
            width: 100%;
            height: 50px;
            margin: 30px 0;
        }
        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, .2);
            border-radius: 40px;
            font-size: 16px;
            color: #fff;
            padding: 20px 45px 20px 20px;
        }
        .input-box input::placeholder {
            color: #fff;
        }
        .input-box i {
            position: absolute;
            right: 20px;
            top: 30%;
            transform: translate(-50%);
            font-size: 20px;
        }
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            font-size: 14.5px;
            margin: -15px 0 15px;
        }
        .remember-forgot label input {
            accent-color: #fff;
            margin-right: 3px;
        }
        .remember-forgot a {
            color: #fff;
            text-decoration: none;
        }
        .remember-forgot a:hover {
            text-decoration: underline;
        }
        .btn {
            width: 100%;
            height: 45px;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }
        .register-link {
            font-size: 14.5px;
            text-align: center;
            margin: 20px 0 15px;
        }
        .register-link p a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }
        .register-link p a:hover {
            text-decoration: underline;
        }
        .toggle-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #fff;
            color: #333;
            border: none;
            padding: 10px 20px;
            border-radius: 40px;
            cursor: pointer;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="wrapper">
        <!-- Single Form -->
        <form id="login-form" action="proses_login.php" method="post">
            <h1 id="form-title">Login Morotuku</h1>
            
            <!-- Single Input Box -->
            <div class="input-box">
                <input type="text" name="username" id="username" placeholder="Username" required>
                <i id="icon" class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox">Remember Me</label>
                <a href="#">Forgot Password</a>
            </div>

            <input type="submit" name="login" class="btn btn-success" value="Login">
            
            <div class="register-link">
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>
        </form>
    </div>
    
    <!-- Toggle Button -->
    <button class="toggle-btn" onclick="toggleLogin()">Switch to Worker Login</button>
</div>

<script>
    let isWorkerLogin = false;

    function toggleLogin() {
        const title = document.getElementById('form-title');
        const usernameInput = document.getElementById('username');
        const icon = document.getElementById('icon');
        const toggleBtn = document.querySelector('.toggle-btn');

        if (isWorkerLogin) {
            // Switch to Morotuku Login
            title.textContent = 'Login Morotuku';
            usernameInput.placeholder = 'Username';
            usernameInput.name = 'username';
            usernameInput.value = ''; // Clear the input field
            icon.className = 'bx bxs-user';
            toggleBtn.textContent = 'Switch to Worker Login';
        } else {
            // Switch to Worker Login
            title.textContent = 'Worker Login';
            usernameInput.placeholder = 'Worker ID';
            usernameInput.name = 'usernameptgs'; // Ganti nama input
            usernameInput.value = ''; // Clear the input field
            icon.className = 'bx bxs-id-card';
            toggleBtn.textContent = 'Switch to Morotuku Login';
        }
        isWorkerLogin = !isWorkerLogin;
    }
</script>

</body>
</html>
