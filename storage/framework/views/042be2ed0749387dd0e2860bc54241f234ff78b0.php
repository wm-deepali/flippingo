<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Email Verification - Flippingo</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f7fa;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: 20px auto;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.05);
      overflow: hidden;
    }
    .header {
      background: linear-gradient(90deg, #0073ff, #00b4ff);
      padding: 20px;
      text-align: center;
    }
    .header img {
      height: 50px;
    }
    .header h1 {
      color: #fff;
      margin: 10px 0 0;
      font-size: 22px;
    }
    .content {
      padding: 25px;
      text-align: center;
    }
    .content h2 {
      color: #333;
      font-size: 20px;
    }
    .content p {
      color: #555;
      font-size: 15px;
      line-height: 1.5;
    }
    .otp-box {
      margin: 25px 0;
      background: #eaf4ff;
      border: 2px solid #0073ff;
      border-radius: 10px;
      padding: 20px;
    }
    .otp-title {
      font-weight: bold;
      color: #0073ff;
      margin-bottom: 10px;
    }
    .otp-code {
      font-size: 28px;
      letter-spacing: 6px;
      color: #222;
      font-weight: bold;
    }
    .expiry {
      margin-top: 10px;
      color: #ff4c4c;
      font-size: 14px;
    }
    .features {
      text-align: left;
      margin-top: 25px;
      padding: 15px;
      border: 1px solid #e0e0e0;
      border-radius: 10px;
      background: #f9fcff;
    }
    .features h3 {
      font-size: 16px;
      margin-bottom: 10px;
      color: #0073ff;
    }
    .features ul {
      padding-left: 20px;
      margin: 0;
      color: #444;
      font-size: 14px;
    }
    .footer {
      text-align: center;
      font-size: 12px;
      color: #777;
      margin: 20px 0;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Header -->
    <div class="header">
      <img src="https://via.placeholder.com/120x50?text=Flippingo" alt="Flippingo Logo">
      <h1>Flippingo</h1>
    </div>

    <!-- Content -->
    <div class="content">
      <h2>Welcome 🎉</h2>
      <p>Thank you for joining <b>Flippingo</b>! To complete your account setup and start trading, please verify your email address using the code below.</p>

      <!-- OTP Box -->
      <div class="otp-box">
        <div class="otp-title">Email Verification Code</div>
        <div class="otp-code"><?php echo e($otp); ?></div>
        <div class="expiry">⏳ This code expires in 10 minutes</div>
      </div>

      <!-- Features -->
      <div class="features">
        <h3>🚀 Getting Started</h3>
        <ul>
          <li>Browse and purchase digital products securely</li>
          <li>List your own products for sale</li>
          <li>Use our secure escrow system</li>
          <li>Manage your wallet and transactions</li>
        </ul>
      </div>
    </div>

    <!-- Footer -->
    <div class="footer">
      © 2025 Flippingo. All rights reserved.
    </div>
  </div>
</body>
</html>
<?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/emails/otp-template.blade.php ENDPATH**/ ?>