<?php
session_start();
include_once('connection.php');
$con = connection();

if (!isset($_SESSION['user_id'])) {
    echo '<script>alert("Please log in to post."); window.location = "index.php";</script>';
    exit();
}

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $content = trim($_POST['content']);
    $image_url = null;
}
    // Handle image upload<?php
session_start();
include_once('connection.php');
$con = connection();

if (!isset($_SESSION['user_id'])) {
    echo '<script>alert("Please log in to post."); window.location = "index.php";</script>';
    exit();
}

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $content = trim($_POST['content']);
    $image_url = null;

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $upload_dir = "uploads/posts/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $original_name = basename($_FILES['image']['name']);
        $unique_name = time() . "_" . preg_replace("/[^a-zA-Z0-9\._-]/", "", $original_name);
        $target_file = $upload_dir . $unique_name;

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_url = $target_file; // Store relative path like "uploads/posts/uniquename.jpg"
            } else {
                echo '<script>alert("Failed to upload image.");</script>';
                exit();
            }
        } else {
            echo '<script>alert("Invalid image file type.");</script>';
            exit();
        }
    }

    // Generate randomized counts for likes, comments, shares
    $likes_count = rand(0, 500);      // random number between 0 and 500
    $comments_count = rand(0, 100);   // random number between 0 and 100
    $shares_count = rand(0, 50);      // random number between 0 and 50

    // Insert post with randomized counts
    $stmt = $con->prepare("
        INSERT INTO posts (user_id, content, image_url, likes_count, comments_count, shares_count)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("issiii", $user_id, $content, $image_url, $likes_count, $comments_count, $shares_count);

    if ($stmt->execute()) {
        header("Location: newsfeed.php");
        exit();
    } else {
        echo '<script>alert("Failed to post.");</script>';
    }

    $stmt->close();
}
?>

    if (!empty($_FILES['image']['name'])) {
        $upload_dir = "uploads/posts/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $original_name = basename($_FILES['image']['name']);
        $unique_name = time() . "_" . preg_replace("/[^a-zA-Z0-9\._-]/", "", $original_name);
        $target_file = $upload_dir . $unique_name;

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_url = $target_file; // Store relative path like "uploads/posts/uniquename.jpg"
            } else {
                echo '<script>alert("Failed to upload image.");</script>';
                exit();
            }
        } else {
            echo '<script>alert("Invalid image file type.");</script>';
            exit();
        }
    }

    // Insert post with counts defaulting to 0
    $stmt = $con->prepare("
        INSERT INTO posts (user_id, content, image_url, likes_count, comments_count, shares_count)
        VALUES (?, ?, ?, 0, 0, 0)
    ");
    $stmt->bind_param("iss", $user_id, $content, $image_url);

    if ($stmt->execute()) {
        header("Location: newsfeed.php");
        exit();
    } else {
        echo '<script>alert("Failed to post.");</script>';
    }

    $stmt->close();
}
?>
