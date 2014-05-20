<?php
        require_once(Yii::app()->basePath.'/extensions/tcpdf/tcpdf_barcodes_1d.php');
        // set the barcode content and type
        $barcodeobj = new TCPDFBarcode($code, 'C128');
        // output the barcode as PNG image
        $barcodeobj->getBarcodePNG(2, 30, array(0,0,0));
?>
