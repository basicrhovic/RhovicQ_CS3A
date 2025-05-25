<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = array(
        "firstName" => $_POST['firstName'],
        "lastName" => $_POST['lastName'],
        "course" => $_POST['course'],
        "year" => $_POST['year'],
        "section" => $_POST['section'],
        "username" => $_POST['username'],
        "password" => $_POST['password'],
        "pin" => $_POST['pin']
    );

    if (strlen($data['pin']) <= 8) {
        $record = implode(",", $data) . "\n";
        file_put_contents("records.txt", $record, FILE_APPEND);
        echo "<h3>Welcome, " . $data['firstName'] . "! Registration Successful.</h3>";
        echo "<a href='signin.php'>Proceed to Login</a>";
    } else {
        echo "<h3>Pin code must be 8 characters or less.</h3>";
    }
} else {
?>
<form method="POST" action="">
    <h3>Register New Account</h3>
    First Name: <input type="text" name="firstName" required><br>
    Last Name: <input type="text" name="lastName" required><br>
    Course: <input type="text" name="course" required><br>
    Year: <input type="text" name="year" required><br>
    Section: <input type="text" name="section" required><br>
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Pin Code (max 8): <input type="text" name="pin" required><br>
    <input type="submit" value="Submit">
</form>
<?php } ?>