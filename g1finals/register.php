<?php
    session_start();
    include "config/database.php";
    
    if(isset($_POST['save'])){
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (fullname, username, email, password, role) VALUES ('$fullname', '$username', '$email', '$password', 'user')";

        if(mysqli_query($conn, $sql)){
            header("Location: register.php");
            exit;
        }else{
            $message = "Could not save student record.";
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Researva — Sign Up</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --oneschool-purple: #625fc8;
      --oneschool-purple-hover: #514eb5;
    }

    body {
      min-height: 100vh;
      font-family: "Poppins", Arial, sans-serif;
      background:
        linear-gradient(rgba(48, 55, 61, .88), rgba(48, 55, 61, .88)),
        url("https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=2000&q=85")
        center center / cover no-repeat fixed;
    }

    .navbar {
      min-height: 80px;
    }

    .navbar-brand {
      color: #fff;
      font-size: 20px;
      font-weight: 700;
    }

    .navbar-brand:hover,
    .navbar .nav-link {
      color: #fff;
    }

    .navbar .nav-link {
      font-size: 15px;
      font-weight: 300;
      padding: .5rem 0;
    }

    .navbar .nav-link.active {
      border-bottom: 2px solid #fff;
    }

    .btn-oneschool {
      background-color: var(--oneschool-purple);
      border-color: var(--oneschool-purple);
      border-radius: 50rem;
      color: #fff;
      font-size: 11px;
      font-weight: 600;
      padding: 14px 24px;
      transition: background-color .15s ease, border-color .15s ease;
    }

    .btn-oneschool:hover,
    .btn-oneschool:focus {
      background-color: var(--oneschool-purple-hover);
      border-color: var(--oneschool-purple-hover);
      color: #fff;
    }

    .signup-area {
      min-height: calc(100vh - 80px);
    }

    .signup-card {
      width: 100%;
      max-width: 445px;
      border: 0;
      border-radius: 6px;
      box-shadow: 0 12px 40px rgba(0, 0, 0, .12);
    }

    .signup-card .card-body {
      padding: 37px 40px 45px;
    }

    .signup-title {
      font-size: 23px;
      font-weight: 300;
      margin-bottom: 22px;
    }

    .form-control {
      height: 49px;
      border-color: #d7dce2;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 300;
      padding: 0 13px;
    }

    .form-control:focus {
      border-color: var(--oneschool-purple);
      box-shadow: 0 0 0 .2rem rgba(98, 95, 200, .12);
    }

    .signup-submit {
      min-width: 112px;
      height: 48px;
      margin-top: 8px;
    }

    @media (max-width: 575.98px) {
      .navbar {
        padding-top: 16px;
        padding-bottom: 16px;
      }

      .navbar .nav-link {
        font-size: 13px;
      }

      .navbar .nav-link.active {
        width: fit-content;
      }

      .signup-area {
        min-height: auto;
        padding-top: 35px;
        padding-bottom: 45px;
      }

      .signup-card .card-body {
        padding: 30px 25px 35px;
      }

      body {
        background-attachment: scroll;
      }
    }
  </style>
</head>
<body>
  <!-- Bootstrap responsive navigation -->
  <nav class="navbar navbar-expand-sm">
    <div class="container-fluid px-4 px-lg-5">
      <a class="navbar-brand" href="index.php">Researva</a>

      <button class="navbar-toggler bg-light" type="button"
              data-bs-toggle="collapse" data-bs-target="#mainNavbar"
              aria-controls="mainNavbar" aria-expanded="false"
              aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav mx-auto my-3 my-sm-0 gap-sm-4 gap-lg-5">
          <li class="nav-item"><a class="nav-link" aria-current="page" href="index.php">Getting Started!</a></li>
          <li class="nav-item"><a class="nav-link" href="inquire.php">Inquire</a></li>
        </ul>
        <a class="btn btn-oneschool" href="https://www.facebook.com/deanpierre.01">CONTACT US</a>
      </div>
    </div>
  </nav>

  <!-- Bootstrap flex utilities center the form horizontally and vertically -->
  <main class="signup-area container-fluid d-flex justify-content-center align-items-center px-3">
    <section class="card signup-card" aria-labelledby="signup-title">
      <div class="card-body">
        <h1 class="signup-title" id="signup-title">Sign Up</h1>

        <form id="signupForm" method="POST">
          <div class="mb-3">
            <label for="fullname" class="visually-hidden">Full name</label>
            <input class="form-control" type="text" id="fullname" name="fullname"
                   placeholder="fullname" autocomplete="fullname" required>
          </div>

          <div class="mb-3">
            <label for="username" class="visually-hidden">Username</label>
            <input class="form-control" type="username" id="username" name="username"
                   placeholder="username" autocomplete="username" required>
          </div>

          <div class="mb-3">
            <label for="email" class="visually-hidden">Email address</label>
            <input class="form-control" type="email" id="email" name="email"
                   placeholder="email" autocomplete="email" required>
          </div>

          <div class="mb-3">
            <label for="password" class="visually-hidden">password</label>
            <input class="form-control" type="text" id="password" name="password"
                   placeholder="password" required>
          </div>

          <button class="btn btn-oneschool signup-submit" type="submit" name="save">SIGN UP</button>
          <div class="form-text text-success mt-3" id="formMessage" aria-live="polite"></div>
        </form>
      </div>
    </section>
  </main>

  <!-- Bootstrap 5 JavaScript bundle (for responsive navbar toggle) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- <script>
    // Demo-only confirmation; this form does not submit data to a server.
    document.getElementById("signupForm").addEventListener("submit", function (event) {
      event.preventDefault();
      document.getElementById("formMessage").textContent =
        "Thanks for signing up!";
      this.reset();
    });
  </script> -->
</body>
</html>
