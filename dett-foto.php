<?php
include('header.php');

$lang = $_GET['lang'];

$pagination = new PaginationController;

$galleria = new GalleriaController;
//$row[] = $fornitori->elenFrn();

$rgGalleria = $galleria->elenGalS($_GET['idCat']);
$rgCatGalleria = $galleria->elenCatGal($_GET['idCat']);
$rowCat = $rgCatGalleria->fetch(PDO::FETCH_BOTH);

$per_page = 1;
$righe = $galleria->numRecordGal();
$tot_records = $galleria->totPagesGal($per_page);

// pagina corrente
$current_page = (!$_GET['page']) ? 1 : (int)$_GET['page'];

// primo parametro di LIMIT
$primo = ($current_page - 1) * $per_page;
$secondo = $primo+$per_page;

//$row = $rgGalleria->fetch(PDO::FETCH_BOTH);

?>

<!-- 1. Add latest jQuery and fancybox files -->

<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<!-- Page Content -->
<div class="container">
    <div class="row mb-3">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5"><?= $rowCat['categoria'.strtoupper($lang)]; ?></h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= _URL_.'/'.$lang.'/' ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= _URL_.'/'.$lang.'/'.$navLink['link_04'].'/'; ?>"><?= $navLink['link_04']; ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $rowCat['categoria'.strtoupper($lang)]; ?></li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row">
		<?php
		$inc = 0;
		while($row = $rgGalleria->fetch(PDO::FETCH_BOTH)):
		$inc++;

		if(($inc > $primo) && ($inc <= $secondo)) {

			$hideshow = '';

		} else {

			$hideshow = 'style="display:none"';

		}
		?>
        <div class="col-md-4" <?= $hideshow; ?>>
			<a href="<?php echo _URL_; ?>/storage/galleria/img/<?php echo $row['Img']; ?>" data-fancybox="galleria">
				<img src="<?php echo _URL_; ?>/storage/galleria/crop/<?php echo $row['Img']; ?>" alt="<?php echo $titolo; ?>" class="img-fluid thumb-img-gal">
			</a>
        </div>
		<?php endwhile; ?>
    </div>

    <div class="mt-4">
        <?php
        $righe = $galleria->numRecordGal();
        //echo $righe;
        //var_dump($righe);
        if($righe > 0) {
        echo $pagination->paginazione($righe, $per_page);
        }
        ?>
    </div>

</div>
<?php include('footer.php'); ?>
