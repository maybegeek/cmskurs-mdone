<?php
session_start();
header('Cache-control: private');
$scriptroot = $_SERVER['SCRIPT_URI'];
//
// multilanguage
$languages = array('DE', 'EN');
if(in_array($_GET['lang'], $languages)) {
  $_SESSION['lang'] = $_GET['lang'];
  header("Location:$scriptroot");
  exit();
}
define('LANG', in_array($_SESSION['lang'], $languages) ? $_SESSION['lang'] : 'DE');
$i18n = array();
$i18n['short'] = strtolower(LANG);
//
// technical debt: statische Sprach-String-Zuweisung
$i18n['DE']['title'] = 'mdone';
$i18n['EN']['title'] = 'mdone';
$i18n['DE']['teaser'] = 'Markdown Ein-Seiter';
$i18n['EN']['teaser'] = 'markdown one pager';
$i18n['DE']['metaDescription'] = 'mdone | Markdown plus Parsedown = Ein-Seiter';
$i18n['EN']['metaDescription'] = 'mdone | markdown, parsedown, one page layout';
$i18n['DE']['metaKeywords'] = 'Markdown, Parsedown, Multilanguage, Ein-Seiter';
$i18n['EN']['metaKeywords'] = 'markdown, parsedown, multilanguage, one page';
$i18n['DE']['metaAuthor'] = 'Vorname Nachname';
$i18n['EN']['metaAuthor'] = 'Vorname Nachname';
$i18n['DE']['navOne'] = 'Menü1';
$i18n['EN']['navOne'] = 'menu1';
$i18n['DE']['navTwo'] = 'Menü2';
$i18n['EN']['navTwo'] = 'menu2';
$i18n['DE']['navThree'] = 'Menü3';
$i18n['EN']['navThree'] = 'menu3';
$i18n['DE']['flag'] = '#flagGermany';
$i18n['EN']['flag'] = '#flagUnitedKingdom';
//
// get the language corresponding content
$tmplmain1    = file_get_contents("./inhalt/main-1-oben-{$i18n['short']}.md");
$tmplmain2    = file_get_contents("./inhalt/main-2-mitte-{$i18n['short']}.md");
$tmplmain3    = file_get_contents("./inhalt/main-3-unten-{$i18n['short']}.md");
$tmplfooter   = file_get_contents("./inhalt/footer-{$i18n['short']}.md");
$parallax1    = trim(file_get_contents("./inhalt/parallax-1.txt"));
$parallax2    = trim(file_get_contents("./inhalt/parallax-2.txt"));
$parallax3    = trim(file_get_contents("./inhalt/parallax-3.txt"));
//
// Parsedown for Markdown to HTML
include('assets/parsedown/Parsedown.php');
$Parsedown = new Parsedown();
?><!DOCTYPE html>
<html lang="<?php echo $i18n['short']; ?>">
  <head>
    <meta charset="utf-8">
    <title><?php echo $i18n[LANG]['title']; ?> | <?php echo $i18n[LANG]['teaser']; ?></title>
    <meta name="description" content="<?php echo $i18n[LANG]['metaDescription']; ?>">
    <meta name="keywords" content="<?php echo $i18n[LANG]['metaKeywords']; ?>">
    <meta name="author" content="<?php echo $i18n[LANG]['metaAuthor']; ?>">
    <meta name="publisher" content="<?php echo $i18n[LANG]['metaAuthor']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://rawcdn.githack.com/maybegeek/neogridic/master/neogridic.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Eczar">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="assets/js/jquery.sticky.js"></script>
  </head>
  <body class="grid w640">

    <!-- svg flags for language chooser -->
    <svg style="position: absolute; width: 0; height: 0; overflow: hidden" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
      <defs>
        <symbol id="flagGermany" viewBox="0 0 5 3">
          <title>Flag of Germany</title>
          <desc>Flag of Germany</desc>
          <rect id="black_stripe" width="5" height="3" y="0" x="0" fill="#000"/>
          <rect id="red_stripe" width="5" height="2" y="1" x="0" fill="#D00"/>
          <rect id="gold_stripe" width="5" height="1" y="2" x="0" fill="#FFCE00"/>
        </symbol>
      </defs>
      <defs>
        <symbol id="flagUnitedKingdom" viewBox="0 0 60 30">
          <title>Flag of the United Kingdom</title>
          <desc>Flag of the United Kingdom</desc>
          <clipPath id="t">
        	<path d="M30,15 h30 v15 z v15 h-30 z h-30 v-15 z v-15 h30 z"/>
          </clipPath>
          <path d="M0,0 v30 h60 v-30 z" fill="#00247d"/>
          <path d="M0,0 L60,30 M60,0 L0,30" stroke="#fff" stroke-width="6"/>
          <path d="M0,0 L60,30 M60,0 L0,30" clip-path="url(#t)" stroke="#cf142b" stroke-width="4"/>
          <path d="M30,0 v30 M0,15 h60" stroke="#fff" stroke-width="10"/>
          <path d="M30,0 v30 M0,15 h60" stroke="#cf142b" stroke-width="6"/>
        </symbol>
      </defs>
    </svg>

    <div class="row">


