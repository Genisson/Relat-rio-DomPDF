<?php

//CARREGAR O COMPOSER
require __DIR__.'/vendor/autoload.php';

//INCLUIR CONEXÃO COM BD
include_once './conexao.php';

//QUERY para recuperar os dados do banco de dados
$query_solicitacao = "SELECT id, protocolo, servico , relator, bairro, rua, situacao FROM solicitacao";

//Preparar a Query
$result_solicitacao = $conn->prepare($query_solicitacao);

//Executar a Query
$result_solicitacao->execute();

//DADOS GERADOS PARA O PDF
$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= " <meta http-equiv='X-UA-Compatible' content='IE=edge'>";
$dados .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
$dados .= "<title>Gerar PDF</title>";
$dados .= "<link rel='stylesheet' href='css/estilo.css'>";
$dados .= "</head>";
$dados .= "<body>";
$dados .= "  <div class='cabecalho'>";
$dados .= "<div class='logo'>";
$dados .= " <img src='img/pmi_logo.png' alt='Logo Prefeitura'>";
$dados .= " </div>";
$dados .= "  <div class='titulo'>";
$dados .= "<h2>Prefeitura Municipal de Ipatinga</h2>";
$dados .= "<p>Secretaria Municipal de Saúde</p>";
$dados .= "</div>";
$dados .= " </div>";
$dados .= "<div class='categorias'>";
$dados .= " <table>";
$dados .= "<tr>";
$dados .= "<th>Secretaria: </th>";
$dados .= "<td>Secretaria Municipal de Saúde - SMS</td>";
$dados .= " </tr>";
$dados .= "</tr>";
$dados .= "<th>Departamento: </th>";
$dados .= "<td>Seção de Controle de Zoonoses - SCZ</td>";
$dados .= " </tr>";
$dados .= " <tr>";
$dados .= " <th>Serviço: </th>";
$dados .= "<td>Castração de Cães e Gatos com tutor</td>";
$dados .= " </tr>";
$dados .= " </table>";
$dados .= "</div>";
$dados .= "<div class='dados'>";
$dados .= "<table class='table'>";
$dados .= "<thead>";
$dados .= "<tr>";
$dados .= "<th >#</th>";
$dados .= "<th scope='col'>Protocolo</th>";
$dados .=  "<th scope='col'>Serviço</th>";
$dados .= "<th scope='col'>Relator</th>";
$dados .= "<th scope='col'>Bairro</th>";
$dados .= "<th scope='col'>Rua</th>";
$dados .= "<th scope='col'>Situação</th>";
$dados .= "</tr>";
$dados .= "</thead>";
$dados .= "<tbody>";

$dados .= "";

//Ler os registros do BD
 while($row_solicitacao = $result_solicitacao->fetch(PDO::FETCH_ASSOC)){
     //var_dump($row_solicitacao);
     extract($row_solicitacao);
    
     $dados .= " <tr>";
     $dados .= "<th>$id</th>";
     $dados .= "<td>$protocolo</td>";
     $dados .= "<td>$servico</td>";
     $dados .= "<td>$relator</td>";
     $dados .= "<td>$bairro</td>";
     $dados .= "<td>$rua</td>";
     $dados .= "<td>$situacao</td>";
     $dados .= " </tr>";
 
 }

 $dados .= "</tbody>";
 $dados .= "</table>";
 $dados .= "</div>";
 $dados .= "</body>";
 $dados .= "</html>";

 use Dompdf\Dompdf;
 use Dompdf\Options;

 //INSTANCIA DE OPTIONS
 $options = new Options();
 $options->setChroot(__DIR__);
 $options->setIsRemoteEnabled(true);

//INSTANCIA DE DOMPDF
 $dompdf = new Dompdf($options);

 //CARREGAR HTML PARA DENTRODA CLASSE
 $dompdf->loadhtml($dados);

 //PÁGINA
  $dompdf->setPaper('A4','landscape');

//RENDERIZAR O ARQUIVO PDF
 $dompdf-> render();
 //IMPRIMI O CONTEÚDO DO ARQUIVO NA TELA
 header('content-type: application/pdf');
 echo $dompdf->output();





?>




