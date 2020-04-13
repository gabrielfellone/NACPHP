<?php
class Usuario {
    private $id;
    private $nome;
    private $sexo;
    private $perfil;
    private $dataNascimento;
    private $password;

    public function __construct($id, $nome, $sexo, $perfil, $dataNascimento, $password) {
        $this->id = $id;
        $this->nome = $nome;
        $this->sexo = $sexo;
        $this->perfil = $perfil;
        $this->dataNascimento = $dataNascimento;
        $this->password = $password;
    }
    
    public function setNome($nome) {
        $this->nome= $nome;
    }
    public function setSexo($sexo) {
        $this->sexo= $sexo;
    }
    public function setPerfil($perfil) {
        $this->perfil= $perfil;
    }
    public function setId($id) {
        $this->id= $id;
    }
    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento= $dataNascimento;
    }
    public function setPassword($password) {
        $this->password= $password;
    }

    public function getId(){
        return $this->id;
    }
    public function getNome(){
        return $this->nome;
    }
    public function getSexo(){
        return $this->sexo;
    }
    public function getPerfil(){
        return $this->perfil;
    }
    public function getDataNascimento(){
        return $this->dataNascimento;
    }
    public function getPassword(){
        return $this->password;
    }
}
?>