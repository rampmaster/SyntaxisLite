<?php 
/**
 * Controlador
 *
 * @name    fotos.php
 * @author  PHPost Team
*/
/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	$tsPage = "fotos";	// tsPage.tpl -> PLANTILLA PARA MOSTRAR CON ESTE ARCHIVO.

	$tsLevel = 2;		// NIVEL DE ACCESO A ESTA PAGINA. => VER FAQs

	$tsAjax = empty($_GET['ajax']) ? 0 : 1; // LA RESPUESTA SERA AJAX?
	
	$tsContinue = true;	// CONTINUAR EL SCRIPT
	
/*++++++++ = ++++++++*/

	include "../../header.php"; // INCLUIR EL HEADER

	$tsTitle = $tsCore->settings['titulo'].' - '.$tsCore->settings['slogan']; 	// TITULO DE LA PAGINA ACTUAL

/*++++++++ = ++++++++*/
	// PARA LAS FOTOS...
    $action = htmlspecialchars($_GET['action']);		
	if($tsCore->settings['c_fotos_private'] == '0') {	
    if($action == '' || $action == 'ver') $tsLevel = 0;		
	}else{		
	$tsLevel = 2;		
	}
	// VERIFICAMOS EL NIVEL DE ACCSESO ANTES CONFIGURADO
	$tsLevelMsg = $tsCore->setLevel($tsLevel, true);
	if($tsLevelMsg != 1){	
		$tsPage = 'aviso';
		$tsAjax = 0;
		$smarty->assign("tsAviso",$tsLevelMsg);
		//
		$tsContinue = false;
	}
	//
	if($tsContinue){
/**********************************\

* (VARIABLES LOCALES ESTE ARCHIVO)	*

\*********************************/
	//
	include("../class/c.fotos.php");
	$tsFotos = new tsFotos();

/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/

    switch($action){
        case '':
            //ULTIMOS TEMAS CON PAGINACION AJAX     
            $tsLastFotos = $tsFotos->getLastFotos();
            $smarty->assign("tsLastFotos", $tsLastFotos);
            $smarty->assign("tsPages", $tsLastFotos['pages']);
            $smarty->assign("tsTotal", $tsLastFotos['photos__total']);

            $smarty->assign("tsLastComments", $tsFotos->getLastComments());
			$q = db_exec('fetch_assoc', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT stats_miembros, stats_fotos, stats_foto_comments FROM w_stats WHERE stats_no = \'1\''));
            $smarty->assign("tsStats", $q); 
            
        break;
        case 'agregar':
            if(!empty($_POST['titulo'])){
                $result = $tsFotos->newFoto();
                $tsPage = 'aviso';
                if(!is_array($result) && $result > 0){
                    $titulo = $tsCore->setSecure($_POST['titulo']);

                    $Foto = $tsCore->settings['url']."/fotos/".$tsUser->nick."/".$result."/".$tsCore->setSEO($titulo).".html";
                    header('location: ' .$Foto);    

                } else {
                    $smarty->assign("tsAviso",array('titulo' => 'Opps...', 'mensaje' => $result, 'but' => 'Volver', 'link' => "{$tsCore->settings['url']}/fotos/agregar.php"));
                }
            }
            
        break;
        case 'editar':
            if(empty($_POST['titulo'])){
                $tsFoto = $tsFotos->getFotoEdit();
                if(!is_array($tsFoto)){
                    $tsPage = 'aviso';
                    $smarty->assign("tsAviso",array('titulo' => 'Opps...', 'mensaje' => $tsFoto, 'but' => 'Ir a Fotos', 'link' => "{$tsCore->settings['url']}/fotos/"));
                }
                else $smarty->assign("tsFoto", $tsFoto);
            } else {
                $tsPage = 'aviso';
                $tsFoto = $tsFotos->editFoto();
                $smarty->assign("tsAviso",array('titulo' => 'Opps...', 'mensaje' => $tsFoto, 'but' => 'Ir a Fotos', 'link' => "{$tsCore->settings['url']}/fotos/"));
            }
        break;
        case 'borrar':
            $tsAjax = 1;
            echo $tsFotos->delFoto();
        break;
        case 'ver':
            $tsFoto = $tsFotos->getFoto();
            // TITULO
            $tsTitle = $tsFoto['foto']['f_title'].' - '.$tsCore->settings['titulo'];
			
			if($tsFoto['foto']['f_status'] == 1 && (!$tsUser->is_admod && $tsUser->permisos['moacp'] == false)) {
			$tsPage = 'aviso';
            $smarty->assign("tsAviso",array('titulo' => 'Opps...', 'mensaje' => 'Esta foto se encuentra en revisi&oacute;n por acumulaci&oacute;n de denuncias', 'but' => 'Ir a Fotos', 'link' => "{$tsCore->settings['url']}/fotos/"));
			}elseif($tsFoto['foto']['exist'] == 0){
            $tsPage = 'aviso';
			$smarty->assign("tsAviso",array('titulo' => 'Opps...', 'mensaje' => 'Esta foto no existe', 'but' => 'Ir a Fotos', 'link' => "{$tsCore->settings['url']}/fotos/"));
			}else{
    			$smarty->assign("tsFoto", $tsFoto['foto']);
                $smarty->assign("tsUFotos", $tsFoto['last']);
                $smarty->assign("tsFFotos", $tsFoto['amigos']);
                $smarty->assign("tsFComments", $tsFoto['comments']);
    			$smarty->assign("tsFVisitas", $tsFoto['visitas']);
    			$smarty->assign("tsFMedallas", $tsFoto['medallas']);
    			$smarty->assign("tsTMedallas", $tsFoto['m_total']);

                # SEO FOTO
                $SeoFoto = $tsFotos->SeoFotos($_GET['fid']);                
                $smarty->assign('tsTitle', $SeoFoto['f_title']);
                $smarty->assign('tsAuthor', $SeoFoto['user_name']);
                $smarty->assign('tsSeoDescripcion', $SeoFoto['Seo']);
                $smarty->assign('tsPublished', $tsCore->timeseo($SeoFoto['f_date']));
                $smarty->assign('tsImagen', $SeoFoto['f_url']);
                $smarty->assign('tsUrl', $SeoFoto['Url']);
                $smarty->assign('tsKey', 'web, juegos, blog, posts, videos, peliculas, series, offtopic, diferentes, titulos, aventura, accion, drama, comedia, estrategia');
			}
		break;
        case 'album':
            $username = $_GET['user'];
            $user_id = $tsUser->getUserID($username);
            if(empty($user_id)){
                $tsPage = 'aviso';
                $smarty->assign("tsAviso",array('titulo' => 'Opps...', 'mensaje' => 'Este usuario no existe.', 'but' => 'Ir a Fotos', 'link' => "{$tsCore->settings['url']}/fotos/"));
            } else {
                $tsFotox = $tsFotos->getFotos($user_id);
                $smarty->assign("tsFotos", $tsFotox);
                $smarty->assign("tsFUser", array($user_id, $username));
            }

        break;
    }

/**********************************\

* (AGREGAR DATOS GENERADOS | SMARTY) *

\*********************************/
    $smarty->assign("tsAction",$action);
    
}

if(empty($tsAjax)) {	// SI LA PETICION SE HIZO POR AJAX DETENER EL SCRIPT Y NO MOSTRAR PLANTILLA, SI NO ENTONCES MOSTRARLA.

	$smarty->assign("tsTitle",$tsTitle);	// AGREGAR EL TITULO DE LA PAGINA ACTUAL

	/*++++++++ = ++++++++*/
	include("../../footer.php");
	/*++++++++ = ++++++++*/
}