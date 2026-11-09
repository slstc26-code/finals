<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Researva — Inquiry Flowchart</title>

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

    .hero-main {
      width: min(100% - 10%, 1138px);
      min-height: calc(100vh - 80px);
      margin: 0 auto;
      padding: 40px 0 90px;
    }

    .page-title {
      font-size: clamp(28px, 3vw, 36px);
      font-weight: 600;
      letter-spacing: -.8px;
      margin: 0 0 12px;
      text-align: center;
    }

    .page-sub {
      color: rgba(255,255,255,.88);
      font-size: 16px;
      font-weight: 300;
      text-align: center;
      margin: 0 0 48px;
    }

    .flowchart {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0;
      max-width: 720px;
      margin: 0 auto;
    }

    .flow-node {
      position: relative;
      text-align: center;
      font-weight: 500;
      font-size: 15px;
      line-height: 1.4;
      padding: 18px 28px;
      min-width: 220px;
      max-width: 340px;
      box-shadow: 0 8px 24px rgba(0,0,0,.18);
      transition: transform .15s ease, box-shadow .15s ease;
    }

    .flow-node:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 32px rgba(0,0,0,.22);
    }

    .node-start,
    .node-end {
      background: #fff;
      color: #0a2540;
      border-radius: 12px;
      border: 3px solid var(--purple);
      font-weight: 600;
    }

    .node-end {
      border-color: #2ca8a8;
      background: linear-gradient(135deg, #e8f8f8, #fff);
    }

    .node-decision-wrap {
      position: relative;
      width: 260px;
      height: 160px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 8px 0;
    }

    .node-decision {
      width: 180px;
      height: 180px;
      background: #fff;
      color: #0a2540;
      border: 3px solid var(--ink);
      transform: rotate(45deg);
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 8px 24px rgba(0,0,0,.18);
      transition: transform .15s ease, box-shadow .15s ease;
    }

    .node-decision:hover {
      transform: rotate(45deg) translateY(-2px);
      box-shadow: 0 12px 32px rgba(0,0,0,.22);
    }

    .node-decision-text {
      transform: rotate(-45deg);
      font-size: 13px;
      font-weight: 600;
      line-height: 1.35;
      text-align: center;
      padding: 8px;
      max-width: 130px;
    }

    .node-process {
      background: rgba(255,255,255,.95);
      color: #0a2540;
      border-radius: 8px;
      border: 2px solid rgba(255,255,255,.6);
      font-size: 14px;
      font-weight: 500;
    }

    .flow-connector {
      width: 3px;
      height: 36px;
      background: rgba(255,255,255,.7);
      position: relative;
    }

    .flow-connector::after {
      content: "";
      position: absolute;
      bottom: -6px;
      left: 50%;
      transform: translateX(-50%);
      border-left: 7px solid transparent;
      border-right: 7px solid transparent;
      border-top: 10px solid rgba(255,255,255,.7);
    }

    .branch-row {
      display: flex;
      justify-content: center;
      gap: 48px;
      width: 100%;
      max-width: 640px;
      position: relative;
      margin-top: 4px;
    }

    .branch-col {
      display: flex;
      flex-direction: column;
      align-items: center;
      flex: 1;
      max-width: 280px;
    }

    /* Yes / No buttons */
    .branch-btns {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 10px;
    }

    .btn-yes {
      border: 0;
      border-radius: 999px;
      background: #2ecc71;
      color: #fff;
      font: 600 13px "Poppins", sans-serif;
      padding: 8px 22px;
      cursor: pointer;
      transition: transform .15s ease, background .15s ease, box-shadow .15s ease;
      box-shadow: 0 4px 12px rgba(46, 204, 113, .35);
    }

    .btn-yes:hover {
      background: #27ae60;
      transform: translateY(-1px);
      box-shadow: 0 6px 16px rgba(46, 204, 113, .45);
      color: #fff;
    }

    .btn-no {
      border: 0;
      border-radius: 999px;
      background: rgba(231, 76, 60, .85);
      color: #fff;
      font: 600 13px "Poppins", sans-serif;
      padding: 8px 22px;
      cursor: pointer;
      transition: transform .15s ease, background .15s ease, box-shadow .15s ease;
      box-shadow: 0 4px 12px rgba(231, 76, 60, .3);
    }

    .btn-no:hover {
      background: #c0392b;
      transform: translateY(-1px);
      box-shadow: 0 6px 16px rgba(231, 76, 60, .4);
      color: #fff;
    }

    .branch-line {
      width: 3px;
      height: 28px;
      background: rgba(255,255,255,.55);
      position: relative;
    }

    .branch-line::after {
      content: "";
      position: absolute;
      bottom: -5px;
      left: 50%;
      transform: translateX(-50%);
      border-left: 6px solid transparent;
      border-right: 6px solid transparent;
      border-top: 8px solid rgba(255,255,255,.55);
    }

    .h-connector {
      position: absolute;
      top: 18px;
      left: 25%;
      right: 25%;
      height: 3px;
      background: rgba(255,255,255,.4);
      z-index: 0;
    }

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
        padding: 30px 0 60px;
      }

      .branch-row {
        flex-direction: column;
        align-items: center;
        gap: 24px;
      }

      .h-connector { display: none; }

      .node-decision-wrap {
        width: 220px;
        height: 140px;
      }

      .node-decision {
        width: 150px;
        height: 150px;
      }

      .node-decision-text {
        font-size: 12px;
        max-width: 110px;
      }

      .flow-node {
        min-width: 180px;
        font-size: 14px;
        padding: 14px 20px;
      }
    }

    @media (max-width: 390px) {
      .brand { font-size: 18px; }
      .site-nav { gap: 8px; }
      .site-nav .nav-link { font-size: 12px; }
    }
  </style>
