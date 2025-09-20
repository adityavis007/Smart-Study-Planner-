<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login &amp; signup form</title>
  <link rel="icon" href="image/logo.png" />
  <style>
    @import url("https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
html,
body {
  display: grid;
  height: 100%;
  width: 100%;
  place-items: center;
  background-image: url('img/back.png');
}
::selection {
  background: #0449f9;
  color: #fff;
}
.wrapper {
  overflow: hidden;
  max-width: 390px;
  background: #292828;
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.1);
}
.wrapper .title-text {
  display: flex;
  width: 200%;
}
.wrapper .title {
  width: 50%;
  color: #fff;
  font-size: 35px;
  font-weight: 600;
  text-align: center;
  transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
.wrapper .slide-controls {
  position: relative;
  display: flex;
  height: 50px;
  width: 100%;
  overflow: hidden;
  margin: 30px 0 10px 0;
  justify-content: space-between;
  border: 1px solid lightgrey;
  border-radius: 15px;
}
.slide-controls .slide {
  height: 100%;
  width: 100%;
  color: #fff;
  font-size: 18px;
  font-weight: 500;
  text-align: center;
  line-height: 48px;
  cursor: pointer;
  z-index: 1;
  transition: all 0.6s ease;
}
.slide-controls label.signup {
  color: #fff;
  cursor: default;
}
.slide-controls .slider-tab {
  position: absolute;
  height: 100%;
  width: 50%;
  left: 0;
  z-index: 0;
  border-radius: 15px;
  background: -webkit-linear-gradient(left, #010d5d, #06019c, #014bba, #3660ec);
  transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
input[type="radio"] {
  display: none;
}
#signup:checked ~ .slider-tab {
  left: 50%;
}
#signup:checked ~ label.signup {
  color: #fff;
  cursor: default;
  user-select: none;
}
#signup:checked ~ label.login {
  color: #000;
}
#login:checked ~ label.signup {
  color: #000;
}
#login:checked ~ label.login {
  cursor: default;
  user-select: none;
}
.wrapper .form-container {
  width: 100%;
  overflow: hidden;
}
.form-container .form-inner {
   position: relative;
  width: 200%;
}
.form-container .form-inner form {
  width: 50%;
  transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
.form-inner form .field {
  height: 50px;
  width: 100%;
  margin-top: 20px;
}
.form-inner form .field input {
  height: 100%;
  width: 100%;
  outline: none;
  padding-left: 15px;
  border-radius: 15px;
  border: 1px solid lightgrey;
  border-bottom-width: 2px;
  font-size: 17px;
  transition: all 0.3s ease;
}
.form-inner form .field input:focus {
  border-color: #0441f9;
  /* box-shadow: inset 0 0 3px #fb6aae; */
}
.form-inner form .field input::placeholder {
  color: #999;
  transition: all 0.3s ease;
}
form .field input:focus::placeholder {
  color: #0441f9;
}
.form-inner form .pass-link {
  margin-top: 5px;
}
.form-inner form .signup-link {
  text-align: center;
  margin-top: 30px;
  color: #fff;
}
.form-inner form .pass-link a,
.form-inner form .signup-link a {
  color: #0349ac;
  text-decoration: none;
}
.form-inner form .pass-link a:hover,
.form-inner form .signup-link a:hover {
  text-decoration: underline;
}
form .btn {
  height: 50px;
  width: 100%;
  border-radius: 15px;
  position: relative;
  overflow: hidden;
}
form .btn .btn-layer {
  height: 100%;
  width: 300%;
  position: absolute;
  left: -100%;
  background: -webkit-linear-gradient(
    right,
    #01215d,
    #01139c,
    #0441f9,
    #3660ec
  );
  border-radius: 15px;
  transition: all 0.4s ease;
}
form .btn:hover .btn-layer {
  left: 0;
}
form .btn input[type="submit"] {
  height: 100%;
  width: 100%;
  z-index: 1;
  position: relative;
  background: none;
  border: none;
  color: #fff;
  padding-left: 0;
  border-radius: 15px;
  font-size: 20px;
  font-weight: 500;
  cursor: pointer;
}

@media (max-width: 600px) {
  html, body {
    height: 100%;
    width: 100%;
    min-height: 100vh;
    min-width: 100vw;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background: #0b0b0b;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  body {
    min-height: 100vh;
    min-width: 100vw;
    width: 100vw;
    height: 100vh;
    overflow-x: hidden;
  }
  .wrapper {
    max-width: 100vw;
    width: 100vw;
    min-height: 100vh;
    height: 100vh;
    border-radius: 0;
    padding: 0 0;
    box-shadow: none;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
  .wrapper .title {
    font-size: 22px;
  }
  .wrapper .slide-controls {
    font-size: 15px;
    height: 42px;
    border-radius: 10px;
  }
  .slide-controls .slide {
    line-height: 40px;
    font-size: 15px;
  }
  .slide-controls .slider-tab {
    border-radius: 10px;
  }
  .form-inner form .field {
    height: 42px;
    margin-top: 12px;
  }
  .form-inner form .field input {
    font-size: 15px;
    padding-left: 10px;
    border-radius: 10px;
  }
  form .btn {
    height: 42px;
    border-radius: 10px;
  }
  form .btn .btn-layer {
    border-radius: 10px;
  }
  form .btn input[type="submit"] {
    font-size: 16px;
    border-radius: 10px;
  }
  .form-inner form .signup-link {
    margin-top: 18px;
    font-size: 13px;
  }
}

@media (max-width: 350px) {
  .wrapper {
    padding: 5px;
  }
  .wrapper .title {
    font-size: 20px;
  }
  .form-inner form .field input {
    font-size: 17px;
  }
}


  </style>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="wrapper">
  <div class="title-text">
    <div class="title login">Login Form</div>
    <div class="title signup">Signup Form</div>
  </div>
  <div class="form-container">
    <div class="slide-controls">
      <input type="radio" name="slide" id="login" checked>
      <input type="radio" name="slide" id="signup">
      <label for="login" class="slide login">Login</label>
      <label for="signup" class="slide signup">Signup</label>
      <div class="slider-tab"></div>
    </div>
    <div class="form-inner">
      <form action="#" class="login">
        <div class="field">
          <input type="text" placeholder="Email Address" required>
        </div>
        <div class="field">
          <input type="password" placeholder="Password" required>
        </div>
        <div class="pass-link"><a href="#">Forgot password?</a></div>
        <div class="field btn">
          <div class="btn-layer"></div>
          <input type="submit" value="Login">
        </div>
        <div class="signup-link">Not a member? <a href="#signup">Signup now</a></div>
      </form>
      <form action="#signup" class="signup">
        <div class="field">
          <input type="text" placeholder="Enter your name" required>
        </div>
        <div class="field">
          <input type="text" placeholder="Username" required>
        </div>
        <div class="field">
            <input type="Number" placeholder="Phone Number" required>
        </div>
        <div class="field">
          <input type="text" placeholder="Email Address" required>
        </div>
        <div class="field">
          <input type="password" placeholder="Password" required>
        </div>
        <div class="field">
          <input type="password" placeholder="Confirm password" required>
        </div>
        <div class="field btn">
          <div class="btn-layer"></div>
          <input type="submit" value="Signup">
        </div>
      </form>
    </div>
  </div>
</div>
<!-- partial -->
  <script  src="./script.js"></script>
<script>
  // Show only the selected form (login or signup)
  document.addEventListener("DOMContentLoaded", function() {
    const loginRadio = document.getElementById("login");
    const signupRadio = document.getElementById("signup");
    const loginForm = document.querySelector("form.login");
    const signupForm = document.querySelector("form.signup");
    const signupLink = document.querySelector(".signup-link a");

    function updateForms() {
      if (loginRadio.checked) {
        loginForm.style.display = "block";
        signupForm.style.display = "none";
      } else if (signupRadio.checked) {
        loginForm.style.display = "none";
        signupForm.style.display = "block";
      }
    }

    // Initial state
    updateForms();

    // Listen for radio changes
    loginRadio.addEventListener("change", updateForms);
    signupRadio.addEventListener("change", updateForms);

    // Switch to signup when clicking "Signup now"
    if(signupLink && signupRadio) {
      signupLink.addEventListener("click", function(e) {
        e.preventDefault();
        signupRadio.checked = true;
        updateForms();
      });
    }
  });
</script>
</body>
</html>