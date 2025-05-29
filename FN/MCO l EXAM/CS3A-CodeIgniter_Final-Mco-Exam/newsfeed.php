<?php
session_start();

include_once('connection.php');
$con = connection();

$sql = "SELECT 
            users.username, 
            users.profile_image_url AS profile_image, 
            posts.image_url, 
            posts.content, 
            posts.likes_count, 
            posts.comments_count, 
            posts.shares_count, 
            posts.created_at
        FROM posts
        JOIN users ON posts.user_id = users.id
        ORDER BY posts.created_at DESC";

$result = $con->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Feed</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            box-sizing: border-box;
            margin: 0px;
            padding: 0px;
        }
        /* background  */
        body {
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
        .post {
            margin-top: 40px;
            width: 750px;
            margin-inline: auto;
            display: flex;
            flex-direction: column;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        .postheader {
            display: flex;
            align-items: center;
        }
        .postheader img {
            width: 50px;
            height: 50px;
            border-radius: 50px;
            object-fit: cover;
        }
        .postheader p {
            margin-left: 15px;
            font-size: 20px;
            font-weight: 600;
        }
        .timestamp {
            font-weight: 100 !important;
            font-size: 14px !important;
        }
        .postheader i {
            margin-left: auto;
        }
        .post > img {
            width: 80%;
            margin: 30px auto;
        }
        .postaction {
            display: flex;
            justify-content: space-between;
        }
        i {
            font-size: 20px;
        }
        .action {
            display: flex;
            margin-right: 25px;
            align-items: center;
        }
        .action p {
            margin-left: 10px;
        }
        h3 {
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: 20px;
            font-weight: 100;
        }
        p {
            text-align: justify;
            line-height: 30px;
        }
        .post-form {
            margin-top: 50px;
            max-width: 750px;
            margin-inline: auto;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(4px);
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .post-form textarea {
        resize: vertical;
        min-height: 100px;
        padding: 15px;
        border: none;
        font-size: 14px;
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
        }

        .post-form textarea::placeholder {
        color: #d9d9d9;
        }

        #image-upload {
        color: white;
        border: none;
        }

        .submit-button {
        margin-top: 15px;
        padding: 10px;
        background-color: rgb(17, 99, 28);
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
        }

        .submit-button:hover {
        background-color: rgb(29, 116, 40);
        }

        .errorp {
            margin-top: 30px;
            font-size: 24px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <img src="resources/yap.png" alt="">
        <nav>
            <a href="hashtag.php">Hashtags</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    
        <form class="post-form" action="post.php" method="post" enctype="multipart/form-data">
            <textarea name="content" placeholder="Write something..." required></textarea>
            <input class="button" type="file" name="image" id="image-upload" required>
            <input type="submit" name="submit" value="Post" class="submit-button">
        </form>


        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $username = htmlspecialchars($row['username']);
                    $profileImage = htmlspecialchars($row['profile_image']); 
                    $contentImage = htmlspecialchars($row['image_url']); 
                    $content = nl2br(htmlspecialchars($row['content']));
                    $likes = (int)$row['likes_count'];
                    $comments = (int)$row['comments_count'];
                    $shares = (int)$row['shares_count'];
                    $createdAt = date("F j, Y g:i A", strtotime($row['created_at'])); 

                    echo '
                        <div class="post">
                            <div class="postheader">
                                <img src="' . $profileImage . '" alt="">
                                <div class="userinfo">
                                    <p class="username">' . $username . '</p>
                                    <p class="timestamp">' . $createdAt . '</p>
                                </div>
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <img src="' . $contentImage . '" alt="">
                            <div class="postaction">
                                <div class="likes action">
                                    <i class="fa-regular fa-heart"></i>
                                    <p>' . $likes . ' Likes</p>
                                </div>
                                <div class="comments action">
                                    <i class="fa-regular fa-comment"></i>
                                    <p>' . $comments . ' Comments</p>
                                </div>
                                <div class="shares action">
                                    <i class="fa-regular fa-paper-plane"></i>
                                    <p>' . $shares . ' Shares</p>
                                </div>
                            </div>
                            <div class="content">
                                <h3>' . $username . '</h3>
                                <p>' . $content . '</p>
                            </div>
                        </div>
                    ';
                }
            } else {
                echo '<p class="errorp">No posts found.</p>';
            }
        ?>
</body>
</html>