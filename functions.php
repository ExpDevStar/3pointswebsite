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

    function getLink($url){
        global $config;
        if(empty($config)){
            $config = require_once('config.php');
        }
        $siteUrl    = $config['siteurl'];
        return $siteUrl . $url;
    }