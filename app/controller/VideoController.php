<?php
class VideoController extends Connessione {

    public function elenVideo(int $id, int $perPage = 0) {

        $sql = "SELECT * FROM ".$this->prefix."_video WHERE 1=1";

        if(!empty($id)) {
            $sql .= " AND idVideo = $id";
        } else {

            $rs = $this->verConn()->query($sql);

            // numero totale di records
            $tot_records = $this->numRecord();

            // risultati per pagina(secondo parametro di LIMIT)
            $per_page = $perPage;

            // numero totale di pagine
            $tot_pages = $this->totPages($perPage);

            // pagina corrente
            $current_page = (!$_GET['page']) ? 1 : (int)$_GET['page'];

            // primo parametro di LIMIT
            $primo = ($current_page - 1) * $per_page;

            $sql.=" ORDER BY idVideo DESC LIMIT $primo, $per_page";

        }

        $rs = $this->verConn()->query($sql);

        return $rs;

    }

    public function numRecord() {
        $sql = "SELECT * FROM ".$this->prefix."_video";
        $rs = $this->verConn()->query($sql);
        $righe = $rs->rowCount();

        return $righe;
    }

    public function totPages(int $perPage) {
        $tot_pages = ceil($this->numRecord() / $perPage);
        return $tot_pages;
    }

    public function modVideo(int $id, $lang, $nomeFile) {

        $titolo = htmlentities($_REQUEST['titolo'],ENT_QUOTES,$this->charset);
		$link = htmlentities($_REQUEST['link'],ENT_QUOTES,$this->charset);
        $categoria = $_REQUEST['categoria'];

        $campoTitle = 'Titolo'.strtoupper($lang);

        if($nomeFile == NULL) {
            $sql = "UPDATE ".$this->prefix."_video SET $campoTitle = :titolo, Sorgente = :sorgente, LinkUrl = :url WHERE idVideo= $id";
            $rs = $this->verConn()->prepare($sql);
            $rs->bindParam(':titolo', $titolo, PDO::PARAM_STR);
            $rs->bindParam(':sorgente', $categoria, PDO::PARAM_STR);
            $rs->bindParam(':url', $link, PDO::PARAM_STR);
            //$rs->execute([$titolo, $categoria, $link]);
        } else {
            $sql = "UPDATE ".$this->prefix."_video SET $campoTitle = :titolo, Sorgente = :sorgente, LinkUrl = :url, LinkImg = :img WHERE idVideo= $id";
            $rs = $this->verConn()->prepare($sql);
            $rs->bindParam(':titolo', $titolo, PDO::PARAM_STR);
            $rs->bindParam(':sorgente', $categoria, PDO::PARAM_STR);
            $rs->bindParam(':url', $link, PDO::PARAM_STR);
            $rs->bindParam(':img', $nomeFile, PDO::PARAM_STR);
        }

        if($rs->execute()) {
            $modok = 1;
            header('Location: mod-video.php?idVideo='.$id.'&lang='.$lang.'&mod='.$modok);
        } else {
            $modok = 0;
            header('Location: mod-video.php?idVideo='.$id.'&lang='.$lang.'&mod='.$modok);
        }

        //$rs->debugDumpParams();

    }

    public function insVideo($lang, $nomeFile) {

        $titolo = htmlentities($_REQUEST['titolo'],ENT_QUOTES,$this->charset);
		$link = htmlentities($_REQUEST['link'],ENT_QUOTES,$this->charset);
        $categoria = $_REQUEST['categoria'];

        $campoTitle = 'Titolo'.strtoupper($lang);

        $sql = "INSERT INTO ".$this->prefix."_video ($campoTitle, Sorgente, LinkUrl, LinkImg) VALUES (:titolo,:sorgente,:url,:img)";
        $rs = $this->verConn()->prepare($sql);
        $rs->bindParam(':titolo', $titolo, PDO::PARAM_STR);
        $rs->bindParam(':sorgente', $categoria, PDO::PARAM_STR);
        $rs->bindParam(':url', $link, PDO::PARAM_STR);
        $rs->bindParam(':img', $nomeFile, PDO::PARAM_STR);

        if($rs->execute()) {
            $modok = 1;
            echo 'Video inserito correttamente';
        } else {
            $modok = 0;
            echo 'Errore nell\'inserimento del video';
        }

        //$rs->debugDumpParams();
        //var_dump($rs);

    }

    public function delVideo(int $id) {

        $sqlS = "SELECT * FROM ".$this->prefix."_video WHERE idVideo = '$id'";
        $rsS = $this->verConn()->query($sqlS);
        $rowS = $rsS->fetch(PDO::FETCH_BOTH);

        $file = '../storage/video/img/'.$rowS['LinkImg'];
        @unlink($file);
        $file = '../storage/video/crop/'.$rowS['LinkImg'];
        @unlink($file);

        $sql = "DELETE FROM ".$this->prefix."_video WHERE idVideo = '$id'";
        $rs = $this->verConn()->prepare($sql);

        if($rs->execute()) {
            //echo $file;
            header('Location: video.php');
        } else {
            echo 'Errore eliminazione record';
        }

    }

}
?>
