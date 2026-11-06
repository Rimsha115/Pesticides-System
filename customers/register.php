<?php
require_once "../includes/header.php";
?>
<style>
.agro-reg-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    min-height: 100vh;
    padding: 50px 20px;
    box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background-color: #ffffff;
}

.agro-reg-wrapper .agro-reg-card {
    display: flex;
    width: 100%;
    max-width: 1100px;
    background: #ffffff;
    border: 2px solid #4c6d5b;
    border-radius: 24px;
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
    padding: 60px 50px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.agro-reg-wrapper .agro-reg-banner h1 {
    font-size: 36px;
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
    font-size: 14px;
    margin-bottom: 12px;
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
    margin-right: 10px;
    font-size: 12px;
}

.agro-reg-wrapper .register-container {
    flex: 1.1;
    padding: 50px 45px;
    box-sizing: border-box;
    background: #628270; 
    display: flex;
    flex-direction: column;
    justify-content: center;
    color: #ffffff;
}

.agro-reg-wrapper .register-container h2 {
    color: #ffffff;
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 6px;
}

.agro-reg-wrapper .register-subtitle {
    color: #e2e8f0;
    font-size: 14px;
    margin-bottom: 24px;
}

.agro-reg-wrapper .register-container label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #f8fafc;
    margin-bottom: 6px;
}

.agro-reg-wrapper .register-container input {
    padding: 14px 18px;
    width: 100%;
    margin-bottom: 16px;
    box-sizing: border-box;
    border: none;
    border-radius: 10px;
    background-color: #739582 !important;
    color: #ffffff;
    font-size: 15px;
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
    padding: 15px;
    background: #385142; 
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s ease, transform 0.1s ease;
    margin-top: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.agro-reg-wrapper .register-container button:hover {
    background: #2a3e32;
}

.agro-reg-wrapper .register-container button:active {
    transform: scale(0.98);
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
        padding: 35px 25px;
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
                 
                 <label>Email Address</label>
                 <input type="email" name="email" placeholder="Enter your email address" required>

                 <label>Phone Number</label>
                 <input type="text" name="phone" placeholder="Enter your phone number" required>

                 <label>Password</label>
                 <input type="password" name="password" placeholder="Enter your password" required>

                 <label>Confirm Password</label>
                 <input type="password" name="confirm_password" placeholder="Re-enter your password" required>

                 <button type="submit" name="register">Register</button>
            </form> 
        </div>
    </div>
</div>

<?php
require_once "../includes/footer.php";
?>