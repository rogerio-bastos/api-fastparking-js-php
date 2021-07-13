<?php

use App\Core\Controller;

class Clients extends Controller{

    public function index(){
        $clientsModel = $this->model("Client");

        $clients = $clientsModel->listAll();

        echo json_encode($clients, JSON_UNESCAPED_UNICODE);
    }

    public function find($id){
        $clientsModel = $this->model("Client");

        $clients = $clientsModel->findById($id);

        if($clients){
            echo json_encode($clients, JSON_UNESCAPED_UNICODE);
        }else{
            http_response_code(404);

            $erro = ['erro' => 'Cliente não encontrado.'];

            echo json_encode($erro, JSON_UNESCAPED_UNICODE);
        }
    }
    
    public function store(){
        $json = file_get_contents("php://input");

        $newClient = json_decode($json);

        $clientsModel = $this->model("Client");

        $clientsModel->name = $newClient->name;
        $clientsModel->placa = $newClient->placa;
        $clientsModel->dia = $newClient->dia;
        $clientsModel->hora = $newClient->hora;

        if($clientsModel->insert()){
            http_response_code(201);
            echo json_encode($clientsModel, JSON_UNESCAPED_UNICODE);
        }else{
            http_response_code(500);
            echo json_encode(["erro" => "Problemas ao inserir categoria"]);
        }
    }


    public function update($id){
        $json = file_get_contents("php://input");

        $clientToUpdate = json_decode($json);

        $clientsModel = $this->model("Client");

        var_dump($clientsModel);

        $clientsModel = $clientsModel->findById($id);

        var_dump($clientsModel);

        if(!$clientsModel){
            http_response_code(404);
            echo json_encode(["erro" => "Cliente não encontrado."]);
            exit;
        }

        $clientsModel->nome = $clientToUpdate->name;
        $clientsModel->placa = $clientToUpdate->placa;
        $clientsModel->id = $id;
        
        $result = $clientsModel->update();

        if($clientsModel->update()){
            http_response_code(204);
        }else{
            http_response_code(500);
            echo json_encode(["erro" => "Problemas ao atualizar cliente."]);
        }
    }

    public function delete($id){
        $clientsModel = $this->model("Client");

        $clientsModel = $clientsModel->findById($id);

        if(!$clientsModel){
            http_response_code(404);
            echo json_encode(["erro" => "Cliente não encontrado."]);
            exit;
        }

        $clientsModel->id = $id;

        $clientsModel->delete();
    }

}