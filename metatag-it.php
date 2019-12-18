<?php

$scriptC = basename($_SERVER['PHP_SELF']);
//echo $scriptC;

if($scriptC == 'index.php') {

$titleM = 'Home | CMS 2LD';
$contenutoM = '';

?>
<title><?php echo $titleM; ?></title>
<meta name="description" content="" />

<meta property="og:url" content="<?php echo _URL_; ?>/" />
<meta property="og:title" content="<?php echo $titleM; ?>" />
<meta property="og:description" content="<?php echo $contenutoM; ?>" />
<!--meta property="og:image" content="http://www.whiteostuni.it/beachclub/images/slider/1.jpg" /-->

<?php
}
?>

<?php
if($scriptC == 'page.php') {

$pagineM = new PageController;
$rgPageM = $pagineM->elenPage($_GET['idPage']);
while($rowM = $rgPageM->fetch(PDO::FETCH_BOTH)):

$titleM = $rowM['titolo'.strtoupper($lang)].' | CMS 2LD';
$contenutoM = '';

?>
<title><?php echo $titleM; ?></title>
<meta name="description" content="" />

<meta property="og:url" content="<?php echo _URL_; ?>/" />
<meta property="og:title" content="<?php echo $titleM; ?>" />
<meta property="og:description" content="<?php echo $contenutoM; ?>" />
<!--meta property="og:image" content="http://www.whiteostuni.it/beachclub/images/slider/1.jpg" /-->

<?php
endwhile;
}
?>

<?php
if($scriptC == 'foto.php') {

$titleM = 'Foto | CMS 2LD';
$contenutoM = '';
?>
<title><?php echo $titleM; ?></title>
<meta name="description" content="" />

<meta property="og:url" content="<?php echo _URL_; ?>/Foto/" />
<meta property="og:title" content="<?php echo $titleM; ?>" />
<meta property="og:description" content="<?php echo $contenutoM; ?>" />
<!--meta property="og:image" content="http://www.whiteostuni.it/beachclub/images/slider/1.jpg" /-->

<?php } ?>
<?php
if($scriptC == 'dett-foto.php') {

$categorieM = new GalleriaController;
//$row[] = $fornitori->elenFrn();

$rgCategorieM = $categorieM->elenCatGal($_GET['idCat']);
$rowM = $rgCategorieM->fetch(PDO::FETCH_BOTH);

?>
<title><?= $rowM['categoria'.strtoupper($lang)]; ?> | Foto | CMS 2LD</title>
<meta name="description" content="" />

<?php } ?>
<?php
if($scriptC == 'news.php') {

$titleM = 'News | CMS 2LD';
$contenutoM = '';
?>
<title><?php echo $titleM; ?></title>
<meta name="description" content="" />

<meta property="og:url" content="<?php echo _URL_; ?>/News/" />
<meta property="og:title" content="<?php echo $titleM; ?>" />
<meta property="og:description" content="<?php echo $contenutoM; ?>" />
<!--meta property="og:image" content="http://www.whiteostuni.it/beachclub/images/slider/1.jpg" /-->

<?php } ?>
<?php
if($scriptC == 'dett-news.php') {

$newsM = new NewsController;
//$row[] = $fornitori->elenFrn();

$rgNewsM = $newsM->elenNews($_GET['idNew']);
$rowM = $rgNewsM->fetch(PDO::FETCH_BOTH);

$titleM = $rowM['Titolo'.strtoupper($lang)].' | News | CMS 2LD';
$contenutoM = '';
?>
<title><?php echo $titleM; ?></title>
<meta name="description" content="" />

<meta property="og:url" content="<?php echo _URL_; ?>/News/" />
<meta property="og:title" content="<?php echo $titleM; ?>" />
<meta property="og:description" content="<?php echo $contenutoM; ?>" />
<!--meta property="og:image" content="http://www.whiteostuni.it/beachclub/images/slider/1.jpg" /-->

<?php } ?>
<?php
if($scriptC == 'video.php') {

$titleM = 'Video | CMS 2LD';
$contenutoM = '';
?>
<title><?php echo $titleM; ?></title>
<meta name="description" content="" />

<meta property="og:url" content="<?php echo _URL_; ?>/Video/" />
<meta property="og:title" content="<?php echo $titleM; ?>" />
<meta property="og:description" content="<?php echo $contenutoM; ?>" />
<!--meta property="og:image" content="http://www.whiteostuni.it/beachclub/images/slider/1.jpg" /-->

<?php } ?>
<?php
if($scriptC == 'contatti.php') {

$titleM = 'Contatti | CMS 2LD';
$contenutoM = '';
?>
<title><?php echo $titleM; ?></title>
<meta name="description" content="" />

<meta property="og:url" content="<?php echo _URL_; ?>/Dicono-di-noi/" />
<meta property="og:title" content="<?php echo $titleM; ?>" />
<meta property="og:description" content="<?php echo $contenutoM; ?>" />
<!--meta property="og:image" content="http://www.whiteostuni.it/beachclub/images/slider/1.jpg" /-->

<?php } ?>
