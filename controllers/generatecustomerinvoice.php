<?php
    require_once("../models/db.php");
    require_once("../fpdf181/fpdf.php");
    require_once("../models/mail.php");

    $mail= new mail();
    $db=new db();
    $pdf=new FPDF('P','mm','A4');

    // A4 width is 219mm
    // Default margin is 10mm on each side
    // writable horizontal is 219-(10mm*2) = 189mm
    if (isset($_GET['getinvoicedetails'])) {
        $invoiceid=$_GET['invoiceid'];
        $printinvoice=$_GET['printinvoice'];
        // get institution details
        $sql="CALL spgetinstitutiondetails()";
        $rst=$db->getData($sql);
        if($rst->rowCount()){
            $companydetails=$rst->fetch(PDO::FETCH_ASSOC);
        }
        // get invoice details
        $sql="CALL spgetcustomerinvoicedetails({$invoiceid})";
        $rst=$db->getData($sql);
        if($rst->rowCount()){
           $invoicedetails= $rst->fetch(PDO::FETCH_ASSOC);
        } 
        $pdf->AddPage();
        $pdf->SetFont('Arial','B','14');
        // Cell(width,height,text,border, end line, [align])
        $pdf->Cell(130,5, $companydetails['companyname'],0,0);
        $pdf->Cell(59,5,'CUSTOMER INVOICE',0,1);

        // set font to arial regular 12
        $pdf->SetFont('Arial','','12');
        $pdf->Cell(130,5,'P. O Box '.$companydetails['address'],0,0);
        $pdf->Cell(59,5,'',0,1);

        $pdf->Cell(130,5,$companydetails['postalcode'].' '.$companydetails['town'],0,0);
        $pdf->Cell(24,5,'Date',0,0);
        $pdf->Cell(35,5,$invoicedetails['invoicedate'],0,1);

        $pdf->Cell(130,5,'Phone '.$companydetails['phone'],0,0);
        $pdf->Cell(24,5,'Invoice #',0,0);
        $pdf->Cell(35,5,$invoicedetails['invoicenumber'],0,1);

        $pdf->Cell(130,5,'Email '.$companydetails['email'],0,0);
        $pdf->Cell(24,5,'Customer #',0,0);
        $pdf->Cell(35,5,$invoicedetails['customerid'],0,1);

        // make a dummy vertical cell as a spacer
        $pdf->Cell(189,10,'',0,1);

        // billing address
        $pdf->Cell(100,5,'Bill to:',0,1);

        // add cell at the beginning of each line for indetation
        $pdf->Cell(10,5,'',0,0);
        $pdf->Cell(90,5,$invoicedetails['customername'],0,1);

        /*$pdf->Cell(10,5,'',1,0);
        $pdf->Cell(90,5,'[Company Name]',1,1);*/

        $pdf->Cell(10,5,'',0,0);
        $pdf->Cell(90,5,$invoicedetails['customeraddress'].' '.$invoicedetails['customerpostalcode'].' '.$invoicedetails['customertown'],0,1);

        $pdf->Cell(10,5,'',0,0);
        $pdf->Cell(90,5,$invoicedetails['customermobileno'],0,1);

        $pdf->Cell(10,5,'',0,0);
        $pdf->Cell(90,5,$invoicedetails['customeremail'],0,1);

        // make a dummy vertical cell as a spacer
        $pdf->Cell(189,5,'',0,1);

        // invoice contents
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(39,5,'Meter #',1,0);
        $pdf->Cell(30,5,'Prev Reading',1,0);
        $pdf->Cell(30,5,'Curr Reading',1,0);
        $pdf->Cell(30,5,'Quantity Used',1,0);
        $pdf->Cell(30,5,'Unit Price',1,0);
        $pdf->Cell(30,5,'Total',1,1);

        $pdf->SetFont('Arial','',10);
        // output the invoice details here
        // numbers are aligned so we give 'R' after end of line param
        $pdf->Cell(39,5,$invoicedetails['meterno'],1,0,'R');
        $pdf->Cell(30,5,$invoicedetails['previousreading'],1,0,'R');
        $pdf->Cell(30,5,$invoicedetails['currentreading'],1,0,'R');
        $pdf->Cell(30,5,$invoicedetails['currentreading']-$invoicedetails['previousreading'],1,0,'R');
        $pdf->Cell(30,5,$invoicedetails['priceperkg'],1,0,'R');
        $pdf->Cell(30,5,($invoicedetails['currentreading']-$invoicedetails['previousreading'])*$invoicedetails['priceperkg'],1,1,'R');
        // perform total
        $pdf->Cell(129,5,'',0,0);
        $pdf->Cell(30,5,'SUB-TOTAL',1,0,'R');
        $pdf->Cell(30,5,($invoicedetails['currentreading']-$invoicedetails['previousreading'])*$invoicedetails['priceperkg'],1,1,'R');
        // output pdf
        if($printinvoice==1){
            $pdf->OutPut();
        }else{
            $filename=mt_rand(1000,9999)."_".$invoicedetails['invoicenumber'].".pdf";
            $pdf->OutPut('F',"../documents/invoices/".$filename,true);
            // send email
            $recipient=$invoicedetails['customeremail'];
            $message="<p> Please find attached your invoice </p><p>Kind Regards</p>";
            $subject="Invoice # ".$invoicedetails['invoicenumber'];
            $sender=$_SESSION['username'];
            $attachment="../documents/invoices/".$filename;
            echo json_encode($mail->sendEmail($recipient,$subject,$message,$sender,$attachment)); 
        }
    }

?>