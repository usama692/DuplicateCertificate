

<form enctype="multipart/form-data" id="returnApplicationForm" name="returnApplicationForm" method="post" action="<?php echo base_url(); ?>Performa/downloadApplicationFormByAppId">

    <div class="form-group">

        <h1>Download you Application Form</h1>
        <h3>Your Application ID No.<?php echo @$data['appId']; ?></h3>
        <input type="hidden" id="appId" name="appId" value="<?php echo @$data['appId'] ?>">
    </div>
    <div class="form-group">

        <input type="submit" value="Download" id="Download" name="Download" class="btn btn-primary">
        <input type="button" value="Cancel" id="cancel" name="cancel" class="btn btn-primary" onclick="return CancelAlert();">

    </div>


</form>