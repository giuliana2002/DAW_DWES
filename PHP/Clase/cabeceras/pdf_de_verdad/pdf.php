<?php

use Fpdf\Fpdf;

require_once __DIR__ . '/vendor/autoload.php';
require('vendor\fpdf\fpdf\src\Fpdf\Fpdf.php');

class PDF extends Fpdf
{
    function Header()
    {
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Título
        $this->Cell(0, 10, 'PDF LOCOOOO', 0, 1, 'C');
        // Salto de línea
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Crear una instancia de la clase PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Agregar contenido al PDF
$pdf->Cell(0, 10, 'Este es un documento PDF generado dinámicamente usando FPDF.', 0, 1);
$pdf->Cell(0, 10, 'Ta guapo el pdf eeeh.', 0, 1);
$pdf->Cell(0, 10, 'Puedes agregar texto, imágenes, tablas, etc.', 0, 1);
$pdf->Cell(0, 10, 'Esto solo es un ejemplo de las cosicas que se pueden hacer jejeje.', 0, 1);
$pdf->Ln(10);

// Nombre del archivo PDF
$nombreArchivoPDF = 'PDFGC.pdf';

// Enviar encabezados para forzar la descarga del archivo PDF
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $nombreArchivoPDF . '"');

// Enviar el contenido del PDF al navegador
$pdf->Output('D', $nombreArchivoPDF);
