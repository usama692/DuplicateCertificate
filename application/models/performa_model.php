<?php
class performa_model extends CI_Model 
{
    public function __construct()
    {
        $this->load->database(); 
    }


    public function LoadCertificates($data)
    {
        //DebugBreak();

        @$rno = $data["rno"];
        @$cls = $data["cls"];
        @$year = $data["year"];
        @$sess = $data["sess"];

        if($cls == 9 || $cls == 10)
        {
            $query = $this->db->query("exec matric_new..matric_Results $rno,$cls,$year,$sess");    
        }
        else if($cls == 11 || $cls == 12)
        {
            $query = $this->db->query("exec matric_new..Inter_Results $rno,$cls,$year,$sess");
        }

        $rowcount = $query->num_rows();

        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }

    public function InsertApplicationFormModel($data)
    {

        //DebugBreak();

        $name = $data['name'];
        $fName = $data['fName'];
        $dob = $data['dob'];
        $bForm = $data['bForm'];
        $fNic = $data['fNic'];
        $cellNo = $data['cellNo'];
        $mrkOfInden = $data['mrkOfInden'];
        $permanentAddress = $data['permanentAddress'];
        $postalAddress = $data['postalAddress'];
        $strRegNo = $data['strRegNo'];
        $rno = $data['rno'];
        $cls = $data['cls'];
        $year = $data['year'];
        $sess = $data['sess'];
        $result1 = $data['result1'];
        $result2 = $data['result2'];
        $obt_mrk = $data['obt_mrk'];
        $instName = $data['instName'];
        $district = $data['district'];
        $type = $data['type'];
        $isUrgent = $data['isUrgent'];
        $reason = $data['reason'];
        $url = $data['url'];
        @$picPath = $data['picPath'];

        $query = $this->db->query("Exec Registration..spApplicationForDuplicate $rno, $cls, $year, $sess, '".$strRegNo."', $type, '".$name."', '".$fName."', '".$dob."', '".$bForm."', '".$fNic."', '".$cellNo."', '".$mrkOfInden."', '".$permanentAddress."', '".$postalAddress."', $district, $obt_mrk, '".$result1."', '".$result2."', '".$reason."', $isUrgent, '".$instName."', '".$url."', '".$picPath."' ");  

        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return -1;
        }
    }

    public function downloadApplicationFormByAppIdModel($appId)
    {    
        //DebugBreak();
        $query = $this->db->query("select * from Registration..tblApplicationForDuplicate where AppID = $appId");   
        $rowcount = $query->num_rows();

        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }
}
?>
