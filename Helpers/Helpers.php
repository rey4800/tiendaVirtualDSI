<?php

//Retorna la url del proyecto 


function base_url(){


    return BASE_URL;

}


function media(){

    return BASE_URL."/Assets";
}

function headerAdmin($data=""){

    $view_header = "Views/Template/header_admin.php";
    require_once($view_header);


}

function footerAdmin($data=""){

    $view_footer = "Views/Template/footer_admin.php";

    require_once($view_footer);
    

}
 //funcionn para  que  se  vea laa  vista header
 function headerTienda($data=""){
    $view_header =  "Views/Template/header_tienda.php";
    require_once($view_header);
    }

     //funcionn para  que  se  vea laa  vista header
 function headerForo($data=""){
    $view_headerforo =  "Views/Template/header_foro.php";
    require_once($view_headerforo);
    }
    
    //funncion  para  que  se veaa la vista footer
    function footerTienda($data=""){
        $view_footer =  "Views/Template/footer_tienda.php";
        require_once($view_footer);
        }

//Muestra informacion formateada
function dep($data){


    $format = print_r('<pre>');
    $format = print_r($data);
    $format = print_r('</pre>');

    return $format;

}

function getFile(string $url, $data){

    require_once("Views/{$url}.php");
    $file = ob_get_clean();
    return $file;

}



function getModal(string $nameModal, $data){

    $view_modal = "Views/Template/Modals/{$nameModal}.php";
    require_once $view_modal;

}

function getPermisos(int $idmodulo){
    require_once ("Models/PermisosModel.php");
    $objPermisos = new PermisosModel();
    $idrol = $_SESSION['userData']['idrol'];
    $arrPermisos = $objPermisos->permisosModulo($idrol);
    $permisos = '';
    $permisosMod = '';
    if(count($arrPermisos) > 0 ){
        $permisos = $arrPermisos;
        $permisosMod = isset($arrPermisos[$idmodulo]) ? $arrPermisos[$idmodulo] : "";
    }
    $_SESSION['permisos'] = $permisos;
    $_SESSION['permisosMod'] = $permisosMod;
}


function uploadImage(array $data, string $name){
    $url_temp = $data['tmp_name'];
    $destino    = 'Assets/images/uploads/'.$name;        
    $move = move_uploaded_file($url_temp, $destino);
    return $move;
}

function deleteFile(string $name){
    unlink('Assets/images/uploads/'.$name);
}
 
 //Elimina exceso de espacios entre palabras - Evita inyecciones sql en los formularios
 function strClean($strCadena){
    $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $strCadena);
    $string = trim($string); //Elimina espacios en blanco al inicio y al final
    $string = stripslashes($string); // Elimina las \ invertidas
    $string = str_ireplace("<script>","",$string);
    $string = str_ireplace("</script>","",$string);
    $string = str_ireplace("<script src>","",$string);
    $string = str_ireplace("<script type=>","",$string);
    $string = str_ireplace("SELECT * FROM","",$string);
    $string = str_ireplace("DELETE FROM","",$string);
    $string = str_ireplace("INSERT INTO","",$string);
    $string = str_ireplace("SELECT COUNT(*) FROM","",$string);
    $string = str_ireplace("DROP TABLE","",$string);
    $string = str_ireplace("OR '1'='1","",$string);
    $string = str_ireplace('OR "1"="1"',"",$string);
    $string = str_ireplace('OR ´1´=´1´',"",$string);
    $string = str_ireplace("is NULL; --","",$string);
    $string = str_ireplace("is NULL; --","",$string);
    $string = str_ireplace("LIKE '","",$string);
    $string = str_ireplace('LIKE "',"",$string);
    $string = str_ireplace("LIKE ´","",$string);
    $string = str_ireplace("OR 'a'='a","",$string);
    $string = str_ireplace('OR "a"="a',"",$string);
    $string = str_ireplace("OR ´a´=´a","",$string);
    $string = str_ireplace("OR ´a´=´a","",$string);
    $string = str_ireplace("--","",$string);
    $string = str_ireplace("^","",$string);
    $string = str_ireplace("[","",$string);
    $string = str_ireplace("]","",$string);
    $string = str_ireplace("==","",$string);
    return $string;
}
//Genera una contraseña de 10 caracteres
function passGenerator($length = 10)
{
    $pass = "";
    $longitudPass=$length;
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $longitudCadena=strlen($cadena);

    for($i=1; $i<=$longitudPass; $i++)
    {
        $pos = rand(0,$longitudCadena-1);
        $pass .= substr($cadena,$pos,1);
    }
    return $pass;
}
//Genera un token
function token()
{
    $r1 = bin2hex(random_bytes(10));
    $r2 = bin2hex(random_bytes(10));
    $r3 = bin2hex(random_bytes(10));
    $r4 = bin2hex(random_bytes(10));
    $token = $r1.'-'.$r2.'-'.$r3.'-'.$r4;
    return $token;
}
//Formato para valores monetarios
function formatMoney($cantidad){
    $cantidad = number_format($cantidad,2,SPD,SPM);
    return $cantidad;
}








?>