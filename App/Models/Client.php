<?php

use App\Core\Model;

class Client{

    public $id;
    public $name;
    public $placa;
    public $dia;
    public $hora;

    public function listAll(){
        $sqlSelect = ' SELECT * FROM tbl_clients ';

        $stmt = Model::getConnection()->prepare($sqlSelect);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        }else {
            return[];
        }
    }

    public function findById($id){
        $sqlSelect = " SELECT * FROM tbl_clients WHERE id = ? ";

        $stmt = Model::getConnection()->prepare($sqlSelect);

        $stmt->bindValue(1, $id);

        $stmt->execute();

        if($stmt->rowCount() > 0){
            $client = $stmt->fetch(\PDO::FETCH_OBJ);

            return $client;
        }else{
            return null;
        }
    }

    public function insert(){
        $sqlInsert = " INSERT INTO tbl_clients(nome, placa, dia, hora) values(?, ?, ?, ?) ";

        $stmt = Model::getConnection()->prepare($sqlInsert);

        $stmt->bindvalue(1, $this->name);
        $stmt->bindvalue(2, $this->placa);
        $stmt->bindvalue(3, $this->dia);
        $stmt->bindvalue(4, $this->hora);

       return $stmt->execute();
    }

    public function update(){
        $sqlUpdate = " UPDATE tbl_clients SET nome = ?, placa = ? WHERE id = ? ";

        $stmt = Model::getConnection()->prepare($sqlUpdate);

        $stmt->bindValue(1, $this->name);
        $stmt->bindValue(2, $this->placa);
        $stmt->bindValue(3, $this->id);

        return $stmt->execute();
    }
}
