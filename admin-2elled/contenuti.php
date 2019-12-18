<?php
include('../vendor/autoload.php');
include('header.php');
?>
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Contenuti</h1>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Contenuti</li>
    </ol>
  </nav>

  <!-- DataTales Example -->
  <div class="card shadow mb-4 mt-3">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Titolo</th>
              <th>Modifica IT</th>
              <th>Modifica EN</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th>Titolo</th>
                <th>Modifica IT</th>
                <th>Modifica EN</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            $pagine = new PageController;
            $rgPage = $pagine->elenPage(0);
            while($row = $rgPage->fetch(PDO::FETCH_BOTH)):
            ?>
            <tr>
              <td><?= $row['titoloIT']; ?></td>
              <td><a href="mod-contenuto.php?idCont=<?php echo $row['idContenuto']; ?>&lang=it" class="btn btn-light">MODIFICA IT</a></td>
              <td><a href="mod-contenuto.php?idCont=<?php echo $row['idContenuto']; ?>&lang=en" class="btn btn-light">MODIFICA EN</a></td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<?php include('footer.php'); ?>
