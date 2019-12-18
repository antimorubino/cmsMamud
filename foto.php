<?php
include('header.php');

$lang = $_GET['lang'];

$perPagina = 20;
$pagination = new PaginationController;

$galleria = new GalleriaController;
$rgCategorie = $galleria->elenCatGal(0, $perPagina);

//$righe = $rgGalleria->numRecordGal();
//$imgRand = rand(1)

?>
<!-- Page Content -->
<div class="container">
    <div class="row mb-3">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5"><?= $navLink['link_04']; ?></h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= _URL_.'/'.$lang.'/' ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $navLink['link_04']; ?></li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row">
        <?php
        while($row = $rgCategorie->fetch(PDO::FETCH_BOTH)):

        $rgImg = $galleria->elenGalS($row['idCategoria'], 1);
        $rowImg = $rgImg->fetch(PDO::FETCH_BOTH);

        if(empty($rowImg['Img'])) {
    		$foto = 'nofoto.jpg';
    	} else {
    		$foto = $rowImg['Img'];
    	}

        $linkRic = _URL_.'/'.$lang.'/'.$navLink['link_04'].'/'.Stringhe::puliscistringa($row['categoria'.strtoupper($lang)]).'/'.$row['idCategoria'].'/';

        ?>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <a href="<?= $linkRic; ?>">
                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="" src="<?= _URL_.'/storage/galleria/crop/'.$foto; ?>" data-holder-rendered="true">
                </a>
                <div class="card-body">
                    <h2><?= $row['Titolo'.strtoupper($lang)]; ?></h2>
                    <p class="card-text">
                        <?= Stringhe::cutHtmlText($row['Contenuto'.strtoupper($lang)],200, '...', false, false, false); ?>
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="<?= $linkRic; ?>" class="btn btn-info">Dettagli</a>
                        <!--button type="button" class="btn btn-sm btn-outline-secondary">Edit</button-->
                    </div>
                    <!--small class="text-muted">9 mins</small-->
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

    <div class="">
        <?php
        $righe = $galleria->numRecordCGal();
        //echo $righe;
        //var_dump($righe);
        if($righe > 0) {
        echo $pagination->paginazione($righe, $perPagina);
        }
        ?>
    </div>
</div>
<?php include('footer.php'); ?>
