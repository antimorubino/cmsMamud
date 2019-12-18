<?php
include('header.php');

$lang = $_GET['lang'];

$perPagina = 10;

$pagination = new PaginationController;

$video = new VideoController;
$rgVideo = $video->elenVideo(0, $perPagina);

?>

<!-- 1. Add latest jQuery and fancybox files -->

<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<!-- Page Content -->
<div class="container">
    <div class="row mb-3">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5"><?= $navLink['link_05']; ?></h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= _URL_.'/'.$lang.'/' ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $navLink['link_05']; ?></li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row">
		<?php
		while($row = $rgVideo->fetch(PDO::FETCH_BOTH)):

        $titolo = $row['Titolo'.strtoupper($lang)];

        if($row['Sorgente']==1) {

            $urlQuery = parse_url($row['LinkUrl'], PHP_URL_QUERY);
            $arrUrl_1 = explode('&', $urlQuery);
            $arrUrl_2 = explode('=', $arrUrl_1[0]);

            $arrNurl = array($arrUrl_2[0]=>$arrUrl_2[1]);

            $linkVideo = "http://www.youtube.com/watch?v=";
        }

        if($row['Sorgente']==2) {

            $arrL = strlen($row['LinkUrl']) - 18;
            //echo $arrL;
            $arrUrl = substr($row['LinkUrl'], 18, $arrL);
            //echo $arrUrl;
            $arrNurl = array('v'=>$arrUrl);
            //var_dump($urlQuery);
            $linkVideo = 'http://vimeo.com/';
        }

        if (empty($row['LinkImg'])) {
            $immagine = 'nofoto.jpg';
        }
        # ...altrimenti do conferma!
        else {
            //fclose($fp);
            $immagine = $row['LinkImg'];
        }

		?>
        <div class="col-md-4">
            <div class="conFoto mb-4">
                <a href="<?php echo $linkVideo.$arrNurl['v']; ?>" data-fancybox="galleria">
                    <img src="<?php echo _URL_.'/storage/video/crop/'.$immagine; ?>" alt="<?php echo $titolo; ?>" class="img-fluid thumb-img-gal">
                </a>
                <div class="linkfFt">
                    <?php echo $titolo; ?>
                </div>
            </div>
        </div>
		<?php endwhile; ?>
    </div>

    <div class="mt-4">
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
<?php include('footer.php'); ?>
