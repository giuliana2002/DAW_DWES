<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpZip\ZipFile;

try {
    $zipFile = new ZipFile();

    $zipFile->addFile(__DIR__ . '/archivos/archivo.txt', 'archivo.txt');
    $zipFile->addFile(__DIR__ . '/archivos/descarga.jpeg', 'descarga.jpeg');
    $zipFile->addFile(__DIR__ . '/archivos/archivo3.pdf', 'archivo3.pdf');

   
    $nombreArchivoZip = 'archivosZIPGC.zip';

    // Generar el contenido del archivo ZIP y calcular su tamaño
    $contenidoZip = $zipFile->outputAsString();
    $tamanoZip = strlen($contenidoZip);

    // Configurar encabezados para forzar la descarga
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="' . $nombreArchivoZip . '"');
    header('Content-Length: ' . $tamanoZip);

    // Enviar el contenido del archivo ZIP al navegador
    echo $contenidoZip;

    // Cerrar el archivo ZIP para liberar recursos
    $zipFile->close();
} catch (\PhpZip\Exception\ZipException $e) {
    echo 'Error al crear el archivo ZIP: ', $e->getMessage();
} finally {
    // Cierra el archivo ZIP si no se ha cerrado
    if (isset($zipFile) && $zipFile instanceof ZipFile) {
        $zipFile->close();
    }
}
