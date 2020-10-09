<?php

if(isset($_POST['cep'])){

    // $array = array("result"=>$_REQUEST['cep']);
    if(!preg_match('/^[0-9]{8}$/',trim($_REQUEST['cep']))){
        echo "error";
        return;
    }
    
    $url = "https://viacep.com.br/ws/".$_REQUEST['cep']."/json/";
    
    $ch = curl_init($url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $response = json_decode(curl_exec($ch));

    echo $response->localidade."-".$response->uf." ".$response->logradouro;
}