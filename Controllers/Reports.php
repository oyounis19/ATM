<?php
require_once '../Controllers/lib/PHPMailer/src/PHPMailer.php';
require_once 'DBconnector.php';
include('../Controllers/lib/TCPDF/tcpdf.php');

class Report{
    private $pdf;
    private $db;
    public function __construct(){
        $this->pdf = new TCPDF('P', 'mm', 'A4');
        $this->db = new DBConnector();
    }
    public function generateAdminPDF(){
        //remove deafault header and footer
        $this->pdf->setPrintFooter(false);
        $this->pdf->setPrintHeader(false);

        //Add 1 page
        $this->pdf->AddPage();
        // $this->pdf->Cell(190, 10, "this is a cell", 1, 1, 'C');
        
        $this->pdf->writeHTMLCell(190,1, '', '', '<h1 style="text-align: center;">ATMs Report</h1>',1, 1);
        $this->pdf->writeHTMLCell(31.66,0, '', '', '<h1 style="text-align: center;">ATM<br>ID</h1>',1, 0);
        $this->pdf->writeHTMLCell(31.66,0, '', '', '<h1 style="text-align: center;">ATM<br>City</h1>',1, 0);
        $this->pdf->writeHTMLCell(31.66,0, '', '', '<h1 style="text-align: center;">ATM<br>Street</h1>',1, 0);
        $this->pdf->writeHTMLCell(31.66,0, '', '', '<h1 style="text-align: center;">ATM<br>Area</h1>',1, 0);
        $this->pdf->writeHTMLCell(31.66,0, '', '', '<h1 style="text-align: center;">ATM Balance</h1>',1, 0);
        $this->pdf->writeHTMLCell(31.66,0, '', '', '<h1 style="text-align: center;">Need Service</h1>',1, 1);
        //Getting data from Database
        $result = $this->db->select("`ATM`","*");
        $columnsNames = array("ID", "City", "Street", "Area", "Balance");

        if(!$result){
            return false;
        }else{
            for($i=0; $i<sizeof($result); $i++){
                for($j=0; $j<sizeof($result[$i]); $j++){
                    $this->pdf->writeHTMLCell(31.66,20, '', '', '<h1 style="text-align: center;">'.$result[$i][$columnsNames[$j]].'</h1>',1, 0);
                }                
                if($result[$i]["Balance"] < 10000)
                    $this->pdf->writeHTMLCell(31.66,20, '', '', '<h1 style="text-align: center; color:red">Low Balance</h1>',1, 1);
                else
                    $this->pdf->writeHTMLCell(31.66,20, '', '', '<h1 style="text-align: center; color: green">Not Needed</h1>',1, 1);
            }
        }
        //Add content
        
        $this->pdf->Output();
    }

    public function generateTechPDF(){
        
    }
}
?>