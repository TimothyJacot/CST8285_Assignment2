//validation function for JavaScript (login.html )

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("signupForm");
    const errorMsg = document.getElementById("errorMsg");
  
    form.addEventListener("submit", function (e) {
      e.preventDefault(); 
  
      errorMsg.textContent = "";
      errorMsg.style.color = "#e74c3c"; 
        //creating variables
      const username = document.getElementById("username").value.trim();
      const password = document.getElementById("password").value.trim();
      const email = document.getElementById("email").value.trim();
      const phone = document.getElementById("phone").value.trim();
        //setting parameters for username
      if (username.length < 8) {
        errorMsg.textContent = "Username must be at least 8 characters.";
        return;
      }
      //setting password parameters, 8 characters, 1 number, 1 special character
      const passwordPattern = /^(?=.*[0-9])(?=.*[!?\%]).{8,}$/;
      if (!passwordPattern.test(password)) {
        errorMsg.textContent = "Password does not follow required format. (8 characters, 1 number, 1 special character (!,?,$)";
        return;
      }
      //setting email format
      const emailPattern = /^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$/;
      if (!emailPattern.test(email)) {
        errorMsg.textContent = "Email does not follow xyz@xyz.xyz format.";
        return;
      }
      //setting phone number format
      const phonePattern = /^\d{3}-\d{3}-\d{4}$/;
      if (!phonePattern.test(phone)) {
        errorMsg.textContent = "Phone number does not follow xxx-xxx-xxxx format.";
        return;
      }
  
      form.submit();
    });
  });
  
