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

            $this->setData($result[0]);

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

            $this->setData($result[0]);

        }else{
            throw new Exception("Login e/ou senha invalidos!!!");
        }
    }

    public function setData($data){

            $this->setId($data['id']);
            $this->setDeslogin($data['deslogin']);
            $this->setDesenha($data['desenha']);
            $this->setDtCadastro(new DateTime($data['dtcadastro']));
    }

    public function insert(){
        $sql = new Sql();

        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDesenha()
        ));

        if (count($results) > 0 ){
            $this->setData($results[0]);
        }
    }

    public function update($login, $password){

        $this->setDeslogin($login);
        $this->setDesenha($password);

        $sql = new Sql();

        $sql->query("UPDATE tb_usuario SET deslogin = :LOGIN, desenha = :PASSWORD WHERE id= :ID", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDesenha(),
            ':ID'=>$this->getId()
        ));

    }

    public function delete(){
        $sql = new Sql();

        $sql->query("DELETE FROM tb_usuario WHERE id = :ID", array(
            ':ID'=>$this->getId()    
        ));

        $this->setId(0);
        $this->setDeslogin("");
        $this->setDesenha("");
        $this->setDtCadastro(new DateTime());

    }

    public function __construct($login ="", $password = "") {
        $this->setDeslogin($login);
        $this->setDesenha($password);
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