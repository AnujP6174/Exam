<?php
    if(isset($_POST['g-recaptcha-response'])){
        $secret_key="6Lcjm2QcAAAAAJIUjubU1KEnSpnBuoarqyl6i6dF";
        $ip=$_SERVER['REMOTE_ADDR'];
        $response=$_POST['g-recaptcha-response'];
        $url="https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$response&remoteip=$ip";
        $fire=file_get_contents($url);
        $data=json_decode($fire);
        if($data->success==true){
            echo "Login Successfull";
        }
        else{
            echo "Please fill Captcha";
        }
    }
    else{
        echo "Captcha Error";
    }
