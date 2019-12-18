<?php
session_start();
include('./vendor/autoload.php');
include('./costanti.php');

$langDefault = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

if($langDefault != 'it' && $langDefault != 'en') {
	$_GET['lang'] = 'it';
}


if(isset($_GET['lang'])){

    $lang = $_GET['lang'];

} else {

    $lang = $langDefault;

}

include('lang/'.$lang.'_'.strtoupper($lang).'.php');
//include('lang/link_'.$lang.'.json');

$fileJ=file_get_contents('lang/link_'.$lang.'.json', 'r');
$navLink = json_decode($fileJ, true);

//var_dump($navLink);

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <?php include('metatag-'.$lang.'.php') ?>

  <!-- Bootstrap core CSS -->
  <link href="<?= _URL_; ?>/layout/frontend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="#">CMS 2LD</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
		<a href="<?= _URL_; ?>/change.php?lang=it"><img src="<?= _URL_.'/lang/flag-it.jpg'; ?>" /></a>
		&nbsp;&nbsp;&nbsp;
		<a href="<?= _URL_; ?>/change.php?lang=en"><img src="<?= _URL_.'/lang/flag-en.jpg'; ?>" /></a>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?= _URL_.'/'.$lang.'/'; ?>">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= _URL_.'/'.$lang.'/'.$navLink['link_01'].'/'; ?>"><?= $navLink['link_01']; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= _URL_.'/'.$lang.'/'.$navLink['link_02'].'/'; ?>"><?= $navLink['link_02']; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= _URL_.'/'.$lang.'/'.$navLink['link_03'].'/'; ?>"><?= $navLink['link_03']; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= _URL_.'/'.$lang.'/'.$navLink['link_04'].'/'; ?>"><?= $navLink['link_04']; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= _URL_.'/'.$lang.'/'.$navLink['link_05'].'/'; ?>"><?= $navLink['link_05']; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= _URL_.'/'.$lang.'/'.$navLink['link_06'].'/'; ?>"><?= $navLink['link_06']; ?></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
