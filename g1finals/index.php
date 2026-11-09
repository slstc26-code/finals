<?php
    session_start();
    include "config/database.php";
   if(isset($_SESSION["role"])){
        if($_SESSION["admin"] == "admin"){
            header("Location: admin/first.php");
        }else{
            header("Location: user/first.php");
        }
        exit;
    }
    
    if(isset($_POST["login"])){
        $username = mysqli_escape_string($conn,$_POST["username"]);
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) == 1){
            $user = mysqli_fetch_assoc($result);
            if(password_verify($password, $user["password"])){
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["fullname"] = $user["fullname"];
                $_SESSION["role"] = $user["role"];

                if($user["role"] == "admin"){
                    header("Location: admin/first.php");
                }else{
                    header("Location: user/first.php");
                }
                exit;
            }
        }
        $error = "Invalid username or password";
           



    }
    
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Group 1</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Original Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root { --purple: #625fc8; --ink: #0f7ad1; }
    * { box-sizing: border-box; }

    body {
      margin: 0;
      min-height: 100vh;
      font-family: "Poppins", Arial, sans-serif;
      color: white;
      background:
        linear-gradient(rgba(8, 42, 71, 0.88), rgba(44, 168, 168, 0.88)),
        url("https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=2000&q=85")
        center / cover no-repeat fixed;
    }

    /* Bootstrap navbar with styling retained from your original design */
    .site-header {
      width: min(100% - 8.5%, 1400px);
      margin: 0 auto;
      min-height: 80px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 24px;
    }

    .brand {
      color: #fff;
      text-decoration: none;
      font-size: 20px;
      font-weight: 700;
      letter-spacing: -.5px;
    }

    .site-nav {
      display: flex;
      align-items: center;
      gap: clamp(22px, 3vw, 48px);
    }

    .site-nav .nav-link {
      color: #f5f5f5;
      text-decoration: none;
      font-size: 15px;
      font-weight: 300;
      padding: 8px 0;
    }

    .site-nav .nav-link.active { border-bottom: 2px solid #fff; }

    .pill {
      border: 0;
      border-radius: 999px;
      background: var(--purple);
      color: white;
      padding: 15px 30px;
      font: 600 11px "Poppins", sans-serif;
      cursor: pointer;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: transform .15s ease, background .15s ease;
    }

    .pill:hover { background: #514eb5; color: white; transform: translateY(-1px); }
    .header-cta { padding: 14px 22px; }

    /* Bootstrap grid replaces the original CSS grid */
    .hero-main {
      width: min(100% - 10%, 1138px);
      min-height: calc(100vh - 80px);
      margin: 0 auto;
      padding: 50px 0 90px;
    }

    .intro { padding-top: 10px; }

    h1 {
      font-size: clamp(30px, 3vw, 39px);
      line-height: 1.25;
      margin: 0 0 24px;
      font-weight: 600;
      letter-spacing: -.8px;
    }

    .intro p {
      color: rgba(255,255,255,.88);
      font-size: 16px;
      line-height: 1.8;
      font-weight: 300;
      margin: 0 0 26px;
      max-width: 560px;
    }

    .intro .pill { min-width: 206px; min-height: 52px; }

    /* Bootstrap card and form controls */
    .signup-card {
      background: #fff;
      color: #080808;
      border-radius: 6px;
      padding: 37px 40px 55px;
      width: 100%;
      max-width: 445px;
      box-shadow: 0 12px 40px rgba(0,0,0,.08);
      border: 0;
    }

    h2 { font-size: 23px; font-weight: 300; margin: 0 0 22px; }

    .signup-card .form-control {
      display: block;
      width: 100%;
      height: 49px;
      margin: 0 0 16px;
      border: 1px solid #d7dce2;
      border-radius: 6px;
      background: #fff;
      padding: 0 13px;
      font: 300 14px "Poppins", sans-serif;
      color: #3f4650;
      outline: none;
      box-shadow: none;
      transition: border-color .15s, box-shadow .15s;
    }

    .signup-card .form-control::placeholder { color: #657080; opacity: 1; }

    .signup-card .form-control:focus {
      border-color: var(--purple);
      box-shadow: 0 0 0 3px rgba(98,95,200,.12);
    }

    .signup-card .pill { min-width: 112px; height: 48px; margin-top: 8px; }
    .form-message { color: #315d42; font-size: 13px; margin: 14px 0 0; min-height: 18px; }

    @media (max-width: 760px) {
      .site-header {
        width: min(100% - 36px, 600px);
        flex-wrap: wrap;
        padding: 18px 0;
      }

      .site-nav {
        order: 3;
        width: 100%;
        justify-content: space-between;
        gap: 12px;
      }

      .site-nav .nav-link { font-size: 13px; }
      .header-cta { padding: 12px 16px; }

      .hero-main {
        width: min(100% - 36px, 540px);
        padding: 55px 0 60px;
      }

      .intro { padding-top: 0; }
      .signup-card { max-width: none; padding: 30px 25px 35px; }
    }

    @media (max-width: 390px) {
      .brand { font-size: 18px; }
      .site-nav { gap: 8px; }
      .site-nav .nav-link { font-size: 12px; }
      h1 { font-size: 29px; }
    }
  </style>
</head>
<body>
  <!-- Header/navigation retained; Bootstrap utilities provide layout -->
  <header class="site-header navbar navbar-expand">
    <a class="brand navbar-brand m-0 p-0" href="index.php" aria-label="Researva">Researva</a>

    <nav class="site-nav navbar-nav flex-row" aria-label="Main navigation">
      <a class="nav-link" href="#home">Getting Started!</a>
      <a class="nav-link" href="inquire.php">Inquire</a>
    </nav>

    <a class="pill header-cta btn" href="https://www.facebook.com/deanpierre.01">CONTACT US</a>
  </header>

  <!-- Bootstrap responsive row/columns -->
  <main class="hero-main row align-items-center g-0" id="home">
    <section class="intro col-md-7 pe-md-4" aria-labelledby="hero-title">
      <h1 id="hero-title">Ease of access with us.</h1>
      <p>Monitor your progress<br class="desktop-break">End it with success.</p>
      <a class="pill btn" href="register.php">Create an account</a>
    </section>
    <section class="col-md-5 d-flex justify-content-md-end mt-4 mt-md-0" id="signup" aria-labelledby="signup-title">
      <div class="signup-card card">
        <h2 id="login">Log in</h2>
        <form id="login" method="POST">
          <input class="form-control" type="text" name="username" placeholder="Username" aria-label="Username" required>
          <input class="form-control" type="email" name="email" placeholder="Email address" aria-label="Email address" required>
          <input class="form-control" type="text" name="password" placeholder="password" aria-label="password" required>
          <button class="pill btn" type="submit" name="login">Enter</button>
          <p class="form-message" id="form-message" role="status" aria-live="polite"></p>
        </form>
      </div>
    </section>
  </main>

  <!-- Bootstrap JavaScript bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Demo-only form feedback; this does not send login details to a server.
    document.getElementById("signup-form").addEventListener("submit", function (event) {
      event.preventDefault();
      document.getElementById("form-message").textContent =
        "Form submitted for demo purposes only. No information was sent.";
    });
  </script>
</body>
</html>
