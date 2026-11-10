<?php
require_once "../config/database.php";
require_once "../includes/header.php";


$name_error = "";
$email_error = "";
$password_error = "";
$confirm_password_error = "";
$success_message = "";

if (isset($_POST['register'])) {

    // Receive form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $confirm_password = $_POST['confirm_password'];

    // Password validation
    if ($password !== $confirm_password) {

        $confirm_password_error =  "Passwords do not match!";

    } else {

        // Check duplicate email and Use prepared statement 
        $check_email = "SELECT id FROM users WHERE email = ?";

$stmt = mysqli_prepare($conn, $check_email);

mysqli_stmt_bind_param($stmt, "s", $email);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {

            $email_error = "Email already exists!";

        } else {

          $insert_user = "INSERT INTO users (name, email, phone, password)
                VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $insert_user);

mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $hashed_password);

$result = mysqli_stmt_execute($stmt);




if ($result) {
    $success_message = "Registration Successful!";
} else {
    echo "Registration Failed: " . mysqli_error($conn);
}

        }
    }
}
?>

<style>
.agro-reg-wrapper {
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
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background-color: #ffffff;
    overflow: hidden;
    z-index: 999;
}

.agro-reg-wrapper .agro-reg-card {
    display: flex;
    width: 100%;
    max-width: 1150px;
    background: #ffffff;
    border: 2px solid #4c6d5b;
    border-radius: 28px;
    overflow: hidden;
    box-shadow: 0 25px 50px rgba(76, 109, 91, 0.25);
}

.agro-reg-wrapper .agro-reg-banner {
    flex: 1.2;
    position: relative;
    background: linear-gradient(135deg, rgba(76, 109, 91, 0.82) 0%, rgba(60, 88, 72, 0.90) 100%), url('https://images.unsplash.com/photo-1625246333195-78d9c38ad449?auto=format&fit=crop&w=1200&q=80');
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    color: #ffffff;
    padding: 65px 50px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.agro-reg-wrapper .agro-reg-banner h1 {
    font-size: 38px;
    font-weight: 700;
    margin-bottom: 20px;
    line-height: 1.2;
    color: #ffffff;
}

.agro-reg-wrapper .agro-reg-banner p {
    font-size: 16px;
    line-height: 1.6;
    color: #f1f5f9;
    margin-bottom: 30px;
}

.agro-reg-wrapper .agro-features {
    list-style: none;
    padding: 0;
    margin: 0;
}

.agro-reg-wrapper .agro-features li {
    font-size: 14.5px;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    color: #ffffff;
    font-weight: 500;
}

.agro-reg-wrapper .agro-features li::before {
    content: "✓";
    display: inline-block;
    color: #4c6d5b;
    background: #ffffff;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    text-align: center;
    line-height: 20px;
    font-weight: bold;
    margin-right: 12px;
    font-size: 12px;
    flex-shrink: 0;
}

.agro-reg-wrapper .register-container {
    flex: 1.1;
    padding: 45px 45px;
    box-sizing: border-box;
    background: #628270; 
    display: flex;
    flex-direction: column;
    justify-content: center;
    color: #ffffff;
}

.agro-reg-wrapper .register-container h2 {
    color: #ffffff;
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 4px;
}

.agro-reg-wrapper .register-subtitle {
    color: #e2e8f0;
    font-size: 13.5px;
    margin-bottom: 18px;
}

.agro-reg-wrapper .register-container label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #f8fafc;
    margin-bottom: 5px;
}

.agro-reg-wrapper .register-container input {
    padding: 12px 16px;
    width: 100%;
    margin-bottom: 12px;
    box-sizing: border-box;
    border: none;
    border-radius: 12px;
    background-color: #739582 !important;
    color: #ffffff;
    font-size: 14.5px;
    outline: none;
    box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.2);
    transition: all 0.2s ease;
}