</head>
<body>
  <header class="site-header navbar navbar-expand">
    <a class="brand navbar-brand m-0 p-0" href="index.php" aria-label="Researva">Researva</a>

    <nav class="site-nav navbar-nav flex-row" aria-label="Main navigation">
      <a class="nav-link" href="index.php">Getting Started!</a>
      <a class="nav-link" href="inquire.php">Inquire</a>
    </nav>

    <a class="pill header-cta btn" href="https://www.facebook.com/deanpierre.01">CONTACT US</a>
  </header>

  <main class="hero-main" id="home">
    <h1 class="page-title">Student Inquiry Flowchart</h1>
    <p class="page-sub">Follow the steps below to know where your concern should go.</p>

    <div class="flowchart">

      <!-- START -->
      <div class="flow-node node-start">
        START<br><small class="fw-normal">You have a question / concern</small>
      </div>
      <div class="flow-connector"></div>

      <!-- Decision 1 -->
      <div class="node-decision-wrap">
        <div class="node-decision">
          <span class="node-decision-text">Can our student government answer this?</span>
        </div>
      </div>

      <!-- Yes / No branches for Decision 1 -->
      <div class="branch-row">
        <div class="h-connector"></div>

        <!-- YES path -->
        <div class="branch-col">
          <div class="branch-btns">
            <button type="button" class="btn-yes">Yes</button>
          </div>
          <div class="branch-line"></div>
          <div class="flow-node node-process">
            Contact Student Government / Student Council
          </div>
          <div class="flow-connector"></div>
          <div class="flow-node node-end">END</div>
        </div>

        <!-- NO path -->
        <div class="branch-col">
          
          <div class="branch-line"></div>

          <!-- Decision 2 -->
          <div class="node-decision-wrap">
            <div class="node-decision">
              <span class="node-decision-text">Is this for registry?</span>
            </div>
          </div>

          <div class="branch-row" style="max-width:100%; gap:28px;">
            <!-- YES – Registry -->
            <div class="branch-col">
              <div class="branch-btns">
                <button type="button" class="btn-yes">Yes</button>
              </div>
              <div class="branch-line"></div>
              <div class="flow-node node-process">
                Go to the Registrar’s Office
              </div>
              <div class="flow-connector"></div>
              <div class="flow-node node-end">END</div>
            </div>

            <!-- NO – continue to Payment -->
            <div class="branch-col">
              
              <div class="branch-line"></div>

              <!-- Decision 3 -->
              <div class="node-decision-wrap">
                <div class="node-decision">
                  <span class="node-decision-text">Payment?</span>
                </div>
              </div>

              <div class="branch-row" style="max-width:100%; gap:20px;">
                <!-- YES – Payment -->
                <div class="branch-col">
                  <div class="branch-btns">
                    <button type="button" class="btn-yes">Yes</button>
                  </div>
                  <div class="branch-line"></div>
                  <div class="flow-node node-process">
                    Proceed to Cashier / Accounting
                  </div>
                  <div class="flow-connector"></div>
                  <div class="flow-node node-end">END</div>
                </div>

                <!-- NO – Other -->
                <div class="branch-col">
                  
                  <div class="branch-line"></div>
                  <div class="flow-node node-process">
                    Contact the concerned office / Admin
                  </div>
                  <div class="flow-connector"></div>
                  <div class="flow-node node-end">END</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>