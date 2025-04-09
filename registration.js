function validateForm() {
  // Get values from password and confirm password fields
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirmPassword').value;

  // Reference to the element where error messages will be displayed
  const errorMsg = document.getElementById('errorMsg');

  // Clear previous error messages
  errorMsg.textContent = '';

  // Check if passwords match
  if (password !== confirmPassword) {
    errorMsg.textContent = "Passwords do not match!";
    return false; // Prevent form submission
  }

  // Check if password is at least 6 characters long
  if (password.length < 6) {
    errorMsg.textContent = "Password must be at least 6 characters.";
    return false; // Prevent form submission
  }

  // All validations passed
  return true;
}
