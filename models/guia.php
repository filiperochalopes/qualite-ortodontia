<?php

class Guia {
    public function __construct(
        $id
    ){
        global $mydb;

        $pesquisaguia = $mydb->query("SELECT * FROM guias WHERE id = $id");

        while($row = $pesquisaguia->fetch_assoc()){
            $this->id = $row["id"];
            $this->numero = $row["numero"];
            $this->nomeconvenio = get_convenio($row["convenio"]);
            $this->paciente = $row["paciente"];   
            $this->dentista = $row["dentista"];
            $this->atendido = $row["atendido"];
            $this->atendimento = get_atendimento($row["atendimento"]);
            $this->descricao = $row["descricao"];
            $this->datahora = $row["datahora"];
        }
    }

}

?>