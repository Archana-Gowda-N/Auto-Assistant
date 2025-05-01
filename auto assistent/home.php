<?php
$response = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['username']));
    $phone = htmlspecialchars(trim($_POST['phone']));

    // Basic validation
    if (empty($name) || empty($phone)) {
        $response = "<h2>Please fill in all fields.</h2>";
    } else {
        // Optionally, validate phone number format (this is a simple regex example)
        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $response = "<h2>Please enter a valid phone number (10 digits).</h2>";
        } else {
            $response = "<h2>Thank you, $name!</h2><p>We will contact you at <strong>$phone</strong>.</p>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Auto Assistant - Vehicle Breakdown Help</title>
  <script defer src="home.js"></script>
  <style>
    /* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    scroll-behavior: smooth;
  }
  
  /* Body */
  body {
    font-family: 'Poppins', sans-serif;
    overflow-x: hidden;
  }

  /* toolkit */
  /* Tooltip Style */
.tooltip {
  display: none;
  position: absolute;
  background-color: #333;
  color: white;
  padding: 10px 15px;
  border-radius: 5px;
  margin-top: 20px;
  font-size: 14px;
  top: 70px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 1000;
  white-space: nowrap;
}

.tooltip a {
  color: #FFD700;
  text-decoration: none;
}

.tooltip a:hover {
  text-decoration: underline;
}

  /* Navbar */
  .navbar {
    position: fixed;
    width: 100%;
    top: 0;
    padding: 20px 80px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 1000;
    background: transparent;
  }

  /* extra */
  .navbar .logo {
    font-size: 24px;
    font-weight: bold;
}

.navbar nav {
    display: flex;
    gap: 20px;
    align-items: center;
}

.navbar nav a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    position: relative;
}




  /* Special style for Register button */
.register-button {
  background-color: #28a745;
  padding: 8px 16px;
  border-radius: 5px;
  color: white;
  font-weight: bold;
  transition: background-color 0.3s ease;
}

.register-button:hover {
  background-color: #218838;
}
  
  .logo {
    font-weight: bold;
    font-size: 24px;
    letter-spacing: 2px;
  }
  
  nav a {
    margin-left: 30px;
    text-decoration: none;
    color: #000;
    font-weight: 500;
    transition: 0.3s;
  }
  
  nav a:hover {
    color: #ffcc00;
  }
  
  /* Hero */
  .hero {
    width: 100%;
    height: 600px;
    background: url('https://cdn.pixabay.com/photo/2013/06/10/09/23/desert-123978_1280.jpg') no-repeat center center/cover;
     
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    position: relative;
  }
  
  .hero-content {
    margin-top: 80px;
  }
  
  .choose {
    font-size: 14px;
    letter-spacing: 3px;
    color: #fff;
    margin-bottom: 10px;
  }
  
  .title {
    font-size: 60px;
    font-weight: bold;
    color: #fff;
    margin-bottom: 20px;
  }
  
  .car-image {
    width: 300px;
    max-width: 90%;
    animation: float 4s ease-in-out infinite;
     border-radius:30px;
  }
  
  /* Floating Animation */
  @keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
  }
  
  /* Navigation Circles */
  .navigation-circles {
    margin-top: 20px;
  }
  
  .nav-number {
    display: inline-block;
    margin: 0 10px;
    font-size: 18px;
    color: #fff;
    cursor: pointer;
    position: relative;
  }
  
  .nav-number:hover {
    color: #ffcc00;
  }
  
  /* Start Button */
  .start-button {
    margin-top: 30px;
  }
  
  .start-button .circle {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid #fff;
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    color: #fff;
    font-size: 14px;
    font-weight: bold;
    position: relative;
    transition: 0.4s;
    cursor: pointer;
  }
  
  .start-button .circle:hover {
    background: #ffcc00;
    color: #000;
  }
  
  .arrow-down {
    font-size: 18px;
    margin-top: 5px;
  }


  /* ________________________________________________________________________________________ */
  
  /* Info Section */
  .info-section {
    width: 100%;
    height: 500px;
    background: #f27329;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 20px;
    /* margin-top: 80px; <-- this creates the gap */
  }
  
  
  .info-content {
    width: 90%;
    max-width: 1200px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  
  .text-side {
    flex: 1;
    color: #fff;
  }
  
  .text-side h2 {
    font-size: 42px;
    margin-bottom: 20px;
  }
  
  .text-side h2 span {
    color: #000;
  }
  
  .text-side p {
    font-size: 16px;
    line-height: 1.5;
    margin-bottom: 30px;
  }
  
  .details-button {
    background: transparent;
    border: 2px solid #fff;
    color: #fff;
    padding: 10px 20px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.3s;
  }
  
  .details-button:hover {
    background: #fff;
    color: #f27329;
  }
  
  /* Video side */
  .video-side {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .angled-video {
    width: 300px;
    height: 400px;
    object-fit: cover;
    transform: rotate(-5deg);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
    border-radius: 8px;
  }
  
  /* Responsive */
  @media (max-width: 768px) {
    .info-content {
      flex-direction: column;
      text-align: center;
    }
  
    .video-side {
      margin-top: 20px;
    }
  
    .angled-video {
      width: 250px;
      height: 300px;
    }
  }
  /* *****************************container3******************************************** */
 /* Container */
 .container {
  text-align: center;
  padding: 50px 20px;
}

/* Title */
h1 {
  font-size: 2.5rem;
  color: #111;
  margin-bottom: 50px;
  font-weight: bold;
}

h1 span {
  color: #555;
}

/* Cards */
.cards {
  display: flex;
  justify-content: center;
  gap: 30px;
}

.card {
  position: relative;
  width: 250px;
  height: 350px;
  overflow: hidden;
  transform: skewY(-5deg);
  animation: slideIn 1s ease forwards;
  animation-delay: var(--delay);
  opacity: 0;
  cursor: pointer;
}

.card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

/* Hover effect */
.card:hover img {
  transform: scale(1.1);
}

/* Animation */
@keyframes slideIn {
  0% {
    transform: translateY(100px) skewY(-5deg);
    opacity: 0;
  }
  100% {
    transform: translateY(0) skewY(-5deg);
    opacity: 1;
  }
}

/* Modal Styling */
.modal {
  display: none;
  position: fixed;
  top: 0; left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.6);
  justify-content: center;
  align-items: center;
  z-index: 10;
}

.modal-content {
  background: white;
  padding: 30px;
  border-radius: 10px;
  width: 80%;
  max-width: 400px;
  text-align: center;
  position: relative;
}

.close {
  position: absolute;
  top: 15px;
  right: 20px;
  font-size: 24px;
  cursor: pointer;
}

.modal h2 {
  margin-bottom: 10px;
}

/* Overlay Styling */
.overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.6);
  color: white;
  opacity: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  transition: opacity 0.5s ease;
  transform: skewY(5deg);
}

