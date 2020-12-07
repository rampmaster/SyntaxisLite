<div class="boxy-title">
    <h3>Caracter&iacute;sticas y Opciones</h3>
</div>
<div id="res" class="boxy-content">
{if $tsSave}<div class="alert alert-info">Configuraciones guardadas</div>{/if}
	<form action="" method="post" autocomplete="off">
    <fieldset>
        <legend>Configuraci&oacute;n del Sitio</legend>
        <dl>
            <dt><label for="ai_titulo">Nombre del Sitio:</label></dt>
            <dd><input type="text" id="ai_titulo" name="titulo" maxlength="24" value="{$tsConfig.titulo}" /></dd>
        </dl>
        <dl>
            <dt><label for="ai_slogan">Descripci&oacute;n del Sitio:</label></dt>
            <dd><input type="text" id="ai_slogan" name="slogan" maxlength="32" value="{$tsConfig.slogan}"/></dd>
        </dl>
        <dl>
            <dt><label for="ai_url">Direcci&oacute;n del sitio:</label></dt>
            <dd><input type="text" id="ai_url" name="url" maxlength="32" value="{$tsConfig.url}" /></dd>
        </dl>
        <hr />
        <dl>
            <dt><label for="pkey">reCaptcha p&uacute;blica</label><span>Clave p&uacute;blica de <a href="https://www.google.com/recaptcha/admin">reCatpcha</a>.</span></dt>
            <dd><input type="text" id="pkey" name="pkey" value="{$tsConfig.pkey}" /></dd>
        </dl>
        <dl>
            <dt><label for="skey">reCaptcha secreta</label><span>Clave privada de <a href="https://www.google.com/recaptcha/admin">reCatpcha</a>.</span></dt>
            <dd><input type="text" id="skey" name="skey" value="{$tsConfig.skey}" /></dd>
        </dl>
        <hr />
        <dl>
            <dt><label for="c_max_upload">Tama&ntilde;o m&aacute;ximo de archivos:</label><br /><span>Peso m&aacute;ximo de archivos en MB. <strong>Nota:</strong> Si deja el campo en 0 no habr&aacute; l&iacute;mite de subida.</span></dt>
            <dd><input type="text" id="c_max_upload" name="max_upload" style="width:10%" maxlength="3" value="{$tsConfig.c_max_upload}" />Mb</dd>
        </dl>
        <dl>
            <dt><label for="c_files_type">Permisos de archivos:</label><span>Si va a permitir o excluir extensiones de archivos, separelos por comas y sin espacios. Ej: <strong>sql,php,bd</strong></span></dt>
            <dd class="d-flex justify-content-center align-items-center">
                <select id="c_files_type" name="files_type" class="select">
                    <option value="0" {if $tsConfig.c_files_type == 0}selected{/if} >Permitir subir cualquier tipo de archivos</option>
                    <option value="1" {if $tsConfig.c_files_type == 1}selected{/if} >Permitir archivos con extensi&oacute;n</option>
                    <option value="2" {if $tsConfig.c_files_type == 2}selected{/if} >Excluir archivos con extensi&oacute;n</option>
                    <option value="3" {if $tsConfig.c_files_type == 3}selected{/if} >No permitir la subida de archivos</option>
                </select>
                <input type="text" id="c_files_ext" placeholder="sql, php, bd, html" name="files_ext" value="{$tsConfig.c_files_ext}" />
            </dd>
        </dl>
        <hr />
        <dl>
            <dt><label for="ai_offline">Modo mantenimiento:</label><span>Esto har&aacute; al Sitio inaccesible a los usuarios. Si quiere, tambi&eacute;n puede introducir un breve mensaje (255 caracteres) para mostrar.</span></dt>
            <dd>
                <label><input name="offline" type="radio" id="ai_offline" value="1"{if $tsConfig.offline == 1} checked{/if} class="radio"/> S&iacute;</label>
                <label><input name="offline" type="radio" id="ai_offline" value="0"{if $tsConfig.offline != 1} checked{/if} class="radio"/> No</label>
                <input type="text" name="offline_message" id="ai_offline" value="{$tsConfig.offline_message}" />
            </dd>
        </dl>
        <hr />
        <dl>
            <dt><label for="ai_edad">Edad requerida:</label> <span>A partir de que edad los usuarios pueden registrarse.</span></dt>
            <dd><input type="text" id="ai_edad" name="edad" style="width:10%" maxlength="2" value="{$tsConfig.c_allow_edad}" /> a&ntilde;os.</dd>
        </dl>
		 <dl>
            <dt><label for="ai_met_welcome">Mensaje de Bienvenida:</label><span id="desc_message_welcome"  {if $tsConfig.c_met_welcome == 0}style="display:none;"{/if}> <br /> [usuario] => Nombre del registrado <br /> [welcome] => Bienvenido/a depende del sexo <br /> [web] => Nombre de esta web <br /> <br />(Se aceptan BBCodes y Smileys)</span></dt>
            <dd>
			<select id="ai_met_welcome" name="met_welcome" class="select" {if $tsConfig.c_met_welcome == 0} onchange="if($('#ai_met_welcome').val() != 0) $('textarea[name=message_welcome]').slideDown(); $('#desc_message_welcome').slideDown();" {/if}>
			<option value="0" {if $tsConfig.c_met_welcome == 0}selected{/if} >No dar bienvenida</option>
            <option value="1" {if $tsConfig.c_met_welcome == 1}selected{/if} >Muro</option>
            <option value="2" {if $tsConfig.c_met_welcome == 2}selected{/if} >Mensaje privado</option>
            <option value="3" {if $tsConfig.c_met_welcome == 3}selected{/if} >Aviso</option>
            </select>
			<br />
            <textarea name="message_welcome" id="ai_met_welcome" style="height: 100px; {if $tsConfig.c_met_welcome == 0} display:none; {/if}" >{$tsConfig.c_message_welcome}</textarea>
            </dd>
        </dl>
        <dl>
            <dt><label for="ai_active">Usuario online:</label><span>Tiempo que debe trascurrir para considerar que un usuario est&aacute; en linea.</span></dt>
            <dd><input type="text" id="ai_active" name="active" style="width:10%" maxlength="2" value="{$tsConfig.c_last_active}" /> min.</dd>
        </dl>
        <dl>
            <dt><label for="ai_stats_cache">Estad&iacute;sticas en buffer:</label><span>Tiempo que debe trascurrir para actualizar las estad&iacute;sticas del sitio.</span></dt>
            <dd><input type="text" id="ai_stats_cache" name="stats_cache" style="width:10%" maxlength="2" value="{$tsConfig.c_stats_cache}" /> min.</dd>
        </dl>
        <dl>
            <dt><label for="ai_sess_ip">Login por IP:</label><span>Por seguridad cada que un usuario cambie de IP se le pedir&aacute; loguearse nuevamente.</span></dt>
            <dd>
                <label><input name="sess_ip" type="radio" id="ai_sess_ip" value="1" {if $tsConfig.c_allow_sess_ip == 1} checked{/if} class="radio"/>S&iacute;</label>
                <label><input name="sess_ip" type="radio" id="ai_sess_ip" value="0" {if $tsConfig.c_allow_sess_ip != 1} checked{/if} class="radio"/>No</label>
            </dd>
        </dl>
        <dl>
		    <dt><label for="ai_count_guests">Los visitantes suman estad&iacute;sticas</label><span>Contar a los visitantes en las estad&iacute;sticas generales.</span></dt>                                          
            <dd>
		     <label><input name="count_guests" type="radio" id="ai_count_guests" value="1" {if $tsConfig.c_count_guests == 1} checked{/if} class="radio"/>S&iacute;</label>                                              
		     <label><input name="count_guests" type="radio" id="ai_count_guests" value="0" {if $tsConfig.c_count_guests != 1} checked{/if} class="radio"/>No</label>
            </dd>
        </dl>
		
		<dl>
		    <dt><label for="ai_hits_guest">Los visitantes suman visitas</label><span>Contar las visitas de los visitantes en posts y fotos.</span></dt>                                          
            <dd>
		     <label><input name="hits_guest" type="radio" id="ai_hits_guest" value="1" {if $tsConfig.c_hits_guest == 1} checked{/if} class="radio"/>S&iacute;</label>                                              
		     <label><input name="hits_guest" type="radio" id="ai_hits_guest" value="0" {if $tsConfig.c_hits_guest != 1} checked{/if} class="radio"/>No</label>
            </dd>
        </dl>

        <hr />
        <dl>
            <dt><label for="ai_reg_active">Registro abierto:</label><span>Permitir el registro de nuevos usuarios</span></dt>
            <dd>
                <label><input name="reg_active" type="radio" id="ai_reg_active" value="1" {if $tsConfig.c_reg_active == 1} checked{/if} class="radio"/>S&iacute;</label>
                <label><input name="reg_active" type="radio" id="ai_reg_active" value="0" {if $tsConfig.c_reg_active != 1} checked{/if} class="radio"/>No</label>
            </dd>
        </dl>
        <dl>
            <dt><label for="ai_reg_activate">Activar usuarios:</label><span>Activar autom&aacute;ticamente la cuenta de usuario.</span></dt>
            <dd>
                <label><input name="reg_activate" type="radio" id="ai_reg_activate" value="1" {if $tsConfig.c_reg_activate == 1} checked{/if} class="radio"/>S&iacute;</label>
                <label><input name="reg_activate" type="radio" id="ai_reg_activate" value="0" {if $tsConfig.c_reg_activate != 1} checked{/if} class="radio"/>No</label>
            </dd>
        </dl>
		
		<dl>
		
            <dt><label for="ai_firma">Firma de usuario:</label><span>Las firmas de los usuarios son visibles en los post.</span></dt>
			<dd>
                <label><input name="firma" type="radio" id="ai_firma" value="1" {if $tsConfig.c_allow_firma == 1} checked{/if} class="radio"/>S&iacute;</label>
				<label><input name="firma" type="radio" id="ai_firma" value="0" {if $tsConfig.c_allow_firma != 1} checked{/if} class="radio"/>No</label>
			</dd>
		</dl>
		
        <hr />
        <dl>
            <dt><label for="ai_upload">Carga externa:</label><span>Si cuentas con un servidor de pago o la librer&iacute;a CURL puedes subir im&aacute;genes remotamente a imgur.com</span></dt>
            <dd>
                <label><input name="upload" type="radio" id="ai_upload" value="1" {if $tsConfig.c_allow_upload == 1} checked{/if} class="radio"/>S&iacute;</label>
                <label><input name="upload" type="radio" id="ai_upload" value="0" {if $tsConfig.c_allow_upload != 1} checked{/if} class="radio"/>No</label>
            </dd>
        </dl>
		
        <dl>
            <dt><label for="ai_portal">Activar portal:</label><span>Los usuarios podr&aacute;n tener un inicio perzonalizado.</span></dt>
            <dd>
                <label><input name="portal" type="radio" id="ai_portal" value="1" {if $tsConfig.c_allow_portal == 1} checked{/if} class="radio"/>S&iacute;</label>
                <label><input name="portal" type="radio" id="ai_portal" value="0" {if $tsConfig.c_allow_portal != 1} checked{/if} class="radio"/>No</label>
            </dd>
        </dl>
		
		<dl>
		    <dt><label for="ai_fotos_private">Secci&oacute;n de fotos oculta</label><span>Si est&aacute; activado, los visitantes no podr&aacute;n ver la secci&oacute;n fotos.</span></dt>                                            
            <dd>
		      <label><input name="fotos_private" type="radio" id="ai_fotos_private" value="1" {if $tsConfig.c_fotos_private == 1} checked{/if} class="radio"/>S&iacute;</label>                                               
		      <label><input name="fotos_private" type="radio" id="ai_fotos_private" value="0" {if $tsConfig.c_fotos_private != 1} checked{/if} class="radio"/>No</label>                                            
            </dd>
        </dl>
		
		<dl>
		    <dt><label for="ai_see_mod">Vista moderativa amplia</label><span>Si est&aacute; activado, el equipo de moderaci&oacute;n podr&aacute; ver, diferenciado por colores, los distintos estados de los posts.</span></dt>                                            
            <dd>
		      <label><input name="see_mod" type="radio" id="ai_see_mod" value="1" {if $tsConfig.c_see_mod == 1} checked{/if} class="radio"/>S&iacute;</label>                                               
		      <label><input name="see_mod" type="radio" id="ai_see_mod" value="0" {if $tsConfig.c_see_mod != 1} checked{/if} class="radio"/>No</label>                                            
            </dd>
        </dl>
		
		<dl>
		    <dt><label for="ai_desapprove_post">Revisi&oacute;n de posts tras su publicaci&oacute;n</label><span>Si est&aacute; activado, el equipo de moderaci&oacute;n deber&aacute; aprobar un post antes de que &eacute;ste sea publicado.</span></dt>                                            
            <dd>
		      <label><input name="desapprove_post" type="radio" id="ai_desapprove_post" value="1" {if $tsConfig.c_desapprove_post == 1} checked{/if} class="radio"/>S&iacute;</label>                                               
		      <label><input name="desapprove_post" type="radio" id="ai_desapprove_post" value="0" {if $tsConfig.c_desapprove_post != 1} checked{/if} class="radio"/>No</label>                                            
            </dd>
        </dl>
		
        <hr />
		<dl>
            <dt><label for="ai_keep_points">Mantener los puntos:</label><span>Al momento de recargar los puntos, si est&aacute; habilitado se conservar&aacute;n los puntos que el usuario no haya gastado los puntos en el d&iacute;, si est&aacute; deshabilitado, se restablecer&aacute;n a los puntos asignados para cada rango.</span></dt>
            <dd>
                <label><input name="keep_points" type="radio" id="ai_keep_points" value="1" {if $tsConfig.c_keep_points == 1} checked{/if} class="radio"/>S&iacute;</label>
                <label><input name="keep_points" type="radio" id="ai_keep_points" value="0" {if $tsConfig.c_keep_points != 1} checked{/if} class="radio"/>No</label>
            </dd>
        </dl>
        <dl>
            <dt><label for="ai_live">Notificaciones Live:</label><span>Los usuarios podr&aacute;n ver en tiempo real sus notificaciones. (Esta opci&oacute;n puede consumir un poco m&aacute;s de recursos.)</span></dt>
            <dd>
                <label><input name="live" type="radio" id="ai_live" value="1" {if $tsConfig.c_allow_live == 1} checked{/if} class="radio"/>S&iacute;</label>
                <label><input name="live" type="radio" id="ai_live" value="0" {if $tsConfig.c_allow_live != 1} checked{/if} class="radio"/>No</label>
            </dd>
        </dl>
        <dl>
            <dt><label for="ai_max_nots">M&aacute;ximo de notificaciones:</label><span>Cuantas notificaciones puede recibir un usuario.</span></dt>
            <dd><input type="text" id="ai_max_nots" name="max_nots" style="width:10%" maxlength="3" value="{$tsConfig.c_max_nots}" /></dd>
        </dl>
        <dl>
            <dt><label for="ai_max_acts">M&aacute;ximo de actividades:</label><span>Cuantas actividades puede registrar un usuario.</span></dt>
            <dd><input type="text" id="ai_max_acts" name="max_acts" style="width:10%" maxlength="3" value="{$tsConfig.c_max_acts}" /></dd>
        </dl>
        <hr />
        <dl>
            <dt><label for="ai_max_post">Posts por p&aacute;gina:</label><span>N&uacute;mero m&aacute;ximo de posts a mostrar en cada p&aacute;gina de la portada.</span></dt>
            <dd><input type="text" id="ai_max_post" name="max_posts" style="width:10%" maxlength="3" value="{$tsConfig.c_max_posts}" /></dd>
        </dl>
        <dl>
            <dt><label for="ai_max_com">Comentarios por post:</label><span>N&uacute;mero m&aacute;ximo de comentarios por p&aacute;gina en los post.</span></dt>
            <dd><input type="text" id="ai_max_com" name="max_com" style="width:10%" maxlength="3" value="{$tsConfig.c_max_com}" /></dd>
        </dl>
		<dl>
            <dt><label for="ai_allow_points" class="qtip" title="Si introducimos '0', se permitir&aacute; dar los puntos definidos por el rango del usuario.  <br />  Si introducimos '-1', se podr&aacute;n dar todos los puntos que el usuario tenga para dar hoy. <br /> Introduciendo un n&uacute;mero superior a 0, todos los usuarios sin importar su rango, tend&aacute;n esa cantidad para dar." >Puntos por post:</label><br /><span>N&uacute;mero m&aacute;ximo de puntos que permitimos dar en los posts. </span></dt>
            <dd><input type="text" id="ai_allow_points" name="allow_points" style="width:10%" maxlength="3" value="{$tsConfig.c_allow_points}" /></dd>
        </dl>
        <dl>
            <dt><label for="ai_sum_p">Los votos suman puntos:</label><br /><span>Cada voto positivo en un comentario es un punto m&aacute;s para el usuario. <strong>Nota:</strong> Los votos negativos no restan puntos</span></dt>
            <dd>
                <label><input name="sump" type="radio" id="ai_sum_p" value="1" {if $tsConfig.c_allow_sump == 1} checked{/if} class="radio"/>Si</label>
                <label><input name="sump" type="radio" id="ai_sum_p" value="0" {if $tsConfig.c_allow_sump != 1} checked{/if} class="radio"/>No</label>
            </dd>
        </dl>
        <hr />
        <dl>
            <dt><label for="ai_nfu">Cambio de rango:</label><span>Un usuario sube de rango cuando obtiene los puntos m&iacute;nimos en:</span></dt>
            <dd>
                <label><input name="newr" type="radio" id="ai_nfu" value="1" {if $tsConfig.c_newr_type == 1} checked{/if} class="radio"/>Todos sus post</label>
                <label><input name="newr" type="radio" id="ai_nfu" value="0" {if $tsConfig.c_newr_type != 1} checked{/if} class="radio"/>Solo en un post</label>
            </dd>
        </dl>
        <p><input type="submit" name="save" value="Guardar Cambios" class="btn btn-success"/></p>
    </fieldset>
    </form>
</div>