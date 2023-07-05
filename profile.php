<?php 
    require 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .container {
            background-color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1rem;
            max-width: 700px;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            margin: auto;
            border: 0.5px solid black;
            margin-top: 150px;
        }

        .profile {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .name {
            font-size: 40px;
        }

        .details {
            font-size: 16px;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="profile">
        <div class="name"><?php echo $user['name'] ?></div>
        <div class="details">
            Age: <?php echo $user['age'] ?><br>
            Gender: <?php echo $user['gender'] ?><br>
            <?php 
                if ($user['role'] == 'doctor') {
                    echo "Specialization: " . $user['specialization'] . "<br>";
                }
            ?>
            Phone number: <?php echo $user['phone_number'] ?><br>
            Email: <?php echo $user['email'] ?><br>
            Address: <?php echo $user['address'] ?><br>
            Role: <?php echo $user['role'] ?><br>
        </div>
    </div>
</body>
</html>
