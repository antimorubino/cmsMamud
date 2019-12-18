<?php
include('../vendor/autoload.php');
include('header.php');
?>
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Video</h1>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Video</li>
    </ol>
  </nav>

  <!-- DataTales Example -->
  <div class="card shadow mb-4 mt-3">
    <div class="card-body">
      <div class="mb-4 text-right">
          <a href="ins-video.php" class="btn btn-success">INSERISCI</a>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
                <th>Immagine</th>
                <th width="40%">Titolo</th>
                <th>Modifica IT</th>
                <th>Modifica EN</th>
                <th>Elimina</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th>Immagine</th>
                <th width="40%">Titolo</th>
                <th>Modifica IT</th>
                <th>Modifica EN</th>
                <th>Elimina</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            $perPagina = 20;
            $pagination = new PaginationController;

            $video = new VideoController;
            $rgVideo = $video->elenVideo(0, $perPagina);
            while($row = $rgVideo->fetch(PDO::FETCH_BOTH)):
            if (empty($row['LinkImg'])) {
            $immagine = 'nofoto.jpg';
            }
            # ...altrimenti do conferma!
            else {
                //fclose($fp);
                $immagine = $row['LinkImg'];
            }
            ?>
            <tr>
              <td><img src="../storage/video/crop/<?php echo $immagine; ?>" /></td>
              <td><?= $row['TitoloIT']; ?></td>
              <td><a href="mod-video.php?idVideo=<?php echo $row['idVideo']; ?>&lang=it" class="btn btn-light">MODIFICA IT</a></td>
              <td><a href="mod-video.php?idVideo=<?php echo $row['idVideo']; ?>&lang=en" class="btn btn-light">MODIFICA EN</a></td>
              <td><a href="del-video.php?idVideo=<?php echo $row['idVideo']; ?>" class="btn btn-light" onclick="return confirm('Sei sicuro di eliminare il record?')">ELIMINA</a></td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
        <div class="">
            <?php
            $righe = $video->numRecord();
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
