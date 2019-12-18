<?php
class PageController extends Connessione {

    public function elenPage(int $id) {

        $sql = "SELECT * FROM ".$this->prefix."_contenuti WHERE 1=1";

        if(!empty($id)) {
            $sql .= " AND idContenuto = $id";
        }
        $rs = $this->verConn()->query($sql);

        return $rs;

    }

    public function modCont($id, $lang) {

        $titolo = htmlentities($_REQUEST['titolo'],ENT_QUOTES,$this->charset);
		$testo = htmlentities($_REQUEST['contenuto'],ENT_QUOTES,$this->charset);

        $campoTitle = 'titolo'.strtoupper($lang);
        $campoCont = 'contenuto'.strtoupper($lang);

        $sql = "UPDATE ".$this->prefix."_contenuti SET $campoTitle = :titolo, $campoCont = :testo WHERE idContenuto= $id";
        $rs = $this->verConn()->prepare($sql);
        $rs->bindParam(':titolo', $titolo, PDO::PARAM_STR);
        $rs->bindParam(':testo', $testo, PDO::PARAM_STR);

        if($rs->execute()) {
            $modok = 1;
            header('Location: mod-contenuto.php?idCont='.$id.'&lang='.$lang.'&mod='.$modok);
        } else {
            $modok = 0;
            header('Location: mod-contenuto.php?idCont='.$id.'&lang='.$lang.'&mod='.$modok);
        }

    }

}
?>
