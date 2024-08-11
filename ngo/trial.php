
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="trial.css">
    <title>LOGIN</title>
</head>
<body>
    <div class="wrapper" >
        <img src="1.jpg" alt="background" class="bg">
        <header>
            <div class="container">
                <div class="nav-logo">
                    <img src="logo.png" alt="Logo">
                    <h4 class="logotext">ImpactLink</h4>
                </div>
                <div class="nav-button">
                    <button class="btn white-btn" id="loginBtn" onclick="login()">Sign In </button>
                    <button class="btn" id="RegisterBtn" onclick="register()">Sign Up </button>
                </div>
            </div>
        </header>
        <div class="form-box">
        
            <!------------------- login form -------------------------->
            <div class="login-container" id="login">
                <div class="top">
                    <span>Don't have an account? <a href="#" onclick="register()">Sign Up</a></span>
                    <header>Login</header>
                </div>
                <form action="includes/login.inc.php" method="post">
                <div class="input-box">
                    <input type="text" class="input-field" name="username" placeholder="Username">
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" name="pwd" placeholder="Password">
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-box">
                    <button type="submit" name="submit"class="submit" value="Sign In">Sign In</button>
                </div>
                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="login-check">
                        <label for="login-check"> Remember Me</label>
                    </div>
                    
                </div>
            </div></form>
            
            <!------------------- registration form -------------------------->
            <div class="register-container" id="register">
                <div class="top">
                    <span>Have an account? <a href="#" onclick="login()">Login</a></span>
                    <header>Sign Up</header>
                </div>
                <form action="includes/signup.inc.php" method="post">
                
                    <div class="input-box">
                        <input type="text" class="input-field" name="username" placeholder="Firstname">
                        <i class="bx bx-user"></i>
                    </div>
                    

                <div class="input-box">
                    <input type="text" class="input-field" name = "email" placeholder="Email">
                    <i class="bx bx-envelope"></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" name="pwd" placeholder="Password">
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-box">
                    <button type="submit" class="submit" name="submit" value="Register">Register</button>
                </div>
                
            </div>
        </div>
    </div> </form>  

    <script>
        var a=document.getElementById("loginBtn");
        var b=document.getElementById("RegisterBtn");
        var x=document.getElementById("login");
        var y=document.getElementById("register");
        function login() {
            x.style.left = "calc(50% - 250px)"; // Adjust the width of the form (500px) divided by 2
            y.style.right = "-520px";
            a.className += " white-btn";
            b.className = "btn";
            x.style.opacity = 1;
            y.style.opacity = 0;
        }
        
        function register() {
            x.style.left = "-320px";
            y.style.right = "calc(50% - 250px)";
            a.className = "btn";
            b.className += " white-btn";
            x.style.opacity = 0;
            y.style.opacity = 1;
        }
    </script>






</body>
</html>