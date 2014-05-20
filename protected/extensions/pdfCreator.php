<?php
/**
 * @abstract This Component Class is created to access TCPDF plugin for generating reports.
 * @example You can refer http://www.tcpdf.org/examples/example_011.phps for more details for this example.
 * @todo you can extend tcpdf class method according to your need here. You can refer http://www.tcpdf.org/examples.php section for 
 *       More working examples.
 * @version 1.0.0
 */
require_once(dirname(__FILE__).'/tcpdf/tcpdf.php');
class pdfCreator extends TCPDF {
 
    // Load table data from file
    public function LoadData($data) {
        // Read file lines
        return $data;
    }
}
?>
