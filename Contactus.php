<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="style.css" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body,
input,
textarea {
  font-family: "Poppins", sans-serif;
  color:#555;
}

.container {
  position: relative;
  width: 100%;
  min-height: 44vh;
  padding: 2rem;
  /* background-color: #fafafa; */
  overflow: hidden;
  /* display: flex; */
  align-items: center;
  justify-content: center;
  text-align: justify;
  /* margin: 52px 0 0 0; */
}

.form {
  width: 100%;
  max-width: 820px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.1);
  z-index: 1000;
  overflow: hidden;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
}

.contact-form {
  background-color:#17a2b8; /*contact us form color #381be7*/
  position: relative;
}
.contact-form .title {
  color: #fff; /* Change the title color to white */
  text-align: center;
}


.circle {
  border-radius: 50%;
  background: linear-gradient(135deg, transparent 20%, #149279);
  position: absolute;
}

.circle.one {
  width: 130px;
  height: 130px;
  top: 130px;
  right: -40px;
}

.circle.two {
  width: 80px;
  height: 80px;
  top: 10px;
  right: 30px;
}

.contact-form:before {
  content: "";
  position: absolute;
  width: 26px;
  height: 26px;
  background-color: #17a2b8;
  transform: rotate(45deg);
  top: 50px;
  left: -13px;
}

form {
  padding: 2.3rem 2.2rem;
  z-index: 10;
  overflow: hidden;
  position: relative;
}

.title {
  color: #fff;
  font-weight: 500;
  font-size: 1.5rem;
  line-height: 1;
  margin-bottom: 0.7rem;
}

.input-container {
  position: relative;
  margin: 1rem 0;
}

.input {
  width: 100%;
  outline: none;
  border: 2px solid #fafafa;
  background: none;
  padding: 0.6rem 1.2rem;
  color: #fff;
  font-weight: 500;
  font-size: 0.95rem;
  letter-spacing: 0.5px;
  border-radius: 5px;
  transition: 0.3s;
}

textarea.input {
  padding: 0.8rem 1.2rem;
  min-height: 150px;
  border-radius: 5px;
  resize: none;
  overflow-y: auto;
}

.input-container label {
  position: absolute;
  top: 50%;
  left: 15px;
  transform: translateY(-50%);
  padding: 0 0.4rem;
  color: #fafafa;
  font-size: 0.9rem;
  font-weight: 400;
  pointer-events: none;
  z-index: 1000;
  transition: 0.5s;
}

.input-container.textarea label {
  top: 1rem;
  transform: translateY(0);
}

.btnn {
  padding: 0.6rem 1.3rem;
  background-color: #fff;
  border: 2px solid #fafafa;
  font-size: 0.95rem;
  color: #17a2b8;
  line-height: 1;
  border-radius: 5px;
  outline: none;
  cursor: pointer;
  transition: 0.3s;
  margin: 0;
  width: 100%;
}

.btnn:hover {
  background-color: transparent;
  color: #fff;
}

.input-container span {
  position: absolute;
  top: 0;
  left: 25px;
  transform: translateY(-50%);
  font-size: 0.8rem;
  padding: 0 0.4rem;
  color: transparent;
  pointer-events: none;
  z-index: 500;
}

.input-container span:before,
.input-container span:after {
  content: "";
  position: absolute;
  width: 10%;
  opacity: 0;
  transition: 0.3s;
  height: 5px;
  background-color: #17a2b8; /* username,phone.etc. onclick */
  top: 50%;
  transform: translateY(-50%);
}

.input-container span:before {
  left: 50%;
}

.input-container span:after {
  right: 50%;
}

.input-container.focus label {
  top: 0;
  transform: translateY(-50%);
  left: 25px;
  font-size: 0.8rem;
}

.input-container.focus span:before,
.input-container.focus span:after {
  width: 50%;
  opacity: 1;
}

.contact-info {
  padding: 2.3rem 2.2rem;
  position: relative;
}

.contact-info .title {
  color: #323743; /*lets get in touch*/
  /* text-align: center; */
}

.text {
  color: #333;
  margin: 1.5rem 0 2rem 0;
}

.information {
  display: flex;
  color: #555;
  margin: 0.7rem 0;
  align-items: center;
  font-size: 0.95rem;
}

.information i {
  color: #323743; /*add,mail,contact icon color*/
}

.icon {
  width: 28px;
  margin-right: 0.7rem;
}

.social-media {
  padding: 1rem 0 0 0;
}

.social-media p {
  color: #333;
}

.social-icons {
  display: flex;
  margin-top: 0.5rem;
}

.social-icons a {
  width: 35px;
  height: 35px;
  border-radius: 5px;
  background: linear-gradient(45deg, #17a2b8, #17a2b8);  /*connect with us icons*/
  color: #fff;
  text-align: center;
  line-height: 35px;
  margin-right: 0.5rem;
  transition: 0.3s;
}

.social-icons a:hover {
  transform: scale(1.05);
}

.contact-info:before {
  content: "";
  position: absolute;
  width: 110px;
  height: 100px;
  border: 22px solid #1abc9c;
  border-radius: 50%;
  bottom: -77px;
  right: 50px;
  opacity: 0.3;
}

/* .big-circle {
  position: absolute;
  width: 500px;
  height: 500px;
  border-radius: 50%;
  background: linear-gradient(to bottom, #1cd4af, #159b80);
  bottom: 50%;
  right: 50%;
  transform: translate(-40%, 38%);
}

.big-circle:after {
  content: "";
  position: absolute;
  width: 360px;
  height: 360px;
  background-color: #fafafa;
  border-radius: 50%;
  top: calc(50% - 180px);
  left: calc(50% - 180px);
} */

.square {
  position: absolute;
  height: 400px;
  top: 50%;
  left: 50%;
  transform: translate(181%, 11%);
  opacity: 0.2;
}

@media (max-width: 850px) {
  .form {
    grid-template-columns: 1fr;
  }

  .contact-info:before {
    bottom: initial;
    top: -75px;
    right: 65px;
    transform: scale(0.95);
  }

  .contact-form:before {
    top: -13px;
    left: initial;
    right: 70px;
  }

  .square {
    transform: translate(140%, 43%);
    height: 350px;
  }

  .big-circle {
    bottom: 75%;
    transform: scale(0.9) translate(-40%, 30%);
    right: 50%;
  }

  .text {
    margin: 1rem 0 1.5rem 0;
  }

  .social-media {
    padding: 1.5rem 0 0 0;
  }
}

@media (max-width: 480px) {
  .container {
    padding: 1.5rem;
    margin-top:50px;

  }

  .contact-info:before {
    display: none;
  }

  .square,
  .big-circle {
    display: none;
  }

  form,
  .contact-info {
    padding: 1.7rem 1.6rem;
  }

  .text,
  .information,
  .social-media p {
    font-size: 0.8rem;
  }

  .title {
    font-size: 1.15rem;
  }

  .social-icons a {
    width: 30px;
    height: 30px;
    line-height: 30px;
  }

  .icon {
    width: 23px;
  }

  .input {
    padding: 0.45rem 1.2rem;
  }

  .btnn {
    padding: 0.45rem 1.2rem;
  }
}
@media (max-width: 320px) {
  .container {
    padding: 1rem;
    /* min-height: 1100px; */
    margin-top:71px;
  }

  .form {
    grid-template-columns: 1fr;
    padding: 0;
  }

  .contact-info {
    padding: 1rem;
  }

  .contact-form {
    padding: 1rem;
  }

  form,
  .contact-info {
    padding: 1rem;
  }

  .text,
  .information,
  .social-media p {
    font-size: 0.7rem;
  }

  .title {
    font-size: 1rem;
  }

  .social-icons a {
    width: 28px;
    height: 28px;
    line-height: 28px;
  }

  .icon {
    width: 20px;
  }

  .input {
    padding: 0.4rem 1rem;
  }

  .btnn {
    padding: 0.4rem 1rem;
    font-size: 0.85rem;
  }

  .input-container label {
    font-size: 0.8rem;
  }
}


      </style>

  </head>
 
  <body>
    <div class="container">
      <span class="big-circle"></span>
      <img src="img/shape.png" class="square" alt="" />
      <div class="form">
        <div class="contact-info">
          <h3 class="title"><b>Let's get in touch</b></h3>
          <p class="text">
          Medicine verification is crucial for ensuring the safety, efficacy, and authenticity of pharmaceutical products.It helps prevent the distribution and consumption of counterfeit or substandard drugs, protecting patients from potential harm.
          </p>

          <div class="info">
          <div class="information">
  
  <a href="https://www.google.com/maps/search/?api=1&query=Mirach+Innovations+FZ-LLC." target="_blank">
  <i class="fas fa-map-marker-alt"></i>
    Mirach Innovations FZ-LLC. 1st Floor, In5 Media Centre, Dubai
  </a>
</div>
<div class="information">
  <a href="mailto:info@mirachinnovation.com">
  <i class="fas fa-envelope"></i> &nbsp 

    info@mirachinnovation.com
  </a>
</div>
<div class="information">
  <a href="tel:+917483721529">
  <i class="fas fa-phone"></i>&nbsp

    +91 7483721529
  </a>
</div>

          </div>

          <div class="social-media">
            <p>Connect with us :</p>
            <div class="social-icons">
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </div>
        </div>

        <?php
if (isset($_POST['savebtn'])) {
   
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $sql = "INSERT INTO tbContactUs (fdName, fdEMail, fdPhone, fdDescription) VALUES ('$name', '$email', '$phone', '$message')";

    if (mysqli_query($conn, $sql)) {
        echo '<script>
            Swal.fire({
                icon: "success",
                title: "Send Successfully",
            });
        </script>';
    } else {
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Failed to send!",
            });
        </script>';
    }

   
}
?>

        <div class="contact-form">
          <span class="circle one"></span>
          <span class="circle two"></span>

          <form method="post" action="">
            <h3 class="title"><b>Contact us</b></h3>
            <div class="input-container">
                <input type="text" name="name" id="name" class="input" required />
                <label for="name">Username</label>
                <span>Username</span>
            </div>
            <div class="input-container">
                <input type="email" name="email" id="email" class="input" required />
                <label for="email">Email</label>
                <span>Email</span>
            </div>
            <div class="input-container">
                <input type="tel" name="phone" id="phone" class="input" required />
                <label for="phone">Phone</label>
                <span>Phone</span>
            </div>
            <div class="input-container textarea">
                <textarea name="message" id="message" class="input" required></textarea>
                <label for="message">Message</label>
                <span>Message</span>
            </div>
            <input type="submit" value="Send" name="savebtn" id="savebtn" class="btnn" />
        </form>
    </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="app.js"></script>
    <script>
      const inputs = document.querySelectorAll(".input");

function focusFunc() {
  let parent = this.parentNode;
  parent.classList.add("focus");
}

function blurFunc() {
  let parent = this.parentNode;
  if (this.value == "") {
    parent.classList.remove("focus");
  }
}

inputs.forEach((input) => {
  input.addEventListener("focus", focusFunc);
  input.addEventListener("blur", blurFunc);
});
</script>
  </body>
</html>
