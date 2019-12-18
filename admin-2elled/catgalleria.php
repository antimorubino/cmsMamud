<?php
include('../vendor/autoload.php');
include('header.php');
?>
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Categorie</h1>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Categorie</li>
    </ol>
  </nav>

  <!-- DataTales Example -->
  <div class="card shadow mb-4 mt-3">
    <div class="card-body">
      <div class="mb-4 text-right">
          <a href="ins-catgalleria.php" class="btn btn-success">INSERISCI</a>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
                <th width="60%">Titolo</th>
                <th>Modifica IT</th>
                <th>Modifica EN</th>
                <th>Elimina</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th width="60%">Titolo</th>
                <th>Modifica IT</th>
                <th>Modifica EN</th>
                <th>Elimina</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            $perPagina = 20;
            $pagination = new PaginationController;

            $galleria = new GalleriaController;
            $rgGalleria = $galleria->elenCatGal(0, $perPagina);
            while($row = $rgGalleria->fetch(PDO::FETCH_BOTH)):
            ?>
            <tr>
                <td><?= $row['categoriaIT']; ?></td>
                <td><a href="mod-catgalleria.php?idCat=<?php echo $row['idCategoria']; ?>&lang=it" class="btn btn-light">MODIFICA IT</a></td>
                <td><a href="mod-catgalleria.php?idCat=<?php echo $row['idCategoria']; ?>&lang=en" class="btn btn-light">MODIFICA EN</a></td>
                <td><a href="del-catgalleria.php?idCat=<?php echo $row['idCategoria']; ?>" class="btn btn-light" onclick="return confirm('Sei sicuro di eliminare il record?')">ELIMINA</a></td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
        <div class="">
            <?php
            $righe = $galleria->numRecordCGal();
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
