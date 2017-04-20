<?php
session_start();
header('Cache-control: private');
// multilanguage
$languages = array('DE', 'EN');
// Parsedown for Markdown to HTML
include('assets/parsedown/Parsedown.php');
//
if(in_array($_GET['lang'], $languages)) {
  $_SESSION['lang'] = $_GET['lang'];
  header('Location:http://maybegeek.de/~cms/mdone/');
  exit();
}

define('LANG', in_array($_SESSION['lang'], $languages) ? $_SESSION['lang'] : 'DE');
$i18n = array();
$i18n['short'] = strtolower(LANG);

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

// get the language corresponding content
$tmplmain1 = file_get_contents("./inhalt/main-1-oben-{$i18n['short']}.md");
$tmplmain2 = file_get_contents("./inhalt/main-2-mitte-{$i18n['short']}.md");
$tmplmain3 = file_get_contents("./inhalt/main-3-unten-{$i18n['short']}.md");
$tmplfooter = file_get_contents("./inhalt/footer-{$i18n['short']}.md");

// init Parsedown
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
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body class="grid w640">

    <header class="tmpl-header row">
      <h1 class="c8"><?php echo $i18n[LANG]['title']; ?></h1>
      <p class="c4"><?php echo $i18n[LANG]['teaser']; ?></p>
    </header>

    <nav class="tmpl-nav row">
      <ul class="c12">
        <li><a href="#">Dinge</a></li>
        <li><a href="#">Sachen</a></li>
        <li><a href="#">Zeug</a></li>
      </ul>
    </nav>

    <main class="row">
      <section class="tmpl-main-one c12">
        <?php echo $Parsedown->text( $tmplmain1 ); ?>

      </section>

      <section class="tmpl-main-two c12">
        <?php echo $Parsedown->text( $tmplmain2 ); ?>

      </section>

      <section class="tmpl-main-three c12">
        <?php echo $Parsedown->text( $tmplmain3 ); ?>

      </section>
    </main>

    <footer class="tmpl-footer row">
      <div class="c12">
        <?php echo $Parsedown->text( $tmplfooter ); ?>
      </div>

    </footer>
  </body>
</html>
