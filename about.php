<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
    }

    h1 {
      margin: 0;
      font-size: 36px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-weight: bold;
    }

    .container {
    max-width: 6000px;
    padding: 30px;
    background-color: #2c3e50;
    background-size: cover; /* Adjust the background-size property as needed */
    background-repeat: repeat; /* Adjust the background-repeat property as needed */
    background-position: center; /* Adjust the background-position property as needed */
    color: #fff;
    backdrop-filter: blur(1000px); /* Adjust the blur value as needed */
  }
    li {
    list-style: none; /* Remove bullet points from all list items */
    }

    a {
    text-decoration: none; /* Remove underline from the hyperlink */
    color: #000000; /* Set the initial color of the hyperlink */
    transition: color 0.2s ease; /* Add a transition for the color property */
    }

    a:hover {
    color: #000000; /* Change the color of the hyperlink on hover */
    }

    .description {
      margin-bottom: 20px;
      font-size: 18px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-weight: normal;
    }

    .btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #1976D2;
      color: #fff;
      text-decoration: none;
      border-radius: 3px;
      font-size: 16px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #1565C0;
    }

    .features {
      font-size: 18px;
      margin-top: 20px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-weight: normal;
    }

    .features li {
      margin-bottom: 10px;
    }

  .horizontal-groups {
  display: flex; /* Displays the groups horizontally */
  justify-content: space-between; /* Distributes the groups evenly across the container */
  }

  .horizontal-groups ul {
  list-style-type: none; /* Removes the default list bullet points */
  }

  .horizontal-groups ul li {
  display: inline-block; /* Displays the list items in a row */
  margin-right: 10px; /* Adds some spacing between the list items */
  }

  .horizontal-groups ul li:last-child {
  margin-right: 0; /* Removes the right margin from the last list item in each group */
  }
  .banner-ad {
  display: flex;
  justify-content: center;
  margin-top: 30px;
  padding: 20px 0;
  background-color: #f2f2f2;
  }

  .banner-image {
  max-width: 100%;
  height: auto;
  }


  </style>
</head>
  <?php 
      require 'navbar.php';
  ?>
<body>
    


    <div class="container">
      <h2>Welcome to Doc Hub</h2>
      <p class="description">Welcome to Doctor Hub - Your Comprehensive Healthcare Solution</p>
      <p class="description">Doctor Hub is a revolutionary healthcare platform designed to provide seamless and comprehensive solutions for patients, doctors, and healthcare providers. We understand the challenges and complexities involved in managing healthcare, and our goal is to simplify the process, enhance communication, and improve overall patient care.</p>
      <p class="description">In today's fast-paced world, accessing quality healthcare can often be a daunting task. Doctor Hub aims to bridge the gap between patients and doctors, offering a user-friendly platform that facilitates efficient appointment scheduling, secure communication, and easy access to medical records.</p>
      <p class="description">With Doctor Hub, patients can experience a streamlined healthcare journey right at their fingertips. Our platform empowers individuals to search for doctors based on specialties, qualifications, and reviews, enabling them to make informed decisions when choosing their healthcare providers.</p>
      <p class="description">For doctors and healthcare providers, Doctor Hub offers an integrated and efficient system that simplifies appointment management, reduces administrative burdens, and enhances patient engagement. Our platform provides tools for scheduling appointments, managing patient records, and securely exchanging medical information, allowing healthcare professionals to focus on delivering exceptional care.</p>
      <p class="description">At Doctor Hub, we prioritize patient privacy and data security. Our robust security measures ensure that sensitive medical information remains confidential and protected. We adhere to industry standards and regulations, ensuring peace of mind for both patients and healthcare professionals.</p>
      <p class="description">Whether you're a patient seeking healthcare services or a doctor looking to enhance your practice, Doctor Hub is your trusted companion. Join us in revolutionizing the healthcare landscape, where technology and compassion intersect to create a more accessible and patient-centric healthcare experience.</p>
      <p class="description">Experience the convenience, efficiency, and personalized care that Doctor Hub brings to the world of healthcare. Together, let's shape a healthier future for all.</p>
      
      <h3>Key Features:</h3>
      <ul class="features">
        <li>Doctor profiles: The app provides detailed profiles of doctors, including their specialties, qualifications, experience, and any other relevant information, allowing patients to make informed decisions when selecting a doctor.</li>
        <li>Appointment scheduling: Patients can easily schedule appointments with doctors through the app. The app provides a user-friendly interface that allows patients to select preferred dates, times, and available slots based on the doctor's schedule.</li>
        <li>Real-time availability: The app displays real-time availability of doctors, showing open slots and helping patients find suitable appointment times that match their schedules.</li>
        <li>Online consultations: The app supports online consultations, allowing patients to have virtual appointments with doctors through video calls or secure messaging. This feature provides flexibility and convenience, especially for patients who cannot visit the doctor's office physically.</li>
        <li>Appointment history: Patients can view their appointment history within the app, providing them with a record of past appointments, including dates, doctors seen, and any relevant notes or documents.</li>
        <li>Multilingual support: The app may offer multilingual support, allowing patients to use the app in their preferred language, enhancing accessibility for a diverse patient population.</li>
      </ul>

      <p>Get started with Doc Hub today and streamline your medical appointment needs.</p>
      <a href="#" class="btn">Sign Up</a>
    </div>
      <div class="horizontal-groups">
    <ul>
      <li><h1>Doc Hub</h1></li>
      <li><a href="#">Our Story</a></li> 
      <li><a href="#">Pricing</a></li>
      <li><a href="#">Sign Up</a></li>
      <li><a href="#">Wall of Love</a></li>
      <li><a href="#">Data Of Security</a></li>
    </ul>
    
    <ul>
      <li><h1>About</h1></li>
      <li><a href="#">Press</a></li>
      <li><a href="#">Careers</a></li> 
      <li><a href="#">Partnerships</a></li>
      <li><a href="#">Blog</a></li>
      <li><a href="#">Site Map</a></li>
    </ul>
    
    <ul>
      <li><h1>Help</h1></li>
      <li><a href="#">FAQ</a></li>
      <li><a href="#">Terms Of Use</a></li> 
      <li><a href="#">Privacy Policy</a></li>
      <li><a href="#">Request a Demo</a></li>
      <li><a href="#">Find a Doctor</a></li>
    </ul>
    
    <ul>
      <li><h1>Patients</h1></li>
      <li><a href="#">Find a Doctor</a></li>
      <li><a href="#">Online Consultations</a></li> 
      <li><a href="#">Healthcare Blog</a></li>
      <li><a href="#">Health Podcast</a></li>
    </ul>
  </div>
  <div class="banner-ad">
    <!-- Place your banner ad code here -->
    <img src="https://i.postimg.cc/QMZ9mrbv/Doc-hub-3.png" alt="Banner Ad" class="banner-image">
  </div>

  </div>
</body>
</html>
