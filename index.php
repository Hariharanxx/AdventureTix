<!-- filepath: c:\xampp\htdocs\AdventureTix\index.php -->
<?php
// Start session if needed for dynamic content
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Adventure Kingdom - The Ultimate Thrill</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/animations.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=Poppins:wght@300;400;600&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- HEADER -->
    <header>
      <h1>Adventure Kingdom</h1>
      <nav>
        <a href="login.php">Book Tickets</a>
        <a href="contact.php">Contact</a>
        <a href="register.php" class="btn small-btn">Get Started</a>
      </nav>
    </header>

    <!-- HERO SECTION -->
    <section class="hero">
      <h1 class="fade-in">Welcome to <span>Adventure Kingdom</span></h1>
      <p class="slide-up">
        An Unforgettable Journey of Fun, Thrill, and Excitement!
      </p>
      <a href="login.php" class="btn golden-btn">Grab Your Pass</a>
    </section>

    <!-- ABOUT SECTION -->
    <section class="about">
      <h2>Discover the Magic</h2>
      <p>
        Step into a world of breathtaking rides, dazzling shows, and
        electrifying adventures. Whether you're a thrill-seeker or a family
        explorer, we have something for everyone!
      </p>
    </section>

    <!-- RIDE SECTION -->
    <section class="ride-container">
      <div class="ride-card">
        <img src="roller.jpg" alt="The Sky Fury">
        <h3>The Sky Fury</h3>
        <p>Feel the adrenaline rush with our fastest roller coaster yet!</p>
      </div>

      <div class="ride-card">
        <img src="ferriswheel2.jpg" alt="The Golden Wheel">
        <h3>The Golden Wheel</h3>
        <p>A breathtaking view from the top awaits you!</p>
      </div>

      <div class="ride-card">
        <img src="WaterSlide.jpg" alt="Storm Surge">
        <h3>Storm Surge</h3>
        <p>Dive into the wildest water adventure of your life!</p>
      </div>
    </section>

    <!-- TESTIMONIALS -->
    <section class="testimonials">
      <h2>What Our Guests Say</h2>
      <div class="testimonial-slider">
        <p>"This place is pure magic! Can't wait to return!" - Sophia L.</p>
        <p>"The Sky Fury ride was absolutely mind-blowing!" - Daniel R.</p>
        <p>"A perfect getaway for the whole family!" - Olivia M.</p>
      </div>
    </section>

    <!-- FOOTER -->
    <footer>
      <p>&copy; <?php echo date("Y"); ?> Adventure Kingdom. All Rights Reserved.</p>
      <div class="social-icons">
        <a href="#">Facebook</a>
        <a href="#">Instagram</a>
        <a href="#">Twitter</a>
      </div>
    </footer>

    <script src="js/script.js"></script>
  </body>
</html>