<?php
include('../vendor/autoload.php');
include('header.php');

$lang = $_GET['lang'];

$categorie = new GalleriaController;
//$row[] = $fornitori->elenFrn();

$rgCategorie = $categorie->elenCatGal($_GET['idCat']);
$row = $rgCategorie->fetch(PDO::FETCH_BOTH);

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
            <?php
            if(isset($_GET['mod']) && $_GET['mod'] == 1):
            ?>
            <div class="alert alert-success" role="alert">
            Modifica effettuata correttamente
            </div>
            <?php elseif(isset($_GET['mod']) && $_GET['mod'] == 0): ?>
            <div class="alert alert-danger" role="alert">
            Errore nella modifica
            </div>
            <?php endif; ?>
            <form class="" method="post">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="titolo">Titolo</label>
                        <input type="text" name="titolo" class="form-control" value="<?php echo $row['categoria'.strtoupper($lang)]; ?>" />
                    </div>
                </div>
                <button type="submit" class="btn btn-light mt-4">MODIFICA</button>
            </form>
            <?php
            else:
            $categorie->modCat($_GET['idCat'], $_GET['lang']);
            endif;
            ?>
        </div>
    </div>

</div>
<?php include('footer.php'); ?>
