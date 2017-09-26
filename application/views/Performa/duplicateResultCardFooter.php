<div id="footer" class="footer">
    &nbsp; &copy; 2017 BISE Gujranwala, All Rights Reserved. 
</div>

</div>


<script type="text/javascript">

    jQuery(document).ready(function() {    
        var dist_cd ="<?php echo @$data[0]['Dist_Cd']; ?>";

        if(dist_cd == 1)
        {
            $("#districtPvt").empty();
            $("#districtPvt").append('<option value="1" selected="selected">GUJRANWALA</option>');
            $("#districtPvt").append('<option value="2">GUJRAT</option>');
            $("#districtPvt").append('<option value="3">HAFIZABAD</option>');
            $("#districtPvt").append('<option value="4">MANDI BAHA-UD-DIN</option>');
            $("#districtPvt").append('<option value="5">NAROWAL</option>');
            $("#districtPvt").append('<option value="6">SIALKOT</option>');

        }
        else if(dist_cd == 2)
        {
            $("#districtPvt").empty();
            $("#districtPvt").append('<option value="1">GUJRANWALA</option>');
            $("#districtPvt").append('<option value="2" selected="selected">GUJRAT</option>');
            $("#districtPvt").append('<option value="3">HAFIZABAD</option>');
            $("#districtPvt").append('<option value="4">MANDI BAHA-UD-DIN</option>');
            $("#districtPvt").append('<option value="5">NAROWAL</option>');
            $("#districtPvt").append('<option value="6">SIALKOT</option>');
        }
        else if(dist_cd == 3)
        {
            $("#districtPvt").empty();
            $("#districtPvt").append('<option value="1">GUJRANWALA</option>');
            $("#districtPvt").append('<option value="2">GUJRAT</option>');
            $("#districtPvt").append('<option value="3" selected="selected">HAFIZABAD</option>');
            $("#districtPvt").append('<option value="4">MANDI BAHA-UD-DIN</option>');
            $("#districtPvt").append('<option value="5">NAROWAL</option>');
            $("#districtPvt").append('<option value="6">SIALKOT</option>');
        }
        else if(dist_cd == 4)
        {
            $("#districtPvt").empty();
            $("#districtPvt").append('<option value="1">GUJRANWALA</option>');
            $("#districtPvt").append('<option value="2">GUJRAT</option>');
            $("#districtPvt").append('<option value="3">HAFIZABAD</option>');
            $("#districtPvt").append('<option value="4" selected="selected">MANDI BAHA-UD-DIN</option>');
            $("#districtPvt").append('<option value="5">NAROWAL</option>');
            $("#districtPvt").append('<option value="6">SIALKOT</option>');
        }
        else if(dist_cd == 5)
        {
            $("#districtPvt").empty();
            $("#districtPvt").append('<option value="1">GUJRANWALA</option>');
            $("#districtPvt").append('<option value="2">GUJRAT</option>');
            $("#districtPvt").append('<option value="3">HAFIZABAD</option>');
            $("#districtPvt").append('<option value="4">MANDI BAHA-UD-DIN</option>');
            $("#districtPvt").append('<option value="5" selected="selected">NAROWAL</option>');
            $("#districtPvt").append('<option value="6">SIALKOT</option>');
        }
        else if(dist_cd == 6)
        {
            $("#districtPvt").empty();
            $("#districtPvt").append('<option value="1">GUJRANWALA</option>');
            $("#districtPvt").append('<option value="2">GUJRAT</option>');
            $("#districtPvt").append('<option value="3">HAFIZABAD</option>');
            $("#districtPvt").append('<option value="4">MANDI BAHA-UD-DIN</option>');
            $("#districtPvt").append('<option value="5">NAROWAL</option>');
            $("#districtPvt").append('<option value="6" selected="selected">SIALKOT</option>');
        }
        else
        {
            $("#districtPvt").empty();
            $("#districtPvt").append('<option value="0">SELECT ONE</option>');
            $("#districtPvt").append('<option value="1">GUJRANWALA</option>');
            $("#districtPvt").append('<option value="2">GUJRAT</option>');
            $("#districtPvt").append('<option value="3">HAFIZABAD</option>');
            $("#districtPvt").append('<option value="4">MANDI BAHA-UD-DIN</option>');
            $("#districtPvt").append('<option value="5">NAROWAL</option>');
            $("#districtPvt").append('<option value="6" selected="selected">SIALKOT</option>');
        }


        $('#feeMsg').hide();
        $('#feeMsg1').hide();

        $( "#dob1" ).datepicker(
            {
                dateFormat: 'dd-mm-yy'
                ,changeMonth: true,changeYear:true
                , yearRange: '-50:'
        }).val();
        $(document.getElementById("cellNo")).mask("9999-9999999", { placeholder: "_" });
        $(document.getElementById("fNic")).mask("99999-9999999-9", { placeholder: "_" });
        $(document.getElementById("bForm")).mask("99999-9999999-9", { placeholder: "_" });
        $( "#txtYear" ).hide();
        $( "#lblYear" ).hide();
    });

    function validatenumber(evt) {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode( key );
        var regex = /^[0-9\b]+$/;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }

    $( "#type" ).change(function() {
        var type = $( "#type" ).val();
        var typeFee = $( "#isUrgent" ).val();

        if(type == 1 || type == 2)
        {
            $('#cls').empty();
            $("#cls").append('<option value="10">10TH</option>'); 
            $("#cls").append('<option value="12">12TH</option>');
        }
        else if(type == 3)
        {
            $('#cls').empty();
            $("#cls").append('<option value="9">9TH</option>'); 
            $("#cls").append('<option value="10">10TH</option>'); 
            $("#cls").append('<option value="11">11TH</option>'); 
            $("#cls").append('<option value="12">12TH</option>');
        }
        else{
            $('#cls').empty();
            $("#cls").append('<option value="10">10TH</option>'); 
            $("#cls").append('<option value="12">12TH</option>');
        }

        if((type == 1 || type == 2) && (typeFee == 1)){
            $('#feeMsg').show();
            $('#feeMsg1').hide();
        }

        else if((type == 3) && (typeFee == 1)){
            $('#feeMsg').hide();
            $('#feeMsg1').show();
        }

        else{
            $('#feeMsg').hide();
            $('#feeMsg1').hide();
        }
    });

    $( "#year").change(function() {
        var year = $( "#year" ).val();
        if(year == 100){
            $( "#txtYear" ).show();   
            $( "#lblYear" ).show();
        }
        else if(year != 100)
        {
            $( "#txtYear" ).hide();
            $( "#lblYear" ).hide();
        }
    });

    $( "#isUrgent" ).change(function() {
        var type = $( "#type" ).val();
        var typeFee = $( "#isUrgent" ).val();  

        if((type == 1 || type == 2) && (typeFee == 1)){
            $('#feeMsg').show();
            $('#feeMsg1').hide();
        }

        else if((type == 3) && (typeFee == 1)){
            $('#feeMsg').hide();
            $('#feeMsg1').show();
        }

        else{
            $('#feeMsg').hide();
            $('#feeMsg1').hide();
        }
    });

    function ValidateFileUpload() {
        var fuData = document.getElementById('inputFile');
        var FileUploadPath = fuData.value;
        if (FileUploadPath == '') {
            alert("Please upload an image");
            jQuery('#image_upload_preview').removeAttr('src');
        } 
        else {
            var Extension = FileUploadPath.substring(
                FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
            if (Extension == "jpeg" || Extension == "jpg") {
                if (fuData.files && fuData.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image_upload_preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(fuData.files[0]);
                }
            } 
            else {
                $('#inputFile').removeAttr('value');
                jQuery('#image_upload_preview').removeAttr('src');
                alert("Image only allows file types of JPEG. ");
                return false;
            }
        }
        var file_size = $('#inputFile')[0].files[0].size;
        if(file_size>20480) {                                    
            $('#inputFile').removeAttr('value');
            jQuery('#image_upload_preview').removeAttr('src');
            alert("File size can be between 20KB"); 
            return false;
        } 
    }

    function minmax(value, min, max) {
        if(parseInt(value) < 0 || isNaN(value)){
            return 0; 
        }
        else if(parseInt(value) > 1050){
            alertify.error('Maximum Obtained Marks Value is 1050');
            return 1050; 
        }
        else{
            return value;
        }
    }

    function checks() {

        var Class =  $('#Class').val();
        var name =  $('#name').val();
        var fName =  $('#fName').val();
        var dob =  $('#dob').val();
        var dob1 =  $('#dob1').val();
        var bForm =  $('#bForm').val();
        var fNic =  $('#fNic').val();
        var cellNo =  $('#cellNo').val();
        var mrkOfInden =  $('#mrkOfInden').val();
        var permanentAddress =  $('#permanentAddress').val();
        var postalAddress =  $('#postalAddress').val();
        var districtRegular =  $('#districtRegular').val();
        var distCd =  $('#districtPvt').val();
        var obt_mrk =  $('#obt_mrk').val();
        var reason =  $('#reason').val();
        var RegPvt =  $('#RegPvt').val();
        var inputFile =  $('#image').val();

        if(inputFile == "" || inputFile == null || inputFile == undefined){
            alertify.error('Please Choose an Image.');
            $('#image').focus();
            return false;
        }

        else if(name == "" || name == null || name == undefined){
            alertify.error('Please Enter Your Name');
            $('#name').focus();
            return false;
        }

        else if(fName == "" || fName == null || fName == undefined){
            alertify.error('Please Enter Your Fathers Name');
            $('#fName').focus();
            return false;
        }

        else if((Class != 9 || Class != 10) && (dob1 == '')){
            alertify.error('Please Enter Date of Birth');
            $('#dob1').focus();
            return false;    
        }

        else if((Class == 9 || Class == 10) && (dob == '')){
            alertify.error('Please Enter Date of Birth');
            $('#dob').focus();
            return false;    
        }

        else if(fNic == "" || fNic == null || fNic == undefined){
            alertify.error('Please Enter Fathers CNIC');
            $('#fNic').focus();
            return false;
        }

        else if(bForm == "" || bForm == null || bForm == undefined){
            alertify.error('Please Enter B-FORM No');
            $('#bForm').focus();
            return false;
        }



        else if(cellNo == "" || cellNo == null || cellNo == undefined){
            alertify.error('Please Enter Cell No.');
            $('#cellNo').focus();
            return false;
        }

        else if(mrkOfInden == "" || mrkOfInden == null || mrkOfInden == undefined){
            alertify.error('Please Enter Mark of Identification.');
            $('#mrkOfInden').focus();
            return false;
        }

        else if(permanentAddress == "" || permanentAddress == null || permanentAddress == undefined){
            alertify.error('Please Enter Permanent Adress.');
            $('#permanentAddress').focus();
            return false;
        }

        else if(postalAddress == "" || postalAddress == null || postalAddress == undefined){
            alertify.error('Please Enter Postal Adress.');
            $('#postalAddress').focus();
            return false;
        }

        else if(districtRegular == 0){
            if(RegPvt == 1){
                alertify.error('Please Select District.');
                $('#districtRegular').focus();
                return false;    
            }

        }

        else if(distCd < 1){
            if(RegPvt == 2){
                alertify.error('Please Select District');
                $('#districtPvt').focus();
                return false;    
            }
        }

        else if(obt_mrk == "" || obt_mrk == null || obt_mrk == undefined){
            alertify.error('Please Enter Marks Obtained.');
            $('#obt_mrk').focus();
            return false;
        }

        else if(reason == "" || reason == null || reason == undefined){
            alertify.error('Please Describe Reason.');
            $('#reason').focus();
            return false;
        }

        else if (!$("input[name='terms']")[0].checked) {
            alertify.error('Please Accept the Terms and Condition for Further Process.');
            $('#terms').focus();
            return false;
        }

        else
        {
            //debugger;
            $.ajax({
                type: "POST",
                url: "<?php  echo site_url('Performa/validateForm'); ?>",
                data: $("#myform").serialize() ,
                datatype : 'html',

                success: function(data)
                {
                    var obj = JSON.parse (data);
                    if(obj.excep == 'Success')
                    {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>" + "Performa/InsertApplicationForm/",
                            data: $("#myform").serialize() ,
                            datatype : 'html',


                            beforeSend: function() {  $('.mPageloader').show(); },
                            complete: function() { $('.mPageloader').hide();},


                            success: function(data){
                                var obj = JSON.parse(data) ;
                                if(obj.error ==  1)
                                {
                                    window.location.href ='<?php echo base_url(); ?>Performa/formdownloaded/'+obj.AppID[0]['AppID'];
                                }   
                                else
                                {
                                    alertify.error(obj.error);
                                    return false; 
                                }
                            },
                            error: function(request, status, error){

                                alertify.error(request.responseText);
                            }
                        });
                        return false
                    }
                    else
                    {
                        alertify.error(obj.excep);
                        return false;     
                    }
                }
            });
            return false;   
        } 
    }


    var max_file_size             = 20000; 
    var allowed_file_types         = ['image/jpeg', 'image/pjpeg']; 
    var result_output             = '#output'; 
    var my_form_id                 = '#upload_form'; 
    var progress_bar_id         = '#progress-wrp'; 
    var total_files_allowed     = 1;

    $(function() {
        $("input:file").change(function (event){

            event.preventDefault();
            var proceed = true;
            var error = [];   
            var total_files_size = 0;

            $(progress_bar_id +" .progress-bar").css("width", "0%");
            $(progress_bar_id + " .status").text("0%");

            if(!window.File && window.FileReader && window.FileList && window.Blob){ 
                alertify.error("Your browser does not support new File API! Please upgrade."); 
            }else{
                var total_selected_files = this.files.length; 

                if(total_selected_files > total_files_allowed){
                    alertify.error( "You have selected "+total_selected_files+" file(s), " + total_files_allowed +" is maximum!");
                    proceed = false;
                }

                $(this.files).each(function(i, ifile){
                    if(ifile.value !== ""){
                        if(allowed_file_types.indexOf(ifile.type) === -1){
                            alertify.error( "<b>"+ ifile.name + "</b> is unsupported file type!");
                            proceed = false;
                        }

                        total_files_size = total_files_size + ifile.size; 
                    }
                });



                if(total_files_size > max_file_size && proceed == true){ 
                    alertify.error( "Allowed size is 20 KB, Try smaller file!"); 
                    proceed = false; 
                }


                if(proceed){

                    var form_data = new FormData( $('form')[0]); 
                    var post_url = '<?= base_url()?>Performa/uploadpic';


                    $.ajax({
                        url : post_url,
                        type: "POST",
                        data : form_data,
                        contentType: false,
                        cache: false,
                        processData:false,
                        xhr: function(){

                            var xhr = $.ajaxSettings.xhr();
                            if (xhr.upload) {
                                xhr.upload.addEventListener('progress', function(event) {
                                    var percent = 0;
                                    var position = event.loaded || event.position;
                                    var total = event.total;
                                    if (event.lengthComputable) {
                                        percent = Math.ceil(position / total * 100);
                                    }

                                    $(progress_bar_id +" .progress-bar").css("width", + percent +"%");
                                    $(progress_bar_id + " .status").text(percent +"%");
                                    }, true);

                                var fuData = document.getElementById('image');
                                var FileUploadPath = fuData.value;

                                if (fuData.files && fuData.files[0]) 
                                {
                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        $('#previewImg').attr('src', e.target.result);
                                    }
                                    reader.readAsDataURL(fuData.files[0]);
                                }
                            }
                            return xhr;
                        },
                        mimeType:"multipart/form-data"
                    }).done(function(res){

                        $(result_output).html(res);

                    });

                }
            }



            $(result_output).html("");  
            $(error).each(function(i){
                $(result_output).append('<div class="error">'+error[i]+"</div>");
            });
        });
    });

    function CancelAlert(){
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {
            if (e) {
                window.location.href ='<?php echo base_url(); ?>index.php/Performa/index';
            } else {
            }
        });
    }

</script>

</body>
</html>