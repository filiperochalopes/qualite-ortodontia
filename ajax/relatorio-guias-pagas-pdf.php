<?php

require("../functions.php");
require("../config-db.php");

if(isset($_POST["convenio"])){
    $convenio_id = $_POST["convenio"];
    $convenio = get_convenio($convenio_id);
}
if(isset($_POST["dentista"])){
$dentista_id = $_POST["dentista"];
$dentista = get_object_perfil($dentista_id)->nome;
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


$html = '<h1> Relatório de guias não pagas <small>do convênio <span class="convenio">'.$convenio.'</span></small></h1>';
$html .= '<h3>'.date("d/m/Y H:i:s").'</h3>';
$html .= '<table class="table-responsive table-sm simple">
<thead>
    <tr>
        <th>Guia</th>
        <th>Profissional</th>
        <th>Convênio</th>
        <th>Data e hora</th>
    </tr>
</thead>
<tbody>
    <tr class="space"><td></td><td></td><td></td><td></td></tr>';

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

$nome_relatorio = "relatorio_CONVENIO_guias_nao_pagas_".date("d_m_Y_H_i_s"); //reset
$mes_atual = 0; //reset

if(isset($convenio_id)){
$pesquisaguias = $mydb->query("SELECT * FROM guias WHERE convenio = ".$convenio_id." AND b_pago = 0 ORDER BY datahora DESC");
}else{
$pesquisaguias = $mydb->query("SELECT * FROM guias WHERE b_pago = 0 ORDER BY datahora DESC");
}

while($row = $pesquisaguias->fetch_assoc()){
$datetime = new DateTime($row["datahora"]);
$mes_novo = $datetime->format('m');
$ano_novo = $datetime->format('Y');

if($mes_novo != $mes_atual){
    $html .= "<tr><td colspan='4' class='month'>>> ".$meses[intval($mes_novo)]." de ".$ano_novo."</td></tr>";
}

$html .= "<tr>
<td>".$row["numero"]."</td>
<td>".get_object_perfil($row["dentista"])->nome."</td>
<td>".get_convenio($row["convenio"])."</td>
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