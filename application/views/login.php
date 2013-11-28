<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $this->config->item("nama_perusahaan"); ?></title>
        <meta charset="UTF-8" />
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/newtonsix.login.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
    <body>
        <div id="logo">
            <img src="<?php echo base_url(); ?>/bootstrap/img/logo.png" alt="" />
        </div>
        <div class="container">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <h4>Terjadi Kesalahan!</h4>
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>
            <?php if ($this->session->flashdata('result_login')) { ?>
                <div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <h4>Terjadi Kesalahan!</h4>
                    <?php echo $this->session->flashdata('result_login'); ?>
                </div>
            <?php } ?>
        </div>

        <div id="loginbox"> 
            <?php echo form_open('admin/login', 'id="loginform" class="form-vertical"'); ?>
            <p>Masukkan Username dan Password.</p>
            <div class="control-group">
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-user"></i></span><input type="text" placeholder="Username" name="username"/>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-lock"></i></span><input type="password" placeholder="Password" name="password" />
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <span class="pull-right"> <button class="btn btn-inverse" type="submit">Login</button> </span>
            </div>
            <?php echo form_close(); ?>
            <div id="push"></div>
        </div>


        <div class="navbar navbar-inverse navbar-fixed-bottom navbar-min">
            <div class="navbar-inner">
                <div class="container">
                    <center><small>Mobile Learning Application Server - Developed By <a href="http://twitter.com/_hakz_">Hafiz Ridha</small></center>
                </div>                
            </div>            
        </div>
        <script src="<?php echo base_url(); ?>/bootstrap/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>/bootstrap/js/jquery.min.js"></script>  
        <script src="<?php echo base_url(); ?>/bootstrap/js/newtonsix.login.js"></script> 
    </body>
</html>
