<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0px;
            padding: 0px;
        }
        body {
            text-align: center;
            background-image: url('resources/background1.jpg');
            background-size: calc(200vw - 2in) 100vh;           /* Adjust this to fix zoom */
            background-repeat: no-repeat;       
            background-position: center center;
            background-attachment: fixed;
            color: white;
        }
        header {
            display: flex;
            align-items: center;
            padding: 5px 80px;
            background-color: rgb(17, 99, 28);
        }
        header img {
            width: 100px;
        }
        header form {
            margin-left: auto;
            margin-right: 10px
        }
        header input {
            height: 40px;
            width: 250px;
            padding: 10px;
            font-size: 18px;
            border-radius: 15px;
            border: none;
        }
        header nav {
            margin-left: auto;
        }
        header a {
            text-decoration: none;
            font-size: 24px;
            margin-left: 20px; 
            color: white;
        }
        video {
            width: 75%;
            height: 600px;
            margin-inline: auto;
        }
        .hero-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            background-color: rgb(29, 65, 26);
         }
         .container {
            display: flex;
            justify-content: center;
            margin-inline: auto;
            max-width: 1200px;
            height: 100vh;
        }
        .hero {
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
        .features {
            display: flex;
            justify-content: space-evenly;
        }
        .feature img {
            height: 600px
        }
        body > h2 {
            margin-bottom: 25px;
            font-size: 38px;
        }
        footer {
            background-color: rgb(17, 99, 28);
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            padding-top: 10px;
        }
        footer img {
            width: 100px;
        }
        body > p {
            background-color: rgb(17, 99, 28);
            color: white;
            text-align: center;
            padding-top: 10px;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
    <header>
        <img src="resources/yap.png" alt="">
        <nav>
            <a href="index.php">Login</a>
            <a href="signup.php">Sign Up</a>
        </nav>
    </header>
    <div class="container">
        <video width="640" height="360" controls>
            <source src="resources/yap.mp4" type="video/mp4">
        </video>
    </div>
    <div class="container">
        <div class="hero">
            <img src="resources/yap.png" alt="">
            <p>YAP is a social platform where you can share your life stories, rants, and personal moments freely. Whether it’s a major life event or a random late-night thought, YAP is your digital space to be real—no filters, no judgment.</p>
        </div>
    </div>
    <h2>Featured Posts</h2>
    <div class="features">
        <div class="feature">
            <h2></h2>
            <img src="resources/features/rhovic.png" alt="">
        </div>
        <div class="feature">
            <img src="resources/features/emerson.png" alt="">
        </div>
        <div class="feature">
            <h2></h2>
            <img src="resources/features/sean.png" alt="">
        </div>
    </div>
    <footer>
        <img src="resources/yap.png" alt="">
        <div>
            <p>Rhovic James G. Queddeng</p>
            <p>Emerson E. Manzano</p>
            <p>Sean Ander Christian Galace</p>
        </div>
    </footer>
    <p>&copy; 2025 CodeIgniter. All rights reserved.</p>
</body>
</html>