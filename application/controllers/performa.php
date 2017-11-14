<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Performa extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');   
        $this->clear_cache();
    }
    function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
    public function index()
    {             
        $this->load->library('session');
        if($this->session->flashdata('error'))
        {
            $error = array('error'=>$this->session->flashdata('error'));  
        }
        else
        {
            $error = array('error'=>"");
        }

        $this->load->view('Performa/duplicateResultCardHeader.php');
        $this->load->view('Performa/performaView.php',$error);
        $this->load->view('Performa/duplicateResultCardFooter.php');
    }

    public function downloadApplicationFormByAppId()
    {
        //DebugBreak();

        @$appId = @$_POST['appId'];
        $this->load->model('performa_model'); 
        $val = $this->performa_model->downloadApplicationFormByAppIdModel($appId);

        if($val == true)
        {
            @$appId = $val['0']['AppID'];
            @$rno = $val['0']['rno'];
            @$cls = $val['0']['class'];
            @$year = $val['0']['mYear'];
            @$sess = $val['0']['sess'];
            if(@$sess == 1)@$sess = "A";else if(@$sess == 2) @$sess = "S";else @$sess = "";
            @$strRegNo = $val['0']['RegNo'];
            @$type = $val['0']['ApplicationType'];
            @$name = $val['0']['Name'];
            @$fName = $val['0']['FName'];
            @$dob = $val['0']['DOB'];
            @$dob = date("d-m-Y", strtotime($dob));
            @$bForm = $val['0']['CNIC'];
            @$fNic = $val['0']['FNIC'];
            @$cellNo = $val['0']['CellNo'];
            @$mrkOfInden = $val['0']['MarkOfIdentity'];
            @$permanentAddress = $val['0']['PermanentAddress'];
            @$postalAddress = $val['0']['PostalAddress'];
            @$district = $val['0']['dist_cd'];
            if(@$district == 1) @$district = "GUJRANWALA";else if(@$district == 2) @$district = "GUJRAT";else if(@$district == 3) @$district = "HAFIZABAD";else if(@$district == 4) @$district = "MANDI BAHA-UD-DIN";else if(@$district == 5) @$district = "NAROWAL";else if(@$district == 6) @$district = "SIALKOT";else @$district ="";
            @$obt_mrk = $val['0']['Obt_mrk'];
            @$result1 = $val['0']['result1'];
            @$result2 = $val['0']['result2'];
            @$reason = $val['0']['Reason'];
            @$instName = $val['0']['InstitutionName'];
            @$fee = $val['0']['Fee'];
            @$formFee = $val['0']['FormFee'];
            @$totalFee = $val['0']['TotalFee'];
            @$challanForm = $val['0']['ChallanForm'];
            @$isUrgent =  $val['0']['IsUrgent'];
            if(@$isUrgent == 0) @$isUrgent = "Ordinary"; else if(@$isUrgent == 1)@$isUrgent = "URGENT";else @$isUrgent = "";
            @$isActive =  $val['0']['IsActive'];
            @$picPath = $val['0']['picPath'];  


            $this->load->library('NumbertoWord');
            $obj    = new NumbertoWord();
            $obj->toWords($totalFee,"Only.","");
            $feeInWords = ucwords($obj->words);

            $this->load->library('pdf_rotate');
            $pdf = new pdf_rotate('P','in',"A4");
            $lmargin =1.5;
            $rmargin =7.3;
            $pdf ->SetRightMargin(80);

            $pdf->AddPage();
            $x = 0.55;
            $Y = -0.20;

            //------------Logo and Title--------------------------

            $pdf->Image("assets/img/logo2.png",0.65, 0.17, 0.65, 0.65, "PNG");
            $pdf->Image(base_url()."uplaods/DuplicateCertificatesPics/".$appId.".jpg",6.8, 1.24, 1, 1, "jpg");

            $pdf->SetFont('Arial','BU',13);
            $pdf->SetXY(1.3,0.2);
            $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");

            $pdf->SetFont('Arial','',11);
            $pdf->SetXY(2.6,0.5);

            if($type == 1){
                $pdf->Cell(0, 0, "Obtain Before Time Certificate(OBTC) Application Form", 0.25, "C");    
            }
            else if($type == 2)
            {
                $pdf->Cell(0, 0, "Duplicate Certificate Application Form", 0.25, "C");       
            }
            else if($type == 3)
            {
                $pdf->Cell(0, 0, "Duplicate Result Card Application Form", 0.25, "C");       
            }
            //------------End Logo and Title--------------------------

            //------------Barcode --------------------------
            $Barcode = $appId."@".$cls.'@'.$year.'@'.$sess.'@'.$challanForm;
            $image =  $this->set_barcode($Barcode);
            $pdf->Image(BARCODE_PATH.$image,2.8, 0.65  ,2.4,0.24,"PNG");
            //------------End Barcode--------------------------

            //------------Application ID--------------------------
            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.6,0.8);
            $pdf->Cell(0, 0.2, "Application:", 0.25, "C");

            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(1.7,0.8);
            $pdf->Cell(0, 0.2,$appId , 0.25, "C");

            //------------Urgent/Ordinary--------------------------
            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.6,1.0);
            $pdf->Cell(0, 0.2, "Type:", 0.25, "C");

            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(1.7,1.0);
            $pdf->Cell(0, 0.2,$isUrgent , 0.25, "C");

            //------------Name--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,1.2);
            $pdf->Cell(0, 0.2, "Name:", 0.25, "C");

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.7,1.2);
            $pdf->Cell(0, 0.2,$name , 0.25, "C");
            //------------Father Name--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,1.4);
            $pdf->Cell(0, 0.2, "Father Name:", 0.25, "C");

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.7,1.4);
            $pdf->Cell(0, 0.2,$fName , 0.25, "C");

            //------------Bform No--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(4.0,1.2);
            $pdf->Cell(0, 0.2, "Bay Form No:", 0.25, "C");

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(5.2,1.2);
            $pdf->Cell(0, 0.2,$bForm , 0.25, "C");

            //------------Father CNIC--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(4.0,1.4);
            $pdf->Cell(0, 0.2, "Father CNIC:", 0.25, "C");

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(5.2,1.4);
            $pdf->Cell(0, 0.2,$fNic , 0.25, "C");

            //------------Date of Birth--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,1.6);
            $pdf->Cell(0, 0.2, "Date of Birth:", 0.25, "C");

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.7,1.6);
            $pdf->Cell(0, 0.2,$dob , 0.25, "C");

            //------------Cell No--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(4.0,1.6);
            $pdf->Cell(0, 0.2, "Mobile No:", 0.25, "C");

            $pdf->SetFont('Arial','B',8);  
            $pdf->SetXY(5.2,1.6);
            $pdf->Cell(0, 0.2,$cellNo , 0.25, "C");

            //------------Registration No--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,1.8);
            $pdf->Cell(0, 0.2, "Registration No:", 0.25, "C");

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.7,1.8);
            $pdf->Cell(0, 0.2,$strRegNo , 0.25, "C");

            //------------Examination Info--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,2.0);
            $pdf->Cell(0, 0.2, "Exam Info:", 0.25, "C");

            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.7,2.0);
            $pdf->Cell(0, 0.2,$rno." (" .$cls."th".", ".$sess.", ".$year." )", 0.25, "C");

            //------------Mark of Identitification--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(4.0,1.8);
            $pdf->Cell(0, 0.2, "Identification Mark:", 0.25, "C");

            $pdf->SetFont('Arial','B',8);  
            $pdf->SetXY(5.2,1.8);
            $pdf->Cell(0, 0.2,$mrkOfInden , 0.25, "C");

            //------------Permanent Adress--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,2.3);
            $pdf->MultiCell(6.0, 0.10,"Permanent Address" ,0, "L",0);

            $pdf->SetFont('Arial','B',7);
            $pdf->SetXY(1.7,2.3);
            $pdf->MultiCell(6.0, 0.10,$permanentAddress ,0, "L",0);


            //------------Postal Adress--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,2.6);
            $pdf->MultiCell(6.0, 0.10,"Postal Address" ,0, "L",0);

            $pdf->SetFont('Arial','B',7);
            $pdf->SetXY(1.7,2.6);
            $pdf->MultiCell(6.0, 0.10,$postalAddress ,0, "L",0);

            //------------District Name--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(4.0,2.0);
            $pdf->Cell(0, 0.2, "District Name:", 0.25, "C");

            $pdf->SetFont('Arial','B',8);  
            $pdf->SetXY(5.2,2.0);
            $pdf->Cell(0, 0.2,$district , 0.25, "C");            

            //if($RegPvt == 1)
            //{
            //------------Institute Name--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,2.8);
            $pdf->Cell(0, 0.2, "Institute Name:", 0.25, "C");

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.7,2.8);
            $pdf->Cell(0, 0.2,$instName , 0.25, "C");
            // }

            //------------Reason Name--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,3.0);
            $pdf->Cell(0, 0.2, "Reason:", 0.25, "C");

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.7,3.0);
            $pdf->Cell(0, 0.2,$reason , 0.25, "C");

            //------------Affidavit--------------------------
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(0.6,3.2);
            $pdf->Cell(0, 0.2, "Affidavit:", 0.25, "C");

            $pdf->SetFont('Arial','U',9);
            $pdf->SetXY(1.7,3.2);
            $pdf->MultiCell(6.0, .15,"It is certify that all the above information is correct and if i make any mistake then the BOARD \nwill authorise to take necessary action against me." ,0, "L",0);

            //------------Candidate Signature in Urdu--------------------------
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(0.6,3.6);
            $pdf->MultiCell(1.2, 0.15, "Candidate Signature in Urdu:" ,0, "L",0);

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.7,3.7);
            $pdf->Cell(0, 0.2,"___________________________" , 0.25, "C");

            //------------Candidate Signature in English--------------------------
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(0.6,4.2);
            $pdf->MultiCell(1.2, 0.15, "Candidate Signature in English:" ,0, "L",0);

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.7,4.3);
            $pdf->Cell(0, 0.2,"___________________________" , 0.25, "C");                                               



            //------------Stamp/Signature--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(4.0,3.8);
            $pdf->MultiCell(1.381, 0.10, "Stamp/Signature Headmaster/Headmistres/Principal Head of Institute Name:",0, "L",0);

            $pdf->SetFont('Arial','B',8);  
            $pdf->SetXY(4.0,4.3);
            $pdf->Cell(0, 0.2,"CNIC:  _________________________________" , 0.25, "C");                                               


            //------------Recent Photo Section--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(6.8,3.5);
            $pdf->MultiCell(1.1, 0.25, "Paste recent photograph & must be cross attested by the Head/Deputy Head of Institution",1, "L",0);


            //------------Thumb Section-------------------------- 
            $pdf->SetXY(6.8,4.95);
            $pdf->Cell(1.1,0.60,'',1,0,'C',0); 
            $pdf->SetXY(6.8,5.30);
            $pdf->SetFont('Arial','B',7);
            $pdf->MultiCell(1.1,0.25, 'Thumb Impression',0,'C'); 

            //------------Branch Copy-------------------------- 
            $pdf->SetFont('Arial','B',8);  
            $pdf->SetXY(0.6,4.6);
            $pdf->Cell(0, 0.2,"Branch Copy" , 0.25, "C");  

            //------------Due Date--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,4.8);
            $pdf->SetFillColor(0,0,0);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(2.6,0.2,'Due Date: '.date("d-m-y",strtotime("+10 days")),1,0,'C',1); 

            //------------Printing Date--------------------------
            $pdf->SetFont('Arial','B',7);
            $pdf->SetXY(1.4,4.6);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0,0.2,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

            //------------Student Name--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,5.0);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"Students Name:  ".$name , 0.25, "C");  

            //------------Total Fee--------------------------
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(0.6,5.2);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"Total Amount Rs.  ".$totalFee."/-" , 0.25, "C");  


            //------------CMD Account No--------------------------
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.0,4.8);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"CMD Account No.  00427900072103" , 0.25, "C");  


            //------------Bank Challan No--------------------------
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.0,5.0);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"Bank Challan No.".$challanForm , 0.25, "C");  


            //------------Amount in Words--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,5.4);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"Amount In Words:" , 0.25, "C");  

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.6,5.4);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,ucwords($feeInWords), 0.25, "C");  

            //------------Manager/Cashier--------------------------
            $pdf->SetFont('Arial','B',7);
            $pdf->SetXY(4.0,5.4);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"Manager/Cashier: _____________________________", 0.25, "C");  

            $pdf->Image(base_url().'assets/img/cutter.jpg',0.2,5.6, 9.2,0.09, "jpeg"); 

            //------------Candidate Copy-------------------------- 

            $pdf->SetFont('Arial','U',10);
            $pdf->SetXY(1.7,5.7);
            $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(2.6,6.0);

            if($type == 1){
                $pdf->Cell(0, 0, "Obtain Before Time Certificate(OBTC) Application Form", 0.25, "C");    
            }
            else if($type == 2)
            {
                $pdf->Cell(0, 0, "Duplicate Certificate Application Form", 0.25, "C");       
            }
            else if($type == 3)
            {
                $pdf->Cell(0, 0, "Duplicate Result Card Application Form", 0.25, "C");       
            }
            //------------End Logo and Title--------------------------

            //------------Barcode --------------------------
            $Barcode = $appId."@".$cls.'@'.$year.'@'.$sess.'@'.$challanForm;
            $image =  $this->set_barcode($Barcode);
            $pdf->Image(BARCODE_PATH.$image,5.5, 6.1,2.4,0.24,"PNG");


            $pdf->SetFont('Arial','B',8);  
            $pdf->SetXY(0.6,6.1);
            $pdf->Cell(0, 0.2,"Candidate Copy" , 0.25, "C");          
            //------------Due Date--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,6.3);
            $pdf->SetFillColor(0,0,0);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(2.6,0.2,'Due Date: '.date("d-m-y",strtotime("+10 days")),1,0,'C',1); 

            //------------Printing Date--------------------------
            $pdf->SetFont('Arial','B',7);
            $pdf->SetXY(1.6,6.1);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0,0.2,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

            //------------Student Name--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,6.5);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"Students Name:  ".$name , 0.25, "C");  

            //------------Total Fee--------------------------
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(0.6,6.7);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"Total Amount Rs.  ".$totalFee."/-" , 0.25, "C");  


            //------------Application ID--------------------------
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.0,6.2);
            $pdf->Cell(0, 0.2, "Application Id:  ".$appId, 0.25, "C");

            //------------CMD Account No--------------------------
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.0,6.4);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"CMD Account No.  00427900072103" , 0.25, "C");  


            //------------Bank Challan No--------------------------
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.0,6.6);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"Bank Challan No.".$challanForm , 0.25, "C");  

            //------------Amount in Words--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,6.9);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"Amount In Words:" , 0.25, "C");  

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.6,6.9);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,ucwords($feeInWords), 0.25, "C");  

            //------------Manager/Cashier--------------------------
            $pdf->SetFont('Arial','B',7);
            $pdf->SetXY(4.0,6.9);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"Manager/Cashier:  _______________________________", 0.25, "C");  


            $pdf->SetXY(6.8,6.4);
            $pdf->Cell(1.2,0.65,'',1,0,'C',0); 
            $pdf->SetXY(6.9,6.8);
            $pdf->SetFont('Arial','b',12);
            $pdf->MultiCell(1.1,0.2, 'O.W.O',0,'C'); 

            $pdf->Image(base_url().'assets/img/cutter.jpg',0.2,7.1, 9.2,0.09, "jpeg"); 


            //------------Board Copy-------------------------- 


            $pdf->SetFont('Arial','U',10);
            $pdf->SetXY(1.7,7.2);
            $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(2.6,7.5);

            if($type == 1){
                $pdf->Cell(0, 0, "Obtain Before Time Certificate(OBTC) Application Form", 0.25, "C");    
            }
            else if($type == 2)
            {
                $pdf->Cell(0, 0, "Duplicate Certificate Application Form", 0.25, "C");       
            }
            else if($type == 3)
            {
                $pdf->Cell(0, 0, "Duplicate Result Card Application Form", 0.25, "C");       
            }
            //------------End Logo and Title--------------------------

            //------------Barcode --------------------------
            $Barcode = $appId."@".$cls.'@'.$year.'@'.$sess.'@'.$challanForm;
            $image =  $this->set_barcode($Barcode);
            $pdf->Image(BARCODE_PATH.$image,5.5, 7.6  ,2.4,0.24,"PNG");


            $pdf->SetFont('Arial','B',8);  
            $pdf->SetXY(0.6,7.6);
            $pdf->Cell(0, 0.2,"Board Copy(Along with Scroll)" , 0.25, "C");          
            //------------Due Date--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,7.8);
            $pdf->SetFillColor(0,0,0);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(2.6,0.2,'Due Date: '.date("d-m-y",strtotime("+10 days")),1,0,'C',1); 

            //------------Printing Date--------------------------
            $pdf->SetFont('Arial','B',7);
            $pdf->SetXY(2.3,7.6);
            $pdf->SetTextColor( 0,0,0);
            $pdf->Cell(0,0.2,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

            //------------Student Name--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,8.0);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"Students Name:  ".$name , 0.25, "C");  

            //------------Total Fee--------------------------
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(0.6,8.2);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"Total Amount Rs.  ".$totalFee."/-" , 0.25, "C");  


            //------------Application ID--------------------------
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.0,7.8);
            $pdf->Cell(0, 0.2, "Application Id:  ".$appId, 0.25, "C");

            //------------CMD Account No--------------------------
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.0,8.0);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"CMD Account No.  00427900072103" , 0.25, "C");  


            //------------Bank Challan No--------------------------
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.0,8.2);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"Bank Challan No.".$challanForm , 0.25, "C");  

            //------------Amount in Words--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,8.4);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"Amount In Words:" , 0.25, "C");  

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.6,8.4);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,ucwords($feeInWords), 0.25, "C");  

            //------------Manager/Cashier--------------------------
            $pdf->SetFont('Arial','B',7);
            $pdf->SetXY(4.0,8.4);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"Manager/Cashier:  _______________________________", 0.25, "C");  

            $pdf->Image(base_url().'assets/img/cutter.jpg',0.2,8.6, 9.2,0.09, "jpeg"); 



            //------------Bank Copy-------------------------- 


            $pdf->SetFont('Arial','U',10);
            $pdf->SetXY(1.7,8.8);
            $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(2.6,9.1);

            if($type == 1){
                $pdf->Cell(0, 0, "Obtain Before Time Certificate(OBTC) Application Form", 0.25, "C");    
            }
            else if($type == 2)
            {
                $pdf->Cell(0, 0, "Duplicate Certificate Application Form", 0.25, "C");       
            }
            else if($type == 3)
            {
                $pdf->Cell(0, 0, "Duplicate Result Card Application Form", 0.25, "C");       
            }
            //------------End Logo and Title--------------------------

            //------------Barcode --------------------------
            $Barcode = $appId."@".$cls.'@'.$year.'@'.$sess.'@'.$challanForm;
            $image =  $this->set_barcode($Barcode);
            $pdf->Image(BARCODE_PATH.$image,5.5, 9.2  ,2.4,0.24,"PNG");


            $pdf->SetFont('Arial','B',8);  
            $pdf->SetXY(0.6,9.2);
            $pdf->Cell(0, 0.2,"Bank Copy" , 0.25, "C");          
            //------------Due Date--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,9.4);
            $pdf->SetFillColor(0,0,0);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(2.6,0.2,'Due Date: '.date("d-m-y",strtotime("+10 days")),1,0,'C',1); 

            //------------Printing Date--------------------------
            $pdf->SetFont('Arial','B',7);
            $pdf->SetXY(1.6,9.2);
            $pdf->SetTextColor( 0,0,0);
            $pdf->Cell(0,0.2,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

            //------------Student Name--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,9.6);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"Students Name:  ".$name , 0.25, "C");  

            //------------Total Fee--------------------------
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(0.6,9.8);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"Total Amount Rs.  ".$totalFee."/-" , 0.25, "C");  


            //------------Application ID--------------------------
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.0,9.4);
            $pdf->Cell(0, 0.2, "Application Id:  ".$appId, 0.25, "C");

            //------------CMD Account No--------------------------
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.0,9.6);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"CMD Account No.  00427900072103" , 0.25, "C");  


            //------------Bank Challan No--------------------------
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.0,9.8);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"Bank Challan No.".$challanForm , 0.25, "C");  

            //------------Amount in Words--------------------------
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.6,10.0);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"Amount In Words:" , 0.25, "C");  

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.6,10.0);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,ucwords($feeInWords), 0.25, "C");  

            //------------Manager/Cashier--------------------------
            $pdf->SetFont('Arial','B',7);
            $pdf->SetXY(4.0,10.4);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0, 0.2,"Manager/Cashier:  _______________________________", 0.25, "C");

            $pdf->Output('testingform', 'I');

        }         
    }

    public function formdownloaded()
    {
        //DebugBreak();

        @$appId = $this->uri->segment(3);
        $data['appId'] = $appId;
        $this->load->view('Performa/duplicateResultCardHeader.php');
        $this->load->view('Performa/duplicateResultCardFormDownload.php',array('data'=>$data));
        $this->load->view('Performa/duplicateResultCardFooter.php');
    }

    public function LoadData()
    {
        //DebugBreak();

        $this->load->library('session');
        $this->load->model('performa_model'); 

        $type = $_POST["type"]; 
        $rno = $_POST["rno"];
        $cls = $_POST["cls"];
        $year = $_POST["year"];
        $sess = $_POST["sess"];
        $isUrgent = $_POST["isUrgent"];

        $data['rno'] = $rno;
        $data['cls'] = $cls;
        $data['year'] = $year;
        $data['sess'] = $sess;
        $data['isUrgent'] = $isUrgent;

        $data = $this->performa_model->LoadCertificates($data);

        $error_msg = '';
        if(!$data){
            $error_msg.='Record Not Found Against Your Criteria';
            $this->load->library('session');
            $mydata = array('data'=>$_POST,'error_msg'=>$error_msg);
            $this->session->set_flashdata('error',$mydata );
            redirect('Performa/index');
        }

        else
        {
            $this->load->view('Performa/duplicateResultCardHeader.php');
            $this->load->view('Performa/resultCardFormView.php',array('data'=>$data));
            $this->load->view('Performa/duplicateResultCardFooter.php');
        }                                                                     
    }

    private function set_barcode($code)
    {                             
        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');
        $file = Zend_Barcode::draw('code128','image', array('text' => $code,'drawText'=>false), array());
        $store_image = imagepng($file,BARCODE_PATH."{$code}.png");
        return $code.'.png';
    }

    public function InsertApplicationForm()
    {
        //DebugBreak();

        $this->load->model('performa_model');
        $this->load->library('session');
        @$name = strtoupper(@$_POST['name']);
        @$fName = strtoupper(@$_POST['fName']);
        if(@$_POST['dob'] == ""){@$dob = @$_POST['dob1'];}else{@$dob = @$_POST['dob'];}
        if(@$_POST['dob1'] == ""){@$dob = @$_POST['dob'];}else{@$dob = @$_POST['dob1'];}
        $dob = date("Y-m-d", strtotime($dob));
        @$bForm = @$_POST['bForm'];
        @$fNic = @$_POST['fNic'];
        @$cellNo = @$_POST['cellNo'];
        @$mrkOfInden = strtoupper(@$_POST['mrkOfInden']);
        @$permanentAddress = strtoupper(@$_POST['permanentAddress']);
        @$postalAddress = strtoupper(@$_POST['postalAddress']);
        @$strRegNo = @$_POST['strRegNo'];
        @$rno = @$_POST['rno'];
        @$cls = @$_POST['Class'];
        @$year = @$_POST['year'];
        @$sess = @$_POST['session'];
        @$result1 = @$_POST['result1'];
        @$result2 = @$_POST['result2'];
        @$obt_mrk = @$_POST['obt_mrk'];
        @$RegPvt = @$_POST['RegPvt'];
        if($RegPvt == 1){if($cls == 9 || $cls == 10){$instCd = @$_POST['Sch_Cd'];}else if($cls == 11 || $cls == 12){$instCd = @$_POST['coll_cd'];}@$district = @$_POST['districtRegular'];}else{$instCd = 999999;@$district = @$_POST['districtPvt'];}
        @$type = @$_POST['type'];
        @$isUrgent = @$_POST['isUrgent'];
        @$reason = strtoupper(@$_POST['reason']);
        @$instName = @$_POST['instName'];
        @$url = base_url(uri_string());
        @$picPath = $this->session->userdata('picname');

        $data = array(

            'name' =>@$name,
            'fName' =>@$fName,
            'dob' =>@$dob,
            'bForm' =>@$bForm,
            'fNic' =>@$fNic,
            'cellNo' =>@$cellNo,
            'mrkOfInden' =>@$mrkOfInden,
            'permanentAddress' =>@$permanentAddress,
            'postalAddress' =>@$postalAddress,
            'strRegNo' =>@$strRegNo,
            'rno' =>@$rno,
            'cls' =>@$cls,
            'year' =>@$year,
            'sess' =>@$sess,
            'result1' =>@$result1,
            'result2' =>@$result2,
            'obt_mrk' =>@$obt_mrk,
            'instCd' =>@$instCd,
            'district' =>@$district,
            'type' =>@$type,
            'isUrgent' =>@$isUrgent,
            'reason' =>@$reason,
            'instName' =>@$instName,
            'url' =>@$url,
            'picPath' =>@$picPath


        );

        //DebugBreak();

        $val = $this->performa_model->InsertApplicationFormModel($data);

        $info =  '';
        foreach($val[0] as $key=>$val1)
        {
            if($key == 'AppID')
            {
                if($val[0]['picPath'] != '')
                {
                    $oldpath = 'D:\Xampp\htdocs\Inter_Admission\uplaods\DuplicateCertificatesPics\\'.$val[0]['picPath']; 
                    $newpath =  'D:\Xampp\htdocs\Inter_Admission\uplaods\DuplicateCertificatesPics\\'.$val1.'.jpg';
                    $err = rename($oldpath,$newpath); 
                }
                $info['error'] = 1;
                $info['AppID'] = $val;
            }
            else if($key == 'error')
            {
                $info['error'] = $val;
                $info['AppID'] = '';
            }
        }
        echo  json_encode($info);

    }

    public function uploadpic()  
    {
        //DebugBreak();

        $this->load->library('session');
        $this->session->unset_userdata('picname');

        $config["generate_image_file"]            = true;
        $config["generate_thumbnails"]            = false;
        $config["image_max_size"]                 = 150;
        $config["thumbnail_size"]                  = 200;
        $config["image_prefix"]                 = "duplicate_";
        $config["thumbnail_prefix"]                = "thumb_"; 
        $config["destination_folder"]            = 'D:\Xampp\htdocs\Inter_Admission\uplaods\DuplicateCertificatesPics\\';
        $config["thumbnail_destination_folder"]    = ''; 
        $config["quality"]                         = 90;
        $config["random_file_name"]                = true;

        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            exit;
        }

        $config["file_data"] = $_FILES["__files"]; 
        $this->load->library('ImageResize');
        $im = new ImageResize(); 

        try
        {
            $responses = $im->resize($config);
            foreach($responses["images"] as $response)
            {
                $this->session->set_userdata('picname', $response);
            }
        }
        catch(Exception $e)
        {
            echo '<div class="error">';
            echo $e->getMessage();
            echo '</div>';
        }

        return $response;
    }

    public function validateForm()
    {          

        //DebugBreak();

        $msg['excep'] = '';

        if(@$_POST['name'] == '' )
        {
            $msg['excep'] = 'Please Enter Your Name';
        }
        else if(@$_POST['fName'] == '' )
        {
            $msg['excep'] = 'Please Enter Your Fathers Name';
        }

        else if(@$_POST['fNic'] == '')
        {
            $msg['excep'] = 'Please Enter Fathers CNIC';
        }

        else if(@$_POST['bForm'] == '')
        {
            $msg['excep'] = 'Please Enter B-FORM No';
        }

        else if(@$_POST['cellNo'] == '')
        {
            $msg['excep'] = 'Please Enter Cell No.';
        }  

        else if(@$_POST['mrkOfInden'] == '')
        {
            $msg['excep'] = 'Please Enter Mark of Identification.';
        } 

        else if(@$_POST['permanentAddress'] == '')
        {
            $msg['excep'] = 'Please Enter Permanent Adress.';
        } 

        else if(@$_POST['postalAddress'] == '')
        {
            $msg['excep'] = 'Please Enter Postal Adress.';
        } 

        else if(@$_POST['districtRegular'] == 0)
        {
            if(@$_POST['RegPvt'] == 1)
            {
                $msg['excep'] = 'Please Select District.';    
            }
        } 

        else if(@$_POST['districtPvt'] == 0)
        {
            if(@$_POST['RegPvt'] == 2)
            {
                $msg['excep'] = 'Please Select District.';    
            }
        } 

        else if(@$_POST['obt_mrk'] == '')
        {
            $msg['excep'] = 'Please Enter Marks Obtained.';
        } 

        else if(@$_POST['reason'] == '')
        {
            $msg['excep'] = 'Please Describe Reason.';
        } 

        else if(@$_POST['terms'] != yes)
        {
            $msg['excep'] = 'Please Accept the Terms and Condition for Further Process.';
        }

        if($msg['excep'] == '')
        {
            $msg['excep'] =  'Success';
        }

        echo json_encode($msg);
    }
}