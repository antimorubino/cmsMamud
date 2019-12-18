<?php
class GalleriaController extends Connessione {

    /* Categoria */

    public function elenCatGal(int $id, int $perPage = 0) {

        $sql = "SELECT * FROM ".$this->prefix."_catgalleria WHERE 1=1";

        if(!empty($id)) {
            $sql .= " AND idCategoria = $id";
        } else {

            $rs = $this->verConn()->query($sql);

            // numero totale di records
            $tot_records = $this->numRecordCGal();

            // risultati per pagina(secondo parametro di LIMIT)
            $per_page = $perPage;

            // numero totale di pagine
            $tot_pages = $this->totPagesCGal($perPage);

            // pagina corrente
            $current_page = (!$_GET['page']) ? 1 : (int)$_GET['page'];

            // primo parametro di LIMIT
            $primo = ($current_page - 1) * $per_page;

            $sql.=" ORDER BY idCategoria DESC LIMIT $primo, $per_page";

        }

        $rs = $this->verConn()->query($sql);

        return $rs;

    }

    public function elenCatGalS() {

        $sql = "SELECT * FROM ".$this->prefix."_catgalleria";
        $rs = $this->verConn()->query($sql);

        return $rs;

    }

    public function modCat(int $id, $lang) {

        $titolo = htmlentities($_REQUEST['titolo'],ENT_QUOTES,$this->charset);

        $campoTitle = 'categoria'.strtoupper($lang);

        $sql = "UPDATE ".$this->prefix."_catgalleria SET $campoTitle = :titolo WHERE idCategoria= $id";
        $rs = $this->verConn()->prepare($sql);
        $rs->bindParam(':titolo', $titolo, PDO::PARAM_STR);
        $rs->execute();

        if($rs->execute()) {
            $modok = 1;
            header('Location: mod-catgalleria.php?idCat='.$id.'&lang='.$lang.'&mod='.$modok);
        } else {
            $modok = 0;
            header('Location: mod-catgalleria.php?idCat='.$id.'&lang='.$lang.'&mod='.$modok);
        }

    }

    public function insCat() {

        $titolo = htmlentities($_REQUEST['titolo'],ENT_QUOTES,$this->charset);

        $campoTitle = 'categoria'.strtoupper($lang);

        $sql = "INSERT INTO ".$this->prefix."_catgalleria (categoriaIT, categoriaEN) VALUES (:titoloIT, :titoloEN)";
        $rs = $this->verConn()->prepare($sql);
        $rs->bindParam(':titoloIT', $titolo, PDO::PARAM_STR);
        $rs->bindParam(':titoloEN', $titolo, PDO::PARAM_STR);

        if($rs->execute()) {
            $modok = 1;
            echo 'Inserimento avvenuto con successo';
        } else {
            $modok = 0;
            echo 'Errore nell\'inserimento della news';
        }

        //$rs->debugDumpParams();

    }

    public function delCat(int $id) {

        $sqlS = "SELECT * FROM ".$this->prefix."_galleria WHERE idCategoria = '$id'";
        $rsS = $this->verConn()->query($sqlS);
        $count = $rsS->rowCount();
        //echo $count;

        if($count == 0) {
            $sql = "DELETE FROM ".$this->prefix."_catgalleria WHERE idCategoria = '$id'";
            $rs = $this->verConn()->prepare($sql);

            if($rs->execute()) {
                //echo $count;
                header('Location: catgalleria.php');
            } else {
                echo 'Errore eliminazione record';
            }
        } else {
            echo 'Errore: Immagini presenti nella categoria';
        }
    }

    /* Galleria */

    public function elenGalS(int $id, int $cs = 0) {

        $sql = "SELECT * FROM ".$this->prefix."_galleria WHERE 1=1";

        if(!empty($id)) {
            $sql .= " AND idCategoria = $id";
        }

        if($cs == 1) {
            $sql .= " ORDER BY RAND() LIMIT 1";
        }

        $rs = $this->verConn()->query($sql);

        return $rs;

    }

