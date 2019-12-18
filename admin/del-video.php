<?php
include('../vendor/autoload.php');
include('header.php');

$lang = $_GET['lang'];

$video = new VideoController;
//$row[] = $fornitori->elenFrn();

?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Modifica Video</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="video.php">Video</a></li>
        <li class="breadcrumb-item active">Modifica Video</li>
      </ol>
    </nav>
    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-3">
        <div class="card-body">
            <?php
            $video->delVideo($_GET['idVideo']);
            ?>
        </div>
    </div>

</div>
<?php include('footer.php'); ?>
