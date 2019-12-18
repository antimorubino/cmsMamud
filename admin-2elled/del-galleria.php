<?php
include('../vendor/autoload.php');
include('header.php');

$lang = $_GET['lang'];

$galleria = new GalleriaController;
//$row[] = $fornitori->elenFrn();

?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Modifica New</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="categorie.php">Categorie</a></li>
        <li class="breadcrumb-item active">Modifica Categoria</li>
      </ol>
    </nav>
    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-3">
        <div class="card-body">
            <?php
            $galleria->delGal($_GET['idGal']);
            ?>
        </div>
    </div>

</div>
<?php include('footer.php'); ?>
