<!DOCTYPE html>
<html lang="en">
<head>
    <title>Duplicate Result Card | BISEGRW</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/alertify.core.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/alertify.min.js"></script>

    <style>

        /* progress bar */
        #progress-wrp {
            border: 1px solid #0099CC;
            padding: 1px;
            position: relative;
            border-radius: 3px;
            margin-bottom: 25px;
            text-align: left;
            background: #fff;
            width:140px;
            height: 25px;
            box-shadow: inset 1px 3px 6px rgba(0, 0, 0, 0.12);
        }
        #progress-wrp .progress-bar{
            height: 20px;
            border-radius: 3px;
            background-color: #337ab7;
            width: 0;
            box-shadow: inset 1px 1px 10px rgba(0, 0, 0, 0.11);
        }
        #progress-wrp .status{
            top:2px;
            left:45%;
            position:absolute;
            display:inline-block;
            color: black;
            font-weight: bolder;
        }
        /*End progress bar */

        /* Horizontal Line Styling */
        .colorgraph 
        {
            height: 5px;
            border-top: 0;
            background: #c4e17f;
            border-radius: 5px;
            background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
            background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
            background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
            background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
        }
        /* End Horizontal Line Styling */

        /* Check box styling */
        input[type=checkbox]
        {
            -ms-transform: scale(2);
            -moz-transform: scale(2);
            -webkit-transform: scale(2); 
            -o-transform: scale(2); 
            padding: 10px;
        }

        .checkboxtext
        {
            font-size: 110%;
            display: inline;
        }
        /*End Check box styling */

        .footer{width:100%; float:right; background:#003a6a ; height:40px; color: wheat; margin-top: 25px; margin-bottom: 3px; border-radius: 4px; text-align: center;}

    </style>

</head>
<body>
<div class="container">
<div class="row-fluid">
    <h2 style="background:#003a6a !important; color: wheat; text-align: center;" class="jumbotron">
        <img src="<?php echo base_url(); ?>assets/img/BISEGRW_Icon.png" class="img-circle" width="125px" height="125px" alt="Logo">
        Board of Intermediate & Secondary Education, Gujranwala
    </h2>
</div>