.card:hover .overlay {
  opacity: 1;
}

/* Overlay text */
.overlay h3 {
  margin: 0;
  font-size: 1.5rem;
}

.overlay p {
  margin-top: 10px;
  font-size: 1rem;
}

/* Animating cards one after another */
.cards .card:nth-child(1) {
  --delay: 0s;
}

.cards .card:nth-child(2) {
  --delay: 0.5s;
}

.cards .card:nth-child(3) {
  --delay: 1s;
}




/* ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^container 4 ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^6 */
/*  */
/* Subscribe Section */
.subscribe-section {
  background-color: #dd7733;
  padding: 60px 0;
  overflow: hidden;
}

.subscribe-container {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 80px;
  max-width: 1200px;
  margin: auto;
  padding: 0 20px;
}

/* Initial states for animation */
.subscribe-image img {
  width: 400px;
  height: auto;
  transform: translateX(150px) scale(0.8);
  opacity: 0;
  animation: slideZoomInRight 1s forwards;
}

.subscribe-form {
  color: white;
  transform: translateX(-150px) scale(0.8);
  opacity: 0;
  animation: slideZoomInLeft 1s forwards;
}

/* Text inside form */
.subscribe-form h2 {
  font-size: 2rem;
  margin-bottom: 20px;
  font-weight: bold;
}

.subscribe-form form {
  display: flex;
  flex-direction: column;
}

.subscribe-form label {
  margin-bottom: 5px;
  font-size: 0.9rem;
}

/* .subscribe-form input {
  margin-bottom: 15px;
  padding: 10px;
  font-size: 1rem;
  border: 1px solid #ccc;
  width: 300px;
  max-width: 100%;
} */

/* Input fields basic styling (already exists) */
.subscribe-form input {
  margin-bottom: 15px;
  padding: 10px;
  font-size: 1rem;
  border: 1px solid #ccc;
  width: 300px;
  max-width: 100%;
  transition: all 0.3s ease;
  border-radius: 5px; /* Optional - makes corners soft */
}

/* NEW: Hover effect on input fields */
.subscribe-form input:hover,
.subscribe-form input:focus {
  background-color: #fff8f0;
  border-color: #ff9800;
  box-shadow: 0 0 8px rgba(255, 152, 0, 0.6);
  transform: scale(1.02);

}


.subscribe-form button {
  background-color: #ffc107;
  color: black;
  padding: 10px 20px;
  border: none;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  margin-top: 10px;
  transition: background 0.3s;
}

.subscribe-form button:hover {
  background-color: #e0a800;
}

/* Animations */
@keyframes slideZoomInRight {
  to {
    transform: translateX(0) scale(1);
    opacity: 1;
  }
}

@keyframes slideZoomInLeft {
  to {
    transform: translateX(0) scale(1);
    opacity: 1;
  }
}

/* Hover zoom effect */
/* Hover zoom in-out effect */
.subscribe-image img:hover {
  animation: zoomInOut 2s infinite alternate;
}

