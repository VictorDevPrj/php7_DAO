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
    //metodos estaticos nao precisa instanciar pode chamar DIRETO,
    //caso não tenha $this-> dentro do escopo do metodo
    public static function getList(){ 
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuario ORDER BY deslogin;");

    }

    public static function search($login){
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuario WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
            ':SEARCH'=>"%".$login."%"
        ));
    }

    public function login($login, $password){
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_usuario WHERE deslogin = :LOGIN AND desenha = :PASSWORD", array(
            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
        ));

        if(count($result) > 0) {
            $row = $result[0];

            $this->setId($row['id']);
            $this->setDeslogin($row['deslogin']);
            $this->setDesenha($row['desenha']);
            $this->setDtCadastro(new DateTime($row['dtcadastro']));

        }else{
            throw new Exception("Login e/ou senha invalidos!!!");
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