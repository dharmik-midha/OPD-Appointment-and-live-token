<div class="signup_form" id="sign_up">
  <form action="insert.php" method="post" style="border:1px solid #ccc">
    <div class="container">
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>

      <div class="row">
        <div class="col">
        <label for="email"><b>First Name</b></label>
        <input type="text" placeholder="Your First Name" name="fname" required>
        </div>

        <div class="col">
          <label for="email"><b>Last Name</b></label>
          <input type="text" placeholder="Your last Name" name="lname" required>
        </div>
      </div>

      <label for="email"><b>Email</b></label>
      <input type="email" up="Enter Email" placeholder="Your Email" name="email" required>


      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>


      <label for="psw-repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="rpsw" required>

      <div class="clearfix">
        <button type="submit" class="signupbtn" name="signup">Sign Up</button>
      </div>
    </div>
  </form>
</div>