<?php 
session_start();

require_once "../config/database.php";

$email_error = "";
$password_error = "";

if (isset ($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT id, name, email, password, role FROM users WHERE email = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0 ) {

       $user = mysqli_fetch_assoc($result);

       if (password_verify($password , $user['password'])){

       session_regenerate_id(true);

$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];
$_SESSION['user_email'] = $user['email'];
$_SESSION['user_role'] = $user['role'];

if ($user['role'] === 'admin'){
    header("Location: ../admin/dashboard.php");
} else {
    header("Location: ../dashboard/index.php");
}

exit;
        
       } else {

          $password_error = "Invalid email or password!";

       }

    } else {

       $email_error = "Invalid email or password!";

    }
}

?>

<style>
        .portal-main-wrapper {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f4f5f7;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
            overflow: hidden;
            z-index: 999;
        }

        /* Ambient Glowing Background Elements */
        .portal-main-wrapper .ambient-blob-1 {
            position: absolute;
            top: -100px;
            left: -80px;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(98, 130, 112, 0.2) 0%, rgba(244, 245, 247, 0) 70%);
            z-index: 0;
            pointer-events: none;
            filter: blur(40px);
        }

        .portal-main-wrapper .ambient-blob-2 {
            position: absolute;
            bottom: -100px;
            right: -80px;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(56, 81, 66, 0.15) 0%, rgba(244, 245, 247, 0) 70%);
            z-index: 0;
            pointer-events: none;
            filter: blur(40px);
        }

        .portal-main-wrapper .login-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 630px; /* Width ko mazeed barha diya gaya hai */
        }

        /* Unique Organic Curved Card (Height aur spacing mazeed barha di gayi hai) */
        .portal-main-wrapper .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1.5px solid rgba(230, 235, 230, 0.8);
            border-radius: 44px;
            padding: 0 60px 50px 60px; /* Height aur width dono mein mazeed khula aur bara kar diya hai */
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.08),
                        0 1px 3px rgba(0, 0, 0, 0.03);
            position: relative;
            overflow: hidden;
            color: #2a3e32;
        }

        /* Curved Leaf Accent Top Header */
        .portal-main-wrapper .card-header-bg {
            margin: 0 -60px 32px -60px;
            padding: 44px 20px 54px 20px;
            background: linear-gradient(145deg, #385142 0%, #4c6d5b 60%, #628270 100%);
            border-radius: 0 0 50% 50% / 0 0 42px 42px;
            text-align: center;
            position: relative;
            box-shadow: 0 10px 25px rgba(56, 81, 66, 0.25);
        }

        /* Floating Icon Ring */
        .portal-main-wrapper .icon-badge {
            width: 82px;
            height: 82px;
            background: #ffffff;
            border-radius: 26px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.18), 
                        inset 0 0 0 4px #eef5f1;
            margin-bottom: -15px;
            transform: translateY(10px);
            animation: pulseFloat 3.5s ease-in-out infinite;
        }

        @keyframes pulseFloat {
            0%, 100% { transform: translateY(10px) scale(1); }
            50% { transform: translateY(3px) scale(1.03); }
        }

        .portal-main-wrapper .store-title {
            font-size: 29px;
            font-weight: 800;
            color: #2a3e32;
            letter-spacing: -0.4px;
            text-align: center;
            margin-top: 24px;
            margin-bottom: 8px;
        }

        .portal-main-wrapper .store-subtitle {
            font-size: 15px;
            color: #628270;
            text-align: center;
            margin-bottom: 28px;
            font-weight: 500;
        }

        .portal-main-wrapper .form-group {
            margin-bottom: 20px; /* Fields ke darmiyan spacing barha di gayi hai taake height mazeed achi lage */
        }

        .portal-main-wrapper .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #385142;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }

        .portal-main-wrapper .input-box {
            position: relative;
            display: flex;
            align-items: center;
        }

        .portal-main-wrapper .input-icon {
            position: absolute;
            left: 18px;
            color: #628270;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.25s ease;
            pointer-events: none;
        }

        .portal-main-wrapper .input-box input {
            width: 100%;
            padding: 16px 18px 16px 48px; /* Input boxes ki height barha di gayi hai */
            font-family: inherit;
            font-size: 15px;
            font-weight: 500;
            color: #2a3e32;
            background: #f8faf9;
            border: 1.5px solid #d4e0d8;
            border-radius: 16px;
            outline: none;
            box-sizing: border-box;
            transition: all 0.25s ease;
        }

        .portal-main-wrapper .input-box input::placeholder {
            color: #9cb0a3;
        }

        .portal-main-wrapper .input-box input:focus {
            background: #ffffff;
            border-color: #385142;
            box-shadow: 0 0 0 4px rgba(56, 81, 66, 0.12);
        }

        .portal-main-wrapper .input-box input:focus + .input-icon {
            color: #385142;
            transform: scale(1.1);
        }

        .portal-main-wrapper .login-error {
            color: #d93838;
            font-size: 12px;
            margin-top: 6px;
            font-weight: 600;
        }

        .portal-main-wrapper .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 12px;
            margin-bottom: 26px;
            font-size: 14px;
        }

        .portal-main-wrapper .remember-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #4c6d5b;
            cursor: pointer;
            font-weight: 600;
            user-select: none;
        }


        .portal-main-wrapper .remember-checkbox input {
            accent-color: #385142;
            width: 17px;
            height: 17px;
            cursor: pointer;
            border-radius: 5px;
        }

        .portal-main-wrapper .forgot-link {
            color: #385142;
            text-decoration: none;
            font-weight: 700;
            transition: color 0.2s;
        }

        .portal-main-wrapper .forgot-link:hover {
            color: #1b2a22;
            text-decoration: underline;
        }

        /* Shimmer Interactive Submit Button */
        .portal-main-wrapper .submit-btn {
            width: 100%;
            padding: 16px; /* Button ko mazeed bara aur prominent kar diya gaya hai */
            background: linear-gradient(135deg, #385142 0%, #25382d 100%);
            color: #ffffff;
            border: none;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 24px rgba(42, 62, 50, 0.25);
            position: relative;
            overflow: hidden;
        }

        .portal-main-wrapper .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .portal-main-wrapper .submit-btn:hover::before {
            left: 100%;
        }

        .portal-main-wrapper .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(42, 62, 50, 0.35);
        }

        .portal-main-wrapper .submit-btn:active {
            transform: translateY(0);
        }

        .portal-main-wrapper .register-footer {
            text-align: center;
            margin-top: 26px;
            padding-top: 20px;
            border-top: 1px dashed #d4e0d8;
            font-size: 14px;
            color: #628270;
            font-weight: 500;
        }

        .portal-main-wrapper .register-footer a {
            color: #385142;
            font-weight: 800;
            text-decoration: none;
            margin-left: 4px;
        }

        .portal-main-wrapper .register-footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 680px) {
            .portal-main-wrapper .login-card {
                padding: 0 24px 34px 24px;
                border-radius: 28px;
            }
            .portal-main-wrapper .card-header-bg {
                margin: 0 -24px 26px -24px;
            }
        }
    </style>

    <div class="portal-main-wrapper">
        <div class="ambient-blob-1"></div>
        <div class="ambient-blob-2"></div>

        <div class="login-wrapper">

            <div class="login-card">
                
                <div class="card-header-bg">
                    <div class="icon-badge">🌱</div>
                </div>

                <h1 class="store-title">Pesticides Portal</h1>
                <p class="store-subtitle">Sign in to manage & order agricultural solutions</p>

                <form action="" method="POST">

                    <div class="form-group">
                        <label>Email Address</label>
                        <div class="input-box">
                            <input
                                type="email"
                                name="email"
                                placeholder="yourname@domain.com"
                                required
                            >
                            <span class="input-icon">
                                <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </span>
                        </div>
                        <?php if(!empty($email_error)) { ?>
                            <p class="login-error">
                                <?php echo $email_error; ?>
                            </p>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-box">
                            <input
                                type="password"
                                name="password"
                                placeholder="••••••••••••"
                                required
                            >
                            <span class="input-icon">
                                <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </span>
                        </div>
                        <?php if(!empty($password_error)) { ?>
                            <p class="login-error">
                                <?php echo $password_error; ?>
                            </p>
                        <?php } ?>
                    </div>

                    <div class="form-options">
                        <label class="remember-checkbox">
                            <input type="checkbox" name="remember"> Keep me logged in
                        </label>
                        <a href="#" class="forgot-link">Forgot?</a>
                    </div>

                    <button type="submit" name="login" class="submit-btn">
                        Sign In to Account
                    </button>

                    <div class="register-footer">
                        New to store?
                        <a href="register.php">Create an Account</a>
                    </div>

                </form>

            </div>

        </div>
    </div>