<?php
if (isset($parallax1)) {
    echo '
      <div class="c12 para1">
        <div class="parallax-window" data-parallax="scroll" data-image-src="' . $parallax1 . '" data-naturalWidth="900" data-naturalHeight="600"></div>
      </div>
';
}
?>

    </div>

    <header class="tmpl-header row">
      <h1 class="c6"><a href="<?php echo $scriptroot; ?>"><?php echo $i18n[LANG]['title']; ?></a></h1>
      <p class="c4 teaser"><?php echo $i18n[LANG]['teaser']; ?></p>
      <span class="c2 sprachen"><?php foreach($languages as $language) {
        echo '<span class="sprache sprache-'.strtolower($language).'"><a href="?lang='.$language.'" title="'.strtolower($language).'"><svg class="flag flag-'.strtolower($language).'"><use xlink:href="'.$i18n[$language]['flag'].'"></use></svg></a></span>'."\n";
      } ?></span>
    </header>

    <nav class="tmpl-nav row">
      <ul class="c12">
        <li><a href="#main-section-one"><?php echo $i18n[LANG]['navOne']; ?></a></li>
        <li><a href="#main-section-two"><?php echo $i18n[LANG]['navTwo']; ?></a></li>
        <li><a href="#main-section-three"><?php echo $i18n[LANG]['navThree']; ?></a></li>
      </ul>
    </nav>

    <main class="row">
      <section id="main-section-one" class="tmpl-main-one c12">
        <?php echo $Parsedown->text( $tmplmain1 ); ?>

      </section>

<?php
if (isset($parallax2)) {
    echo '
      <div class="c12 para2">
        <div class="parallax-window" data-parallax="scroll" data-image-src="' . $parallax2 . '" data-naturalWidth="900" data-naturalHeight="600"></div>
      </div>
';
}
?>

      <section id="main-section-two" class="tmpl-main-two c12">
        <?php echo $Parsedown->text( $tmplmain2 ); ?>

      </section>

<?php
if (isset($parallax3)) {
    echo '
      <div class="c12 para3">
        <div class="parallax-window" data-parallax="scroll" data-image-src="' . $parallax3 . '" data-naturalWidth="900" data-naturalHeight="600"></div>
      </div>
';
}
?>
      <section id="main-section-three" class="tmpl-main-three c12">
        <?php echo $Parsedown->text( $tmplmain3 ); ?>

      </section>
    </main>

    <footer class="tmpl-footer row">
      <div class="c12">
        <?php echo $Parsedown->text( $tmplfooter ); ?>

      </div>
    </footer>
  <script>
    $(document).ready(function(){
      $("nav.tmpl-nav").sticky({topSpacing:0});
    });
  </script>
  <script src="assets/js/parallax.min.js"></script>
  <script src="assets/js/smooth-scroll.js"></script>
  <script>smoothScroll.init();</script>
  </body>
</html>
