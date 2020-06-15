<?php

class Usuario {
    private $id;
    private $deslogin;
    private $desenha;
    private $dtcadastro;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getDeslogin(){
        return $this->deslogin;
    }

    public function setDeslogin($deslogin){
        $this->deslogin = $deslogin;
    }

    public function getDesenha(){
        return $this->desenha;
    }

    public function setDesenha($desenha){
        $this->desenha = $desenha;
    }

    public function getDtCadastro(){
        return $this->dtcadastro;
    }

    public function setDtCadastro($dtcadastro){
        $this->dtcadastro = $dtcadastro;
    }
    
    public function loadById($id){
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_usuario WHERE id = :ID", array(
            ":ID"=>$id
        ));

        if(count($result) > 0) {
            $row = $result[0];

            $this->setId($row['id']);
            $this->setDeslogin($row['deslogin']);
            $this->setDesenha($row['desenha']);
            $this->setDtCadastro(new DateTime($row['dtcadastro']));

        }
    }

    public function __toString(){
        return json_encode(array(
            "id"=>$this->getId(),
            "deslogin"=>$this->getDeslogin(),
            "desenha"=>$this->getDesenha(),
            "dtcadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
        ));
    }

}



?>