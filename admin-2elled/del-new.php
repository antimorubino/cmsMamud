<?php
include('../vendor/autoload.php');
include('header.php');

$lang = $_GET['lang'];

$news = new NewsController;
//$row[] = $fornitori->elenFrn();

$rgNews = $news->elenNews($_GET['idNew']);
$row = $rgNews->fetch(PDO::FETCH_BOTH);

?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Modifica New</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="news.php">News</a></li>
        <li class="breadcrumb-item active">Modifica New</li>
      </ol>
    </nav>
    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-3">
        <div class="card-body">
            <?php
            $news->delNew($_GET['idNew']); 
            ?>
        </div>
    </div>

</div>
<?php include('footer.php'); ?>
