// DARK ROOM LOGIN/SIGN-UP LOGIC

// Store users in memory
const users = [];

// Reference elements
const signup = document.getElementById('signup');
const login = document.getElementById('login');
const success = document.getElementById('success');

// Create a new user from the sign-up form
function createUser() {
  const username = document.getElementById('username-su').value.trim();
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password-su').value;
  const confirmPassword = document.getElementById('confirm-password').value;

  // Basic validation
  if (!username || !email || !password || !confirmPassword) {
    alert('Please fill in all fields.');
    return;
  }

  if (password !== confirmPassword) {
    alert('Passwords do not match.');
    return;
  }

  // Check for duplicate usernames
  const existingUser = users.find(user => user.username === username);
  if (existingUser) {
    alert('Username already exists.');
    return;
  }

  const newUser = { username, email, password };
  users.push(newUser);
  console.log('User created:', newUser);

  // Switch to login view
  signup.classList.add('hidden');
  login.classList.remove('hidden');
}

// Authenticate login
function authUser() {
  const username = document.getElementById('username').value.trim();
  const password = document.getElementById('password').value;

  if (!username || !password) {
    alert('Please fill in all fields.');
    return;
  }

  const foundUser = users.find(user => user.username === username && user.password === password);
  if (foundUser) {
    login.classList.add('hidden');
    success.classList.remove('hidden');
    console.log('Login successful for:', username);
  } else {
    alert('Invalid username or password.');
  }
}

// Toggle between signup and login views
function changePage() {
  signup.classList.toggle('hidden');
  login.classList.toggle('hidden');
}

// Go back from success screen to login
function back() {
  success.classList.add('hidden');
  login.classList.remove('hidden');
}