.agro-reg-wrapper .register-container input:-webkit-autofill,
.agro-reg-wrapper .register-container input:-webkit-autofill:hover, 
.agro-reg-wrapper .register-container input:-webkit-autofill:focus {
    -webkit-box-shadow: 0 0 0 1000px #739582 inset, inset 0 2px 5px rgba(0, 0, 0, 0.2) !important;
    -webkit-text-fill-color: #ffffff !important;
}

.agro-reg-wrapper .register-container input::placeholder {
    color: #d1ded6;
}

.agro-reg-wrapper .register-container input:focus {
    background-color: #7b9d8b !important;
    box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.25), 0 0 0 3px rgba(255, 255, 255, 0.2);
}

.agro-reg-wrapper .register-container button {
    width: 100%;
    padding: 14px;
    background: #385142; 
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 15.5px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s ease, transform 0.1s ease;
    margin-top: 6px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.agro-reg-wrapper .register-container button:hover {
    background: #2a3e32;
}

.agro-reg-wrapper .register-container button:active {
    transform: scale(0.98);
}

.agro-reg-wrapper .login-redirect-footer {
    text-align: center;
    margin-top: 18px;
    font-size: 13.5px;
    color: #e2e8f0;
    font-weight: 500;
}

.agro-reg-wrapper .login-redirect-footer a {
    color: #ffffff;
    font-weight: 700;
    text-decoration: none;
    margin-left: 4px;
}

.agro-reg-wrapper .login-redirect-footer a:hover {
    text-decoration: underline;
}

.error {
    color: #ffcccc;
    font-size: 12px;
    margin-top: -8px;
    margin-bottom: 10px;
}

.success {
    color: #d1fae5;
    font-size: 13.5px;
    margin-bottom: 12px;
}

@media (max-width: 768px) {
    .agro-reg-wrapper .agro-reg-card {
        flex-direction: column;
        max-width: 450px;
    }
    .agro-reg-wrapper .agro-reg-banner {
        display: none;
    }
    .agro-reg-wrapper .register-container {
        padding: 30px 22px;
    }
}
</style>

<div class="agro-reg-wrapper">
    <div class="agro-reg-card">
        <div class="agro-reg-banner">
            <h1>Online Pesticides Store</h1>
            <p>Protect your crops with top-quality pesticides and fertilizers through a seamless and reliable purchasing experience.</p>
            <ul class="agro-features">
                <li>100% Genuine & Safe Products</li>
                <li>Expert Crop Care Recommendations</li>
                <li>Fast & Reliable Home Delivery</li>
            </ul>
        </div>
        
        <div class="register-container">
            <h2>Create Account</h2>
            <p class="register-subtitle">Sign up to access the pesticides purchasing system.</p>
            <form action="" method="POST">
                 <label>Full Name</label>
                 <input type="text" name="name" placeholder="Enter your full name" required>
                 <?php if(!empty($name_error)) { ?>
                 <P class="error"><?php echo $name_error?></P>
                 <?php } ?>


                 <label>Email Address</label>
                 <input type="email" name="email" placeholder="Enter your email address" required>
                 <?php if(!empty($email_error)) { ?>
                 <p class="error"> <?php echo $email_error ?></p>
                 <?php } ?>


                 <label>Phone Number</label>
                 <input type="text" name="phone" placeholder="Enter your phone number" required>

                 <label>Password</label>
                 <input type="password" name="password" placeholder="Enter your password" required>
                 <?php if(!empty($password_error)) { ?>
                 <p class="error"> <?php echo $password_error ?> </p>
                 <?php } ?>


                 <label>Confirm Password</label>
                 <input type="password" name="confirm_password" placeholder="Re-enter your password" required>
                 <?php if(!empty($confirm_password_error)) { ?>
                 <p class="error" ><?php echo $confirm_password_error ?></p>
                 <?php } ?>

<?php if(!empty($success_message)) { ?>
    <p class="success"><?php echo $success_message; ?></p>
<?php } ?>


                 <button type="submit" name="register">Register</button>

                 <div class="login-redirect-footer">
                     Already have an account? 
                     <a href="login.php">Sign In</a>
                 </div>
            </form> 
        </div>
    </div>
</div>

<?php
require_once "../includes/footer.php";
?>