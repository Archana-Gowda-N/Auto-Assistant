<?php
$response = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['username']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $response = "<h2>Thank you, $name!</h2><p>We will contact you at <strong>$phone</strong>.</p>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Auto Assistant - Vehicle Breakdown Help</title>
  <link rel="stylesheet" href="home.css">
  <script defer src="home.js"></script>
</head>
<body>

<!-- Navigation -->
<header class="navbar">
  <div class="logo">Auto Assistant</div>
  <nav>
    <a href="#">Home</a>
    <a href="#info-section">About</a>
    <a href="services.php">Services</a>
    <a href="#">Contact</a>
    <a href="register.php" class="register-button" id="registerBtn">Register</a>
  </nav>
</header>


<!-- Hero Section -->
<section class="hero">
  <div class="hero-content">
    <p class="choose">On-Demand Vehicle Breakdown Support</p>
    <h1 class="title">AUTO-ASSISTANT</h1>
    <img src="https://media.istockphoto.com/id/673723668/photo/handsome-auto-service-workers.jpg?s=612x612&w=0&k=20&c=uSQVOvjatxrv2lujk1ydApTNOsyPfsHApKkZaY8Sq9M=" alt="Car" class="car-image">


    <div class="navigation-circles">
      <span class="nav-number" onclick="changeCar(1)">01</span>
      <span class="nav-number" onclick="changeCar(2)">02</span>
      <span class="nav-number" onclick="changeCar(3)">03</span>
      <span class="nav-number" onclick="changeCar(4)">04</span>
    </div>

    <div class="start-button" onclick="scrollToSection('info-section')">
      <div class="circle">
        <span>START</span>
        <div class="arrow-down">&#8595;</div>
      </div>
    </div>
  </div>
</section>


<!-- Info Section -->
<section class="info-section" id="info-section">
  <div class="info-content">
    <div class="text-side">
      <h2>ALWAYS READY TO <br><span>GET YOU BACK</span> <br>ON THE ROAD</h2>
      <p>Auto Assistant connects you instantly with certified repair shops and roadside support services. Whether it’s a flat tire, engine trouble, or battery issue — we’ve got your back.</p>
      <button class="details-button">LEARN MORE ➔</button>
    </div>
    <div class="video-side">
      <video autoplay muted loop playsinline class="angled-video">
        <source src="assets\WhatsApp Video 2025-04-28 at 20.53.20_fb536fc2.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>
  </div>
</section>



<!-- container 3 -->

<section class="info-section1" id="info-section1">
  <div class="container">
    <h1>TOP RATED <br><span>VEHICLE REPAIR PARTNERS</span></h1>
    <div class="cards">
      <div class="card" onclick="showInfo('Silver Garage', 'Available 24/7 • Engine Diagnostics', 'infoModalSilver')">
        <img src="https://media.istockphoto.com/id/1317137029/photo/man-greeting-a-mechanic-with-a-handshake-at-an-auto-repair-shop.jpg?s=612x612&w=0&k=20&c=KnlTKOS8DdDQiFifRGSaBwFrTMNXhOuVV7LJuiB-I9U=" alt="Silver Garage">
        <div class="overlay">
          <h3>Silver Garage</h3>
          <p>Emergency roadside repair experts</p>
        </div>
      </div>
      <div class="card" onclick="showInfo('Yellow Garage', '9am–11pm • Electrical & AC Repair', 'infoModalYellow')">
        <img src="https://media.istockphoto.com/id/188052258/photo/car-components.jpg?s=612x612&w=0&k=20&c=ecwDRfBXUZt3BgSNOzvnGOveu7O5AX82y9OQ5kFFrZg=" alt="Yellow Garage">
        <div class="overlay">
          <h3>Yellow Garage</h3>
          <p>Car diagnostics and parts replacement</p>
        </div>
      </div>
      <div class="card" onclick="showInfo('Blue Performance', 'Mobile Assistance • Battery, Tires & More', 'infoModalBlue')">
        <img src="https://media.istockphoto.com/id/1162856846/photo/auto-mechanic-working-on-car-engine-in-mechanics-garage-repair-service-authentic-close-up-shot.jpg?s=612x612&w=0&k=20&c=jCd_iRrP9DYJiRoGkwFGQqX7L69fFlTqJT4cv3AFiVA=" alt="Blue Performance">
        <div class="overlay">
          <h3>Blue Performance</h3>
          <p>Mobile vehicle service team</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Modals -->
  <div id="infoModalSilver" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeInfo('infoModalSilver')">&times;</span>
      <h2 id="carTitle"></h2>
      <p id="carDetails"></p>
    </div>
  </div>

  <div id="infoModalYellow" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeInfo('infoModalYellow')">&times;</span>
      <h2 id="carTitle"></h2>
      <p id="carDetails"></p>
    </div>
  </div>

  <div id="infoModalBlue" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeInfo('infoModalBlue')">&times;</span>
      <h2 id="carTitle">Title</h2>
      <p id="carDetails">Details</p>

    </div>
  </div>
</section>








<!-- Subscribe Section -->
<section class="subscribe-section">
  <div class="subscribe-container">
    <div class="subscribe-image">
      <img src="https://media.istockphoto.com/id/1162856846/photo/auto-mechanic-working-on-car-engine-in-mechanics-garage-repair-service-authentic-close-up-shot.jpg?s=612x612&w=0&k=20&c=jCd_iRrP9DYJiRoGkwFGQqX7L69fFlTqJT4cv3AFiVA=" alt="Repair Mechanic">
    </div>
    <div class="subscribe-form">
      <h2>NEED HELP? WE'LL CALL YOU BACK</h2>


      <form action="home.php" method="POST">
        <label>Your Name</label>
        <input type="text" name="username" placeholder="Enter your name" required>
        <label>Phone Number</label>
        <input type="tel" name="phone" placeholder="Enter phone number" required pattern="[0-9]{10}" title="Enter a 10-digit phone number">
        <button type="submit">REQUEST CALLBACK ➔</button>
      </form>
      
      <button class="contact-button">Contact Us</button>
      <?php if (!empty($confirmation)) echo $confirmation; ?>

    </div>
  </div>


<!-- Footer -->
<footer class="footer">
  <div class="footer-logo">AUTO ASSISTANT</div>
  <ul class="footer-links">
    <li>Privacy & Legal</li>
    <li>Contact</li>
    <li>Locations</li>
    <li>News</li>
    <li>Forums</li>
  </ul>
  <div class="footer-social">
    <i class="fab fa-facebook-f"></i>
    <i class="fab fa-instagram"></i>
    <i class="fab fa-x-twitter"></i>
  </div>
  <p class="footer-copy">© All Rights Reserved By Auto Assistant</p>
</footer>
</section>
</body>
</html>
