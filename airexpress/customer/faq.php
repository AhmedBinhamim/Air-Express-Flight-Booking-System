<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8">
  <title>FAQ</title>
  <link rel="stylesheet" href="../stylesheet.css">
  <style>
    main{
      margin: 5em;
    }
    .faq-container{
      padding: 5px;
      margin-top: 1em;
      background-color: rgba(255,255,255,0.5);
      width: fit-content;
      cursor: pointer;
    }
    .faq-question{
      cursor: pointer;
    }
    .faq-answer{
      display: none;
    }
  </style>
</head>
<?php include('header.php') ?>
<body class="home-body">
  <main>
    <div class="faq-container">
      <div class="faq-question">
      <h3>How do I book a flight on your website?</h3>
      <p class="faq-answer">To book a flight on our website, simply navigate to the "Book a Flight" page and enter your desired travel dates, destinations, and number of passengers. Then, select from the available flight options and proceed to the payment page to complete your booking.</p>
      </div>
      <script type="text/javascript">
        var questions = document.getElementsByClassName("faq-question");
        for (var i = 0; i < questions.length; i++) {
          questions[i].addEventListener("click", function() {
            var answer = this.getElementsByClassName("faq-answer")[0];
            if(answer.style.display === "block") {
              answer.style.display = "none";
            } else {
              answer.style.display = "block";
            }
          });
        }
      </script>
    </div>

    <div class="faq-container">
      <div class="faq-question2">
        <h3>Can I make changes to my flight booking after it has been confirmed?</h3>
        <p class="faq-answer">Yes, you can make changes to your flight booking by logging into your account and accessing your booking details. Depending on the airline's policy, you may be able to change your flight dates, times, or even destinations for a fee.</p>
      </div>
      <script type="text/javascript">
        var questions = document.getElementsByClassName("faq-question2");
        for (var i = 0; i < questions.length; i++) {
          questions[i].addEventListener("click", function() {
          var answer = this.getElementsByClassName("faq-answer")[0];
            if(answer.style.display === "block") {
              answer.style.display = "none";
            } else {
              answer.style.display = "block";
            }
          });
        }
      </script>
    </div>

    <div class="faq-container">
      <div class="faq-question3">
        <h3>How do I check-in for my flight?</h3>
        <p class="faq-answer">You can check-in for your flight online by visiting the airline's website and entering your booking details. You will also be able to select your seat and print your boarding pass.</p>
      </div>
      <script type="text/javascript">
        var questions = document.getElementsByClassName("faq-question3");
        for (var i = 0; i < questions.length; i++) {
            questions[i].addEventListener("click", function() {
            var answer = this.getElementsByClassName("faq-answer")[0];
            if(answer.style.display === "block") {
              answer.style.display = "none";
            } else {
              answer.style.display = "block";
            }
          });
        }
      </script>
    </div>

    <div class="faq-container">
      <div class="faq-question4">
        <h3>Can I bring additional baggage on my flight?</h3>
        <p class="faq-answer">Each airline has different baggage policies, so it's best to check with them directly. Some airlines allow you to purchase additional baggage or bring a certain number of bags for free, while others have weight and size restrictions.</p>
      </div>
      <script type="text/javascript">
        var questions = document.getElementsByClassName("faq-question4");
        for (var i = 0; i < questions.length; i++) {
          questions[i].addEventListener("click", function() {
          var answer = this.getElementsByClassName("faq-answer")[0];
          if(answer.style.display === "block") {
              answer.style.display = "none";
            } else {
              answer.style.display = "block";
            }
          });
        }
      </script>
    </div>

    <div class="faq-container">
      <div class="faq-question5">
        <h3>Need more help?</h3>
        <p class="faq-answer">Contact support at: <a style="color: black;" href="mailto:airexpress@gmail.com">airexpress@gmail.com</a></p>
      </div>
      <script type="text/javascript">
        var questions = document.getElementsByClassName("faq-question5");
        for (var i = 0; i < questions.length; i++) {
          questions[i].addEventListener("click", function() {
          var answer = this.getElementsByClassName("faq-answer")[0];
          if(answer.style.display === "block") {
              answer.style.display = "none";
            } else {
              answer.style.display = "block";
            }
          });
        }
      </script>
    </div>

  </main>
</body>
<?php include('customer-footer.php') ?>
</html>