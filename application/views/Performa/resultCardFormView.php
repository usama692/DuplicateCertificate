

<form method="post" action="<?php echo base_url(); ?>/index.php/Performa/InsertApplicationForm" name="myform" id="myform">
    <?php
    @$mysg = @$error['error_msg'];
    if(@$mysg != "")
    {
        ?>
        <div class="alert alert-danger fade in alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong><?php echo $mysg ?> </strong></div>
        <?php
    }   
    ?>
    <h3 class="bold">Personal Information</h3>

    <div class="form-group">
        <img id="previewImg" style="width:140px; height: 140px;" class="img-rounded" src="<?php echo base_url(); ?>assets/img/no_image.png" alt="Candidate Image">
    </div>

    <div class="form-group">
        <div id="progress-wrp"><div class="progress-bar"></div ><div class="status">0%</div></div>
        <input type="file" id="image" name="__files[]">
    </div>


    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" required="required" value="<?php echo @$data[0]['Name'] ?>" readonly="readonly">
    </div>

    <div class="form-group">
        <label for="fName">Father Name:</label>
        <input type="text" class="form-control" id="fName" name="fName" required="required" value="<?php echo @$data[0]['Fname'] ?>" readonly="readonly">
    </div>

    <?php


    if((@$data[0]['Class'] == 9 || @$data[0]['Class'] == 10) && (@$data[0]['dob'] != '' || @$data[0]['dob'] != null || @$data[0]['dob'] != undefined))    
    {
        ?>
        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="text" class="form-control" id="dob" name="dob" required="required" value="<?php echo @$data[0]['dob'] ?>" readonly="readonly">
        </div>
        <?php
    }
    else
    {
        ?>
        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="text" class="form-control" id="dob1" name="dob1" placeholder="Choose Date of Birth" required="required" readonly="readonly">
        </div>    
        <?php
    }     
    ?>

    <?php
    if(@$data[0]['FNIC'] == "")
    {
        ?>

        <div class="form-group">
            <label for="fNic">Father CNIC:</label>
            <input type="text" class="form-control" id="fNic" name="fNic" required="required">
        </div>

        <?php
    }      else{
        ?>

        <div class="form-group">
            <label for="fNic">Father CNIC:</label>
            <input type="text" class="form-control" id="fNic" name="fNic" required="required" value="<?php echo @$data[0]['FNIC'] ?>" readonly="readonly">
        </div>

        <?php
    }
    ?>

    <div class="form-group">
        <label for="bForm">B-Form/CNIC:</label>
        <input type="text" class="form-control" id="bForm" name="bForm" required="required">
    </div>

    <div class="form-group">
        <label for="cellNo">Cell No:</label>
        <input type="text" class="form-control" id="cellNo" name="cellNo"  placeholder="0300-123456789" required="required">
    </div> 

    <div class="form-group">
        <label for="mrkOfInden">Mark of Identification:</label>
        <input type="text" class="form-control" id="mrkOfInden" name="mrkOfInden" required="required" value="<?php echo @$data[0]['markOfIden'] ?>" >
    </div>

    <?php
    if(@$data[0]['Addr'] == "")
    {
        ?>
        <div class="form-group">
            <label for="permanentAddress">Permanent Address (As per Admission Form):</label>
            <input type="text" class="form-control" id="permanentAddress" name="permanentAddress" required="required">
        </div>
        <?php
    }      else{
        ?>

        <div class="form-group">
            <label for="permanentAddress">Permanent Address (As per Admission Form):</label>
            <input type="text" class="form-control" id="permanentAddress" name="permanentAddress" required="required" value="<?php echo @$data[0]['Addr'] ?>" readonly="readonly">
        </div>
        <?php
    }
    ?>
    <div class="form-group">
        <label for="postalAddress">Postal Address:</label>
        <textarea cols="30" rows="3" class="form-control" id="postalAddress" name="postalAddress" required="required" value=""></textarea>
    </div>

    <hr class="colorgraph">

    <h3 class="bold">Exam Information</h3>

    <div class="form-group">
        <label for="strRegNo">Registration No:</label>
        <input type="text" class="form-control" id="strRegNo" name="strRegNo" required="required" value="<?php echo @$data[0]['strRegNo'] ?>" readonly="readonly">
    </div>

    <div class="form-group">
        <label for="rno">Roll No:</label>
        <input type="text" class="form-control" id="rno" name="rno" value="<?php echo @$data[0]['RNo'] ?>" required="required" readonly="readonly">
    </div>

    <div class="form-group">
        <label for="cls">Class:</label>
        <input type="text" class="form-control" id="cls" name="cls" value="<?php echo @$data[0]['Class']."th"?>" required="required" readonly="readonly">
    </div>

    <div class="form-group">
        <label for="year">Year:</label>
        <input type="text" class="form-control" id="year" name="year" value="<?php echo @$_POST['year']?>" required="required" readonly="readonly">
    </div>

    <?php
    if(@$data[0]['sess'] == 1){
        @$sess = 'Annual';
    }
    else if(@$data[0]['sess'] == 2){
        @$sess = 'Supply' ;
    }
    ?>
    <div class="form-group">
        <label for="sess">Session:</label>
        <input type="text" class="form-control" id="sess" name="sess" value="<?php echo @$sess ?>" required="required" readonly="readonly">
    </div>

    <?php
    if(@$data[0]['RegPvt'] == 1)    
    {
        ?>
        <div class="form-group">
            <label for="inst">Institute Name:</label>
            <input type="text" class="form-control" id="instName" name="instName" required="required" value="<?php echo @$data[0]['InstituteName'] ?>" readonly="readonly">
        </div>

        <div class="form-group">
            <label for="dist">District:</label>
            <select class="form-control" id="districtRegular" name="districtRegular">
                <option value='0'>SELECT DISTRICT</option>
                <option value='1'>GUJRANWALA</option>
                <option value='2'>GUJRAT</option>
                <option value='3'>HAFIZABAD</option>
                <option value='4'>MANDI BAHA-UD-DIN</option>
                <option value='5'>NAROWAL</option>
                <option value='6'>SIALKOT</option>
            </select>
        </div>

        <?php
    }

    else if(@$data[0]['RegPvt'] == 2)  
    {   ?>
        <div class="form-group">
            <label for="dist">District:</label>
            <select class="form-control" id="districtPvt" name="districtPvt"></select>
        </div>
        <?php       
    }
    ?>

    <div class="form-group">
        <label for="obt_mrk">Marks Obtained:</label>

        <?php if(@$data[0]['obt_mrk'] != '')
        {    
            ?>
            <input type="text" class="form-control" id="obt_mrk" name="obt_mrk" value="<?php echo @$data[0]['obt_mrk'] ?>" required="required" readonly="readonly">

            <?php   }
        else{
            ?>
            <input type="text" class="form-control" id="obt_mrk" name="obt_mrk" value="" required="required" maxlength="4" onkeyup="this.value = minmax(this.value, 0, 1050)">
            <?php       
        }
        ?>
    </div>    

    <div class="form-group">
        <label for="reason">Describe the Reason to get the Duplicate Result Card/Certificate:</label>
        <textarea cols="30" rows="3" class="form-control" id="reason" name="reason" required="required" value=""></textarea>
    </div>    

    <!---Start Hidden fields -->

    <input type="hidden" id="type" name="type" value="<?php echo @$_POST['type'] ?>"> 
    <input type="hidden" id="isUrgent" name="isUrgent" value="<?php echo @$_POST['isUrgent'] ?>"> 
    <input type="hidden" id="coll_cd" name="coll_cd" value="<?php echo @$data[0]['coll_cd'] ?>"> 
    <input type="hidden" id="Sch_Cd" name="Sch_Cd" value="<?php echo @$data[0]['Sch_Cd'] ?>"> 
    <input type="hidden" id="result1" name="result1" value="<?php echo @$data[0]['result1'] ?>"> 
    <input type="hidden" id="result2" name="result2" value="<?php echo @$data[0]['result2'] ?>"> 
    <input type="hidden" id="RegPvt" name="RegPvt" value="<?php echo @$data[0]['RegPvt'] ?>"> 
    <input type="hidden" id="Class" name="Class" value="<?php echo @$data[0]['Class'] ?>"> 
    <input type="hidden" id="session" name="session" value="<?php echo @$data[0]['sess'] ?>"> 

    <!---End Hidden fields -->


    <div class="form-group">
        <label class="checkbox-inline">
            <input type="checkbox" class="checkboxtext" id="terms" name="terms" value="yes" required ><span style="color: red; font-size:larger; font-weight: bold;">I Accept All The Terms and Conditions of Board of Intermediate and Secondary Education, Gujranwala</span>  
        </label>
    </div>

    <input type="submit" value="Proceed" id="proceed" name="proceed" class="btn btn-primary btn-block" onclick="return checks()">

</form>