    public function elenGal(int $id, int $perPage = 0) {

        $sql = "SELECT * FROM ".$this->prefix."_galleria NATURAL JOIN ".$this->prefix."_catgalleria WHERE 1=1";

        if(!empty($id)) {
            $sql .= " AND idGalleria = $id";
        } else {

            if(isset($_GET['idCat']) && !empty($_GET['idCat'])) {
                $sql .= " AND idCategoria = '{$_GET['idCat']}'";
            }

            $rs = $this->verConn()->query($sql);

            // numero totale di records
            $tot_records = $this->numRecordGal();

            // risultati per pagina(secondo parametro di LIMIT)
            $per_page = $perPage;

            // numero totale di pagine
            $tot_pages = $this->totPagesGal($perPage);

            // pagina corrente
            $current_page = (!$_GET['page']) ? 1 : (int)$_GET['page'];

            // primo parametro di LIMIT
            $primo = ($current_page - 1) * $per_page;

            $sql.=" ORDER BY idGalleria DESC LIMIT $primo, $per_page";

        }

        $rs = $this->verConn()->query($sql);
        //$rs->debugDumpParams();
        return $rs;

    }

    public function modImg(int $id, $nomeFile) {

        $categoria = htmlentities($_REQUEST['categoria'],ENT_QUOTES,$this->charset);

        if($nomeFile == NULL) {
            $sql = "UPDATE ".$this->prefix."_galleria SET idCategoria = :categoria WHERE idGalleria = $id";
            $rs = $this->verConn()->prepare($sql);
            $rs->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        } else {
            $sql = "UPDATE ".$this->prefix."_galleria SET idCategoria = :categoria, Img = :img WHERE idGalleria = $id";
            $rs = $this->verConn()->prepare($sql);
            $rs->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            $rs->bindParam(':img', $nomeFile, PDO::PARAM_STR);
        }

        if($rs->execute()) {
            $modok = 1;
            header('Location: mod-galleria.php?idGal='.$id.'&lang='.$lang.'&mod='.$modok);
        } else {
            $modok = 0;
            header('Location: mod-galleria.php?idGal='.$id.'&lang='.$lang.'&mod='.$modok);
        }

    }

    public function insImg($nomeFile) {

        $categoria = htmlentities($_REQUEST['categoria'],ENT_QUOTES,$this->charset);

        $sql = "INSERT INTO ".$this->prefix."_galleria (idCategoria, Img) VALUES (:categoria, :img)";
        $rs = $this->verConn()->prepare($sql);
        $rs->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        $rs->bindParam(':img', $nomeFile, PDO::PARAM_STR);

        if($rs->execute()) {
            echo 'Immagine '.$nomeFile.' Inserita correttamente<br />';
        }

    }

    public function delGal(int $id) {

        $sqlS = "SELECT * FROM ".$this->prefix."_galleria WHERE idGalleria = '$id'";
        $rsS = $this->verConn()->query($sqlS);
        $rowS = $rsS->fetch(PDO::FETCH_BOTH);

        $file = '../storage/galleria/img/'.$rowS['Img'];
        @unlink($file);
        $file = '../storage/galleria/thumb/'.$rowS['Img'];
        @unlink($file);
        $file = '../storage/galleria/crop/'.$rowS['Img'];
        @unlink($file);

        $sql = "DELETE FROM ".$this->prefix."_galleria WHERE idGalleria = '$id'";
        $rs = $this->verConn()->prepare($sql);

        if($rs->execute()) {
            header('Location: galleria.php');
        } else {
            echo 'Errore eliminazione record';
        }

    }

    /**/

    public function numRecordGal() {
        $sql = "SELECT * FROM ".$this->prefix."_galleria";
        $rs = $this->verConn()->query($sql);
        $righe = $rs->rowCount();

        return $righe;
    }

    public function totPagesGal(int $perPage) {
        $tot_pages = ceil($this->numRecordGal() / $perPage);
        return $tot_pages;
    }

    public function numRecordCGal() {
        $sql = "SELECT * FROM ".$this->prefix."_catgalleria";
        $rs = $this->verConn()->query($sql);
        $righe = $rs->rowCount();

        return $righe;
    }

    public function totPagesCGal(int $perPage) {
        $tot_pages = ceil($this->numRecordCGal() / $perPage);
        return $tot_pages;
    }

}
?>
