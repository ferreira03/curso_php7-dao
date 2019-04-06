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
            $this->setData($results[0]);
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

            $this->setData($results[0]);

        } else {
            throw new Exception("Login e/ou senha nao cadastrado");

        }
    }

    public function setData($data)
    {
        $this->setIdUsuario($data["idusuario"]);
        $this->setDeslogin($data["deslogin"]);
        $this->setDessenha($data["dessenha"]);
        $this->setDtcadastro(new DateTime($data["dtcadastro"]));

    }
    public function insert()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN,:PASSWORD)", array(
            ':LOGIN' => $this->getDeslogin(),
            ':PASSWORD' => $this->getDessenha(),
        ));
        if (count($results) > 0) {
            $this->setData($results[0]);
        }
    }
    public function update($login, $password)
    {
        $this->setDeslogin($login);
        $this->setDessenha($password);
        $sql = new Sql();

        $sql->query("UPDATE tb_usuarios SET deslogin=:LOGIN, dessenha=:PASSWORD WHERE idusuario=:ID", array(
            ':LOGIN' => $this->getDeslogin(),
            ':PASSWORD' => $this->getDessenha(),
            ':ID' => $this->getIdUsuario(),
        ));

    }

    public function delete()
    {
        $sql = new Sql();
        $sql->query("DELETE FROM tb_usuarios WHERE idusuario=:ID", array(
            ':ID' => $this->getIdUsuario(),
        ));
        $this->setIdUsuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtcadastro(new Datetime());
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
