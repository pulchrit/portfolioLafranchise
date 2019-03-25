<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Mission | Ketchikan Humane Society</title>
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" media="print" href="styles/print.css">
  <meta name="author" content="Melissa Lafranchise">
  <meta name="description" content="The Ketchikan Humane Society rescues, rehabilitates and rehomes animals in need.">
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>

<body class="mission">

<header>
        <a href="index.php" title="Back to homepage"><img class="logo" src="images/KHS_logo8.png" alt="Ketchikan Humane Society logo showing background of Deer Mountain and silhouettes of a dog and cat."></a>
   
   
        <nav id="menu">
        <?php require_once('includes/menu.txt');?>   
        </nav>
</header>



<br class=clear>
    
   
    
<div class="content">
    <h1>Ketchikan Humane Society Mission</h1> 
    <p>The Ketchikan Humane Society is a 501&#45;c(3) formed in 2001 with the following primary goals&#58;</p>
        <ul>
            <li>Help abused and abandoned animals in Southern Southeast Alaska find loving homes</li>
            <li>Reduce the population of unwanted animals through low-cost spay and neutering</li>
            <li>Prevent animal cruelty through legislation in Alaska and the Ketchikan Gateway Borough</li>
        </ul>
 
    <p>Our hope is to eliminate killing as a method for controlling the number of unwanted animals and to hold those who abuse animals accountable.</p>
    <h2>Animal rehabilitation</h2>
    <p>The Ketchikan Humane Society spays and neuters all animals in our care before they are placed in foster homes. Foster homes assess the animals&rsquo; temperaments and help socialize the animal in a family environment. Basic training&mdash;for example, commands for <em>Sit</em>, <em>Don&rsquo;t</em>, <em>Here</em>&mdash;is also provided.</p>
 
    <h2>Good boy, Blue!</h2>
    <p>Watch Blue, a recently adopted lab, as he&rsquo;s put through his paces by his new owner.</p>

    <figure id="bluevideo">
        <video width="480" height="320" controls title="A video of recently adopted dog, Blue, responding to commands from his new owner.">
 
        <source src="videos/blue.mp4" type="video/mp4; codecs=avc1.42E01E, mp4a.40">
             
        <source src="videos/blue.ogv"  type="video/ogg; codecs=theora,vorbis">
         
        <!--Flash fallback for older browsers-->
        <object id="flowplayer" width="480" height="320" data="videos/flowplayer-3.2.16.swf" type="application/x-shockwave-flash">
             
                <param name="movie" value="videos/flowplayer-3.2.16.swf">
 
                <param name="flashvars" value="config={'clip':{'url':'videos/blue.mp4','autoPlay':false}}">
        </object>
        </video>
        <figcaption>This video shows Blue responding to his owner's commands. He sits, gives his owner a high-five with each front paw, and then speaks.</figcaption>
    </figure>

</div> <!--/content-->
 
 
 
<div class="sidebar">
<aside class="relatedcontent">
    <h3>Working together</h3>
    <p>The Ketchikan Humane Society &#40;KHS&#41; is not affiliated with the <a href=http://www.borough.ketchikan.ak.us/animal/animal.htm title="Link to the Ketchikan Gateway Borough Animal Protection department page">Ketchikan Gateway Borough&rsquo;s Animal Protection department</a>. However, we do adopt animals from the Borough&rsquo;s shelter and, if necessary, we also give animals to the shelter.</p>
</aside> <!--/relatedcontent-->
 
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