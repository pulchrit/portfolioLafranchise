<?php session_start();
if ( isset($_SESSION['htmlOutput']) ) {
  $html_output = "<p>Here is what  you submitted:</p>".$_SESSION['htmlOutput'];
} else {
  $html_output = "";
}
$successMessage = isset($_SESSION['successMessage']) ? $_SESSION['successMessage'] : "Data submitted successfully!";
?>

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
    <h1>Thank you.</h1> 
        
        <h2><?php echo $successMessage; ?></h2>
 
        <?php echo $html_output; ?>
        
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