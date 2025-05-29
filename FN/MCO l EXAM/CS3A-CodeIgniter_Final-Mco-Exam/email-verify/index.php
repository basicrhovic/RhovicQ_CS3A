<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Email Verification</title>
	<style>
		/* Style the body with a gradient background and center the content vertically and horizontally */
		body {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: linear-gradient(to right,rgb(15, 63, 12),rgb(105, 146, 121));
      background-size: cover;
      background-position: center;
      margin: 0;
      color: white;
    }

    /* Style the main container with a colored background, padding, and rounded corners */
    .container {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 300px;
      background-color: rgb(29, 65, 26);
    }

    /* Center and space the title */
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    /* Use a vertical layout for the form */
    form {
      display: flex;
      flex-direction: column;
    }

    /* Add spacing for the label */
    label {
      margin-top: 10px;
    }

    /* Style the input field */
    input {
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    /* Style the submit button with color and hover effect */
    button {
      margin-top: 15px;
      padding: 10px;
      background-color: rgb(17, 99, 28);
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: rgb(29, 116, 40);
    }
	</style>
</head>
<body>
	<!-- Form container asking user to enter email -->
	<div class="container">
		<h2>Enter Your Email</h2>
		<!-- Form that sends the email input to send_otp.php using POST method -->
		<form action="send_otp.php" method="POST">
				<label for="email">Email</label>
				<input type="email" id="email" name="email" required>
				
				<button type="submit">Submit</button>
		</form>
	</div>
</body>
</html>
