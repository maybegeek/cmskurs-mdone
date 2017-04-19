<?php
include('assets/parsedown/Parsedown.php');
//
$tmplfooter = file_get_contents('./inhalt/footer-de.md');
$Parsedown = new Parsedown();
?><!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <title>mdone | markdown one page</title>
    <meta name="author" content="Vorname Nachname">
    <meta name="keywords" content="Begriff1, Begriff2, Begriff3">
    <meta name="description" content="Beschreibung des Themas der Seite">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://rawcdn.githack.com/maybegeek/neogridic/master/neogridic.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <header class="tmpl-header">
      <h1>mdone</h1>
      <p>markdown to one page</p>
    </header>

    <nav class="tmpl-nav">
      <ul>
        <li><a href="#">Dinge</a></li>
        <li><a href="#">Sachen</a></li>
        <li><a href="#">Zeug</a></li>
      </ul>
    </nav>

    <main>
      <section class="tmpl-main-one">

      </section>

      <section class="tmpl-main-two">

      </section>

      <section class="tmpl-main-three">

      </section>
    </main>

    <footer class="tmpl-footer">
      <?php echo $Parsedown->text( $tmplfooter ); ?>

    </footer>
  </body>
</html>
