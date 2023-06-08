<!DOCTYPE html>
<html>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
    }

    .banner {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 500px;
      background-image: url("https://cdn.theatlantic.com/thumbor/sJt29URQDac4B6JAPBv-TknDazk=/0x207:5005x3022/960x540/media/img/mt/2014/03/shutterstock_90266317/original.jpg");
      background-size: cover;
      background-position: center;
    }

    .banner-title {
      color: black;
      font-size: 48px;
      font-weight: bold;
      text-align: center;
    }

    .banner-subtitle {
      color: black;
      font-size: 24px;
      text-align: center;
    }

    .banner-button {
      display: block;
      margin: 20px auto;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      background-color: #f39c12;
      color: white;
      font-size: 18px;
      cursor: pointer;
    }

    .banner-button:hover {
      background-color: #e67e22;
    }

    .services {
      display: flex;
      justify-content: space-between;
      padding: 40px 0;
    }

    .service-card {
      width: 30%;
      text-align: center;
    }

    .service-icon {
      width: 100px;
      height: auto;
    }

    .service-title {
      font-size: 24px;
      font-weight: bold;
      margin-top: 20px;
    }

    .service-description {
      font-size: 18px;
      margin-top: 10px;
    }

    .footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: #2c3e50;
      padding: 10px;
      color: white;
    }

    .footer-menu {
      display: flex;
      list-style: none;
    }

    .footer-menu li {
      margin-left: 20px;
    }

    .footer-menu a {
      color: white;
      text-decoration: none;
    }

    .footer-menu a:hover {
      color: #f39c12;
    }
  </style>

  <head>
    <link href="Home-Page.css" rel="stylesheet" type="text/css">
  </head>
  <?php 
      require 'navbar.php';
  ?>
  <body>
    <div class="container">
    <div class="banner">
        <div class="banner-content"> 
          <h1 class="banner-title">Welcome to DocHub</h1> 
          <p class="banner-subtitle">Connecting Patients and Doctors, One Click at a Time</p> 
          <?php if ($user) {
                    if ($user['role'] == 'doctor') {
                        echo '<button class="banner-button" disabled>Book Now</button>';
                    } else {
                        echo '<button class="banner-button" onclick="redirectToBook()">Book Now</button>';
                    }
                } else {
                    echo '<button class="banner-button" onclick="redirectToLogin()">Book Now</button>';
                }
                ?>
        </div> 
      </div> 
     <div class="services"> 
       <div class="service-card"> 
       <img src="https://lh3.googleusercontent.com/drive-viewer/AFGJ81q0DDuVeICnkZMh97l3IAj0UDEpeJCIsN9pwvFx6LHnamSy7hwZJhrkMgyGM_jkMxLGbWVa4Ox-TCMNfHvpgMI2S11kXw=s1600" class="service-icon" />
         <h3 class="service-title">Online Appointment</h3> 
         <p class="service-description">You can book an appointment with your doctor anytime, anywhere. Just select your preferred date and time, and confirm your booking.</p> 
       </div> 
       <div class="service-card"> 
       <img src="https://lh3.googleusercontent.com/drive-viewer/AFGJ81oKou8CK7z9hTr4MJaFFOSLQacOJtwTsoEuZoEe_rDeeBkqbVOEb-R3p0ZCMguVgnPO5oggjmwN5R55LZ4gkS_daSLmLw=s1600" class="service-icon" /> </a> 
         <h3 class="service-title">Online Consultation</h3> 
         <p class="service-description">You can consult with your doctor online via video call or chat. You can also upload your reports and prescriptions for review.</p> 
       </div> 
       <div class="service-card"> 
       <img src="https://lh3.googleusercontent.com/drive-viewer/AFGJ81oFbTcFeObMMMNPWFrMrUNX0gYt-vZ1Vyzfe1JTvC-THHjfcEKpLYh-CsekKkL7Cgichmth9q3JHyaL-fjTJqqF6CercQ=s1600" class="service-icon" /> </a>
         <h3 class="service-title">Online Prescription</h3> 
         <p class="service-description">You can get your prescription online from your doctor. You can also order your medicines online and get them delivered to your doorstep.</p> 
       </div> 
     </div> 
     <div class="footer"> 
      <img src="https://lh3.googleusercontent.com/drive-viewer/AFGJ81oPLY3tWwP5Ehvtv0-5ucfnf0ht4a204opiPOE9q4EjYrsrfHfAHVwX3L9Uk-sSdnEYQa7LZAZ8Rqnz7uYEbCcOPN29cg=s2560" class="navbar-logo" /> 
     </div> 
   </div> 
 </body>
 <script>
    function redirectToLogin() {
        window.location.href = "login.php";
    }
    
    function redirectToBook() {
        window.location.href = "show_doctors.php";
    }
</script>
</html>
