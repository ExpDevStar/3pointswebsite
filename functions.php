<?php 
    function pr($arr){
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }

    function prd($arr){
        pr($arr);
        die;
    }

    function flashMsg($msg = ''){
        if($msg){
            $_SESSION['flashMsg']   = $msg;
        } else{
            if(isset($_SESSION['flashMsg'])){
                echo '<div class="alert alert-info">
                '. $_SESSION['flashMsg'] .'
              </div>';
              unset($_SESSION['flashMsg']);
            }
        }
    }