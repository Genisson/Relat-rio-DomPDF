<?php

//AUTOLOAD DO COMPOSER
require __DIR__.'/vendor/autoload.php';

include('conexao.php');

$sql = "SELECT * FROM solicitacao";

$res = $mysqli->query($sql);


if($res->num_rows > 0){
    while($row = $res->fetch_object()){

     print $row->id;
     print $row->protocolo;
     print $row->servico;
     print $row->relator;
     print $row->bairro;
     print $row->rua;
     print $row->situacao;

    }

}else{
 print 'Nenhum dado registrado';
 }


use Dompdf\Dompdf;
use Dompdf\Options;

//INSTANCIA DE OPTIONS
$options = new Options();
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);

//INSTANCIA DE DOMPDF
$dompdf = new Dompdf($options);

//CARREGAR HTML PARA DENTRODA CLASSE
$dompdf->loadhtmlFile(__DIR__.'/arquivo.html');

//PÁGINA
 $dompdf->setPaper('A4','portrait');

//RENDERIZAR O ARQUIVO PDF
 $dompdf-> render();

 //$dompdf->stream();
//IMPRIMI O CONTEÚDO DO ARQUIVO NA TELA
 header('content-type: application/pdf');
 echo $dompdf->output();







?>