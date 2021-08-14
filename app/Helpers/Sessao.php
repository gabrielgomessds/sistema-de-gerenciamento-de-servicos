<?php

class Sessao{
    public $icone;
    
    public static function mensagem($nome, $texto = null, $classe = null){
        if(!empty($texto) && empty($_SESSION[$nome])):
            if(!empty($_SESSION[$nome])):
                unset($_SESSION[$nome]);
            endif;
            $_SESSION[$nome] = $texto;
            $_SESSION[$nome.'classe'] = $classe;
        elseif(!empty($_SESSION[$nome]) && empty($texto)):
            $classe = !empty($_SESSION[$nome.'classe']) ? $_SESSION[$nome.'classe'] : 'alert-success';
                if($_SESSION[$nome.'classe'] == 'alert-danger'):
                   $icone = '<i class="bi bi-exclamation-triangle-fill"></i>';
                else:
                    $icone = '<i class="bi bi-check-circle-fill"></i>';
                endif;
                echo '<div class="alert"><p class="'.$classe.'">'
                .$_SESSION[$nome].$icone.
                ' </p><span class="close '.$classe.'" onclick="buttonClose();">x</span></div>';

            unset($_SESSION[$nome]);
            unset($_SESSION[$nome.'classe']);
        endif;
    }

    public static function estaLogado($id){
        if(!isset($id)):
            Sessao::mensagem('admin','Você não está logado','alert-danger');
            URL::redirecionar('paginas/login');
        endif;
    }

    
    
}