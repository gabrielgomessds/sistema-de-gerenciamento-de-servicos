<?php

class Checa{


    public static function checaNome($nome){
        if(!preg_match('/^[A-ZÀ-Ÿ][A-zÀ-ÿ]+\s([A-zÀ-ÿ]\s?)*[A-ZÀ-Ÿ][A-zÀ-ÿ]+$/', $nome)):
            return true;
        else:
            return false;
        endif;
    }

    public static function checaEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
            return true;
        else:
            return false;
        endif;
    }
    public static function dataBr($data){
        if(isset($data)):
            return date('d/m/Y',strtotime($data));
        else:
            return false;
        endif;
    }

 


}