
CREATE TABLE IF NOT EXISTS `a_comentarios` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `com_file` int(11) NOT NULL,
  `com_user` int(11) NOT NULL,
  `com_body` text NOT NULL,
  `com_fecha` int(10) NOT NULL,
  `com_ip` varchar(50) NOT NULL,
  PRIMARY KEY (`com_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `a_descargas` (
  `descarga_id` int(11) NOT NULL AUTO_INCREMENT,
  `d_file` int(11) NOT NULL,
  `d_user` int(11) NOT NULL,
  `d_autor` int(11) NOT NULL,
  `d_total` int(11) NOT NULL,
  `d_fecha` int(10) NOT NULL,
  `d_ip` varchar(50) NOT NULL,
  PRIMARY KEY (`descarga_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `a_favoritos` (
  `fav_id` int(11) NOT NULL AUTO_INCREMENT,
  `fav_file` int(11) NOT NULL,
  `fav_user` int(11) NOT NULL,
  `fav_fecha` int(10) NOT NULL,
  PRIMARY KEY (`fav_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `a_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `f_nombre` varchar(250) NOT NULL,
  `f_url` varchar(250) NOT NULL,
  `f_fecha` int(10) NOT NULL,
  `f_peso` varchar(10) NOT NULL,
  `f_tipo` varchar(100) NOT NULL,
  `f_ext` varchar(10) NOT NULL,
  `f_user` int(11) NOT NULL,
  `f_descargas` int(11) NOT NULL,
  `f_comentarios` int(11) NOT NULL,
  `f_privado` int(1) NOT NULL,
  `f_estado` int(1) NOT NULL,
  `f_folder` int(11) NOT NULL,
  `f_ip` varchar(50) NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `a_folder_files` (
  `folder_id` int(11) NOT NULL AUTO_INCREMENT,
  `folder_name` varchar(200) NOT NULL,
  `folder_user` int(11) NOT NULL,
  `folder_seo` varchar(200) NOT NULL,
  `folder_fecha` int(10) NOT NULL,
  `folder_priv` int(1) NOT NULL,
  PRIMARY KEY (`folder_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE `w_configuracion` ADD `c_max_upload` INT NOT NULL,
ADD `c_files_type` INT( 1 ) NOT NULL,
ADD `c_files_ext` VARCHAR( 150 ) NOT NULL;

ALTER TABLE `p_borradores` CHANGE `b_category` `b_category` VARCHAR(50) NOT NULL DEFAULT '';
ALTER TABLE `p_posts` CHANGE `post_category` `post_category` VARCHAR(50) NOT NULL DEFAULT '';
ALTER TABLE `p_posts` ADD `post_portada` VARCHAR(300) NOT NULL DEFAULT '';
ALTER TABLE `u_perfil` ADD `p_portada` TINYTEXT NOT NULL DEFAULT '' AFTER `p_nombre`;