<?php
    session_start();
        
        include '../app/configuracao.php';
        include '../app/autoload.php';
       /*  include '../app/Controllers/Admins.php'; */
        

        $rotas = new Rota();
        
       /*  $db = new DataBase();
        $control = new Admins();
        
        if(isset($_COOKIE['acesso'])){
            $db->query('select * from admins where acesso = :acesso');
            $db->bind('acesso',$_COOKIE['acesso']);
            $db->resultado();
           
    
            if($db->resultado()){
                $control->fazLogin($db->resultado()->email, $db->resultado()->senha);
                
               
            }
        }
  */