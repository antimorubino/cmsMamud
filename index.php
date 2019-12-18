<?php
include('header.php');

$pagine = new PageController;
//$row[] = $fornitori->elenFrn();

$rgPage = $pagine->elenPage($_GET['idPage']);
$row = $rgPage->fetch(PDO::FETCH_BOTH);

$lang = $_GET['lang'];

?>
<!-- Page Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-12 text-center">
      <h1 class="mt-5"><?= $row['titolo'.strtoupper($lang)]; ?></h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
      </nav>
      <?= $row['contenuto'.strtoupper($lang)]; ?>
      ciao mamma
    </div>
  </div>
</div>
<?php include('footer.php'); ?>
