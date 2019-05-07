<?php

require("../functions.php");
require("../config-db.php");

if(isset($_POST["mes"])){
    $filtro_mes_ano = $_POST["mes"];
    $mes = explode("-", $filtro_mes_ano)[1];
    $ano = explode("-", $filtro_mes_ano)[0];
}else{
    $mes = null;
}

if($_POST["dentista"] != ""){
    $dentista_id = $_POST["dentista"];
    $dentista = get_object_perfil($dentista_id)->nome;
}else{
    $dentista = null;
    $dentista_id = null;
}

require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$css = '
<style>
table{
    border-collapse: collapse;
}

table thead th{
    background: black;
    color: #fff;
    padding: 5px 10px;
}

table td{
    border: 1px solid #000;
    padding: 5px 10px;
}

table tr.space td{
    background: black;
}

small{
    font-size: .7em;
}

.month{
    font-weight: bold;
}

.convenio{
    text-decoration: underline;
}

</style>';

$meses = array(
    "", "Janeiro",
    "Fevereiro",
    "Março",
    "Abril",
    "Maio",
    "Junho",
    "Julho",
    "Agosto",
    "Setembro",
    "Outubro",
    "Novembro",
    "Dezembro"
    );

$filtros_utilizados = array();
if($mes){ 
    array_push( $filtros_utilizados, "Mês: {$meses[$mes]}" );  
    array_push( $filtros_utilizados, "Ano: {$ano}" );  
}
if($dentista) { array_push( $filtros_utilizados, "Dentista: ".$dentista); }

$html = '<h1> Relatório de guias por busca.</h1>';
$html .= '<h3>Filtros</h3>';
foreach ($filtros_utilizados as $filtro) {
    $html .= $filtro."<br/>";
}
$html .= '<h3>Data e hora da consulta: '.date("d/m/Y H:i:s").'</h3>';
$html .= '<table class="table-responsive table-sm simple">
<thead>
    <tr>
        <th>Guia</th>
        <th>Profissional</th>
        <th>Convênio</th>
        <th>Pagamento</th>
        <th>Valor de repasse</th>
        <th>Repasse</th>
        <th>Data e hora</th>
    </tr>
</thead>
<tbody>
    <tr class="space"><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';

$nome_relatorio = "relatorio_por_busca_".date("d_m_Y_H_i_s"); //reset
$mes_atual = 0; //reset

if($mes && $dentista_id){
    $pesquisaguias = $mydb->query("SELECT * FROM guias WHERE MONTH(datahora) = '{$mes}' AND YEAR(datahora) = '{$ano}' AND dentista = {$dentista_id} ORDER BY datahora DESC");
}else if($dentista_id){
    $pesquisaguias = $mydb->query("SELECT * FROM guias WHERE dentista = {$dentista_id} ORDER BY datahora DESC");    
}else if($mes){
    $pesquisaguias = $mydb->query("SELECT * FROM guias WHERE MONTH(datahora) = '{$mes}' AND YEAR(datahora) = '{$ano}' ORDER BY datahora DESC");    
}else{
    $pesquisaguias = $mydb->query("SELECT * FROM guias ORDER BY datahora DESC");    
}

while($row = $pesquisaguias->fetch_assoc()){
$datetime = new DateTime($row["datahora"]);
$mes_novo = $datetime->format('m');
$ano_novo = $datetime->format('Y');

if($mes_novo != $mes_atual){
    $html .= "<tr><td colspan='7' class='month'>>> ".$meses[intval($mes_novo)]." de ".$ano_novo."</td></tr>";
}

$pagamento = $row["b_pago"] == 0 ? "Não pago" : "Pago {$row["valor_pago"]}";
$valor_repasse = $row["b_pago"] == 0 ? "<i>".calc_repasse($row["id"])."</i>" : calc_repasse($row["id"]);
$repasse = $row["b_repasse"] == 0 ? "Não" : "Sim";

$html .= "<tr>
<td>".$row["numero"]."</td>
<td>".get_object_perfil($row["dentista"])->nome."</td>
<td>".get_convenio($row["convenio"])."</td>
<td>{$pagamento}</td>
<td>{$valor_repasse}</td>
<td>{$repasse}</td>
<td class='datahora'>".$row["datahora"]."</td>
</tr>";

$mes_atual = $datetime->format('m');
}

$html .= '</tbody>
</table>';

$html .= $css;

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($nome_relatorio);