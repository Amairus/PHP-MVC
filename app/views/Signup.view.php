<?php

  include 'includes/head.html';
  include 'includes/header.php';
?>
<div class="form">
  <h3 style="color:red; text-align:center;"><?php if(!empty($data['error'])) print_r($data['error']); ?></h3>
  <h3 style="color:green; text-align:center;"><?php if(!empty($data['message'])) print_r($data['message']); ?></h3>
  <ul class="tab-group">
    <li class="tab active"><a href="#signup">Sign Up</a></li>
    <li class="tab"><a href="#login">Log In</a></li>
  </ul>

  <div class="tab-content">
    <div id="signup">
      <h1>Sign Up for Free</h1>

      <form action="" method="POST" id="signup">

        <div class="top-row">
          <div class="field-wrap">
            <label>
              First Name<span class="req">*</span>
            </label>
            <input type="text" required autocomplete="off"  name="Name"/>
          </div>

          <div class="field-wrap">
            <label>
              Last Name<span class="req">*</span>
            </label>
            <input type="text" required autocomplete="off" name="Lastname"/>
          </div>
        </div>

        <div class="field-wrap">
          <label>
            Email Address<span class="req">*</span>
          </label>
          <input type="email" required autocomplete="off" name="Email"/>
        </div>

        <div class="field-wrap">
          <label>
            Set A Password<span class="req">*</span>
          </label>
          <input type="password" required autocomplete="off" name="Password"/>
        </div>

        <button type="submit" class="button button-block" name="Signup" value="active"/>Get Started</button>

      </form>

    </div>

    <div id="login">
      <h1>Welcome Back!</h1>

      <form action="" method="POST">

        <div class="field-wrap">
          <label>
            Email Address<span class="req">*</span>
          </label>
          <input type="email" required autocomplete="off" name="Email" />
        </div>

        <div class="field-wrap">
          <label>
            Password<span class="req">*</span>
          </label>
          <input type="password" required autocomplete="off" name="Password"/>
        </div>

        <!-- <p class="forgot"><a href="#">Forgot Password?</a></p> -->

        <button class="button button-block" name="Login" value="active">Log In</button>

      </form>

    </div>

  </div><!-- tab-content -->

</div> <!-- /form -->
<?php  include_once 'includes/footer.html'; ?>