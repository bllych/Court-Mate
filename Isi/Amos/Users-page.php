<?php
session_start();
require_once '../../db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../Account/index.php');
    exit();
}

$user = getUserById($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Profile</title>
    <link rel="stylesheet" href="../../style/Users-page.css" />
    <link rel="stylesheet" href="../../style/Headfoot.css" />
  </head>

    <header>
      <div class="logo">
        <a href="../../index.php"><img src="../../Gambar/Header Foto/logo.png" /></a>
      </div>
      <div class="search-bar">
        <img src="../../Gambar/Header Foto/Search.png" alt="Search" />
        <input type="text" placeholder="Search..." />
      </div>
      <div class="lgokanan">
        <a href=""><img src="../../Gambar/Header Foto/Notif.png" alt="" style="margin-right: 35px" /></a>
        <a href="../../Account/index.php"><img src="../../Gambar/Header Foto/User.png" alt="" /></a>
      </div>
    </header>

    <!-- Navbar -->
    <nav>
      <a href="../../index.php">Home</a>
      <a href="#">Status</a>
      <a href="../../Isi/Coaching.php">Coaching</a>
      <a href="../../Isi/Amos/Support.php"><u>Support</u></a>
    </nav>

    <div class="profile-container">
    <div class="user-name-title">
        <img src="../../Gambar/Header Foto/User.png" alt="User Icon" class="user-title-icon" />
        <h1><b><?php echo htmlspecialchars($user['name']); ?></b></h1>
    </div>

    <div class="profile-card">

        <div class="profile-left-column">
            <div class="profile-photo-area">
                <div class="photo-placeholder">
                    <span class="cat-illustration"></span>
                          <img src="../../Gambar/Header Foto/User.png" alt="User Icon" class="cat-illustration" />
                </div>
                <button class="profile-button change-photo">Change Photo</button>
            </div>

            <button class="profile-button"><b>Change Password</</button>
            <button class="profile-button"><b>Profile Password</b></button>
        </div>

        <div class="profile-right-column">
            <h3 class="section-title">Account Profile</h3>

            <div class="profile-detail-row">
                <span class="label">Name</span>
                <span class="value"><?php echo htmlspecialchars($user['name']); ?></span>
            </div>
            <div class="profile-detail-row">
                <span class="label">Email</span>
                <span class="value"><?php echo htmlspecialchars($user['email']); ?></span>
            </div>
            <div class="profile-detail-row">
                <span class="label">Phone Number</span>
                <span class="value"><?php echo htmlspecialchars($user['phone'] ?? 'Not set'); ?></span>
            </div>
            <div class="profile-detail-row">
                <span class="label">Role</span>
                <span class="value"><?php echo htmlspecialchars($user['role']); ?></span>
            </div>

            <h3 class="section-title change-profile-title">Change Profile</h3>

            <form method="POST" action="update_profile.php">
                <div class="profile-detail-row">
                    <span class="label">Name</span>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" class="value" required>
                </div>
                <div class="profile-detail-row">
                    <span class="label">Email</span>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="value" required>
                </div>
                <div class="profile-detail-row">
                    <span class="label">Phone Number</span>
                    <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>" class="value">
                </div>
                <button type="submit" class="profile-button" style="margin-top: 20px;">Update Profile</button>
            </form>
        </div>
    </div>
</div>

    <!-- Footer -->
    <footer>
      <div class="footer-box">
        <div class="contact">
          <h3>Contact Us</h3>
        </div>
        <h3>|</h3>
        <div class="socials">
          <a href="https://www.instagram.com/"
            ><img src="../../Gambar/foto footer/Instagram.png" alt="Instagram"
          /></a>
          <a href="https://x.com/"
            ><img src="../../Gambar/foto footer/Twitter.png" alt="Twitter"
          /></a>
          <a href="https://web.whatsapp.com/"
            ><img src="../../Gambar/foto footer/Whatsapp.png" alt="WhatsApp"
          /></a>
          <a href="https://www.tiktok.com/id-ID/"
            ><img src="../../Gambar/foto footer/Tiktok.png" alt="TikTok"
          /></a>
          <a href="https://mail.google.com/mail/u/0/"
            ><img src="../../Gambar/foto footer/email.png" alt="Email"
          /></a>
          <a href="https://www.youtube.com/watch?v=tL9yDq5hpgI"
            ><img src="../../Gambar/foto footer/Phone.png" alt="Phone"
          /></a>
        </div>
      </div>
    </footer>


    <!-- Section Info/Footer Biru -->
    <div class="all-footer-biru">
      <div class="footer-biru">
        <div class="info-section1">
          <div class="info-box">
            <h3>About Us</h3>
            <p>Our team</p>
            <p style="margin-bottom: 61px">Privacy & Policy</p>
          </div>

          <div class="info-box">
            <h3>Support :</h3>
            <p>Help</p>
            <p>Feedback</p>
          </div>
        </div>
        <div class="info-section2">
          <div class="info-box">
            <h3>Contact Us :</h3>
            <p>+62 813 4609 9722</p>
            <p>@username</p>
            <p style="margin-bottom: 40px">myemail@gmail.com</p>
          </div>
          <div class="info-box">
            <h3>Community :</h3>
            <p>Twitter</p>
            <p>Instagram</p>
          </div>
        </div>
      </div>

      <div class="gambar-info-box">
        <hhh3><h3>Payment methods :</h3></hhh3>
        <div class="fotopayment">
          <div class="payments1">
            <a href="https://gopay.co.id/"
              ><img
                src="../../Gambar/foto footer/bayar 1.png"
                alt="qris"
                style="width: 110px; height: 50px"
            /></a>
            <a href="https://gopay.co.id/"
              ><img
                src="../../Gambar/foto footer/bayar 2.png"
                alt="gopay"
                style="width: 150px; height: 45px"
            /></a>
            <a href="https://gopay.co.id/"
              ><img
                src="../../Gambar/foto footer/bayar 3.png"
                alt="mandiri"
                style="width: 153px; height: 50px"
            /></a>
          </div>

          <div class="payment2">
            <a href="https://gopay.co.id/"
              ><img
                src="../../Gambar/foto footer/bayar 4.png"
                alt="shopeepay"
                style="width: 119px; height: 55px"
            /></a>
            <a href="https://gopay.co.id/"
              ><img
                src="../../Gambar/foto footer/bayar 5.png"
                alt="bca"
                style="width: 118px; height: 55px"
            /></a>
          </div>
        </div>
      </div>
    </div>

    <script src="../../Slideshow.js" defer></script>


</body>
</html>
