<?php
class Usuario
{

    private $_idusuario;
    private $_deslogin;
    private $_dessenha;
    private $_dtcadastro;

    public function getIdUsuario()
    {
        return $this->_idusuario;
    }
    public function setIdUsuario($idusuario)
    {
        $this->_idusuario = $idusuario;
    }
    public function getDeslogin()
    {
        return $this->_deslogin;
    }
    public function setDeslogin($deslogin)
    {
        $this->_deslogin = $deslogin;
    }
    public function getDessenha()
    {
        return $this->_dessenha;
    }
    public function setDessenha($dessenha)
    {
        $this->_dessenha = $dessenha;
    }
    public function getDtcadastro()
    {
        return $this->_dtcadastro;
    }
    public function setDtcadastro($dtcadastro)
    {
        $this->_dtcadastro = $dtcadastro;
    }

    public function loadById($id)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario=:ID", array(
            ":ID" => $id,
        ));

        if (count($results) > 0) {
            $row = $results[0];
            $this->setIdUsuario($row["idusuario"]);
            $this->setDeslogin($row["deslogin"]);
            $this->setDessenha($row["dessenha"]);
            $this->setDtcadastro(new DateTime($row["dtcadastro"]));
        }
    }

    public static function getList()
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
    }

    public static function search($login)
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
            ':SEARCH' => "%" . $login . "%",
        ));
    }
    public function login($login, $password)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin=:LOGIN AND dessenha=:PASSWORD", array(
            ":LOGIN" => $login,
            ":PASSWORD" => $password,
        ));

        if (count($results) > 0) {
            $row = $results[0];
            $this->setIdUsuario($row["idusuario"]);
            $this->setDeslogin($row["deslogin"]);
            $this->setDessenha($row["dessenha"]);
            $this->setDtcadastro(new DateTime($row["dtcadastro"]));
        } else {
            throw new Exception("Login e/ou senha nao cadastrado");

        }
    }

    public function __toString()
    {
        return json_encode(array(
            "idusuario" => $this->getIdUsuario(),
            "deslogin" => $this->getDeslogin(),
            "dessenha" => $this->getDessenha(),
            "dtcadastro" => $this->getDtcadastro()->format("d/m/Y H:i:s"),
        ));
    }

}
