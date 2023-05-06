<?php
require_once '../Controllers/lib/PHPMailer/src/PHPMailer.php';
include('../Controllers/lib/TCPDF/tcpdf.php');

class Report{
    private $pdf = new TCPDF('P', 'mm', 'A4');
    public function generateAdminPDF(){
        
        $this->pdf->setPrintFooter(false);
        $this->pdf->setPrintHeader(false);
        //Add 1 page
        $this->pdf->AddPage();

        //Add content
    }
}



?>