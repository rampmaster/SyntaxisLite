<?php 
/** 
	* NUEVA CONFIGURACIÓN PARA EL SCRIPT Y SMARTY 
	* @author Miguel92 
  * @copyright 2019 - 2020
*/

/* Establecemos que las paginas no pueden ser cacheadas */
header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("X-Robots-Tag: index, follow", true);

/* VERSIÓN DEL THEME */
define('VersionTheme', '1.2.2');
/*
 * -------------------------------------------------------------------
 *  DEFINIMOS EL DIRECTORIO DE LA CARPETA CACHE
 * -------------------------------------------------------------------
*/
define('TS_CACHE', TS_ROOT.DIRECTORY_SEPARATOR.'cache');
/*
 * -------------------------------------------------------------------
 *  DEFINIMOS LAS RUTAS DE LOS TEMPLATES (T.PAGINA.TPL)
 * -------------------------------------------------------------------
*/
$smarty->setTemplateDir(array(
  /* ↓ Templates ↓ */
  'Templates' => TS_ROOT.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.TS_TEMA.DIRECTORY_SEPARATOR.'templates', 
));
/*
 * -------------------------------------------------------------------
 *  DEFINIMOS EL DIRECTORIO DE LA CARPETA CACHE
 * -------------------------------------------------------------------
*/
$smarty->setCompileDir(TS_CACHE.DIRECTORY_SEPARATOR.TS_TEMA);

/* COMPRIME EL HTML PARA MÁS VELOCIDAD */
#$smarty->loadFilter('output', 'trimwhitespace');

/* HABILITA SEGUIRDAD PREDETERMINADA */
$smarty->enableSecurity(); 

/* PARA LAS CLAVES DE RECAPTCHA V3 */
$smarty->assign('tsKeyPbulic', $tsCore->settings['pkey']);

/**
 * -------------------------------------------------------------------
 * DAMOS LA UBICACIÓN GEOGRÁFICA 
 * Página: https://www.php.net/manual/es/timezones.php
 * -------------------------------------------------------------------
*/
date_default_timezone_set('America/Argentina/Buenos_Aires');
/**
 * -------------------------------------------------------------------
 * FORZAMOS EL IDIOMA EN ESPAÑOL 
 * Página: https://www.php.net/manual/es/function.setlocale.php
 * -------------------------------------------------------------------
*/
$locale = "es_ES";
setlocale(LC_ALL, $locale);
setlocale(LC_TIME, 'spanish');
// Linux
setlocale(LC_MESSAGES, $locale);
// windows
putenv("LC_ALL={$locale}"); 
$smarty->assign('Lenguaje', $locale);

/*
 * -------------------------------------------------------------------
 *  DEFINIMOS EL DIRECTORIO DE LA CARPETA CACHE
 * -------------------------------------------------------------------
*/
$Cache = TS_ROOT . DIRECTORY_SEPARATOR . 'cache/' . TS_TEMA.'/*';
$files = glob($Cache); 
foreach($files as $archivo){
  if(is_file($archivo)) unlink($archivo);
}

$Hour = date('G');
if ( $Hour >= 5 && $Hour <= 11 ) {
  $smarty->assign('tsLader', 'dias');
  $smarty->assign('tsMessage', "Buenos<br>días");
} else if ( $Hour >= 12 && $Hour <= 18 ) {
  $smarty->assign('tsLader', 'tardes');
  $smarty->assign('tsMessage', "Buenas<br>tardes");
} else if ( $Hour >= 19 || $Hour <= 4 ) {
  $smarty->assign('tsLader', 'noche');
  $smarty->assign('tsMessage', "Buenas<br>noches");
}

// METADATAS
$seo = $tsJson->getSeo();
$smarty->assign("jobSite", 'Miguel92 <https://newrisus.com/perfil/Miguel92>');
$smarty->assign("canonical", urldecode($tsCore->currentUrl()));
$smarty->assign("tsColor", $seo['color']);
$smarty->assign("AppFb", $seo['app_fb']);
$smarty->assign("TwUser", $seo['tw_page']);
if($_GET['do'] == NULL || $_GET['do'] == 'home' || $tsPage == 'fotos' || $tsPage == 'tops' || $tsPage == 'videos') {
  # SEO
  $smarty->assign('tsTitle', $tsTitle);
  $smarty->assign('tsAuthor', 'Miguel92');
  $smarty->assign('tsSeoDescripcion', $seo['description']);
  $smarty->assign('tsPublished', $tsCore->timeseo(time()));
  $smarty->assign('tsUrl', $tsCore->settings['url']);
  $smarty->assign('tsImagen', $seo['images']);
  $smarty->assign('tsKey', $seo['keys']);
}

$smarty->assign('tsFooterDes', $seo['description']);
# Para detectar que tipo de dispositivo esta usando
$smarty->assign('tsMobile', $detect->isMobile());
# Extraemos la información del json para modificar
$smarty->assign("tsAdmInfo", $tsJson->getAdminInfo());
$smarty->assign("tsAdmSeo", $tsJson->getSeo());
# Añadimos la imagen y css al header
$smarty->assign("tsStyleAdmin", $tsJson->getAddInfo());