<?php


function cadastrar($contatos){
    //controlador agenda
    //$contatosAuxiliar = file_get_contents('contatos.json');
    //$contatosAuxiliar = json_decode($contatosAuxiliar, true);

    $contato = [
        'id'=> uniqid(), //deixar unico
        'nome'=>$nome,
        'email'=>$email,
        'telefone'=>$telefone
    ];
    array_push($contatos, $contato);
    //$contatosJson = json_encode($contatos, JSON_PRETTY_PRINT);
    //file_put_contents('contatos.json',$contatosJson);

    encodeJson($contatos);
    header('Location: index.phtml');
}
//-----------------------------------------------------------
function pegarContatos(){
    $contatosAuxiliar = file_get_contents('contatos.json');
    $contatosAuxiliar = json_decode($contatosAuxiliar, true);
    return $contatosAuxiliar;
}
//contatos recebe o valor que a função 'pegarContatos' retornar
//----------------------------------
$contatos = pegarContatos();
//----------------------------------

//-------------------------------------------------------------------------------------------------------------------
//transforma o arquivo json para um array que o php entende
function encodeJson($contatos){
    $contatos = json_encode($contatos, JSON_PRETTY_PRINT);
    file_put_contents('contatos.json',$contatos);

}
//-------------------------------------------------------------------------------------------------------------------

function excluirContato($id,$contatos){
    //$contatosAuxiliar = file_get_contents('contatos.json');
    //$contatosAuxiliar = json_decode($contatosAuxiliar, true);

    foreach ($contatos as $posicao => $contato) { //iteração
        if ($id == $contato['id']) {
            unset($contatos[$posicao]);
        }
    }
    //$contatosJson = json_encode($contatos, JSON_PRETTY_PRINT);
    //file_put_contents('contatos.json', $contatosJson);
    encodeJson($contatos);
    header('Location: index.phtml');
}
//-------------------------------------------------------------------------------------------------------------------

//-------------------------------------------------
function buscarContatoEditar($id_buscado,$contatos){
    //$contatosAuxiliar = file_get_contents('contatos.json');
    //$contatosAuxiliar = json_decode($contatosAuxiliar, true);
    foreach ($contatos as $contato){ //iteração
        if ($contato['id'] == $id_buscado){
            return $contato;
        }
    }
}
//--------------------------------------------------

//--------------------------------------------------
function salvarContatoEditado($id,$contatos){
    //$contatosAuxiliar = file_get_contents('contatos.json');
    //$contatosAuxiliar = json_decode($contatosAuxiliar, true);

    foreach ($contatos as $posição => $contato){ //iteração
        if ($contato['id'] == $id){

            $contatos[$posição]['nome'] = $_POST['nome'];
            $contatos[$posição]['email'] = $_POST['email'];
            $contatos[$posição]['telefone'] = $_POST['telefone'];

            break;
        }
    }

    //$contatos = json_encode($contatos, JSON_PRETTY_PRINT);
    //file_put_contents('contatos.json',$contatos); //transforma o arquivo json para um array que o php entende
    encodeJson($contatos);
    header('Location: index.phtml'); //leva para um arquivo
}
//----------------------------------------------------


//rotas
//---------------------------------------------------
if ($_GET['acao'] == 'cadastrar'){
    cadastrar($contatos);
}elseif ($_GET['acao'] == 'Excluir'){
    excluirContato($_GET['id'],$contatos);
}elseif($_GET['acao'] == 'editar') {
    salvarContatoEditado($_POST['id'],$contatos);
}
//----------------------------------------------------