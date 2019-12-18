<?php
include('../vendor/autoload.php');
include('header.php');

$lang = $_GET['lang'];

$categorie = new GalleriaController;
//$row[] = $fornitori->elenFrn();

?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Modifica Categoria</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="catgalleria.php">Categorie</a></li>
        <li class="breadcrumb-item active">Modifica Categoria</li>
      </ol>
    </nav>
    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-3">
        <div class="card-body">
            <?php if($_SERVER['REQUEST_METHOD'] == 'GET'): ?>
            <form class="" method="post">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="titolo">Titolo</label>
                        <input type="text" name="titolo" class="form-control" value="" />
                    </div>
                </div>
                <button type="submit" class="btn btn-light mt-4">INSERISCI</button>
            </form>
            <?php
            else:
            $categorie->insCat();
            endif;
            ?>
        </div>
    </div>

</div>
<?php include('footer.php'); ?>
