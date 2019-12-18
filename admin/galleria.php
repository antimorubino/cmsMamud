<?php
include('../vendor/autoload.php');
include('header.php');

$perPagina = 20;
$pagination = new PaginationController;

$galleria = new GalleriaController;

$rgCategorie = $galleria->elenCatGalS();

?>
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Galleria</h1>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Galleria</li>
    </ol>
  </nav>

  <!-- DataTales Example -->
  <div class="card shadow mb-4 mt-3">
    <div class="card-body">
      <div class="row mb-4">
          <div class="col-md-6">
              <form class="form-inline" action="" method="get">
                  <select class="form-control" id="categoria" name="idCat">
                      <option value="0">SELEZIONA CATEGORIA</option>
                      <?php
                      while($rowC = $rgCategorie->fetch(PDO::FETCH_BOTH)):
                      ?>
                      <option value="<?= $rowC['idCategoria'];  ?>" <?php if($rowC['idCategoria'] == $_GET['idCat']) echo 'selected'; ?>>
                          <?= $rowC['categoriaIT'];  ?>
                      </option>
                      <?php endwhile; ?>
                  </select>
                  <input type="submit" name="" value="INVIA" class="btn btn-light ml-3">
              </form>

          </div>
          <div class="col-md-6 text-right">
              <a href="ins-galleria.php" class="btn btn-success">INSERISCI FOTO</a>
          </div>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
                <th>Immagine</th>
                <th width="50%">Categoria</th>
                <th>Modifica</th>
                <th>Elimina</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th>Immagine</th>
                <th width="50%">Categoria</th>
                <th>Modifica</th>
                <th>Elimina</th>
            </tr>
          </tfoot>
          <tbody>
            <?php

            $rgGalleria = $galleria->elenGal(0, $perPagina);
            while($row = $rgGalleria->fetch(PDO::FETCH_BOTH)):
            ?>
            <tr>
                <td><img src="../storage/galleria/thumb/<?= $row['Img']; ?>" alt="" width="300"></td>
                <td><?= $row['categoriaIT']; ?></td>
                <td><a href="mod-galleria.php?idGal=<?php echo $row['idGalleria']; ?>" class="btn btn-light">MODIFICA IT</a></td>
                <td><a href="del-galleria.php?idGal=<?php echo $row['idGalleria']; ?>" class="btn btn-light" onclick="return confirm('Sei sicuro di eliminare il record?')">ELIMINA</a></td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
        <div class="">
            <?php
            $righe = $galleria->numRecordGal();
            //echo $righe;
            //var_dump($righe);
            if($righe > 0) {
            echo $pagination->paginazione($righe, $perPagina, 1);
            }
            ?>
        </div>
      </div>
    </div>
  </div>

</div>
<?php include('footer.php'); ?>
