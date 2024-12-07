document.addEventListener("DOMContentLoaded", () => {
    const showRegister = document.getElementById("show-register");
    const showLogin = document.getElementById("show-login");
    const loginForm = document.getElementById("login-form");
    const registerForm = document.getElementById("register-form");
  

    showRegister.addEventListener("click", (e) => {
      e.preventDefault();
      loginForm.style.display = "none";
      registerForm.style.display = "block";
    });
  
    showLogin.addEventListener("click", (e) => {
      e.preventDefault();
      registerForm.style.display = "none";
      loginForm.style.display = "block";
    });
  
    // validimi register
    registerForm.addEventListener("submit", (e) => {
      e.preventDefault();
      const email = document.getElementById("register-email").value;
      const password = document.getElementById("register-password").value;
      const confirmPassword = document.getElementById("confirm-password").value;
  
      if (password !== confirmPassword) {
        alert("Passwords do not match!");
        return;
      }
  
      alert("Registration successful! Please login.");
      registerForm.reset();
      registerForm.style.display = "none";
      loginForm.style.display = "block";
    });
  
    // validimi
    loginForm.addEventListener("submit", (e) => {
      e.preventDefault();
      const email = document.getElementById("email").value;
      const password = document.getElementById("password").value;
  
      if (!email.includes("@")) {
        alert("Please enter a valid email address!");
        return;
      }
  
      if (password.length < 6) {
        alert("Password must be at least 6 characters long!");
        return;
      }
  
      alert("Login successful!");
      window.location.href = "home.html"; // home page
    });
  });
  