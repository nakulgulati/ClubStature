<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<div class="wrapper" style="background:
    linear-gradient(27deg, #151515 5px, transparent 5px) 0 5px,
    linear-gradient(207deg, #151515 5px, transparent 5px) 10px 0px,
    linear-gradient(27deg, #222 5px, transparent 5px) 0px 10px,
    linear-gradient(207deg, #222 5px, transparent 5px) 10px 5px,
    linear-gradient(90deg, #1b1b1b 10px, transparent 10px),
    linear-gradient(#1d1d1d 25%, #1a1a1a 25%, #1a1a1a 50%, transparent 50%, transparent 75%, #242424 75%, #242424);
    background-color: #131313;
    background-size: 20px 20px;">
    <?php
    //Prints nav bar
      $nav = printNav(true);
      echo $nav;
    ?>
    <div class="banner">
        <div class="container">
            <div class="row">
                <p class="welcomeText">About&nbsp;</p>
                <p class="welcomeText welcomeText-club">Club&nbsp;</p>
                <p class="welcomeText welcomeText-stature">Stature</p>
                <p class="subText">A new way to make the most of College.</p>
            </div>
        </div>
    </div>
    
    <div class="wrapper-content-home">
        <div class="container">
           <div class="row">
            <div class="col-lg-10">
              <div class="well" style="font-size: 24px">
                <b>
                <p>
                Looking for ways to make the most of your college or high school's extracurricular opportunities?
                Well, look no further! Here at clubstature, we try to help you choose the organizations that are the right fit for you. 
                </p>
                <p>
                Here, you can read and write reviews about what other people are saying about the various clubs on your campus. 
                We want to make sure you&#39;re well-informed before committing.
                Happy hunting!
                </p>
                </b>
              </div>
            </div>
           </div>
        </div>
        <div class="banner">
        <div class="container">
            <div class="row">
                <p class="welcomeText">Privacy Policy&nbsp;</p>
                <p class="subText">We are not evil.*</p>
            </div>
            
        </div>
        </div>
        <div class="container">
          <div class="row">
        <div class="well" style="font-size: 24px">
          <b>
          The only data we collect from you is your username and email address.  <br> <br>
          You may choose to submit your real name and institution you attend.  <br> <br>
          Although this is by no means required, it will improve the authenticity of your review.  <br>
          </b>
        </div>
        </div>
        </div>
        
        <em><h1 style="color: white;text-align: center">Creators</h1></em>
        <div class="container">
          <div class="row">
            <div class="col-lg-4">
              <div class="well" style="">Nakul Gulati
              <br/>
                Nakul's data
              </div>
            </div>
            <div class="col-lg-4">
              <div class="well" style="">Amit Kalay
              <br/>
                Amit's data
              </div>
            </div>
            <div class="col-lg-4">
              <div class="well" style="">Sudip Guha<br/>
                Sudip's data
              </div>
            </div>
          </div>
        </div>
        <br/><br/><br/>
        
    </div>
</div>

<?php include("includes/footer.php"); ?>