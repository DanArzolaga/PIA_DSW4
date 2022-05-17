<?php
require_once '../../conexion.php';
require_once 'fpdf/fpdf.php';
$pdf = new FPDF('P', 'mm', array(80, 200));
$pdf->AddPage();
$pdf->SetMargins(5, 0, 0);
$pdf->SetTitle("Comanda");
$pdf->SetFont('Arial', 'B', 12);
$id = $_GET['v'];
$idmesa = $_GET['cl'];
$mesa = mysqli_query($conexion, "SELECT * FROM mesa WHERE IdMesa = $idmesa");
$datosC = mysqli_fetch_assoc($mesa);
$ventas = mysqli_query($conexion, "SELECT d.*, m.IdMenu, m.descripcion FROM comanda_detalle d INNER JOIN menu m ON d.id_menu = m.IdMenu WHERE d.id_comanda = $id");
$pdf->Cell(65, 5, utf8_decode('El Buen Sabor Mexicano'), 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(15, 5, utf8_decode("Teléfono: "), 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(15, 5, '83 22 77 10', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(15, 5, utf8_decode("Dirección: "), 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(15, 5, utf8_decode('Av. Universidad 470, San Nicolas de los Garza, N.L.'), 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(15, 5, "Correo: ", 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(15, 5, utf8_decode('contacto@buensazon.mx'), 0, 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(70, 5, "Datos de la Comanda", 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(30, 5, utf8_decode('Mesa'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(30, 5, utf8_decode($datosC['Descrip']), 0, 0, 'L');
$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(70, 5, "Detalle de Platillo", 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(30, 5, utf8_decode('Descripción'), 0, 0, 'L');
$pdf->Cell(10, 5, 'Cant.', 0, 0, 'L');
$pdf->Cell(15, 5, 'Precio', 0, 0, 'L');
$pdf->Cell(15, 5, 'Sub Total.', 0, 1, 'L');
$pdf->SetFont('Arial', '', 7);
$total = 0.00;
$desc = 0.00;
while ($row = mysqli_fetch_assoc($ventas)) {
    $pdf->Cell(30, 5, $row['descripcion'], 0, 0, 'L');
    $pdf->Cell(10, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->Cell(15, 5, $row['precio'], 0, 0, 'L');
    $sub_total = $row['total'];
    $total = $total + $sub_total;
    $pdf->Cell(15, 5, number_format($sub_total, 2, '.', ','), 0, 1, 'L');
}
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(65, 5, 'Total Pagar', 0, 1, 'R');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(65, 5, number_format($total, 2, '.', ','), 0, 1, 'R');

$pdf->Output("comanda.pdf", "I");

?>