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
$i18n['DE']['title'] = 'mdone | markdown one page';
$i18n['EN']['title'] = 'mdone | markdown one page';
$i18n['DE']['metaDescription'] = 'mdone | markdown für one-pager';
$i18n['EN']['metaDescription'] = 'mdone | markdown one page';
$i18n['DE']['metaKeywords'] = 'markdown, parsedown, multilanguage, static site';
$i18n['EN']['metaKeywords'] = 'markdown, parsedown, multilanguage, static site';
$i18n['DE']['metaAuthor'] = 'Vorname Nachname';
$i18n['EN']['metaAuthor'] = 'Vorname Nachname';

// get the language corresponding content
$tmplfooter = file_get_contents("./inhalt/footer-{$i18n['short']}.md");

// init Parsedown
$Parsedown = new Parsedown();
?><!DOCTYPE html>
<html lang="<?php echo $i18n['short']; ?>">
  <head>
    <meta charset="utf-8">
    <title><?php echo $i18n[LANG]['title']; ?></title>
    <meta name="description" content="<?php echo $i18n[LANG]['metaDescription']; ?>">
    <meta name="keywords" content="<?php echo $i18n[LANG]['metaKeywords']; ?>">
    <meta name="author" content="<?php echo $i18n[LANG]['metaAuthor']; ?>">
    <meta name="publisher" content="<?php echo $i18n[LANG]['metaAuthor']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://rawcdn.githack.com/maybegeek/neogridic/master/neogridic.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body class="grid w960">

    <header class="tmpl-header row">
      <h1 class="c8">mdone</h1>
      <p class="c4">markdown to one page</p>
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

      </section>

      <section class="tmpl-main-two c12">

      </section>

      <section class="tmpl-main-three c12">

      </section>
    </main>

    <footer class="tmpl-footer row">
      <div>
        <?php echo $Parsedown->text( $tmplfooter ); ?>
      </div>

    </footer>
  </body>
</html>
