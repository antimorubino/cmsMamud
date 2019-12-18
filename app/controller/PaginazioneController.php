<?php
class PaginationController {

    public function paginazione(int $num, int $perPage, int $modV = 0) {

        //$tot_pages = $num;

        $tot_pages = ceil($num / $perPage);

        // pagina corrente
        $current_page = (!$_GET['page']) ? 1 : (int)$_GET['page'];

        $paginazione = "<ul class='pagination d-flex flex-wrap'>";

        $page = $_GET['page'];

        if(!isset($page)){
            $page = 1;
        }

        $pagina_pr = $page-1;
        $pagina_pross = $page+1;

        $qsArray = array();
        parse_str($_SERVER['QUERY_STRING'], $qsArray);

        if (isset($qsArray['page'])) unset($qsArray['page']);
            $qs = http_build_query($qsArray);

            if(empty($qs)) {
                $link_pag = "?";
            } else {

                if($modV == 0) {
                    $link_pag = "?";
                }

                if($modV == 1) {
                    $link_pag = "?".$qs."&";
                }
                
            }

            if($page == 1) {
                $paginazione .= "<li class=\"disabled page-item\"><a href=\"#\" class=\"page-link\">&laquo;</a></li>";
                $paginazione .= "<li class=\"disabled page-item\"><a href=\"#\" class=\"page-link\">&#8249;</a></li>";
            } else {
                $paginazione .= "<li class=\"page-item\"><a href=\"".$link_pag."page=1\" class=\"page-link\">&laquo;</a></li>";
                $paginazione .= "<li class=\"page-item\"><a href=\"".$link_pag."page=$pagina_pr\" class=\"page-link\">&#8249;</a></li>";
            }

            $page_i=$page-6;
            $page_f=$page+6;

            if($page_i < 3){
               $page_i = 1;
            }


            if($page_f > $tot_pages){
                $page_f = $tot_pages;
            }

            for($i = $page_i; $i <= $page_f; $i++) {

                if($i == $current_page) {
                   $paginazione .= "<li class='active page-item'><a href=\"#\" class=\"page-link\">".$i ."</a></li>";
                } else {
                   $paginazione .= "<li class='page-item'><a href=\"".$link_pag."page=$i\" class=\"page-link\">$i</a></li>";
                }
            }

            if($page==$tot_pages) {
                $paginazione .= "<li class='disabled page-item'><a href=\"#\" class=\"page-link\">&#8250</a></li>";
                $paginazione .= "<li class='disabled page-item'><a href=\"#\" class=\"page-link\">&raquo;</a></li>";
            } else {
                $paginazione .= "<li class='page-item'><a href=\"".$link_pag."page=$pagina_pross\" class=\"page-link\">&#8250;</a></li>";
                $paginazione .= "<li class='page-item'><a href=\"".$link_pag."page=$tot_pages\" class=\"page-link\">&raquo;</a></li>";
            }

        $paginazione.="</ul>";

        return $paginazione;
    }

}
?>
