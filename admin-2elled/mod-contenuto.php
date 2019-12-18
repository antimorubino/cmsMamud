<?php
include('../vendor/autoload.php');
include('header.php');

$lang = $_GET['lang'];

$pagine = new PageController;
//$row[] = $fornitori->elenFrn();

$rgPage = $pagine->elenPage($_GET['idCont']);
$row = $rgPage->fetch(PDO::FETCH_BOTH);

?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Modifica Contenuto</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="contenuti.php">Contenuti</a></li>
        <li class="breadcrumb-item active">Modifica Contenuto</li>
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
                        <input type="text" name="titolo" class="form-control" value="<?php echo $row['titolo'.strtoupper($lang)]; ?>" />
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="contenuto">Contenuto</label>
                        <textarea name="contenuto" rows="15" cols="80" class="form-control editor"><?php echo nl2br($row['contenuto'.strtoupper($lang)]); ?></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-light mt-4">MODIFICA</button>
            </form>
            <?php
            else:
            $pagine->modCont($_GET['idCont'], $_GET['lang']);
            endif;
            ?>
        </div>
    </div>

</div>
<?php include('footer.php'); ?>
