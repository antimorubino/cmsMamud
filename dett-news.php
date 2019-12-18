<?php
include('header.php');

$lang = $_GET['lang'];

$news = new NewsController;
//$row[] = $fornitori->elenFrn();

$rgNews = $news->elenNews($_GET['idNew']);
$row = $rgNews->fetch(PDO::FETCH_BOTH);

if(empty($row['Immagine'])) {
	$fotoNews = 'nofoto.jpg';
} else {
	$fotoNews = $row['Immagine'];
}

?>
<!-- Page Content -->
<div class="container">
    <div class="row mb-3">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5"><?= $navLink['link_03']; ?></h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= _URL_.'/'.$lang.'/' ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= _URL_.'/'.$lang.'/'.$navLink['link_03'].'/'; ?>"><?= $navLink['link_03']; ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $row['Titolo'.strtoupper($lang)]; ?></li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <img src="<?= _URL_.'/storage/news/crop/'.$fotoNews; ?>" alt="" class="img-fluid">
        </div>
        <div class="col-md-8">
            <h2><?= $row['Titolo'.strtoupper($lang)]; ?></h2>
            <?= $row['Contenuto'.strtoupper($lang)]; ?>
        </div>
    </div>

</div>
<?php include('footer.php'); ?>
