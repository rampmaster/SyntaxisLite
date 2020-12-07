<?php if (!defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Modelo para la adminitración
 *
 * @name    c.admin.php
 * @author  PHPost Team
 * @upgrade Actualizaciones, mejoras en el código
 * y eliminación de líneas innecesarias
*/
class tsAdmin {

   # Obtenemos todos los administradores
   public function getAdmins() {
      $query = db_exec(array(__FILE__, __LINE__), 'query', "SELECT `user_id`, `user_name` FROM `u_miembros` WHERE user_rango = 1 ORDER BY user_id");
      $data  = result_array($query);
      return $data;
   }
   # Obtenemos estadísticas de fundación e instalación del script
   public function getInst() {
      $query = db_exec(array(__FILE__, __LINE__), 'query', "SELECT `stats_time_foundation`, `stats_time_upgrade` FROM `w_stats` WHERE stats_no = 1");
      $data = db_exec('fetch_row', $query);
      return $data;
   }
   # Sistema de versiones
   public function SystemUpgrades() {
      global $tsCore;
      $link = 'https://v6demo.000webhostapp.com/news';
      $code = array('w' => $tsCore->settings['titulo'], 's' => $tsCore->settings['slogan'], 'u' => str_replace(array('http://', 'https://'), '', $tsCore->settings['url']), 'v' => $tsCore->settings['version_code']);
      $key = base64_encode(serialize($code));
      # Datos
      $data['datos'] = $tsCore->getUrlContent($link . '/index.php?scr=Datos&key='.$key);
      $data['feed'] = $tsCore->getUrlContent($link . '/index.php?scr=Feed&key='.$key);

      return $data;
   }
   # Obtenemos versiones del PHP, SERVER, MYSQL, GD
   public function getVersions() {
      # PHP
      $data['php'] = PHP_VERSION;
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT VERSION()');
      # MYSQL
      $data['mysql'] = db_exec('fetch_row', $query);
      # SERVER
      $data['server'] = $_SERVER['SERVER_SOFTWARE'];
      # LIBRERÍA GD
      $temp = @gd_info();
      $data['gd'] = $temp['GD Version'];
      //
      return $data;
   }
   # Obtenemos y guardamos configuraciones del sitio
   public function saveConfig() {
      global $tsCore;
      //
      $c = array(
         'titulo'          => $tsCore->setSecure($tsCore->parseBadWords($_POST['titulo'])),
         'slogan'          => $tsCore->setSecure($tsCore->parseBadWords($_POST['slogan'])),
         'url'             => $tsCore->setSecure($tsCore->parseBadWords($_POST['url'])),
         'offline'         => empty($_POST['offline']) ? 0 : 1,
         'offline_message' => $tsCore->setSecure($tsCore->parseBadWords($_POST['offline_message'])),
         'edad'            => $tsCore->setSecure($_POST['edad']),
         'active'          => $tsCore->setSecure($_POST['active']),
         'sess_ip'         => empty($_POST['sess_ip']) ? 0 : 1,
         'count_guests'    => $tsCore->setSecure($_POST['count_guests']),
         'reg_active'      => empty($_POST['reg_active']) ? 0 : 1,
         'reg_activate'    => empty($_POST['reg_activate']) ? 0 : 1,
         'met_welcome'     => $tsCore->setSecure($_POST['met_welcome']),
         'message_welcome' => $tsCore->setSecure($tsCore->parseBadWords($_POST['message_welcome'])),
         'fotos_private'   => empty($_POST['fotos_private']) ? 0 : 1,
         'hits_guest'      => empty($_POST['hits_guest']) ? 0 : 1,
         'keep_points'     => empty($_POST['keep_points']) ? 0 : 1,
         'allow_points'    => $tsCore->setSecure($_POST['allow_points']),
         'see_mod'         => empty($_POST['see_mod']) ? 0 : 1,
         'stats_cache'     => $tsCore->setSecure($_POST['stats_cache']),
         'desapprove_post' => empty($_POST['desapprove_post']) ? 0 : 1,
         'firma'           => empty($_POST['firma']) ? 0 : 1,
         'upload'          => empty($_POST['upload']) ? 0 : 1,
         'portal'          => empty($_POST['portal']) ? 0 : 1,
         'live'            => empty($_POST['live']) ? 0 : 1,
         'max_nots'        => $tsCore->setSecure($_POST['max_nots']),
         'max_acts'        => $_POST['max_acts'],
         'max_posts'       => $tsCore->setSecure($_POST['max_posts']),
         'max_com'         => $tsCore->setSecure($_POST['max_com']),
         'sump'            => empty($_POST['sump']) ? 0 : 1,
         'newr'            => empty($_POST['newr']) ? 0 : 1,
         'pkey'            => $tsCore->setSecure($_POST['pkey']),
         'skey'            => $tsCore->setSecure($_POST['skey']),
         'max_upload'      => $tsCore->setSecure($_POST['max_upload']),
         'files_type'      => $tsCore->setSecure($_POST['files_type']),
         'files_ext'       => $tsCore->setSecure($_POST['files_ext']),
      );
      // UPDATE
      if (db_exec(array(__FILE__, __LINE__), 'query', "UPDATE `w_configuracion` SET `titulo` = '{$c['titulo']}', `slogan` = '{$c['slogan']}', `url` = '{$c['url']}', `c_last_active` = '{$c['active']}', `c_allow_sess_ip` = '{$c['sess_ip']}', `c_count_guests` = '{$c['count_guests']}', `c_reg_active` = '{$c['reg_active']}', `c_reg_activate` = '{$c['reg_activate']}', `c_met_welcome` = '{$c['met_welcome']}', `c_message_welcome` = '{$c['message_welcome']}', `c_fotos_private` = '{$c['fotos_private']}', `c_hits_guest` = '{$c['hits_guest']}', `c_keep_points` = '{$c['keep_points']}', `c_allow_points` = '{$c['allow_points']}', `c_see_mod` = '{$c['see_mod']}', `c_stats_cache` = '{$c['stats_cache']}',`c_desapprove_post` = '{$c['desapprove_post']}', `c_allow_edad` = '{$c['edad']}', `c_max_posts` = '{$c['max_posts']}', `c_max_com` = '{$c['max_com']}', `c_max_nots` = '{$c['max_nots']}', `c_max_acts` = '{$c['max_acts']}', `c_allow_sump` = '{$c['sump']}', `c_newr_type` = '{$c['newr']}', `c_allow_firma` = '{$c['firma']}', `c_allow_upload` = '{$c['upload']}', `c_allow_portal` = '{$c['portal']}', `c_allow_live` = '{$c['live']}', `offline` = '{$c['offline']}', `offline_message` = '{$c['offline_message']}', `pkey` = '{$c['pkey']}', `skey` = '{$c['skey']}', `c_max_upload` = '{$c['max_upload']}', `c_files_type` = '{$c['files_type']}', `c_files_ext` = '{$c['files_ext']}' WHERE `tscript_id` = 1")) return true;
      else exit(show_error('Error al ejecutar la consulta de la l&iacute;nea ' . __LINE__ . ' de ' . __FILE__ . '.', 'db'));
   }
   # Obtenemos todas las noticias
   public function getNoticias() {
      global $tsCore;
      $query = db_exec(array(__FILE__, __LINE__), 'query', "SELECT u.user_id, u.user_name, n.* FROM w_noticias AS n LEFT JOIN u_miembros AS u ON n.not_autor = u.user_id  WHERE n.not_id > 0 ORDER BY n.not_id DESC");
      $data  = result_array($query);
      foreach ($data as $key => $value) {
         $data[$key]['body'] = $tsCore->parseBBCode($data[$key]['not_body']);
      }
      return $data;
   }
   # Eliminamos la noticia
   public function delNoticia() {
      $not_id = intval($_GET['nid']);
      if (!db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', "SELECT `not_id` FROM `w_noticias` WHERE `not_id` = '{$not_id}' LIMIT 1"))) return 'El id ingresado no existe.';
      db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM `w_noticias` WHERE `not_id` = '{$not_id}'");
   }
   # Obtenemos la noticia
   public function getNoticia() {
      global $tsCore;
      $not_id = $tsCore->setSecure($_GET['nid']);
      $query = db_exec(array(__FILE__, __LINE__), 'query', "SELECT `not_id`, `not_body`, `not_date`, `not_active` FROM w_noticias WHERE not_id = '{$not_id}' LIMIT 1");
      $data  = db_exec('fetch_assoc', $query);
      return $data;
   }
   # Creamos nueva noticia
   public function newNoticia() {
      global $tsCore, $tsUser;
      $not_body   = $tsCore->setSecure($tsCore->parseBadWords(substr($_POST['not_body'], 0, 190)));
      $not_active = empty($_POST['not_active']) ? 0 : 1;
      $time = time();
      if (!empty($not_body)) {
         if (db_exec(array(__FILE__, __LINE__), 'query', "INSERT INTO `w_noticias` (`not_body`, `not_autor`, `not_date`, `not_active`) VALUES ('{$not_body}', '{$tsUser->uid }', '{$time}', '{$not_active}')")) return true;
      }
      return false;
   }
   /*
   editNoticia()
   */
   public function editNoticia() {
      global $tsCore, $tsUser;
      $not_id   = intval($_GET['nid']);
      $not_body = $tsCore->setSecure($tsCore->parseBadWords(substr($_POST['not_body'], 0, 190)));
      $not_active = empty($_POST['not_active']) ? 0 : 1;
      //
      if (!empty($not_body)) {
         if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_noticias` SET `not_autor` = \'' . $tsUser->uid . '\', `not_body` = \'' .
            $not_body . '\', not_active = \'' . $not_active . '\' WHERE not_id = \'' . (int)
            $not_id . '\'')) {
            return true;
         }

      }
   }
   /* getTemas() */
   public function getTemas()
   {
      global $tsCore;
      //
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `tid`, `t_name`, `t_url`, `t_path` FROM `w_temas` WHERE tid != \'0\'');
      //
      $data = result_array($query);
      //
      return $data;
   }
   /* getTema() */
   public function getTema($var)
   {
      global $tsCore;
      //
      $tema_id = $tsCore->setSecure($_GET['tid']);
      //
      $query = ($var == 'true') ? db_exec(array(__FILE__, __LINE__), 'query', 'SELECT t.t_name, t.t_copy, c.tema_id FROM w_temas AS t LEFT JOIN w_configuracion AS c ON t.tid = c.tema_id LIMIT 1') : db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `tid`, `t_name`, `t_url`, `t_path` FROM `w_temas` WHERE tid = \'' . (int) $tema_id . '\' LIMIT 1');
      $data  = db_exec('fetch_assoc', $query);
      //
      return $data;
   }

   /* saveTema() */
   public function saveTema()
   {
      global $tsCore;
      //
      $tema_id = $tsCore->setSecure($_GET['tid']);
      //
      $t = array('url' => $tsCore->setSecure($_POST['url']), 'path' => $tsCore->setSecure($_POST['path']));
      //
      if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_temas` SET t_url = \'' . $t['url'] . '\', t_path = \'' . $t['path'] . '\' WHERE tid = \'' . (int) $tema_id . '\'')) {
         return true;
      } else {
         return false;
      }

   }
   /* Instalar theme desde .ZIP */
   public function getTemaModal()
   {
      global $tsCore;
      //
      $tema_id = $tsCore->setSecure($_GET['tid']);
      //
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `tid`, `t_name`, `t_url`, `t_path` FROM `w_temas` WHERE tid = \'' . (int) $tema_id . '\' LIMIT 1');
      $data  = db_exec('fetch_assoc', $query);
      //
      return $data;
   }

   /* changeTema() */
   public function changeTema()
   {
      global $smarty;
      //
      $tema = $this->getTemaModal();
      //
      if (!empty($tema['tid'])) {
         db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_configuracion` SET tema_id = \'' . (int) $tema['tid'] . '\' WHERE tscript_id = \'1\'');
         $d = $smarty->compile_dir;
         $h = opendir($d);
         while (($o = readdir($h)) !== false) {
            if (($o != ".") and ($o != "..")) {
               unlink($d . DIRECTORY_SEPARATOR . $o);
            }
         }
         closedir($h);
         return true;
      } else {
         return false;
      }

   }

   /* deleteTema() */
   public function deleteTema()
   {
      //
      $tema = $this->getTemaModal();
      //
      if (!empty($tema['tid'])) {
         db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM `w_temas` WHERE tid = \'' . (int) $tema['tid'] . '\'');
         return true;
      } else {
         return false;
      }

   }

   /* newTema() */
   public function newTema()
   {
      global $tsCore;
      //
      $tema_path = $tsCore->setSecure($_POST['path']);

      // ARCHIVO DE INSTALACION
      include "../../themes/" . $tema_path . '/install.php';
      //
      if (empty($tema)) {
         return 'Revisa que la carpeta del tema sea correcta.';
      }

      foreach ($tema as $key => $val) {
         if (empty($val)) {
            return 'El archivo de instalaci&oacute;n del tema es incorrecto. Recuerda utilizar temas oficiales.';
         } else {
            $temadb[$key] = $tsCore->setSecure($val);
         }

      }
      // NUEVO
      if (db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `w_temas` (`t_name`, `t_url`, `t_path`, `t_copy`) VALUES (\'' . $tsCore->setSecure($temadb['nombre']) . '\', \'' . $tsCore->setSecure($temadb['url']) . '\', \'' . $tsCore->setSecure($tema_path) . '\', \'' . $tsCore->setSecure($temadb['copy']) . '\')')) {
         return 1;
      } else {
         return 'Ocurri&oacute; un error durante la instalaci&oacute;n. Consulta el foro ofcial de New Risus.';
      }

   }
   /*
   saveAds()
    */
   public function saveAds()
   {
      global $tsCore;
      // D: Podria ser un riesgo de seguridad no limpiar estas variables? no lo creo pues cuando definimos el nivel de acceso solo pueden entrar
      // administradores. Cualquier fallo sera culpa de ellos Dx
      $a = array(
         'ad300' => html_entity_decode($_POST['ad300']),
         'ad468' => html_entity_decode($_POST['ad468']),
         'ad160' => html_entity_decode($_POST['ad160']),
         'ad728' => html_entity_decode($_POST['ad728']),
         'sid'   => $_POST['adSearch']);
      //
      if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_configuracion` SET ads_300 = \'' . $tsCore->
         setSecure($a['ad300']) . '\', ads_468 = \'' . $tsCore->setSecure($a['ad468']) .
         '\', ads_160 = \'' . $tsCore->setSecure($a['ad160']) . '\', ads_728 = \'' . $tsCore->
         setSecure($a['ad728']) . '\', ads_search = \'' . $tsCore->setSecure($a['sid']) .
         '\' WHERE tscript_id = \'1\'')) {
         return true;
      }

   }
   /*
      saveOrden() : GUARDA EL ORDEN DE LAS CAT Y SUBCAT
   */
   public function saveOrden() {
      global $tsCore;
      //
      $catid   = $tsCore->setSecure($_POST['catid']);
      $subcats = $_POST[$catid];
      // MODIFICAMOS
      $orden = 1;
      foreach ($subcats as $key => $cid) {
         if (!empty($cid)) {
            db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `p_categorias` SET c_orden = \'' . (int) $orden . '\' WHERE cid = \'' . (int) $cid . '\'');
            $orden++;
         }
      }
   }
   /*
   getCat()
   : OBTIENE LOS DATOS DE LA CAT O SUBCATEGORIA
    */
   public function getCat()
   {
      global $tsCore;
      //
      //$db = $this->getDBtypes();
      $cid = intval($_GET['cid']);
      //
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT cid, c_orden, c_nombre, c_seo FROM p_categorias WHERE cid = \'' . (int) $cid . '\' LIMIT 1');
      $data = db_exec('fetch_assoc', $query);

      //
      return $data;
   }
   /*
   saveCat()
   : EDITA LOS DATOS DE LA CAT O SUBCAT
    */
   public function saveCat() {
      global $tsCore;
      //
      //$db = $this->getDBtypes();
      $cid = $tsCore->setSecure($_GET['cid']);
      //
      $c_nombre = $tsCore->setSecure($tsCore->parseBadWords($_POST['c_nombre']));
      if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `p_categorias` SET c_nombre = \'' . $tsCore->setSecure($c_nombre) . '\', c_seo = \'' . $tsCore->setSecure($tsCore->setSEO($c_nombre, true)) . '\' WHERE cid = \'' . (int) $cid . '\'')) {
         return true;
      }

   }

   /*
   MoveCat()
   : Movemos de una categoria a otra.
    */
   public function MoveCat() {
      if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `p_posts` SET post_category = \'' . (int) $_POST['newcid'] . '\' WHERE post_category = \'' . (int) $_POST['oldcid'] . '\'')) {
         return true;
      }

   }

   /*
   newCat()
   : CREAMOS UNA NUEVA CATEGORÍA
    */
   public function newCat()
   {
      global $tsCore;
      //
      //$db = $this->getDBtypes();
      // VALORES
      $c_nombre = $tsCore->setSecure($tsCore->parseBadWords($_POST['c_nombre']));
      // ORDEN
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(cid) AS total FROM `p_categorias`');
      $orden = db_exec('fetch_assoc', $query);
      $orden = $orden['total'] + 1;
      // INSERTS
      if (db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `p_categorias` (`c_orden`, `c_nombre`, `c_seo`) VALUES (\'' . $orden . '\', \'' . $c_nombre . '\',\'' . $tsCore->setSEO($c_nombre, true) . '\')')) {
         return true;
      }

   }

   /*
   delCat()
   : BORRAR SCATEGORIA
    */
   public function delCat()
   {
      global $tsCore;
      //
      $cid  = $tsCore->setSecure($_GET['cid']);
      $ncid = $tsCore->setSecure($_POST['ncid']);
      // MOVER
      if (!empty($ncid) && $ncid > 0) {
         if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `p_posts` SET post_category = \'' . (int) $ncid . '\' WHERE post_category = \'' .
            (int) $cid . '\'')) {
            if (db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM `p_categorias` WHERE cid = \'' . (int) $cid . '\'')) {
               return 1;
            }

         } else // SI LLEGÓ HASTA AQUI HUBO UN ERROR.

         {
            return 'Lo sentimos ocurri&oacute; un error, pongase en contacto con PHPost.';
         }

      } else {
         return 'Antes de eliminar una categor&iacute;a debes elegir a donde mover sus subcategor&iacute;as.';
      }

   }

   /*
   getDBtypes()
   : DETERMINA EL NOMBRE DE LA TABLA SEGUN EL TIPO
    */
   public function getDBtypes()
   {
      // TIPO
      if ($_GET['t'] == 'cat') {
         $data['table'] = 'p_categorias';
         $data['pre']   = 'c';
      } else {
         $data['table'] = 'p_subcategorias';
         $data['pre']   = 's';
      }
      //
      return $data;
   }
   /*
   getRangos()
    */
   public function getRangos()
   {
      global $tsCore;
      // RANGOS SIN PUNTOS
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT * FROM u_rangos ORDER BY rango_id, r_cant');
      // ARMAR ARRAY
      while ($row = db_exec('fetch_assoc', $query)) {
         $extra                                                            = unserialize($row['r_allows']);
         $data[$row['r_type'] == 0 ? 'regular' : 'post'][$row['rango_id']] = array(
            'id'          => $row['rango_id'],
            'name'        => $row['r_name'],
            'color'       => $row['r_color'],
            'imagen'      => $row['r_image'],
            'cant'        => $row['r_cant'],
            'max_points'  => $extra['gopfp'],
            'user_puntos' => $extra['gopfd'],
            'type'        => $row['r_type'],
            'num_members' => 0);
      }
      db_exec('free_result', $query);
      // NUMERO DE USUARIOS EN CADA RANGO
      if (!empty($data['post'])) {
         $query = db_exec(array(__FILE__, __LINE__), 'query', "
                SELECT user_rango AS ID_GROUP, COUNT(user_id) AS num_members
                FROM u_miembros
                WHERE user_rango IN (" . implode(', ', array_keys($data['post'])) . ")
                GROUP BY user_rango");
         while ($row = db_exec('fetch_assoc', $query)) {
            $data['post'][$row['ID_GROUP']]['num_members'] += $row['num_members'];
         }

         db_exec('free_result', $query);
      }
      // NUMERO DE USUARIOS EN RANGOS REGULARES
      if (!empty($data['regular'])) {
         $query = db_exec(array(__FILE__, __LINE__), 'query', "
                SELECT user_rango AS ID_GROUP, COUNT(*) AS num_members
                FROM u_miembros
                WHERE user_rango IN (" . implode(', ', array_keys($data['regular'])) . ")
                GROUP BY user_rango");
         while ($row = db_exec('fetch_assoc', $query)) {
            $data['regular'][$row['ID_GROUP']]['num_members'] += $row['num_members'];
         }

         db_exec('free_result', $query);
      }
      //
      return $data;
   }
   /*
   getRango
    */
   public function getRango()
   {
      global $tsCore;
      //
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT * FROM u_rangos WHERE rango_id = \'' . (int) $_GET['rid'] .
         '\' LIMIT 1');
      $data = db_exec('fetch_assoc', $query);

      //
      $data['permisos'] = unserialize($data['r_allows']);
      //
      return $data;
   }
   /*
   getRangoUsers()
    */
   public function getRangoUsers()
   {
      global $tsCore;
      //
      $rid = $tsCore->setSecure($_GET['rid']);
      $max = 10; // MAXIMO A MOSTRAR
      // TIPO DE BUSQUEDA
      $type  = $_GET['t'];
      $where = 'user_rango = \'' . (int) $rid . '\'';
      // SELECCIONAMOS
      $limit = $tsCore->setPageLimit($max, true);
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, u.user_email, u.user_registro, u.user_lastlogin FROM u_miembros AS u WHERE u.' .
         $where . ' LIMIT ' . $limit);
      //
      $data['data'] = result_array($query);

      // PAGINAS
      $query       = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(*) FROM u_miembros WHERE ' . $where);
      list($total) = db_exec('fetch_row', $query);

      $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] .
         '/admin/rangos?act=list&rid=' . $rid . '&t=' . $type . '', $_GET['s'], $total, $max);
      //
      return $data;
   }
   /*
   saveRango()
    */
   public function saveRango()
   {
      global $tsCore;
      //
      $rid = $tsCore->setSecure($_GET['rid']);
      $r   = array(
         'name'  => $tsCore->setSecure($tsCore->parseBadWords($_POST['rName'])),
         'color' => $tsCore->setSecure($_POST['rColor']),
         'cant'  => empty($_POST['global-cantidadrequerida']) ? 0 : $tsCore->setSecure($_POST['global-cantidadrequerida']),
         'img'   => $tsCore->setSecure($_POST['r_img']),
         'type'  => $_POST['global-type'] > 4 ? 0 : $_POST['global-type'],
      );
      //
      if (empty($r['name'])) {
         return 'Debes ingresar el nombre del nuevo rango.';
      }

      if ($_POST['global-pointsforposts'] > $_POST['global-pointsforday']) {
         return 'El rango no puede dar m&aacute;s puntos de los que tiene al d&iacute;a.';
      }

      //
      $array = array(
         'suad'     => $_POST['superadmin'],
         'sumo'     => $_POST['supermod'],
         'moacp'    => $_POST['mod-accesopanel'],
         'mocdu'    => $_POST['mod-cancelardenunciasusuarios'],
         'moadf'    => $_POST['mod-aceptardenunciasfotos'],
         'mocdf'    => $_POST['mod-cancelardenunciasfotos'],
         'mocdp'    => $_POST['mod-cancelardenunciasposts'],
         'moadm'    => $_POST['mod-aceptardenunciasmensajes'],
         'mocdm'    => $_POST['mod-cancelardenunciasmensajes'],
         'movub'    => $_POST['mod-verusuariosbaneados'],
         'moub'     => $_POST['mod-usarbuscador'],
         'morp'     => $_POST['mod-reciclajeposts'],
         'morf'     => $_POST['mod-reficlajefotos'],
         'mocp'     => $_POST['mod-contenidoposts'],
         'mocc'     => $_POST['mod-contenidocomentarios'],
         'most'     => $_POST['mod-sticky'],
         'moayca'   => $_POST['mod-abrirycerrarajax'],
         'movcud'   => $_POST['mod-vercuentasdesactivadas'],
         'movcus'   => $_POST['mod-vercuentassuspendidas'],
         'mosu'     => $_POST['mod-suspenderusuarios'],
         'modu'     => $_POST['mod-desbanearusuarios'],
         'moep'     => $_POST['mod-eliminarposts'],
         'moedpo'   => $_POST['mod-editarposts'],
         'moop'     => $_POST['mod-ocultarposts'],
         'mocepc'   => $_POST['mod-comentarpostcerrado'],
         'moedcopo' => $_POST['mod-editarcomposts'],
         'moaydcp'  => $_POST['mod-desyaprobarcomposts'],
         'moecp'    => $_POST['mod-eliminarcomposts'],
         'moef'     => $_POST['mod-eliminarfotos'],
         'moedfo'   => $_POST['mod-editarfotos'],
         'moecf'    => $_POST['mod-eliminarcomfotos'],
         'moepm'    => $_POST['mod-eliminarpubmuro'],
         'moecm'    => $_POST['mod-eliminarcommuro'],
         'godp'     => $_POST['global-darpuntos'],
         'gopp'     => $_POST['global-publicarposts'],
         'gopcp'    => $_POST['global-publicarcomposts'],
         'govpp'    => $_POST['global-votarposipost'],
         'govpn'    => $_POST['global-votarnegapost'],
         'goepc'    => $_POST['global-editarpropioscomentarios'],
         'godpc'    => $_POST['global-eliminarpropioscomentarios'],
         'gopf'     => $_POST['global-publicarfotos'],
         'gopcf'    => $_POST['global-publicarcomfotos'],
         'gorpap'   => $_POST['global-revisarposts'],
         'govwm'    => $_POST['global-vermantenimiento'],
         'goaf'     => $_POST['global-antiflood'],
         'gopfp'    => $_POST['global-pointsforposts'],
         'gopfd'    => $_POST['global-pointsforday']);
      $permisos = serialize($array);
      //
      if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `u_rangos` SET r_name = \'' . $tsCore->setSecure($r['name']) .
         '\', r_color = \'' . $r['color'] . '\', r_image = \'' . $tsCore->setSecure($r['img']) .
         '\', r_cant = \'' . (int) $r['cant'] . '\', r_allows = \'' . $tsCore->setSecure($permisos) .
         '\', r_type = \'' . $r['type'] . '\' WHERE rango_id = \'' . (int) $rid . '\'')) {
         return true;
      } else {
         exit(show_error('Error al ejecutar la consulta de la l&iacute;nea ' . __LINE__ . ' de ' . __FILE__ . '.', 'db'));
      }

   }
   /*
   newRango()
    */
   public function newRango()
   {
      global $tsCore;
      //
      $r = array(
         'name'  => $tsCore->setSecure($tsCore->parseBadWords($_POST['rName'])),
         'color' => $tsCore->setSecure($_POST['rColor']),
         'cant'  => empty($_POST['global-cantidadrequerida']) ? 0 : $tsCore->setSecure($_POST['global-cantidadrequerida']),
         'img'   => $tsCore->setSecure($_POST['r_img']),
         'type'  => $_POST['global-type'] > 4 ? 0 : $_POST['global-type'],
      );
      //
      //
      if (empty($r['name'])) {
         return 'Debes ingresar el nombre del nuevo rango.';
      }

      if ($_POST['global-pointsforposts'] > $_POST['global-pointsforday']) {
         return 'El rango no puede dar m&aacute;s puntos de los que tiene al d&iacute;a.';
      }

      //
      $array = array(
         'suad'     => $_POST['superadmin'],
         'sumo'     => $_POST['supermod'],
         'moacp'    => $_POST['mod-accesopanel'],
         'mocdu'    => $_POST['mod-cancelardenunciasusuarios'],
         'moadf'    => $_POST['mod-aceptardenunciasfotos'],
         'mocdf'    => $_POST['mod-cancelardenunciasfotos'],
         'mocdp'    => $_POST['mod-cancelardenunciasposts'],
         'moadm'    => $_POST['mod-aceptardenunciasmensajes'],
         'mocdm'    => $_POST['mod-cancelardenunciasmensajes'],
         'movub'    => $_POST['mod-verusuariosbaneados'],
         'moub'     => $_POST['mod-usarbuscador'],
         'morp'     => $_POST['mod-reciclajeposts'],
         'morf'     => $_POST['mod-reficlajefotos'],
         'mocp'     => $_POST['mod-contenidoposts'],
         'mocc'     => $_POST['mod-contenidocomentarios'],
         'most'     => $_POST['mod-sticky'],
         'moayca'   => $_POST['mod-abrirycerrarajax'],
         'movcud'   => $_POST['mod-vercuentasdesactivadas'],
         'movcus'   => $_POST['mod-vercuentassuspendidas'],
         'mosu'     => $_POST['mod-suspenderusuarios'],
         'modu'     => $_POST['mod-desbanearusuarios'],
         'moep'     => $_POST['mod-eliminarposts'],
         'moedpo'   => $_POST['mod-editarposts'],
         'moop'     => $_POST['mod-ocultarposts'],
         'mocepc'   => $_POST['mod-comentarpostcerrado'],
         'moedcopo' => $_POST['mod-editarcomposts'],
         'moaydcp'  => $_POST['mod-desyaprobarcomposts'],
         'moecp'    => $_POST['mod-eliminarcomposts'],
         'moef'     => $_POST['mod-eliminarfotos'],
         'moedfo'   => $_POST['mod-editarfotos'],
         'moecf'    => $_POST['mod-eliminarcomfotos'],
         'moepm'    => $_POST['mod-eliminarpubmuro'],
         'moecm'    => $_POST['mod-eliminarcommuro'],
         'godp'     => $_POST['global-darpuntos'],
         'gopp'     => $_POST['global-publicarposts'],
         'gopcp'    => $_POST['global-publicarcomposts'],
         'govpp'    => $_POST['global-votarposipost'],
         'govpn'    => $_POST['global-votarnegapost'],
         'goepc'    => $_POST['global-editarpropioscomentarios'],
         'godpc'    => $_POST['global-eliminarpropioscomentarios'],
         'gopf'     => $_POST['global-publicarfotos'],
         'gopcf'    => $_POST['global-publicarcomfotos'],
         'gorpap'   => $_POST['global-revisarposts'],
         'govwm'    => $_POST['global-vermantenimiento'],
         'goaf'     => $_POST['global-antiflood'],
         'gopfp'    => $_POST['global-pointsforposts'],
         'gopfd'    => $_POST['global-pointsforday']);
      $permisos = serialize($array);
      //

      if (db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `u_rangos` (`r_name`, `r_color`, `r_image`, `r_cant`, `r_allows`, `r_type`) VALUES (\'' .
         $tsCore->setSecure($r['name']) . '\', \'' . $r['color'] . '\', \'' . $tsCore->
         setSecure($r['img']) . '\', \'' . (int) $r['cant'] . '\', \'' . $tsCore->
         setSecure($permisos) . '\', \'' . (int) $r['type'] . '\')')) {
         return 1;
      }

   }
   /*
   delRango()
    */
   public function delRango()
   {
      global $tsCore;
      //
      $rid = $tsCore->setSecure($_GET['rid']);
      //
      if ($rid > 3) {
         if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_rango = \'' . (int) $_POST['new_rango'] .
            '\' WHERE user_rango = \'' . (int) $rid . '\'')) {
            if (db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM u_rangos WHERE rango_id = \'' . (int) $rid . '\'')) {
               return true;
            }

         }
      } else {
         return 'No es posible eliminar este rango';
      }

   }
   /*
   SetDefaultRango()
    */
   public function SetDefaultRango()
   {
      global $tsCore;
      //
      if ($_SERVER['HTTP_REFERER'] == $tsCore->settings['url'] . '/admin/rangos?save=true' || $_SERVER['HTTP_REFERER'] == $tsCore->settings['url'] . '/admin/rangos') {
         $rid = $tsCore->setSecure($_GET['rid']);
         //
         $dato = db_exec('fetch_assoc', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT rango_id, r_type FROM u_rangos WHERE rango_id = \'' .
            (int) $rid . '\' LIMIT 1'));
         if (!empty($dato['rango_id']) && $dato['r_type'] == 0) {
            if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE w_configuracion SET c_reg_rango = \'' . (int) $rid . '\' WHERE tscript_id = \'1\'')) {
               return true;
            }

         } else {
            return 'El rango no existe o no es posible utilizarlo';
         }

      } else {
         return 'Petici&oacute;n inv&aacute;lida';
      }

   }
   /*
      getExtraIcons()
   */
   public function getExtraIcons($f = 'cat', $size = null) {
      // IMAGENES DEL TIPO...
      $arr_ext = array("jpg","png","gif");
      // DONDE... SOLO VAN EN EL TEMA DEFAULT
      $mydir = opendir("../../themes/".TS_TEMA."/images/icons/" . $f);
      // LEEMOS
      while ($file = readdir($mydir)) {
         $ext = substr($file, -3);
         // ES IMAGEN
         if (in_array($ext, $arr_ext)) {
            if (!empty($size)) {
               $im_size = substr($file, -6, 2);
               if ($size == $im_size) $icons[] = substr($file, 0, -7);
            } else $icons[] = $file;

         }
      }
      //
      return $icons;
   }
   /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
   // ADMINISTRAR USUARIOS \\
   /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
   /*
   getUsuarios()
    */
   public function getUsuarios()
   {
      global $tsCore;
      //
      $max   = 20; // MAXIMO A MOSTRAR
      $limit = $tsCore->setPageLimit($max, true);
      //
      if ($_GET['o'] == 'e') {
         $order = 'u.user_activo, u.user_baneado';
      } elseif ($_GET['o'] == 'c') {
         $order = 'u.user_email';
      } elseif ($_GET['o'] == 'i') {
         $order = 'u.user_last_ip';
      } elseif ($_GET['o'] == 'u') {
         $order = 'u.user_lastactive';
      } else {
         $order = 'u.user_id';
      }
      //
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.*, r.*, p.* FROM u_perfil AS p LEFT JOIN u_miembros AS u ON u.user_id = p.user_id LEFT JOIN u_rangos AS r ON r.rango_id = u.user_rango ORDER BY ' .
         $order . ' ' . ($_GET['m'] == 'a' ? 'ASC' : 'DESC') . ' LIMIT ' . $limit);
      //
      $data['data'] = result_array($query);

      // PAGINAS
      $query       = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(*) FROM u_miembros WHERE user_id > \'0\'');
      list($total) = db_exec('fetch_row', $query);

      $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] . "/admin/users?o=" .
         $_GET['o'] . "&m=" . $_GET['m'] . "", $_GET['s'], $total, $max);
      //
      return $data;
   }

   /*
   getUserData()
    */
   public function getUserPrivacidad()
   {
      global $tsCore;
      //
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT p_configs FROM u_perfil WHERE user_id = \'' . (int)
         $_GET['uid'] . '\' LIMIT 1');
      $data              = db_exec('fetch_assoc', $query);
      $data['p_configs'] = unserialize($data['p_configs']);
      //
      return $data;
   }
   /*
   getUserData()
    */
   public function setUserPrivacidad()
   {
      global $tsCore;
      //
      $muro_firm = ($_POST['muro_firm'] > 4) ? 5 : $_POST['muro_firm'];
      $see_hits  = ($_POST['last_hits'] == 1 || $_POST['last_hits'] == 2) ? 0 : $_POST['last_hits'];
      $array     = array(
         'm'    => $_POST['muro'],
         'mf'   => $muro_firm,
         'rmp'  => $_POST['rec_mps'],
         'hits' => $see_hits);
      $perfilData['configs'] = serialize($array);
      //
      //
      $updates = $tsCore->getIUP($perfilData, 'p_');
      if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_perfil SET ' . $updates . ' WHERE user_id = \'' . (int)
         $_GET['uid'] . '\'')) {
         return true;
      }

   }
   /*
   getUserData()
    */
   public function getUserData()
   {
      global $tsCore;
      //
      $user_id = $tsCore->setSecure($_GET['uid']);
      //
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.*, r.*, p.* FROM u_perfil AS p LEFT JOIN u_miembros AS u ON u.user_id = p.user_id LEFT JOIN u_rangos AS r ON r.rango_id = u.user_rango WHERE u.user_id = \'' .
         (int) $user_id . '\' LIMIT 1');
      $data              = db_exec('fetch_assoc', $query);
      $data['p_configs'] = unserialize($data['p_configs']);
      //
      return $data;
   }
   /*
   setUserData
    */
   public function setUserData($user_id)
   {
      global $tsCore;
      # DATA
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `user_name`, `user_email`, `user_password` FROM u_miembros WHERE user_id = \'' .
         (int) $user_id . '\'');
      $data = db_exec('fetch_assoc', $query);
      # LOCALS
      $email       = empty($_POST['email']) ? $data['user_email'] : $_POST['email'];
      $password    = $_POST['pwd'];
      $cpassword   = $_POST['cpwd'];
      $user_nick   = empty($_POST['nick']) ? $data['user_name'] : $_POST['nick'];
      $user_points = empty($_POST['points']) ? $data['user_puntos'] : $_POST['points'];
      $pointsxdar  = empty($_POST['pointsxdar']) ? $data['user_puntos'] : $_POST['pointsxdar'];
      $changenames = empty($_POST['changenicks']) ? $data['user_name_changes'] : $_POST['changenicks'];
      #

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         return 'Correo electr&oacute;nico incorrecto';
      }

      if ($user_points >= 0) {
         $apoints = ', user_puntos = \'' . (int) $user_points . '\'';
      } else {
         return 'Los puntos del usuario no se reconocen';
      }

      if ($changenames >= 0) {
         $changedis = ', user_name_changes = \'' . (int) $changenames . '\'';
      } else {
         return 'Las disponibilidades de cambios de nombre de usuario deben ser num&eacute;ricas.';
      }

      if ($pointsxdar >= 0) {
         $pxd = ', user_puntosxdar = \'' . (int) $pointsxdar . '\'';
      } else {
         return 'Los puntos para dar no se reconocen';
      }

      if (!empty($password) && !empty($cpassword)) {

         if (strlen($user_nick) < 3) {
            return 'Nick demasiado corto.';
         }

         if (!preg_match('/^([A-Za-z0-9]+)$/', $user_nick)) {
            return 'Nick inv&aacute;lido';
         }

         $new_nick = ', user_name = \'' . $tsCore->setSecure($user_nick) . '\'';

         if (strlen($password) < 6) {
            return 'Contrase&ntilde;a no v&aacute;lida.';
         }

         if ($password != $cpassword) {
            return 'Las contrase&ntilde;as no coinciden';
         }

         $new_key = md5(md5($password) . strtolower($user_nick));
         $db_key  = ', user_password = \'' . $tsCore->setSecure($new_key) . '\'';
      }

      if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `u_miembros` SET user_email = \'' . $tsCore->setSecure($email) .
         '\' ' . $changedis . ' ' . $new_nick . ' ' . $pxd . ' ' . $apoints . ' ' . $db_key .
         ' WHERE user_id = \'' . (int) $user_id . '\'')) {

         if ($_POST['sendata']) {
            mail($email, 'Nuevos datos de acceso', 'Sus datos de acceso a ' . $tsCore->
                  settings['titulo'] .
               ' han sido cambiados por un administrador. Los nuevos datos son: usuario: ' . $user_nick .
               ', contraseña: ' . $password . '. Disculpe las molestias', 'From: ' . $tsCore->settings['titulo'] . ' <no-reply@' . $tsCore->settings['domain'] . '>');
         }
         // FIX: 30/06/2014

         return true;
      }
   }
   public function deleteContent($user_id) {
      global $tsUser;

      if (db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT user_id FROM u_miembros WHERE user_id = \'' . $tsUser->uid . '\' && user_password = \'' . md5(md5($_POST['password']) . strtolower($tsUser->nick)) . '\''))) {
         $c = $_POST['bocuenta'];
         # posts
         if ($_POST['boposts'] || $c) 
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM p_posts WHERE post_user = " . $user_id);
         # comentarios en posts
         if ($_POST['bocomposts'] || $c) 
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM p_comentarios WHERE c_user = " . $user_id);
         # fotos
         if ($_POST['bofotos'] || $c) 
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM f_fotos WHERE f_user = " . $user_id);
         # comentarios en fotos
         if ($_POST['bocomfotos'] || $c) 
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM f_comentarios WHERE c_user = " . $user_id);
         # archivos
         if ($_POST['bofiles'] || $c) 
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM a_files WHERE f_user = " . $user_id);
         # comentarios en archivos
         if ($_POST['bocomfiles'] || $c) 
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM a_comentarios WHERE com_user = " . $user_id);
         # estados
         if ($_POST['boestados'] || $c) 
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM u_muro WHERE p_user_pub = " . $user_id);
         # comentarios en estados
         if ($_POST['bocomestados'] || $c)
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM u_muro_comentarios WHERE c_user = " . $user_id);
         # likes
         if ($_POST['bolikes'] || $c)
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM u_muro_likes WHERE user_id = " . $user_id);
         # seguidores
         if ($_POST['boseguidores'] || $c)
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM u_follows WHERE f_id = {$user_id} && f_type = 1");
         # siguiendo
         if ($_POST['bosiguiendo'] || $c)
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM u_follows WHERE f_user = {$user_id} && f_type = 1");
         # favoritos
         if ($_POST['bofavoritos'] || $c) {
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM p_favoritos WHERE fav_user = " . $user_id);
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM a_favoritos WHERE fav_user = " . $user_id);
         }
         # votos en posts
         if ($_POST['bovotosposts'] || $c) 
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM p_votos WHERE tuser = " . $user_id);
         # votos en fotos
         if ($_POST['bovotosfotos'] || $c) 
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM f_votos WHERE v_user = " . $user_id);
         # actividades
         if ($_POST['boactividad'] || $c) 
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM u_actividad WHERE user_id = " . $user_id);
         # avisos
         if ($_POST['boavisos'] || $c) 
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM u_avisos WHERE user_id = " . $user_id);
         # bloqueos
         if ($_POST['bobloqueos'] || $c)
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM u_bloqueos WHERE b_user = " . $user_id);
         # mensajes
         if ($_POST['bomensajes'] || $c) {
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM u_mensajes WHERE mp_from = " . $user_id);
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM u_respuestas WHERE mr_from = " . $user_id);
         }
         # sesiones
         if ($_POST['bosesiones'] || $c)
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM u_sessions WHERE session_user_id = " . $user_id);
         # visitas
         if ($_POST['bovisitas'] || $c) 
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM w_visitas WHERE user = " . $user_id);

         $data  = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', "SELECT user_name FROM u_miembros WHERE user_id = " . $user_id));
         $admin = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', "SELECT user_email FROM u_miembros WHERE user_id = 1"));

         if ($c && $tsUser->uid != $user_id) {
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM u_miembros WHERE user_id = " . $user_id);
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM u_perfil WHERE user_id = " . $user_id);
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM u_portal WHERE user_id = " . $user_id);
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM w_denuncias WHERE d_user = " . $user_id);
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM u_bloqueos WHERE b_auser = " . $user_id);
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM u_mensajes WHERE mp_to = " . $user_id);
            db_exec(array(__FILE__, __LINE__), 'query', "DELETE FROM w_visitas WHERE `for` = {$user_id} && type = 1");
         }

         db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `u_avisos` (`user_id`, `av_subject`, `av_body`, `av_date`, `av_read`, `av_type`) VALUES (\'1\', \'Contenido eliminado\', \'Hola, le informamos que el administrador ' . $tsUser->nick . ' (' . $tsUser->uid . ') ha eliminado ' . ($c ? 'la cuenta' : 'varios contenidos') . ' de ' . $data[0] . '.\', \'' . time() . '\', \'0\', \'1\')');
         mail($admin[0], 'Contenido eliminado', '<html><head><title>Contenido de cierta cuenta han sido eliminados.</title></head><body><p>Hola, le informamos que el administrador ' . $tsUser->nick . ' (' . $tsUser->uid . ') ha eliminado ' . ($c ? 'la cuenta' : 'varios contenidos') . ' de ' . $data[0] . '</p></body></html>', 'Content-type: text/html; charset=iso-8859-15');
         return 'OK';
      } else {
         return 'Credenciales incorrectas';
      }

   }

   /*
   getUserRango
    */
   public function getUserRango($user_id)
   {

      # CONSULTA
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_rango, r.rango_id, r.r_name, r.r_color FROM u_miembros AS u LEFT JOIN u_rangos AS r ON u.user_rango = r.rango_id WHERE u.user_id = \'' .
         (int) $user_id . '\' LIMIT 1');
      $data['user'] = db_exec('fetch_assoc', $query);

      # RANGOS DISPONIBLES
      $query          = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `rango_id`, `r_name`, `r_color` FROM `u_rangos`');
      $data['rangos'] = result_array($query);

      #
      return $data;
   }

   /*
   getAllRangos
    */
   public function getAllRangos()
   {

      # RANGOS DISPONIBLES
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `rango_id`, `r_name`, `r_color` FROM `u_rangos`');
      $data  = result_array($query);

      #
      return $data;
   }
   /*
   setUserRango($user_id)
    */
   public function setUserRango($user_id)
   {
      global $tsUser;
      # SOLO EL PRIMER ADMIN PUEDE PONER A OTROS ADMINS
      $new_rango = (int) $_POST['new_rango'];
      if ($user_id == $tsUser->uid) {
         return 'No puedes cambiarte el rango a ti mismo';
      } elseif ($tsUser->uid != 1 && $new_rango == 1) {
         return 'Solo el primer Administrador puede crear más administradores principales';
      } else {
         if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_rango = \'' . (int) $new_rango . '\' WHERE user_id = \'' .
            (int) $user_id . '\'')) {
            return true;
         }

      }
   }

   public function setUserFirma($user_id)
   {
      global $tsCore;

      if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `u_perfil` SET user_firma = \'' . $tsCore->setSecure($_POST['firma']) .
         '\' WHERE user_id = \'' . (int) $user_id . '\'')) {
         return true;
      }

   }

   public function setUserInActivo()
   {
      global $tsUser;

      $usuario = $_POST['uid'];

      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT user_activo FROM u_miembros WHERE user_id = \'' . (int)
         $usuario . '\'');
      $data = db_exec('fetch_assoc', $query);

      // COMPROBAMOS
      if ($data['user_activo'] == 1) {
         if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_activo = \'0\' WHERE user_id = \'' .
            (int) $usuario . '\'')) {
            return '2: Cuenta desactivada';
         } else {
            return '0: Ocurri&oacute, un error';
         }

      } else {
         if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_activo = \'1\' WHERE user_id = \'' .
            (int) $usuario . '\'')) {
            return '1: Cuenta activada.';
         } else {
            return 'Ocurri&oacute; un error';
         }

      }
   }

   public function getSessions()
   {
      global $tsCore;
      //
      $max   = 20; // MAXIMO A MOSTRAR
      $limit = $tsCore->setPageLimit($max, true);
      //
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, s.* FROM u_sessions AS s LEFT JOIN u_miembros AS u ON s.session_user_id = u.user_id ORDER BY s.session_time DESC LIMIT ' .
         $limit);
      //
      $data['data'] = result_array($query);

      // PAGINAS
      $query       = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(*) FROM u_sessions');
      list($total) = db_exec('fetch_row', $query);

      $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] .
         "/admin/sesiones?", $_GET['s'], $total, $max);
      //
      return $data;
   }

   public function delSession()
   {
      global $tsCore;
      $session_id = $_POST['sesion_id'];
      if (db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT session_id FROM u_sessions WHERE session_id = \'' .
         $tsCore->setSecure($session_id) . '\' LIMIT 1'))) {
         if (db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM u_sessions WHERE session_id = \'' . $tsCore->
            setSecure($session_id) . '\'')) {
            return '1: Eliminado';
         }

      } else {
         return '0: No existe esa sesi&oacute;n';
      }

   }

   public function getChangeNicks()
   {
      global $tsCore;
      //
      $max   = 20; // MAXIMO A MOSTRAR
      $limit = $tsCore->setPageLimit($max, true);
      //
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, n.* FROM u_nicks AS n LEFT JOIN u_miembros AS u ON n.user_id = u.user_id WHERE estado = \'0\' ORDER BY n.time DESC LIMIT ' .
         $limit);
      //
      $data['data'] = result_array($query);

      // PAGINAS
      $query       = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(*) FROM u_nicks WHERE estado = \'0\'');
      list($total) = db_exec('fetch_row', $query);

      $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] . "/admin/nicks?",
         $_GET['s'], $total, $max);
      //
      return $data;
   }

   public function getChangeNicks_A()
   {
      global $tsCore;
      //
      $max   = 20; // MAXIMO A MOSTRAR
      $limit = $tsCore->setPageLimit($max, true);
      //
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, n.* FROM u_nicks AS n LEFT JOIN u_miembros AS u ON n.user_id = u.user_id WHERE estado > \'0\' ORDER BY n.time DESC LIMIT ' .
         $limit);
      //
      $data['data'] = result_array($query);

      // PAGINAS
      $query       = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(*) FROM u_nicks WHERE estado > \'0\'');
      list($total) = db_exec('fetch_row', $query);

      $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] . "/admin/nicks?",
         $_GET['s'], $total, $max);
      //
      return $data;
   }

   public function ChangeNick_o_no()
   {
      global $tsCore, $tsMonitor;
      //
      $nick_id = $_POST['nid'];
      //
      $datos = db_exec('fetch_assoc', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT * FROM u_nicks WHERE id = \'' . (int)
         $nick_id . '\' LIMIT 1'));
      //
      if ($_POST['accion'] == 'aprobar') {
         db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_name = \'' . $datos['name_2'] . '\', user_password = \'' .
            $datos['hash'] . '\', user_name_changes = user_name_changes - 1 WHERE user_id = \'' .
            $datos['user_id'] . '\'');
         db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_nicks SET estado = \'1\' WHERE id = \'' . (int) $nick_id .
            '\'');
         // AVISO
         $aviso = 'Hola <b>' . $datos['name_1'] . "</b>,\n\n Le informo que desde este momento su nombre de acceso ser&aacute; <b>" .
            $datos['name_2'] . "</b> . Hasta pronto.";
         $tsMonitor->setAviso($datos['user_id'], 'Cambio realizado', $aviso, 4);
         //ENVIAMOS CORREO
         $subject = $datos['name_1'] . ', su petici&oacute;n de cambio ha sido aceptada';
         $body    = 'Hola ' . $datos['name_1'] . ':<br />
            Le enviamos este email para informarle que su petici&oacute;n de cambio de nick ha sido aceptada.
            Desde este momento, podr&aacute; acceder en ' . $tsCore->settings['titulo'] .
         ' con el nombre de usuario ' . $datos['name_2'] . '. <br /><br />
            El staff de <strong>' . $tsCore->settings['titulo'] . '</strong>';
      } elseif ($_POST['accion'] == 'denegar') {
         db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_name_changes = user_name_changes - 1 WHERE user_id = \'' .
            $datos['user_id'] . '\'');
         db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_nicks SET estado = \'2\' WHERE id = \'' . (int) $nick_id .
            '\'');
         // AVISO
         $aviso = 'Hola <b>' . $datos['name_1'] . "</b>,\n\n Lamento informarle que su petici&oacute;n de cambio de nick a <b>" .
            $datos['name_2'] . "</b> , ha sido denegada.";
         $tsMonitor->setAviso($datos['user_id'], 'Cambio realizado', $aviso, 3);
         //ENVIAMOS CORREO
         $subject = $datos['name_1'] . ', su petici&oacute;n de cambio ha sido denegada';
         $body    = 'Hola ' . $datos['name_1'] . ':<br />
            Le enviamos este email para informarle que su petici&oacute;n de cambio de nick ha sido denegada. <br /><br />
            El staff de <strong>' . $tsCore->settings['titulo'] . '</strong>';
      } else {
         return '0: Mijo, ve de paseo';
      }

      // <--
      include TS_ROOT . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'class' .
         DIRECTORY_SEPARATOR . 'c.emails.php';
      $tsEmail               = new tsEmail('confirmar', 'nombre');
      $tsEmail->emailTo      = $datos['user_email'];
      $tsEmail->emailSubject = $subject;
      $tsEmail->emailBody    = $body;
      $tsEmail->emailHeaders = $tsEmail->setEmailHeaders();
      $tsEmail->sendEmail($from, $to, $subject, $body) or die('0: Hubo un error al enviar el correo.');
      die('1: <div class="box_cuerpo" style="padding: 12px 20px; border-top:1px solid #CCC">Hemos enviado un correo a <b>' .
         $datos['user_email'] .
         '</b> con la decisi&oacute;n tomada. Tambi&eacute;n le hemos enviado un aviso al usuario.</div>');
      // -->
   }

   /****************** ADMINISTRACIÓN DE POSTS ******************/
   public function GetAdminPosts() {
      global $tsCore;
      //
      $max   = 18; // MAXIMO A MOSTRAR
      $limit = $tsCore->setPageLimit($max, true);

      if ($_GET['o'] == 'e') $order = 'p.post_status';
      elseif ($_GET['o'] == 'ip') $order = 'p.post_ip';
      else $order = 'p.post_id';

      //
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, c.c_nombre, c.c_seo, p.* FROM p_posts AS p LEFT JOIN u_miembros AS u ON p.post_user = u.user_id LEFT JOIN p_categorias AS c ON c.cid = p.post_category WHERE p.post_id > \'0\' ORDER BY ' .
         $order . ' ' . ($_GET['m'] == 'a' ? 'ASC' : 'DESC') . ' LIMIT ' . $limit);
      //
      $data['data'] = result_array($query);

      // PAGINAS
      $query       = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(*) FROM p_posts WHERE post_id > \'0\'');
      list($total) = db_exec('fetch_row', $query);

      $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] . "/admin/posts?o=" .
         $_GET['o'] . "&m=" . $_GET['m'] . "", $_GET['s'], $total, $max);
      //
      return $data;
   }
   /****************** ADMINISTRACIÓN DE ARCHIVOS ******************/
   public function GetAdminFiles() {
      global $tsCore;
      //
      $max   = 18; // MAXIMO A MOSTRAR
      $limit = $tsCore->setPageLimit($max, true);

      if ($_GET['o'] == 'n') $order = 'f.f_nombre';
      elseif ($_GET['o'] == 'e') $order = 'f.f_ext';
      elseif ($_GET['o'] == 'ip') $order = 'f.f_ip';
      else $order = 'f.file_id';

      $ascdesc = ($_GET['m'] == 'a') ? 'ASC' : 'DESC';

      //
      $query = db_exec(array(__FILE__, __LINE__), 'query', "SELECT u.user_id, u.user_name, f.* FROM a_files AS f LEFT JOIN u_miembros AS u ON f.f_user = u.user_id WHERE f.file_id > 0 ORDER BY {$order} {$ascdesc} LIMIT ". $limit);
      //
      $data['data'] = result_array($query);

      // PAGINAS
      $query       = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(*) FROM a_files WHERE file_id > \'0\'');
      list($total) = db_exec('fetch_row', $query);

      $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] . "/admin/files?o=" .
         $_GET['o'] . "&m=" . $_GET['m'] . "", $_GET['s'], $total, $max);
      //
      return $data;
   }
   /****************** ADMINISTRACIÓN DE FOTOS ******************/
   public function GetAdminFotos()
   {
      global $tsCore;
      //
      $max   = 15; // MAXIMO A MOSTRAR
      $limit = $tsCore->setPageLimit($max, true);
      //
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, f.* FROM f_fotos AS f LEFT JOIN u_miembros AS u ON f.f_user = u.user_id WHERE f.foto_id > \'0\' ORDER BY f.foto_id DESC LIMIT ' .
         $limit);
      //
      $data['data'] = result_array($query);

      // PAGINAS
      $query       = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(*) FROM f_fotos WHERE foto_id > \'0\'');
      list($total) = db_exec('fetch_row', $query);

      $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] . "/admin/fotos?",
         $_GET['s'], $total, $max);
      //
      return $data;
   }

   public function DelFoto()
   {
      //
      $foto = intval($_POST['foto_id']);
      if (db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT foto_id FROM `f_fotos` WHERE foto_id = \'' .
         (int) $foto . '\''))) {
         if (db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM f_fotos WHERE foto_id = \'' . (int) $foto . '\'')) {
            return '1: Foto eliminada';
         } else {
            return '0: La foto no se pudo eliminar';
         }

      } else {
         return '0: La foto no existe';
      }

   }

   public function setOpenClosedFoto()
   {
      global $tsUser;

      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT f_closed FROM f_fotos WHERE foto_id = \'' . (int) $_POST['fid'] .
         '\'');
      $data = db_exec('fetch_assoc', $query);

      // COMPROBAMOS
      if ($data['f_closed'] == 1) {
         if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE f_fotos SET f_closed = \'0\' WHERE foto_id = \'' . (int)
            $_POST['fid'] . '\'')) {
            return '2: Comentarios abiertos';
         } else {
            return '0: Ocurri&oacute, un error';
         }

      } elseif ($data['f_closed'] == 0) {
         if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE f_fotos SET f_closed = \'1\' WHERE foto_id = \'' . (int)
            $_POST['fid'] . '\'')) {
            return '1: Comentarios cerrados.';
         } else {
            return 'Ocurri&oacute; un error';
         }

      }
   }

   public function setShowHideFoto()
   {
      global $tsUser;

      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT f_status FROM f_fotos WHERE foto_id = \'' . (int) $_POST['fid'] .
         '\'');
      $data = db_exec('fetch_assoc', $query);

      // COMPROBAMOS
      if ($data['f_status'] == 1) {
         if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE f_fotos SET f_status = \'0\' WHERE foto_id = \'' . (int)
            $_POST['fid'] . '\'')) {
            return '2: Foto rehabilitada';
         } else {
            return '0: Ocurri&oacute, un error';
         }

      } elseif ($data['f_status'] == 0) {
         if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE f_fotos SET f_status = \'1\' WHERE foto_id = \'' . (int)
            $_POST['fid'] . '\'')) {
            return '1: Foto deshabilitada.';
         } else {
            return 'Ocurri&oacute; un error';
         }

      }
   }

   /****************** ADMINISTRACIÓN DE NOTICIAS ******************/

   public function setNoticiaInActive()
   {
      global $tsUser;

      $noticia = $_POST['nid'];

      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT not_active FROM w_noticias WHERE not_id = \'' . (int)
         $noticia . '\'');
      $data = db_exec('fetch_assoc', $query);

      // COMPROBAMOS
      if ($data['not_active'] == 1) {
         if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE w_noticias SET not_active = \'0\' WHERE not_id = \'' . (int)
            $noticia . '\'')) {
            return '2: Noticia desactivada';
         } else {
            return '0: Ocurri&oacute, un error';
         }

      } else {
         if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE w_noticias SET not_active = \'1\' WHERE not_id = \'' . (int)
            $noticia . '\'')) {
            return '1: Noticia activada.';
         } else {
            return 'Ocurri&oacute; un error';
         }

      }
   }

   /****************** ADMINISTRACIÓN DE LISTA NEGRA ******************/

   public function getBlackList()
   {
      global $tsCore;
      //
      $max   = 20; // MAXIMO A MOSTRAR
      $limit = $tsCore->setPageLimit($max, true);
      //
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, b.* FROM w_blacklist AS b LEFT JOIN u_miembros AS u ON b.author = u.user_id ORDER BY b.date DESC LIMIT ' .
         $limit);
      //
      $data['data'] = result_array($query);

      // PAGINAS
      $query       = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(*) FROM w_blacklist');
      list($total) = db_exec('fetch_row', $query);

      $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] .
         "/admin/blacklist?", $_GET['s'], $total, $max);
      //
      return $data;
   }

   public function getBlock()
   {
      return db_exec('fetch_assoc', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT type, value, reason FROM w_blacklist WHERE id = \'' .
         (int) $_GET['id'] . '\' LIMIT 1'));
   }

   public function saveBlock()
   {
      global $tsCore, $tsUser;

      if (empty($_POST['value']) || empty($_POST['type'])) {
         return 'Debe rellenar todos los campos';
      } else {
         if ($_POST['type'] == 1 && $_POST['value'] == $_SERVER['REMOTE_ADDR']) {
            return 'No puedes bloquear tu propia IP';
         }

         if (!db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT id FROM w_blacklist WHERE type = \'' . (int)
            $_POST['type'] . '\' && value = \'' . $tsCore->setSecure($_POST['value']) . '\''))) {
            if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE w_blacklist SET type = \'' . (int) $_POST['type'] . '\', value = \'' .
               $tsCore->setSecure($_POST['value']) . '\', author = \'' . $tsUser->uid . '\' WHERE id = \'' .
               (int) $_GET['id'] . '\'')) {
               return true;
            }

         } else {
            return 'Ya existe un bloqueo as&iacute;';
         }

      }
   }

   public function newBlock()
   {
      global $tsCore, $tsUser;

      if (empty($_POST['value']) || empty($_POST['type']) || empty($_POST['reason'])) {
         return 'Rellene todos los campos';
      } else {
         if ($_POST['type'] == 1 && $_POST['value'] == $_SERVER['REMOTE_ADDR']) {
            return 'No puedes bloquear tu propia IP';
         }

         if (!db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT id FROM w_blacklist WHERE type = \'' . (int)
            $_POST['type'] . '\' && value = \'' . $tsCore->setSecure($_POST['value']) . '\''))) {
            if (db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO w_blacklist (type, value, reason, author, date) VALUES (\'' .
               (int) $_POST['type'] . '\', \'' . $tsCore->setSecure($_POST['value']) . '\', \'' .
               $tsCore->setSecure($_POST['reason']) . '\', \'' . $tsUser->uid . '\', \'' . time
               () . '\')')) {
               return true;
            }

         } else {
            return 'Ya existe un bloqueo as&iacute;';
         }

      }
   }

   public function deleteBlock()
   {

      if (db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM w_blacklist WHERE id = \'' . (int) $_POST['bid'] . '\'')) {
         return '1: Bloqueo retirado';
      } else {
         return '0: Hubo un error al borrar';
      }

   }

   /****************** ADMINISTRACIÓN DE LISTA NEGRA ******************/

   public function getBadWords()
   {
      global $tsCore;
      //
      $max   = 20; // MAXIMO A MOSTRAR
      $limit = $tsCore->setPageLimit($max, true);
      //
      $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, bw.* FROM w_badwords AS bw LEFT JOIN u_miembros AS u ON bw.author = u.user_id ORDER BY bw.wid DESC LIMIT ' .
         $limit);
      //
      $data['data'] = result_array($query);

      // PAGINAS
      $query       = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(*) FROM w_badwords');
      list($total) = db_exec('fetch_row', $query);

      $data['pages'] = $tsCore->pageIndex($tsCore->settings['url'] .
         "/admin/badwords?", $_GET['s'], $total, $max);
      //
      return $data;
   }

   public function getBadWord()
   {
      return db_exec('fetch_assoc', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT * FROM w_badwords WHERE wid = \'' .
         (int) $_GET['id'] . '\' LIMIT 1'));
   }

   public function saveBadWord()
   {
      global $tsCore, $tsUser;

      $method = empty($_POST['method']) ? 0 : 1;
      $type   = empty($_POST['type']) ? 0 : 1;
      if (empty($_POST['before']) || empty($_POST['after'])) {
         return 'Rellene todos los campos';
      } else {
         if (!db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT wid FROM w_badwords WHERE LOWER(word) = \'' .
            $tsCore->setSecure(strtolower($_POST['before'])) . '\' && LOWER(swop) = \'' . $tsCore->
            setSecure(strtolower($_POST['after'])) . '\''))) {
            if (db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_badwords` SET method = \'' . $method . '\', type = \'' .
               (int) $type . '\', word = \'' . $tsCore->setSecure($_POST['before']) . '\', swop = \'' .
               $tsCore->setSecure($_POST['after']) . '\', author = \'' . $tsUser->uid . '\' WHERE wid = \'' .
               (int) $_GET['id'] . '\'')) {
               return true;
            } else {
               return 'Error al guardar';
            }

         } else {
            return 'Ya existe un filtro as&iacute;';
         }

      }
   }

   public function newBadWord()
   {
      global $tsCore, $tsUser;

      $method = empty($_POST['method']) ? 0 : 1;
      $type   = empty($_POST['type']) ? 0 : 1;
      if (empty($_POST['before']) || empty($_POST['after']) || empty($_POST['reason'])) {
         return 'Rellene todos los campos';
      } else {
         if (!db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT wid FROM w_badwords WHERE LOWER(word) = \'' .
            $tsCore->setSecure(strtolower($_POST['before'])) . '\' && LOWER(swop) = \'' . $tsCore->
            setSecure(strtolower($_POST['after'])) . '\''))) {
            if (db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO w_badwords (word, swop, method, type, author, reason, date) VALUES (\'' .
               $tsCore->setSecure($_POST['before']) . '\', \'' . $tsCore->setSecure($_POST['after']) .
               '\', \'' . (int) $method . '\', \'' . (int) $type . '\', \'' . $tsUser->uid . '\', \'' .
               $tsCore->setSecure($_POST['reason']) . '\', \'' . time() . '\')')) {
               return true;
            } else {
               return 'Error al agregar';
            }

         } else {
            return 'Ya existe un filtro as&iacute;';
         }

      }
   }

   public function deleteBadWord()
   {

      if (db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM w_badwords WHERE wid = \'' . (int) $_POST['wid'] . '\'')) {
         return '1: Filtro retirado';
      } else {
         return '0: Hubo un error al borrar';
      }

   }

   /****************** ADMINISTRACIÓN DE ESTADÍSTICAS ******************/

   public function GetAdminStats()
   {
      $num = db_exec('fetch_assoc', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT
        (SELECT count(foto_id) FROM f_fotos WHERE f_status = \'2\') as fotos_eliminadas,
        (SELECT count(foto_id) FROM f_fotos WHERE f_status = \'1\') as fotos_ocultas,
        (SELECT count(foto_id) FROM f_fotos WHERE f_status = \'0\') as fotos_visibles,

        (SELECT count(post_id) FROM p_posts WHERE post_status = \'0\') as posts_visibles,
        (SELECT count(post_id) FROM p_posts WHERE post_status = \'1\') as posts_ocultos,
        (SELECT count(post_id) FROM p_posts  WHERE post_status = \'2\') as posts_eliminados,
        (SELECT count(post_id) FROM p_posts  WHERE post_status = \'3\') as posts_revision,

        (SELECT count(file_id) FROM a_files WHERE f_estado = \'1\') as archivos_visibles,
        (SELECT count(file_id) FROM a_files WHERE f_estado = \'0\') as archivos_ocultos,
        (SELECT count(file_id) FROM a_files WHERE f_privado = \'1\') as archivos_privados,
        (SELECT count(file_id) FROM a_files WHERE f_privado = \'0\') as archivos_publicos,
        (SELECT count(file_id) FROM a_files WHERE f_descargas != \'0\') as archivos_descargados,
        (SELECT count(fav_id) FROM a_favoritos) AS archivos_favoritos,

        (SELECT count(cid) FROM p_comentarios WHERE c_status = \'0\') as comentarios_posts_visibles,
        (SELECT count(cid) FROM p_comentarios WHERE c_status = \'1\') as comentarios_posts_ocultos,
        (SELECT count(user_id) FROM u_miembros WHERE user_activo = \'1\') as usuarios_activos,
        (SELECT count(user_id) FROM u_miembros WHERE user_activo = \'0\' ) as usuarios_inactivos,
        (SELECT count(user_id) FROM u_miembros WHERE user_baneado = \'1\' ) as usuarios_baneados,
        (SELECT count(cid) FROM f_comentarios) as comentarios_fotos_total,
        (SELECT count(follow_id) FROM u_follows WHERE f_type  = \'1\' ) AS usuarios_follows,
        (SELECT count(follow_id) FROM u_follows WHERE f_type  = \'2\' ) AS posts_follows,
        (SELECT count(follow_id) FROM u_follows WHERE f_type  = \'3\' ) AS posts_compartidos,
        (SELECT count(fav_id) FROM p_favoritos) AS posts_favoritos,
        (SELECT count(mr_id) FROM u_respuestas) AS usuarios_respuestas,
        (SELECT count(mp_id) FROM u_mensajes) AS mensajes_total,
        (SELECT count(mp_id) FROM u_mensajes WHERE mp_del_to = \'1\') AS mensajes_de_eliminados,
        (SELECT count(mp_id) FROM u_mensajes WHERE mp_del_from = \'1\') AS mensajes_para_eliminados,
        (SELECT count(bid) FROM p_borradores) AS posts_borradores,
        (SELECT count(bid) FROM u_bloqueos) AS usuarios_bloqueados,
        (SELECT count(bid) FROM u_bloqueos) AS usuarios_bloqueados,
        (SELECT count(medal_id) FROM w_medallas WHERE m_type = \'1\') AS medallas_usuarios,
        (SELECT count(medal_id) FROM w_medallas WHERE m_type = \'2\') AS medallas_posts,
        (SELECT count(medal_id) FROM w_medallas WHERE m_type = \'3\') AS medallas_fotos,
        (SELECT count(id) FROM w_medallas_assign) AS medallas_asignadas,
        (SELECT count(aid) FROM w_afiliados WHERE a_active = \'1\') AS afiliados_activos,
        (SELECT count(aid) FROM w_afiliados WHERE a_active = \'0\') AS afiliados_inactivos,
        (SELECT count(pub_id) FROM u_muro) AS muro_estados,
        (SELECT count(cid) FROM u_muro_comentarios) AS muro_comentarios
        '));

      $num['usuarios_total'] = $num['usuarios_activos'] + $num['usuarios_inactivos'] + $num['usuarios_baneados'];
      $num['seguidos_total'] = $num['posts_follows'] + $num['usuarios_follows'];
      $num['muro_total'] = $num['muro_estados'] + $num['muro_comentarios'];
      $num['afiliados_total'] = $num['afiliados_activos'] + $num['afiliados_inactivos'];
      $num['posts_total'] = $num['posts_visibles'] + $num['posts_ocultos'] + $num['posts_eliminados'];
      $num['archivos_total'] = $num['archivos_visibles'] + $num['archivos_ocultos'];
      $num['comentarios_posts_total'] = $num['comentarios_posts_visibles'] + $num['comentarios_posts_ocultos'];
      $num['medallas_total'] = $num['medallas_usuarios'] + $num['medallas_posts'] + $num['medallas_fotos'];
      $num['fotos_total'] = $num['fotos_visibles'] + $num['fotos_ocultas'] + $num['fotos_eliminadas'];

      return $num;
   }

   /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
   /*
   Función para obtener más información, y solamente información
    */
   public function getFeed()
   {
      $get_url = 'https://v6demo.000webhostapp.com/news/index.php?file=';
      $Slite   = json_decode(file_get_contents($get_url . 'datos'), true);
      foreach ($Slite as $clave => $valor) {
         $getJson['my_theme_name']     = $valor[0]['name'];
         $getJson['my_theme_author']   = $valor[0]['author'];
         $getJson['my_theme_old']      = $valor[0]['old'];
         $getJson['my_theme_new']      = $valor[0]['new'];
         $getJson['my_theme_download'] = $valor[0]['down'];
      }
      $Themes = json_decode(file_get_contents($get_url . 'feed'), true);
      foreach ($Themes as $valor) {
         $getJson['themes'] = $valor;
      }

      return $getJson;
   }
   /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
   public function newTheme()
   {
      global $tsCore;
      //
      if ($_FILES["zip_file"]["name"]) {
         # obtenemos datos de nuestro ZIP
         $nombre = $_FILES["zip_file"]["name"];
         $ruta   = $_FILES["zip_file"]["tmp_name"];
         $tipo   = $_FILES["zip_file"]["type"];
         # Función descomprimir ficheros en formato ZIP
         $nombresFichZIP = array();
         $zip            = new ZipArchive;
         # En la función open se le pasa la ruta de nuestro archivo (alojada en carpeta temporal)
         if ($zip->open($ruta) === true) {
            for ($i = 0; $i < $zip->numFiles; $i++) {
               # obtenemos ruta que tendrán los documentos cuando los descomprimamos
               $nombresFichZIP['tmp_name'][$i] = '../../themes/' . $zip->getNameIndex($i);
               # obtenemos nombre del fichero
               $nombresFichZIP['name'][$i] = $zip->getNameIndex($i);
            }
            $name     = str_replace('/', '', $zip->getNameIndex(0));
            $UrlTheme = $tsCore->settings['url'] . '/themes/' . $name;
            $zip->extractTo('../../themes/');
            $zip->close();
            # LEEMOS EL ARCHIVO INSTALL
            $JSON   = file_get_contents('../../themes/' . $name . '/install.json');
            $leemos = json_decode($JSON, true);
            foreach ($leemos as $id => $leer) {
               $Autor  = $leer['author'];
               $Nombre = $leer['name'];
            }
            db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `w_temas` (`t_name`, `t_url`, `t_path`, `t_copy`) VALUES (\'' . $tsCore->setSecure($Nombre) . '\', \'' . $tsCore->setSecure($UrlTheme) . '\', \'' . $tsCore->setSecure($Nombre) . '\', \'' . $tsCore->setSecure($Autor) . '\')');
         } else {
            return 'Ocurri&oacute; un error al subir el archivo, int&eacute;ntalo m&aacute;s tarde';
         }

      } else {
         return "1: El theme ha sido instalado correctamente.";
      }

   }
   
}
