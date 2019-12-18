<?php
class NewsController extends Connessione {

    public function elenNews(int $id, int $perPage = 0) {

        $sql = "SELECT * FROM ".$this->prefix."_news WHERE 1=1";

        if(!empty($id)) {
            $sql .= " AND idNews = $id";
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

            $sql.=" ORDER BY Data DESC LIMIT $primo, $per_page";

        }

        $rs = $this->verConn()->query($sql);

        return $rs;

    }

    public function numRecord() {
        $sql = "SELECT * FROM ".$this->prefix."_news";
        $rs = $this->verConn()->query($sql);
        $righe = $rs->rowCount();

        return $righe;
    }

    public function totPages(int $perPage) {
        $tot_pages = ceil($this->numRecord() / $perPage);
        return $tot_pages;
    }

    public function modNew(int $id, $lang, $nomeFile) {

        $titolo = htmlentities($_REQUEST['titolo'],ENT_QUOTES,$this->charset);
		$testo = htmlentities($_REQUEST['contenuto'],ENT_QUOTES,$this->charset);
        $data = $_REQUEST['data'];

        $campoTitle = 'Titolo'.strtoupper($lang);
        $campoCont = 'Contenuto'.strtoupper($lang);

        if($nomeFile == NULL) {
            $sql = "UPDATE ".$this->prefix."_news SET Data = :data, $campoTitle = :titolo, $campoCont = :testo WHERE idNews= $id";
            $rs = $this->verConn()->prepare($sql);
            $rs->bindParam(':data', $data, PDO::PARAM_STR);
            $rs->bindParam(':titolo', $titolo, PDO::PARAM_STR);
            $rs->bindParam(':testo', $testo, PDO::PARAM_STR);
        } else {
            $sql = "UPDATE ".$this->prefix."_news SET Data = :data, $campoTitle = :titolo, $campoCont = :testo, Immagine = :immagine WHERE idNews= $id";
            $rs = $this->verConn()->prepare($sql);
            $rs->bindParam(':data', $data, PDO::PARAM_STR);
            $rs->bindParam(':titolo', $titolo, PDO::PARAM_STR);
            $rs->bindParam(':testo', $testo, PDO::PARAM_STR);
            $rs->bindParam(':immagine', $nomeFile, PDO::PARAM_STR);
        }


        if($rs->execute()) {
            $modok = 1;
            header('Location: mod-new.php?idNew='.$id.'&lang='.$lang.'&mod='.$modok);
        } else {
            $modok = 0;
            header('Location: mod-new.php?idNew='.$id.'&lang='.$lang.'&mod='.$modok);
        }

        //$rs->debugDumpParams();

    }

    public function insNew($id, $nomeFile) {

        $titolo = htmlentities($_REQUEST['titolo'],ENT_QUOTES,$this->charset);
        $testo = htmlentities($_REQUEST['contenuto'],ENT_QUOTES,$this->charset);
        $data = $_REQUEST['data'];

        $sql = "INSERT INTO ".$this->prefix."_news (Data, TitoloIT, TitoloEN, ContenutoIT, ContenutoEN, Immagine) VALUES (:data, :titoloIT, :titoloEN, :testoIT, :testoEN, :immagine)";
        $rs = $this->verConn()->prepare($sql);
        $rs->bindParam(':data', $data, PDO::PARAM_STR);
        $rs->bindParam(':titoloIT', $titolo, PDO::PARAM_STR);
        $rs->bindParam(':titoloEN', $titolo, PDO::PARAM_STR);
        $rs->bindParam(':testoIT', $testo, PDO::PARAM_STR);
        $rs->bindParam(':testoEN', $testo, PDO::PARAM_STR);
        $rs->bindParam(':immagine', $nomeFile, PDO::PARAM_STR);

        //$rs->debugDumpParams();

        if($rs->execute()) {
            $modok = 1;
            echo 'Inserimento avvenuto con successo';
        } else {
            $modok = 0;
            echo 'Errore nell\'inserimento della news';
        }

    }

    public function delNew(int $id) {

        $sqlS = "SELECT * FROM ".$this->prefix."_news WHERE idNews = '$id'";
        $rsS = $this->verConn()->query($sqlS);
        $rowS = $rsS->fetch(PDO::FETCH_BOTH);

        $file = '../storage/news/img/'.$rowS['Immagine'];
        @unlink($file);
        $file = '../storage/news/thumb/'.$rowS['Immagine'];
        @unlink($file);
        $file = '../storage/news/crop/'.$rowS['Immagine'];
        @unlink($file);

        $sql = "DELETE FROM ".$this->prefix."_news WHERE idNews = '$id'";
        $rs = $this->verConn()->query($sql);

        if($rs) {
            header('Location: news.php');
        } else {
            echo 'Errore eliminazione record';
        }

    }

}
?>
