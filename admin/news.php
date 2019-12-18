<?php
include('../vendor/autoload.php');
include('header.php');
?>
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">News</h1>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">News</li>
    </ol>
  </nav>

  <!-- DataTales Example -->
  <div class="card shadow mb-4 mt-3">
    <div class="card-body">
      <div class="mb-4 text-right">
          <a href="ins-new.php" class="btn btn-success">INSERISCI</a>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Titolo</th>
              <th>Data</th>
              <th>Modifica IT</th>
              <th>Modifica EN</th>
              <th>Elimina</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th>Titolo</th>
                <th>Data</th>
                <th>Modifica IT</th>
                <th>Modifica EN</th>
                <th>Elimina</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            $perPagina = 20;
            $pagination = new PaginationController;

            $news = new NewsController;
            $rgNews = $news->elenNews(0, $perPagina, 1);
            while($row = $rgNews->fetch(PDO::FETCH_BOTH)):
            ?>
            <tr>
              <td><?= $row['TitoloIT']; ?></td>
              <td><?= Stringhe::convertData($row['Data']); ?></td>
              <td><a href="mod-new.php?idNew=<?php echo $row['idNews']; ?>&lang=it" class="btn btn-light">MODIFICA IT</a></td>
              <td><a href="mod-new.php?idNew=<?php echo $row['idNews']; ?>&lang=en" class="btn btn-light">MODIFICA EN</a></td>
              <td><a href="del-new.php?idNew=<?php echo $row['idNews']; ?>" class="btn btn-light" onclick="return confirm('Sei sicuro di eliminare il record?')">ELIMINA</a></td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
        <div class="">
            <?php
            $righe = $news->numRecord();
            //echo $righe;
            //var_dump($righe);
            if($righe > 0) {
            echo $pagination->paginazione($righe, $perPagina);
            }
            ?>
        </div>
      </div>
    </div>
  </div>

</div>
<?php include('footer.php'); ?>
