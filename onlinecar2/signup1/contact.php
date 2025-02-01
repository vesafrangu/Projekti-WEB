<?php
require_once('User.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $user = new User();

    if ($user->sendMessage($name, $email,$message)) {
        echo "sent successfully!";
        header('location:contact.php');
        exit();
    } else {
        echo "User registration failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Kontakt</title>
    <link rel="stylesheet" href="contact.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/5.5.2/collection/components/icon/icon.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <header>
      <a href="index.html" class="logo">OnlineCar</a>
      <nav class="navigation">
          <a href="services.html">Services</a>
          <div class="button-container">
              <button onclick="location.href='login.php'" class="login-button">Login</button>
              <button onclick="location.href='choose.html'" class="signup-button">Sign Up</button>
          </div>
      </nav>
  </header>
    <div class="container">
      <div class="content">
        <div class="left-side">
          <div class="address details">
            <ion-icon name="globe"></ion-icon>
            <div class="topic">Address</div>
            <div class="text-one">Prishtine</div>
            <div class="text-two">Zahir Pajaziti</div>
          </div>
          <div class="phone details">
            <ion-icon name="call"></ion-icon>
            <div class="topic">Phone</div>
            <div class="text-one">+3834444444</div>
          </div>
          <div class="email details">
            <ion-icon name="mail"></ion-icon>
            <div class="topic">Email</div>
            <div class="text-one">fatlumsyla@gmail.com</div>
            <div class="text-one">vesafrangu@gmail.com</div>
          </div>
        </div>
        <div class="right-side">
          <div class="topic-text">Send us a message</div>
          <p>Nese keni ndonje pyetje ose kerkese per OnlineCar ,ju lutem na shenoni.</p>
          <form action="contact.php" method="POST" >
            <div class="input-box">
              <input type="text" placeholder="Enter your name" name="name"/>
            </div>
            <div class="input-box">
              <input type="text" placeholder="Enter your email" name ="email" />
            </div>
            <div class="input-box message-box">
              <textarea placeholder="Enter your message" name ="message"></textarea>
            </div>
            <div class="buttoni2">
  <input type="submit" value="Send Now" style="background-color: blue; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px;" />
</div>

          </form>
        </div>
      </div>
    </div>


    
    <footer>
      <div class="content">
        <div class="top">
          <div class="logo-details">
           
          </div>
         
        </div>
        <div class="link-boxes">
          <ul class="box">
            <li class="link_name" style="color: yellow;">OnlineCar</li>
            <li><a href="#">Home</a></li>
            <li><a href="contact.html">Contact us</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="signup-PA.html">Get started</a></li>
          </ul>
      
         
         
       
        </div>
      </div>
      <div class="bottom-details">
        <div class="bottom_text">
          <span class="copyright_text">Copyright © 2024 <a href="#">OnlineCar.</a>All rights reserved</span>
          <span class="policy_terms">
            <a href="#">Privacy policy</a>
            <a href="#">Terms & condition</a>
          </span>
        </div>
      </div>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>document.querySelector("form").addEventListener("submit", function(event) {
    let name = document.querySelector("input[name='name']").value.trim();
    let email = document.querySelector("input[name='email']").value.trim();
    let message = document.querySelector("textarea[name='message']").value.trim();
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (name === "") {
        alert("Please enter your name.");
        event.preventDefault();
        return;
    }

    if (email === "" || !emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        event.preventDefault();
        return;
    }

    if (message === "") {
        alert("Please enter your message.");
        event.preventDefault();
    }
});
</script>
  </body>
</html>

