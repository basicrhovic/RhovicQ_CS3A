<?php
    session_start();

    include_once('connection.php');
    $con = connection();

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare statement to avoid SQL injection
        $stmt = $con->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            // Verify password against hashed password in DB
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                header("Location: email-verify/index.php");
                exit();
            } else {
                echo '<script>alert("Incorrect password.");</script>';
            }
        } else {
            echo '<script>alert("No user found!");</script>';
        }
        $stmt->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            height: 80%;
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
            margin: 20px 0px;
            font-weight: 100;
        }
        input {
            margin-bottom: 30px;
            height: 50px;
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
                <p>Life,<br> Unfiltered.</p>
            </div>
            <h1>Log In</h1>
            <form method="post">
                <input type="text" name="username" id="username" placeholder="Username">
                <input type="password" name="password" id="password" placeholder="Password">
                <input class="button" type="submit" name="submit" value="Login">
            </form>
            <p>Don't have an account? <a href="signup.php">Create One</a></p>
        </div>
    </div>
</body>
</html>