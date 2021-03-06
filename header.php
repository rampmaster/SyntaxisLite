<?php
/**
 * Archivo de Inicializaci�n del Sistema
 *
 * Carga las clases base y ejecuta la solicitud.
 *
 * @name    header.php
 * @author  PHPost Team
 */

/*
 * -------------------------------------------------------------------
 *  Estableciendo variables importantes
 * -------------------------------------------------------------------
 */

    if( defined('TS_HEADER') ) return;

    // Sesi�n
    if(!isset($_SESSION)) session_start();

    // Reporte de errores
    error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
    ini_set('display_errors', TRUE);

    // L�mite de ejecuci�n
    set_time_limit(300);

    // Variable $page
    if( !isset($page) ) $page = '';

/*
 * -------------------------------------------------------------------
 *  Definiendo constantes
 * -------------------------------------------------------------------
 */
    //DEFINICION DE CONSTANTES
    define('TS_ROOT', realpath(dirname(__FILE__)));

    define('TS_HEADER', TRUE);

    define('TS_CLASS', 'inc/class/');

    define('TS_EXTRA', TS_ROOT.'/inc/ext/');

    define('TS_LIBS', TS_ROOT.'/inc/libs/');

    define('TS_SMARTY', TS_ROOT.'/inc/smarty/');

    define('TS_CONF', TS_ROOT.'/files/settings_users/');

    define('TS_FILES', TS_ROOT.'/files/');
    
    set_include_path(get_include_path() . PATH_SEPARATOR . realpath('./'));

/*
 * -------------------------------------------------------------------
 *  Agregamos los archivos globales
 * -------------------------------------------------------------------
 */


    // Contiene las variables de configuraci�n principal
    include 'config.inc.php';

    // No ha sido instalado el script...
    if($db['hostname'] == 'dbhost') header("Location: ./install/index.php");
        
    // Funciones
    include TS_EXTRA.'functions.php';

    // Nuevas librer�as
    include TS_LIBS.'MobileDetect.php';
    $detect = new Mobile_Detect;

    // Nucleo
    include TS_CLASS.'c.core.php';
    
    // Controlador de usuarios
    include TS_CLASS.'c.user.php';

    // Monitor de usuario
    include TS_CLASS.'c.monitor.php';
    
    // Actividad de usuario
    include TS_CLASS.'c.actividad.php';

    // Mensajes de usuario
    include TS_CLASS.'c.mensajes.php';

    # Extraemos, Guardamos en JSON
    include TS_CLASS . "c.jsondb.php";
    
    // Smarty
    include TS_SMARTY.'SmartyBC.class.php';
    
    // Crean requests
    include TS_EXTRA.'QueryString.php';

/*
 * -------------------------------------------------------------------
 *  Inicializamos los objetos principales
 * -------------------------------------------------------------------
 */
 
    // Limpiar variables...
    cleanRequest();

    // Cargamos el nucleo
    $tsCore = new tsCore();
    
    // Usuario
    $tsUser = new tsUser();

    // Monitor
    $tsMonitor = new tsMonitor();

    // Actividad
    $tsActividad = new tsActividad();

    // Mensajes
    $tsMP = new tsMensajes();

    # Json
    $tsJson = new tsJson();

    // Definimos el template a utilizar
    $tsTema = $tsCore->settings['tema']['t_path'];
    if(empty($tsTema)) $tsTema = 'default';
    define('TS_TEMA', $tsTema);

    // Smarty
    $smarty = new SmartyBC();

/*
 * -------------------------------------------------------------------
 *  Asignaci�n de variables
 * -------------------------------------------------------------------
 */
    
    // Configuraciones
    $smarty->assign('tsConfig',$tsCore->settings);
    
    // Obtejo usuario
    $smarty->assign('tsUser',$tsUser);
    
    // Avisos
    $smarty->assign('tsAvisos', $tsMonitor->avisos);
    
    // Nofiticaciones
    $smarty->assign('tsNots',$tsMonitor->notificaciones);
    
    // Mensajes
    $smarty->assign('tsMPs',$tsMP->mensajes);

    # NUEVO ARCHIVO DE CONFIGURACION by Miguel92
    include TS_ROOT . '/ajustes.php';

/*
 * -------------------------------------------------------------------
 *  Validaciones extra
 * -------------------------------------------------------------------
 */
    // Baneo por IP
    $ip = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
    if(!filter_var($ip, FILTER_VALIDATE_IP)) die('Su ip no se pudo validar.'); 
    if(db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT id FROM w_blacklist WHERE type = \'1\' && value = \''.$ip.'\' LIMIT 1'))) die('Bloqueado');

    // Online/Offline
    if($tsCore->settings['offline'] == 1 && ($tsUser->is_admod != 1 && $tsUser->permisos['govwm'] == false) && $_GET['action'] != 'login-user'){
    	$smarty->assign('tsTitle',$tsCore->settings['titulo'].' -  '.$tsCore->settings['slogan']);
        if(empty($_GET['action'])) 
    	   $smarty->display('sections/mantenimiento.tpl');
        else die('Espera un poco...');
    	exit();
    // Banned
    } elseif($tsUser->is_banned) {
        $banned_data = $tsUser->getUserBanned();
        if(!empty($banned_data)){
            // SI NO ES POR AJAX
            if(empty($_GET['action'])){
                $smarty->assign('tsBanned',$banned_data);
                $smarty->display('sections/suspension.tpl');
            } 
            else die('<div class="alert alert-warning text-center small font-weight-bolder">Usuario suspendido</div>');
            //
            exit();
        }
    }