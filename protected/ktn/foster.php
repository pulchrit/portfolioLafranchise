<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Foster | Ketchikan Humane Society</title>
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" media="print" href="styles/print.css">
  <meta name="author" content="Melissa Lafranchise">
  <meta name="description" content="Apply to foster animals for the Ketchikan Humane Society.">
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  
  <script> /* Email validation script adapted from SmartWebby.com (http://www.smartwebby.com/dhtml/) */
        function ValidateForm()
        {
        var emailadd = document.fosterapp.emailaddress; 
        if ((emailadd.value == null) || (emailadd.value == ""))
          {
          alert("Please enter your email address");
          document.fosterapp.emailaddress.focus();
          return false;
          }
          return true;
        }
  </script>
  
</head>

<body class="foster">

<header>
        <a href="index.php" title="Back to homepage"><img class="logo" src="images/KHS_logo8.png" alt="Ketchikan Humane Society logo showing background of Deer Mountain and silhouettes of a dog and cat."></a>
   
   
    <nav id="menu">
        <?php require_once('includes/menu.txt');?>   
    </nav>
</header>



<br class=clear>
    
   
    
<div class="content">
    <h1>Help Foster Animals</h1> 
        <p>You provide love, patience, and training. The Ketchikan Humane Society provides food and veterinary care. We always need good foster homes, especially for large dogs.</p>
                <ul>
                        <li>We expect dogs to leave the foster home well socialized with crate training, house training, and basic commands &#40;like <em>Sit</em> and <em>Here</em>&#41;.</li>
                        <li>We expect cats to leave the foster home well socialized and litter box trained.</li>
                </ul>
        <br>
        
        <h2>If you&rsquo;d like to help foster, please apply below.</h2>
        
        <form id="fosterapp" name="fosterapp" onsubmit="return ValidateForm()" method="post" action="includes/240form_handler.php">
                <fieldset class="contactinfo">
                        <legend class="legend">Contact information</legend>
                        <p class="name"> 
                                <label for="name">Full name:</label>
                                <input type="text" id="name" name="name" size="35" autofocus>
                        </p>
                        <p class="email"> <!-- Javascript will validate that something has been added to email field. -->
                                <label for="emailaddress">Email:</label>
                                <input type="text" id="emailaddress" name="emailaddress" size="35">
                                <span class="required">*Required*</span>
                        </p>
                        <p class="phone"> <!-- php will validate that a phone number has been added.-->
                                <label for="phone">Phone:</label>
                                <input type="text" id="phone" name="phone" size="35">
                                <span class="required">*Required*</span>
                        </p>
                        <p class="preferredcontact">
                                <label class="mainlabel">How should we contact you?</label>
                                <input type="radio" id="emailradiobutton" name="preferredcontact" value="email">
                                <label for="emailradiobutton">Email</label>
                                <input type="radio" id="phoneradiobutton" name="preferredcontact" value="phone">
                                <label for="phoneradiobutton">Phone</label>
                        </p>
          
                </fieldset>
                
                <fieldset>
                        <legend class="legend">Kids and pets?</legend>
                        <p class="kids">
                                <label>Are there children in the home?</label>
                                <select name="kids" id="kids">
                                       <option value="yes">yes</option>
                                       <option value="no">no</option>
                                </select>
                        </p>
                        
                        <p class="pets">
                                <label>Are there pets in the home?</label>
                                
                                <select name="pets" id="pets">
                                        <option value="yes">yes</option>
                                        <option value="no">no</option>
                                </select>
                        </p>
                </fieldset>
                
                <fieldset>
                        <legend class="legend">Foster preferences</legend>
                        <input type="checkbox" id="dogs" name="fosterpreferences[]" value="dogs">
                        <label for="dogs" class="checkboxlabel">Dogs</label> <br>
                        <input type="checkbox" id="cats" name="fosterpreferences[]" value="cats">
                        <label for="cats" class="checkboxlabel">Cats</label> <br>
                        <input type="checkbox" id="exotics" name="fosterpreferences[]" value="exotics">
                        <label for="exotics" class="checkboxlabel">Exotics</label>
                </fieldset>
                
                <fieldset>
                        <legend class="legend">Comments or Questions?</legend>
                        <textarea id="comments" name="comments" rows="5" cols="50"></textarea>
                </fieldset>
                
                <p class="submit">
                        <input type="submit" value="Submit application">
                </p>
        </form>
        
</div> <!--/content-->                
                        
 
<div class="sidebar">
 
<aside class="petofweek">
    <h3>Pet of the week&#58; Charm</h3>
    <img src="images/charm.jpg" alt="Charm, a male Lhasa Apso, is the pet of the week">
    <p>All cleaned up, Charm is an adorable Lhasa Apso. Not yet two years old, he&rsquo;s tons of fun. He is also great with kids and other dogs and currently being tested with cats and birds. His foster family LOVES him. <a href="contact.php" title="Contact us">Call us to learn more</a> or to adopt this little man. Download our <a href="pdfs/dog_adoptionapplication.pdf" title="Download the adoption application">adoption application</a> now or see other <a href="dogs.php" title="See other dogs up for adoption">dogs available for adoption</a>.</p>
</aside> <!--/petofweek-->

<aside class="reminder">
    <h3>Spay or neuter your pet!</h3>
    <p>Your pet will live a longer, healthier life. He or she will be better behaved and stay closer to home. And, spaying and neuturing helps prevent animal overpopulation.</p>
</aside> <!--/reminder-->
</div> <!--/sidebar-->



<footer>
        <?php require_once('includes/footer.txt');?>   
</footer>

</body>

</html>