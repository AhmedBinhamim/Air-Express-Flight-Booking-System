<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="stylesheet.css">
</head>

<body class="home-body">
  <?php
  include 'customer/header.php';
  ?>
    <div class="pageHeadings">
      <h1 class="title">Air Express Airlines</h1>
    </div>
    <div>
      <!-- Slideshow container -->
      <div class="slideshow-container">
      <!-- Full-width images with number and caption text -->
        <div class="mySlides fade">
          <div class="numbertext">1 / 6</div>
          <img src="images/slideImage1.jpg" class="slideImage">
          <div class="text">Jeddah, Saudi Arabia</div>
        </div>

        <div class="mySlides fade">
          <div class="numbertext">2 / 6</div>
          <img src="images/slideImage2.jpg" class="slideImage">
          <div class="text">Kuala Lumpur, Malaysia</div>
        </div>

        <div class="mySlides fade">
          <div class="numbertext">3 / 6</div>
        <img src="images/slideImage3.jpg" class="slideImage">
          <div class="text">London, United Kingdom</div>
        </div>

        <div class="mySlides fade">
          <div class="numbertext">4 / 6</div>
        <img src="images/slideImage4.jpg" class="slideImage">
          <div class="text">New York, United States Of America</div>
        </div>

        <div class="mySlides fade">
          <div class="numbertext">5 / 6</div>
        <img src="images/slideImage5.jpg" class="slideImage">
          <div class="text">Las Vegas, United States Of America</div>
        </div>

        <div class="mySlides fade">
          <div class="numbertext">6 / 6</div>
        <img src="images/slideImage6.jpg" class="slideImage">
          <div class="text">Doha, Qatar</div>
      </div>

      <!-- Next and previous buttons -->
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
      </div>
      <br>
    </div>

<script type="text/javascript">
  let slideIndex = 1;
  showSlides(slideIndex);

  // Next/previous controls
  function plusSlides(n) {
    showSlides(slideIndex += n);
  }

  // Thumbnail image controls
  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    slides[slideIndex-1].style.display = "block";
  }  
</script>
    <form class= "loginForm" method="GET" action="login-process.php">
      <fieldset>
        <legend><img src="images/login.png"></legend>
          <table>
            <tbody>
                <tr>
                    <td><label><img src="images/email.png"></label></td>
                    <td><label>Email:</label></td>
                    <td><input type="email" name="email" placeholder="Eg. smith.john@gmail.com" required></td>
                </tr>
                <tr>
                    <td><label><img src="images/password.png"></label></td>
                    <td><label>Password:</label></td>
                    <td><input type="password" id="loginPass" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title=" The password must contain at least one number, one uppercase, one lowercase letter, and at least 8 or more characters" required></td>
                </tr>
            </tbody>
          </table>
        <input class="submitButton" type="submit" value="Login">
      </fieldset>
    </form>
    <?php
    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (strpos($fullUrl, "credentials=Invalidusernameorpassword") == true) {
      echo '<script>alert("Invalid username or password!")</script>';
    }
    elseif (strpos($fullUrl, "credentials=Invalidpassword") == true) {
      echo '<script>alert("Invalid password!")</script>';
    }
    ?>
  </div>
</body>
<?php include('login-footer.php') ?>
</html>