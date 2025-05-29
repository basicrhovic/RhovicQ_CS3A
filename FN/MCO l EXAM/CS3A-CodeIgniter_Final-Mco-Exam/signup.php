<?php 
    include_once('connection.php');
    $con = connection();

    if (isset($_POST['submit'])) {
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];

        $profile_image_url = "";  

        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['profile_image']['tmp_name'];
            $fileName = $_FILES['profile_image']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($fileExtension, $allowedfileExtensions)) {
                $newFileName = uniqid('', true) . '.' . $fileExtension;
                $uploadFileDir = 'uploads/users/';

                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0755, true);
                }

                $dest_path = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $profile_image_url = $dest_path;  
                } else {
                    echo '<script>alert("There was an error uploading the profile image.");</script>';
                }
            } else {
                echo '<script>alert("Only JPG, JPEG, PNG, and GIF files are allowed.");</script>';
            }
        }

        if (empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password) || empty($confirmpassword)) {
            echo '<script>alert("Please fill in all required fields.");</script>';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<script>alert("Invalid email format.");</script>';
        } elseif ($password !== $confirmpassword) {
            echo '<script>alert("Passwords do not match.");</script>';
        } else {
            $stmt = $con->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo '<script>alert("Username or email already taken.");</script>';
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $insert_stmt = $con->prepare("INSERT INTO users (firstname, lastname, username, email, password, created_at, profile_image_url) VALUES (?, ?, ?, ?, ?, NOW(), ?)");
                $insert_stmt->bind_param("ssssss", $firstname, $lastname, $username, $email, $hashed_password, $profile_image_url);

                if ($insert_stmt->execute()) {
                    header("Location: index.php");
                    exit();
                } else {
                    echo '<script>alert("Error occurred while registering.");</script>';
                }
                $insert_stmt->close();
            }
            $stmt->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0px;
            padding: 0px;
        }
        body {
            background: linear-gradient(to right,rgb(15, 63, 12),rgb(105, 146, 121));
            color: white;
        }
        .container {
            display: flex;
            justify-content: center;
            margin-inline: auto;
            max-width: 1200px;
            height: 100vh;
        }
        .hero {
            flex: 5;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 80px;
        }
        .hero img {
            width: 400px;
            margin-bottom: 50px;
        }
        .hero p {
            font-size: 26px;
            text-align: justify;
            line-height: 40px;
            word-spacing: 2px;
        }
        .form {
            flex: 3;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 90%;
            margin: auto auto;
            padding: 20px 40px;
            border: 1px solid black;
            border-radius: 20px;
            background-color: rgb(29, 65, 26)
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .form img {
            width: 100px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        .logo p {
            font-size: 26px;
            font-style: italic;
        }
        h1 {
            margin-bottom: 5px;
            font-weight: 100;
        }
        input {
            margin-bottom: 15px;
            height: 40px;
            width: 350px;
            padding: 8px;
            border-radius: 10px;
        }
        input {
            font-size: 16px;
            border: none;
        }
        .form > p {
            font-size: 20px;
        }
        a {
            text-decoration: underline;
            font-weight: bold;
            color: white;
        }
        .button {
            color: white;
            background-color: rgb(17, 99, 28);
        }
        .button:hover {
            background-color: rgb(29, 116, 40);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="hero">
            <img src="resources/yap.png" alt="">
            <p>YAP is a social platform where you can share your life stories, rants, and personal moments freely. Whether it’s a major life event or a random late-night thought, YAP is your digital space to be real—no filters, no judgment.</p>
        </div>
        <div class="form">
            <div class="logo">
                <img src="resources/star.png" alt="">
                <p>Life, Unfiltered</p>
            </div>
            <h1>Create an Account</h1>
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="firstname" id="firstname" placeholder="First Name" required>
                <input type="text" name="lastname" id="lastname" placeholder="Last Name" required>
                <input type="text" name="username" id="username" placeholder="Username" required>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" required>
                <input class="button" type="file" name="profile_image" id="profile_image" accept="image/*" required>
                <input class="button" type="submit" name="submit" value="Sign Up">
            </form>
            <p>Already have an account? <a href="index.php">Log In</a> here</p>
        </div>
    </div>
</body>
</html>