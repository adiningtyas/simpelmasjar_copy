<!DOCTYPE html>
<html lang="en">

<head>
    <?php
$get_data = $this->db->get('kontak')->row();
?>
    <title>Register | SIMPELMASJAR</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link href="<?php echo base_url(); ?>/assets/img/log.png" rel="icon">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url(); ?>assets/login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url(); ?>assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url(); ?>assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url(); ?>assets/login/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url(); ?>assets/login/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url(); ?>assets/login/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/css/main.css">
    <!--===============================================================================================-->

    <style>
    .center {
        text-align: center;
    }

    a:link {
        color: #0000FF;
    }

    /* visited link */
    a:visited {
        color: #0000FF;
    }

    /* mouse over link */
    a:hover {
        color: grey;
    }

    /* selected link */
    a:active {
        color: yellow;
    }
    </style>
</head>

<body>

    <div class="limiter">
        <!-- <div class="container-login100" style="background-image: url('assets/login/images/bg-01.jpg');"> -->
        <div class="container-login100" style="background-image: url('../assets/login/images/bgmasjar1.jpg');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41">
                    <?php
                    $get_data = $this->db->get('kontak')->row();
                    ?>
                    Register | SIMPELMASJAR
                </span>
                <?= $this->session->flashdata('message'); ?>
                <form class="login100-form validate-form p-b-33 p-t-5" action="<?php echo site_url('auth/submit_reg'); ?>" method="post">

                    <div class="wrap-input100" data-validate="Enter name">
                        <input class="input100" type="text" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name'); ?>">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>

                    <div class="wrap-input100" data-validate="Enter username">
                        <input class="input100" type="text" id="username" name="username" placeholder="Username" value="<?= set_value('username'); ?>">
                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>

                    <div class="wrap-input100" data-validate="Enter password">
                        <input class="input100" type="password" id="password1" name="password1" placeholder="Password">
                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>

                    <div class="wrap-input100" data-validate="Enter confirm password">
                        <input class="input100" type="password" id="password2" name="password2" placeholder="Confirm Password">
                        <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-32">
                        <button class="login100-form-btn" type="submit" name="submit" value="login">
                            Register
                        </button>
                    </div>
                    <br>
                    <div class="center">Sudah punya akun?
                        <a href="login">login</a>
                    </div>

                    <div class="center">Lupa Password
                    </div>
                    <br>
                </form>
            </div>

        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="<?php echo base_url(); ?>assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?php echo base_url(); ?>assets/login/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?php echo base_url(); ?>assets/login/vendor/bootstrap/js/popper.js"></script>
    <script src="<?php echo base_url(); ?>assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?php echo base_url(); ?>assets/login/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?php echo base_url(); ?>assets/login/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/login/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="<?php echo base_url(); ?>assets/login/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="<?php echo base_url(); ?>assets/login/js/main.js"></script>

</body>

</html>