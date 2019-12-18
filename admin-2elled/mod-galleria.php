<?php
include('../vendor/autoload.php');
include('header.php');

$lang = $_GET['lang'];

$galleria = new GalleriaController;
//$row[] = $fornitori->elenFrn();

$rgGalleria = $galleria->elenGal($_GET['idGal']);
$row = $rgGalleria->fetch(PDO::FETCH_BOTH);

$rgCategorie = $galleria->elenCatGalS(0);


?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Modifica Immagine</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="galleria.php">Galleria</a></li>
        <li class="breadcrumb-item active">Modifica Immagine</li>
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
            <form class="" method="post" enctype="multipart/form-data">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <?php
                        if(empty($row['Img'])) {
                        $foto = "nofoto.jpg";
                        } else {
                        $foto = $row['Img'];
                        }
                        ?>
                        <img src="../storage/galleria/thumb/<?php echo $foto; ?>" /><br /><br />
                        <label for="immagine">Immagine</label>
                        <input type="file" name="immagine" class="form-control" value="" />
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="categoria">Titolo</label>
                        <select class="form-control" id="categoria" name="categoria">
                            <?php
                            while($rowC = $rgCategorie->fetch(PDO::FETCH_BOTH)):
                            ?>
                            <option value="<?= $rowC['idCategoria'];  ?>" <?php if($rowC['idCategoria'] == $row['idCategoria']) echo 'selected'; ?>>
                                <?= $rowC['categoriaIT'];  ?>
                            </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-light mt-4">MODIFICA</button>
            </form>
            <?php
            else:
            $fileup = $_FILES["immagine"]["name"];

            $handle = new \Verot\Upload\Upload($_FILES['immagine']);
            if ($handle->uploaded) {
                //$handle->file_new_name_body   = 'image_resized';

                if(($handle->image_src_x > 1920) || ($handle->image_src_y > 1080)) {
                    $handle->image_resize         = true;
                    $handle->image_x              = 1920;
                    $handle->image_y              = 1080;
                    $handle->image_ratio          = true;
                }

                $handle->process('../storage/galleria/img/');

                $handle->image_resize         = true;
                $handle->image_x              = 640;
                $handle->image_y              = 480;
                $handle->image_ratio          = true;
                $handle->process('../storage/galleria/thumb/');

                $handle->image_resize         = true;
                $handle->image_ratio_crop     = true;
                $handle->image_x              = 370;
                $handle->image_y              = 270;
                $handle->process('../storage/galleria/crop/');

                $nomeFile = $handle->file_dst_name;

            } else {
                $nomeFile = NULL;
            }

            var_dump($nomeFile);
            $galleria->modImg($_GET['idGal'], $nomeFile);
            endif;
            ?>
        </div>
    </div>

</div>
<?php include('footer.php'); ?>
