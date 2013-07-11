<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
//Prints nav bar
  $nav = printNav(true);
  echo $nav;
?>
    <div class="container">
      <div class="hero-unit hidden-phone">
        <h2>What is RateMyClub ?</h2>
        <div class="row">
          <div class="span4">
            <p>Enter your paragraph text here.</p>
            <a class="btn btn-large btn-inverse"
            href="#"><span class="btn-label">Sign Up Today!</span></a> 
          </div>
          <div class="span3 offset2">
            <p>Logo goes here...</p>
          </div>
        </div>
        <p></p>
      </div>
      <a class="btn btn-large btn-primary btn-block visible-phone" href="#"><span class="btn-label">Sign Up Today!</span></a>
      <div class="row main-features">
        <div class="span4">
          <div class="well">
            <h3>Awesome Feature #1</h3>
            <p>Enter a brief description of why it's so awesome here. Then move on to
              the next feature.</p>
          </div>
        </div>
        <div class="span4">
          <div class="well">
            <h3>Awesome Feature #2</h3>
            <p>Enter a brief description of why it's so awesome here. Then move on to
              the next feature.</p>
          </div>
        </div>
        <div class="span4">
          <div class="well">
            <h3>Awesome Feature #3</h3>
            <p>Enter a brief description of why it's so awesome here. Then move on to
              the next feature.</p>
          </div>
        </div>
      </div>
    </div>
<?php include("includes/footer.php"); ?>