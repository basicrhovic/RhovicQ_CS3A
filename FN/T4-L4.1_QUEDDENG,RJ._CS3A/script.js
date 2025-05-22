function authenticateUser() {
  const role = document.getElementById("role").value;
  const password = document.getElementById("password").value;

  let correctPassword = "";

  // Assign password based on role
  switch (role) {
    case "Department Head":
      correctPassword = "SiEsD3ptH34d";
      break;
    case "Faculty":
      correctPassword = "SiEsF4cu1ty";
      break;
    case "Student Officer":
      correctPassword = "#CCSOAko";
      break;
    case "Student":
      correctPassword = "3SapatNa!";
      break;
    default:
      console.error("❌ Invalid role selected.");
      alert("Please select a valid role.");
      return;
  }

  // Check password validity
  if (password.trim() === "") {
    console.warn("⚠️ Password field is empty.");
    alert("Please enter your password.");
  } else if (password === correctPassword) {
    console.log(`✅ Welcome, ${role}! Authentication successful.`);

    // Extra role-based console message
    switch (role) {
      case "Department Head":
        console.log("🧑‍💼 Access: Department Management");
        break;
      case "Faculty":
        console.log("📚 Access: Faculty Dashboard");
        break;
      case "Student Officer":
        console.log("🎓 Access: Student Leadership Tools");
        break;
      case "Student":
        console.log("📘 Access: Course Resources");
        break;
    }

    alert(`Welcome, ${role}!`);
  } else {
    console.error(`❌ Incorrect password for ${role}.`);
    alert("Incorrect password. Try again.");
  }
}
