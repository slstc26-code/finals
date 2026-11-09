<?php
    session_start();
    include "../config/database.php";
    if(!isset($_SESSION["role"]) || $_SESSION["role"] != "admin"){
        header("Location: admin/first.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['create_room'])) {

    $room_name = trim($_POST['room_name']);
    $description = trim($_POST['description']);

    if ($room_name !== "") {

        $sql = "INSERT INTO rooms
                (room_name, description, created_by)
                VALUES (:room_name, :description, :created_by)";

        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ':room_name' => $room_name,
            ':description' => $description,
            ':created_by' => $_SESSION['user_id']
        ]);

        $message = "Room successfully created!";
    } else {
        $message = "Please enter a room name.";
    }
}
?>
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Researva</title>

  <!-- Bootstrap 5.3.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    .create-room-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 28px;
            background: #0d9488; /* teal-600 */
            color: white;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 9999px; /* fully rounded */
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(13, 148, 136, 0.35);
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
            user-select: none;
        }

        .create-room-btn:hover {
            background: #0f766e; /* teal-700 */
            transform: scale(1.08);
            box-shadow: 0 8px 25px rgba(13, 148, 136, 0.45);
        }

        .create-room-btn:active {
            transform: scale(0.97);
        }

    :root {
      --purple: #625fc8;
      --purple-hover: #514eb5;
      --blue: #0f7ad1;
      --teal: #2ca8a8;
      --text: #17232c;
      --muted: #667781;
      --line: #dce5e8;
      --panel: rgba(255,255,255,.97);
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      min-height: 100vh;
      font-family: "Poppins", Arial, sans-serif;
      color: var(--text);
      background:
        linear-gradient(135deg, rgba(8,42,71,.92), rgba(44,168,168,.88)),
        url("https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=2000&q=85")
        center / cover fixed no-repeat;
    }
    .site-header {
      min-height: 80px;
      width: min(100% - 8.5%, 1400px);
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 24px;
      color: white;
    }
    .brand { color: white; text-decoration: none; font-size: 23px; font-weight: 700; letter-spacing: -.7px; }
    .site-nav { display: flex; align-items: center; gap: clamp(20px, 3vw, 44px); }
    .site-nav a { color: rgba(255,255,255,.92); text-decoration: none; font-size: 14px; font-weight: 300; padding: 8px 0; }
    .site-nav a.active { border-bottom: 2px solid white; }
    .pill {
      border: 0; border-radius: 999px; background: var(--purple); color: white;
      padding: 13px 23px; font: 600 11px "Poppins", sans-serif; cursor: pointer;
      text-decoration: none; display: inline-flex; align-items: center; justify-content: center;
      transition: transform .15s ease, background .15s ease;
    }
    .pill:hover { background: var(--purple-hover); color: white; transform: translateY(-1px); }
    .header-cta { padding: 13px 22px; }
    .page { max-width: 680px; margin: 30px auto 60px; }
    .welcome { color: white; margin: 0 0 18px; }
    .welcome h1 { font-size: clamp(24px, 3vw, 32px); line-height: 1.2; margin: 0 0 7px; font-weight: 600; letter-spacing: -.6px; }
    .welcome p { margin: 0; font-size: 14px; line-height: 1.7; font-weight: 300; color: rgba(255,255,255,.86); }
    .lineup-card { background: var(--panel); border: 1px solid rgba(255,255,255,.5); border-radius: 12px; box-shadow: 0 12px 34px rgba(3,28,43,.16); margin-bottom: 18px; overflow: hidden; }
    .composer { padding: 16px; }
    .composer-top, .post-head { display: flex; align-items: center; gap: 11px; }
    .avatar { width: 42px; height: 42px; border-radius: 50%; flex: 0 0 42px; background: #dce7ed; display: grid; place-items: center; overflow: hidden; }
    .avatar svg { width: 35px; height: 35px; margin-top: 6px; }
    .composer-input {
      min-width: 0; flex: 1; border: 0; outline: 0; background: #eef4f6;
      border-radius: 25px; padding: 13px 16px; font: 400 14px "Poppins", sans-serif; color: var(--text);
    }
    .composer-input:focus { box-shadow: inset 0 0 0 1px rgba(15,122,209,.45); }
    .rule { height: 1px; background: var(--line); margin: 15px 0 10px; }
    .composer-actions { display: flex; gap: 7px; }
    .action {
      border: 0; cursor: pointer; border-radius: 8px; font: 500 12px "Poppins", sans-serif;
      padding: 10px 9px; display: inline-flex; align-items: center; justify-content: center; gap: 7px;
      flex: 1; background: transparent; color: #536773;
    }
    .action:hover { background: #edf4f6; color: var(--blue); }
    .action .emoji { font-size: 18px; }
    .upload-label { cursor: pointer; }
    #imageInput { display: none; }
    .preview-wrap { display: none; position: relative; margin-top: 14px; border: 1px solid var(--line); border-radius: 9px; overflow: hidden; }
    .preview-wrap img { width: 100%; max-height: 460px; object-fit: contain; display: block; background: #f7f9fa; }
    .remove-preview { position: absolute; top: 10px; right: 10px; width: 34px; height: 34px; border: 0; border-radius: 50%; background: white; box-shadow: 0 1px 5px #0002; font-size: 20px; cursor: pointer; }
    .post-button { width: 100%; background: var(--blue); color: white; margin-top: 13px; padding: 12px; font: 600 12px "Poppins", sans-serif; border: 0; border-radius: 8px; }
    .post-button:hover { background: #0968b5; }
    .feed-title { color: rgba(255,255,255,.9); font-size: 12px; font-weight: 600; letter-spacing: 1.6px; margin: 24px 3px 10px; }
    .post { padding: 16px 16px 8px; }
    .post-author { font-weight: 600; font-size: 14px; }
    .post-time { color: var(--muted); font-size: 11px; margin-top: 3px; }
    .post-text { font-size: 14px; line-height: 1.7; white-space: pre-wrap; overflow-wrap: anywhere; margin: 14px 0; }
    .post-image { display: block; width: calc(100% + 32px); max-height: 600px; margin: 0 -16px; object-fit: contain; background: #f7f9fa; }
    .post-stats { display: flex; justify-content: space-between; color: var(--muted); font-size: 12px; padding: 12px 0; }
    .post-actions { display: flex; border-top: 1px solid var(--line); padding: 4px 0; gap: 4px; }
    .post-actions button { flex: 1; background: transparent; color: #5b6d77; border: 0; padding: 10px 5px; border-radius: 7px; cursor: pointer; font: 500 12px "Poppins", sans-serif; }
    .post-actions button:hover { background: #edf4f6; }
    .post-actions button.liked { color: var(--blue); }
    .comments { padding: 0 16px 14px; }
    .comment-list { display: grid; gap: 8px; margin-bottom: 10px; }
    .comment-bubble { background: #eef4f6; border-radius: 15px; padding: 9px 12px; font-size: 13px; overflow-wrap: anywhere; }
    .comment-bubble strong { display: block; font-size: 11px; margin-bottom: 3px; }
    .comment-form { display: flex; gap: 8px; }
    .comment-form input { flex: 1; min-width: 0; border: 0; outline: 0; border-radius: 20px; background: #eef4f6; padding: 10px 13px; font: 400 12px "Poppins", sans-serif; }
    .comment-form button { border: 0; background: var(--blue); color: white; border-radius: 20px; padding: 0 16px; cursor: pointer; font: 500 12px "Poppins", sans-serif; }
    .empty { text-align: center; color: var(--muted); font-size: 13px; padding: 25px 14px; }
    @media (max-width: 760px) {
      .site-header { width: min(100% - 36px, 600px); flex-wrap: wrap; padding: 16px 0; }
      .site-nav { order: 3; width: 100%; justify-content: space-between; gap: 12px; }
      .site-nav a { font-size: 12px; }
      .header-cta { padding: 11px 15px; }
      .page { width: calc(100% - 28px); }
    }
    @media (max-width: 480px) {
      .page { width: calc(100% - 16px); margin-top: 20px; }
      .composer { padding: 12px; }
      .composer-actions { gap: 2px; }
      .action { padding: 9px 3px; font-size: 10px; }
      .action .emoji { font-size: 16px; }
      .welcome { padding: 0 4px; }
    }
  </style>
</head>
<body>
  <header class="site-header">
    <a class="brand" href="#" aria-label="Researva">Researva</a>
    <nav class="site-nav" aria-label="Main navigation">
      <a href="first.php">Home</a>
      <a href="inquire.php">Inquire?</a>
    </nav>
    <a class="pill header-cta" href="../logout.php">Log out</a>
  </header>

  <main class="container page" id="home">
    <section class="welcome">
      <h1>Welcome Admin! </h1>
      <p>Share your progress.</p>
    </section>
    <button class="create-room-btn">
        + Create a Room
    </button>

</div>
   
</body>
</html>
