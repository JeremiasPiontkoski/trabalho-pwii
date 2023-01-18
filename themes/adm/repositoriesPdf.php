<?php
use Dompdf\Dompdf;

$dompdf = new Dompdf();

$html = "<table border='1'>";
$html .= "<thead>";
$html .= "<tr>";
$html .= "<td>Id:</td>";
$html .= "<td>Id Usuário:</td>";
$html .= "<td>Nome:</td>";
$html .= "<td>Linguagem:</td>";
$html .= "<td>Proprietário:</td>";
$html .= "<td></td>";
$html .= "</tr>";
$html .= "</thead>";

foreach ($repositories as $repository) {
    $html .= "<tbody>";
    $html .= '<tr><td>' . $repository["id"] . "</td>";
    $html .= '<td>' . $repository["idPerson"] . "</td>";
    $html .= '<td>' . $repository["name"] . "</td>";
    $html .= '<td>' . $repository["language"] . "</td>";
    $html .= '<td>' . $repository["user"]["name"] . "</td></tr>";
    $html .= "</tbody>";
}

$html .= '</table>';

$dompdf->loadHtml(
    '
    <h1>Lista de Repositórios do sistema</h1>
     '. $html .'
');

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

//$dompdf->stream(
//    "relatorio_users.pdf", array(
//    "Attachment" => true
//));

$dompdf->stream("relatorio_repositorios");