/* Keyframes for zoom in and out */
@keyframes zoomInOut {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(1.1);
  }
}

.subscribe-section {
  background-color: #dd7733;
  padding: 60px 0;
  overflow: hidden;
}

.subscribe-container {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 80px;
  max-width: 1200px;
  margin: auto;
  padding: 0 20px;
}

/* Initial states for animation */
.subscribe-image img {
  width: 400px;
  height: auto;
  transform: translateX(150px) scale(0.8);
  opacity: 0;
  animation: slideZoomInRight 1s forwards;
}

.subscribe-form {
  color: white;
  transform: translateX(-150px) scale(0.8);
  opacity: 0;
  animation: slideZoomInLeft 1s forwards;
}

/* Text inside form */
.subscribe-form h2 {
  font-size: 2rem;
  margin-bottom: 20px;
  font-weight: bold;
}

.subscribe-form form {
  display: flex;
  flex-direction: column;
}

.subscribe-form label {
  margin-bottom: 5px;
  font-size: 0.9rem;
}

/* .subscribe-form input {
  margin-bottom: 15px;
  padding: 10px;
  font-size: 1rem;
  border: 1px solid #ccc;
  width: 300px;
  max-width: 100%;
} */

/* Input fields basic styling (already exists) */
.subscribe-form input {
  margin-bottom: 15px;
  padding: 10px;
  font-size: 1rem;
  border: 1px solid #ccc;
  width: 300px;
  max-width: 100%;
  transition: all 0.3s ease;
  border-radius: 5px; /* Optional - makes corners soft */
}

/* NEW: Hover effect on input fields */
.subscribe-form input:hover,
.subscribe-form input:focus {
  background-color: #fff8f0;
  border-color: #ff9800;
  box-shadow: 0 0 8px rgba(255, 152, 0, 0.6);
  transform: scale(1.02);

}


.subscribe-form button {
  background-color: #ffc107;
  color: black;
  padding: 10px 20px;
  border: none;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  margin-top: 10px;
  transition: background 0.3s;
}

.subscribe-form button:hover {
  background-color: #e0a800;
}

/* Animations */
@keyframes slideZoomInRight {
  to {
    transform: translateX(0) scale(1);
    opacity: 1;
  }
}

@keyframes slideZoomInLeft {
  to {
    transform: translateX(0) scale(1);
    opacity: 1;
  }
}

/* Hover zoom effect */
/* Hover zoom in-out effect */
.subscribe-image img:hover {
  animation: zoomInOut 2s infinite alternate;
}

/* Keyframes for zoom in and out */
@keyframes zoomInOut {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(1.1);
  }
}

.subscribe-form button {
  padding: 12px;
  background-color: #e0a800;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  margin-top: 10px;
  transition: background-color 0.3s ease;
}

.subscribe-form button:hover {
  background-color: #0056b3;
}

/* Style for Contact Us button */
.contact-button {
  padding: 12px;
  background-color: #28a745;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  margin-top: 20px;
  transition: background-color 0.3s ease;
}

.contact-button:hover {
  background-color: #218838;
}

/* footer css */
.footer {
  margin-top: 50px;
  padding: 30px 20px;
  background-color: #dd7733;
  text-align: center;
  color: #fff;
  font-family: 'Poppins', sans-serif;
  position: relative;
  overflow: hidden;
}

/* Logo */
.footer-logo {
  font-weight: 700;
  font-size: 1.5rem;
  margin-bottom: 20px;
  opacity: 0;
  animation: fadeInUp 1s forwards;
}

/* Footer Links List */
.footer-links {
  list-style: none;
  padding: 0;
  margin: 0 0 20px;
  display: flex;
  justify-content: center;
  gap: 20px;
  flex-wrap: wrap;
}

/* Each Link */
.footer-links li {
  opacity: 0;
  animation: fadeInUp 0.8s forwards;
  cursor: pointer;
  transition: color 0.3s ease;
}

/* Hover effect on links */
.footer-links li:hover {
  color: #ffd54f;
}

/* Social Icons */
.footer-social {
  margin-bottom: 20px;
  font-size: 1.5rem;
  opacity: 0;
  animation: fadeInUp 1s forwards;
  animation-delay: 2s;
}

.footer-social i {
  margin: 0 10px;
  cursor: pointer;
  transition: transform 0.3s ease;
}

.footer-social i:hover {
  transform: scale(1.2);
}

/* Copyright */
.footer-copy {
  font-size: 0.9rem;
  opacity: 0;
  animation: fadeInUp 1s forwards;
  animation-delay: 2.5s;
}

/* Animation Keyframes */
@keyframes fadeInUp {
  0% {
    opacity: 0;
    transform: translateY(30px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}
  </style>
</head>
<body>

<!-- Navigation -->
<header class="navbar">
  <div class="logo">Auto Assistant</div>
  <nav>
    <a href="#">Home</a>
    <a href="#info-section">About</a>
    <a href="service.html">Services</a>
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