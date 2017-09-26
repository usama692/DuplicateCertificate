<form method="post" action="<?php echo base_url(); ?>performa/LoadData">
    <?php
    @$mysg = @$error['error_msg'];
    // @$feeMsg = '';
    if(@$mysg != "")
    {
        ?>
        <div class="alert alert-danger fade in alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong><?php echo $mysg ?> </strong>
        </div>
        <?php
    }   
    ?>

    <div class="form-group">
        <label for="type">Application for:</label>
        <select class="form-control" id="type" name="type">
            <option value="1" selected="selected" >Obtain Before Time Certificate(OBTC)</option>
            <option value="2">Duplicate Certificate</option>
            <option value="3">Duplicate Result Card</option>
        </select>
    </div>

    <div class="form-group">
        <label for="cls">Type:</label>
        <select class="form-control" id="isUrgent" name="isUrgent">
            <option value="0">Ordinary</option>
            <option value="1">Urgent</option>
        </select>
    </div>

    <div class="alert alert-danger fade in alert-dismissable" id="feeMsg1">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>
        <strong><?php echo @$feeMsg = 'Fee will Extra Charge Rs 500/- from Normal Fee' ?></strong>
    </div>

    <div class="alert alert-danger fade in alert-dismissable" id="feeMsg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>
        <strong><?php echo @$feeMsg = 'Fee will Extra Charge Rs 1000/- from Normal Fee' ?></strong>
    </div>

    <div class="form-group">
        <label for="rno">Roll No:</label>
        <input type="text" class="form-control" id="rno" name="rno" placeholder="Enter Roll No." required="required" maxlength="6" onKeyPress="validatenumber(event);">
    </div>
    <div class="form-group">
        <label for="cls">Class:</label>
        <select class="form-control" id="cls" name="cls">
            <option value="10">10TH</option>
            <option value="12">12TH</option>
        </select>
    </div>
    <div class="form-group">
        <label for="year">Year:</label>
        <select class="form-control" id="year" name="year">
            <option value="2017">2017</option>
            <option value="2016" >2016</option>
            <option value="2015">2015</option>
            <option value="2014" >2014</option>
            <option value="2013">2013</option>
            <option value="2012" >2012</option>
            <option value="2011">2011</option>
            <option value="2010" >2010</option>
            <option value="2009">2009</option>
            <option value="2008" >2008</option>
            <option value="2007">2007</option>
            <option value="2006" >2006</option>
            <option value="2005">2005</option>
            <option value="2004" >2004</option>
            <option value="2003">2003</option>
            <option value="2002" >2002</option>
            <option value="2001">2001</option>
            <option value="2000" >2000</option>
            <option value="100" >Before 2000</option>
        </select>
    </div>

    <div class="form-group">
        <label for="txtYear" id="lblYear">Year:</label>
        <input type="text" class="form-control" id="txtYear" name="txtYear" placeholder="Enter Year Before 2000" maxlength="4" onKeyPress="validatenumber(event);">
    </div>

    <div class="form-group">
        <label for="cls">Session:</label>
        <select class="form-control" id="sess" name="sess">
            <option value="1">Annual</option>
            <option value="2">Supplymentry</option>
        </select>
    </div>
    <input type="submit" value="Proceed" id="proceed" name="proceed" class="btn btn-primary btn-block">
</form>