<?php

/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty combine function plugin
 *
 * Type:    function<br>
 * Name:    combine<br>
 * Date:    September 5, 2015
 * Purpose: Combine content from several JS or CSS files into one
 * Input:   string to count
 * Example: {combine input=$array_of_files_to_combine output=$path_to_output_file use_true_path=true age=$seconds_to_try_recombine_file}
 *
 * @author Gorochov Ivan <dead23angel at gmail dot com>
 * @version 1.0
 * @param array
 * @param string
 * @param int
 * @return string
 */

function smarty_function_combine($params, &$smarty)
{
   require_once dirname(__FILE__) . '/minify/JSmin.php';
   require_once dirname(__FILE__) . '/minify/CSSmin.php';

   /**
    * Build combined file
    *
    * @param array $params
    */
   if (!function_exists('smarty_build_combine')) {
      function smarty_build_combine($params) {
         $filelist      = array();
         $lastest_mtime = 0;

         foreach ($params['input'] as $item) {
            $mtime         = filemtime($params['file_path'] . $item);
            $lastest_mtime = max($lastest_mtime, $mtime);
            $filelist[]    = array('name' => $item, 'time' => $mtime);
         }

         if ($params['debug'] == true) {
            $output_filename = '';
            foreach ($filelist as $file) {
               if ($params['type'] == 'js') {
                  $output_filename .= '<script type="text/javascript" src="' . base_url() . $file['name'] . '" charset="utf-8"></script>' . "\n";
               } elseif ($params['type'] == 'css') {
                  $output_filename .= '<link type="text/css" rel="stylesheet" href="' . base_url() . $file['name'] . '" />' . "\n";
               }
            }

            echo $output_filename;
            return;
         }

         $last_cmtime = 0;

         if (file_exists($params['file_path'] . $params['cache_file_name'])) $last_cmtime = file_get_contents($params['file_path'] . $params['cache_file_name']);

         if ($lastest_mtime > $last_cmtime) {
            $glob_mask        = preg_replace('/\.(js|css)$/i', '_*.$1', $params['output']);
            $files_to_cleanup = glob($params['file_path'] . $glob_mask);

            foreach ($files_to_cleanup as $cfile) {
               if (is_file($cfile) && file_exists($cfile)) unlink($cfile);
            }

            $output_filename = preg_replace('/\.(js|css)$/i', date('_YmdHis.', $lastest_mtime) . '$1', $params['output']);

            $dirname = dirname($params['file_path'] . $output_filename);

            if (!is_dir($dirname)) mkdir($dirname, 0755, true);
            $fh = fopen($params['file_path'] . $output_filename, 'w');

            if (flock($fh, LOCK_EX)) {
               foreach ($filelist as $file) {
                  $min = '';

                  if ($params['type'] == 'js') {
                     $min = JSMin::minify(file_get_contents($params['file_path'] . $file['name']));
                  } elseif ($params['type'] == 'css') {
                     $min = CSSMin::minify(file_get_contents($params['file_path'] . $file['name']));
                  } else {
                     fputs($fh, PHP_EOL . PHP_EOL . '/* ' . $file['name'] . ' @ ' . date('c', $file['time']) . ' */' . PHP_EOL . PHP_EOL);
                     $min = file_get_contents($params['file_path'] . $file['name']);
                  }

                  fputs($fh, $min);
               }

               flock($fh, LOCK_UN);
               file_put_contents($params['file_path'] . $params['cache_file_name'], $lastest_mtime, LOCK_EX);
            }

            fclose($fh);
            clearstatcache();
         }

         touch($params['file_path'] . $params['cache_file_name']);
         smarty_print_out($params);
      }
   }

   /**
    * Print filename
    *
    * @param string $params
    */
   if (!function_exists('smarty_print_out')) {
      function smarty_print_out($params)
      {
         $last_mtime = 0;

         if (file_exists($params['file_path'] . $params['cache_file_name'])) {
            $last_mtime = file_get_contents($params['file_path'] . $params['cache_file_name']);
         }

         $output_filename = preg_replace('/\.(js|css)$/i', date('_YmdHis.', $last_mtime) . '$1', $params['output']);

         if ($params['type'] == 'js') {
            echo '<script type="text/javascript" src="/' . TS_TEMA_URL . $output_filename . '" charset="utf-8"></script>';
         } elseif ($params['type'] == 'css') {
            echo '<link type="text/css" rel="stylesheet" href="/' . TS_TEMA_URL . $output_filename . '" />';
         } else {
            echo $output_filename;
         }
      }
   }

   /**
    * This function gets the base url for the project where this plugin is used
    * If this plugin is used within Code Igniter, the base_url() would have already been defined
    */
   if (!function_exists('base_url')) {
      function base_url()
      {

         return sprintf(
            "%s://%s%s/",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['HTTP_HOST'],
            rtrim(dirname($_SERVER['PHP_SELF']), '/\\')
         );
      }
   }

   // The new 'use_true_path' option that tells this plugin to use the path to the files as it is
   if (isset($params['use_true_path']) && !is_bool($params['use_true_path'])) {
      trigger_error('use_true_path must be boolean', E_USER_NOTICE);
      return;
   }

   if (!isset($params['use_true_path'])) {
      $params['use_true_path'] = false;
   }

   // use the relative path or the true path of the file based on the 'use_true_path' option passed in
   $params['file_path'] = TS_TEMA_URL;

   if (!isset($params['input'])) {
      trigger_error('input cannot be empty', E_USER_NOTICE);
      return;
   }

   if (!is_array($params['input']) || count($params['input']) < 1) {
      trigger_error('input must be array and have one item at least', E_USER_NOTICE);
      return;
   }

   foreach ($params['input'] as $file) {
      if (!file_exists($params['file_path'] . $file)) {
         trigger_error('File ' . $params['file_path'] . $file . ' does not exist!', E_USER_WARNING);
         return;
      }

      $ext = pathinfo($file, PATHINFO_EXTENSION);

      if (!in_array($ext, array('js', 'css'))) {
         trigger_error('all input files must have js or css extension', E_USER_NOTICE);
         return;
      }

      $files_extensions[] = $ext;
   }

   if (count(array_unique($files_extensions)) > 1) {
      trigger_error('all input files must have the same extension', E_USER_NOTICE);
      return;
   }

   $params['type'] = $ext;

   if (!isset($params['output'])) {
      $params['output'] = dirname($params['input'][0]) . '/app.' . $ext;
   }

   if (!isset($params['age'])) {
      $params['age'] = 3600;
   }

   if (!isset($params['cache_file_name'])) {
      $params['cache_file_name'] = $params['output'] . '.cache';
   }

   if (!isset($params['debug'])) {
      $params['debug'] = false;
   }

   $cache_file_name = $params['cache_file_name'];

   if ($params['debug'] == true || !file_exists($params['file_path'] . $cache_file_name)) {
      smarty_build_combine($params);
      return;
   }

   $cache_mtime = filemtime($params['file_path'] . $cache_file_name);

   if ($cache_mtime + $params['age'] < time()) {
      smarty_build_combine($params);
   } else {
      smarty_print_out($params);
   }
}
