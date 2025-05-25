<?php
function getUserInfo($username, $password) {
    $lines = file("records.txt");
    foreach ($lines as $line) {
        $info = explode(",", trim($line));
        if ($info[5] == $username && $info[6] == $password) {
            return $info;
        }
    }
    return null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUser = $_POST['username'];
    $inputPass = $_POST['password'];

    $userInfo = getUserInfo($inputUser, $inputPass);

    if ($userInfo) {
        if (isset($_POST['pin'])) {
            if ($_POST['pin'] == $userInfo[7]) {
                echo "<h3>Access Granted</h3>";
                echo "Full Name: $userInfo[0] $userInfo[1]<br>";
                echo "Course: $userInfo[2]<br>";
                echo "Year: $userInfo[3]<br>";
                echo "Section: $userInfo[4]<br>";
            } else {
                echo "<h3>Incorrect PIN. Try Again.</h3>";
            }
        } else {
            echo "<form method='POST'>";
            echo "<input type='hidden' name='username' value='$inputUser'>";
            echo "<input type='hidden' name='password' value='$inputPass'>";
            echo "Enter PIN: <input type='text' name='pin' required><br>";
            echo "<input type='submit' value='Validate'>";
            echo "</form>";
        }
    } else {
        echo "<h3>Invalid Username or Password</h3>";
    }
} else {
?>
<form method="POST" action="">
    <h3>User Login</h3>
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Login">
</form>
<?php } ?>