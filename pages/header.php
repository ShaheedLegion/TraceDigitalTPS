<?php
	include_once 'pages/iecompat.php';
?>

<!DOCTYPE html>
<html>
  <head>
	<link rel="author" href="https://plus.google.com/106492256302815506122"/>
    <meta name="description" content="Trace Digital Services offers TypeSetting and EBook creation and Conversion services. We specialise in TypeSetting and creating Ebooks from print PDFs. We have recently started creating interactive books and have quickly become the leading supplier of interactive EPUB3 books in South Africa.">
    <meta name="robots" content="noarchive">
    <meta name="keywords" content="CONVERSION,cmyk,MOBI,footnotes,TOC,styles,COVERS,paragraph,BOOKS,title,indesign,headings,notes,footers,formatting,preflight,FONTS,subtitles,bibliographies,pdf,open files, end notes,bullets,spacing,pagenation,design,self publishing,submissions,front matter,reports,margins,links,deadlines,folios,references,tables,bleed,animation,layout,spine,rgb,rtf,corrections,EBOOKS,epubs,Academic Books,Law Books,Trade Books">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Trace Digital | <?php print($page_name); ?></title>
    <script type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script src="js/menus.js" type="text/javascript"></script>
	<script src="js/slides.js" type="text/javascript"></script>
	<script src="js/tps.js" type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="traceweb.css" /><!--Body content styles-->
	<link rel="stylesheet" type="text/css" href="tracenavcompat.css"><!--EI compatible navigation-->
    <link rel="stylesheet" type="text/css" href="traceslide.css" /><!--Slideshow styles-->
    <link rel="stylesheet" type="text/css" href="traceportrait.css" /><!--Team portrait styles-->
	<link rel="stylesheet" type="text/css" href="tps.css" /><!-- stylesheet for TPS system -->
  </head>
  <body>
  
<div class="header">

<div class="navdiv">
	<div class="iecompat">
		<img src="icondata/banner.png" alt="_"/>
	</div>
	<!--[if lt IE 8]>
	<style type="text/css">
		div.iecompat{display: none;}
		div.iecompat img{display: none;}
	</style>

	<div style="float: left; width:213px; height:100px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(
		 src='icondata/banner.png', sizingMethod='scale');"></div>
	<![endif]-->

<!-- - - - - Using jQuery for CSS Menus on older browsers - - - - -->
    <ul id="nav" class="drop">
        <li class="listimg"><a href="index.php">
		<?php print(getcompat('40px', '40px', 'icondata/home.png', 'home', '')); ?>
	 </a></li>
        <li><a href="#" class="dropdown">Services +</a></li>
        <li class="sublinks">
            <span><a href="services.php#typesetting">Typesetting</a></span>
            <span><a href="services.php#drawings">Drawings</a></span>
            <span><a href="services.php#epubs">EPUB creation</a></span>
            <span><a href="services.php#mobis">MOBI creation</a></span>
            <span><a href="services.php#epdf">PDF/ePDF creation</a></span>
            <span><a href="services.php#web">Web design</a></span>
        </li>
	</ul>
	<ul id="nav2" class="drop">
        <li><a href="#" class="dropdown">About +</a></li>
        <li class="sublinks">
            <span><a href="about.php#company">About the company</a></span>
            <span><a href="team.php">About the team</a></span>
            <span><a href="about.php#books">About Digital books</a></span>
            <span><a href="about.php#websites">About Websites</a></span>
        </li>
        <li><span><a href="portfolio.php">Portfolio</a></span></li>
        <li><span><a href="contactus.php">Contact</a></span></li>

<?php
    if (isset($_SESSION['LoggedIn']) && isset($_SESSION['UserName']) && $_SESSION['LoggedIn'] == 1):
?>
                <li><span><a href="tps_logout.php" >Log out TPS</a></span></li>
<?php else: ?>
                <li><span><a href="tps_login.php">TPS Login</a></span></li>
<?php endif; ?>

    </ul>

</div>
   </div>
   <hr />
