<div class="boxy-title">
   <h3>Centro de Administraci&oacute;n</h3>
</div>
<div id="res" class="boxy-content">
   <div class="hero hero-lg">
      <div class="hero-body"><h4>Bienvenido(a), {$tsUser->nick}!</h4>
      <p>Este es tu &quot;<b>Centro de Administraci&oacute;n de {$tsConfig.titulo}</b>&quot;. Aqu&iacute; puedes modificar la configuraci&oacute;n de tu web, modificar usuarios, modificar posts, y muchas otras cosas.<br />Si tienes algun problema, por favor revisa la p&aacute;gina de &quot;<b>Soporte y Cr&eacute;ditos</b>&quot;.  Si esa informaci&oacute;n no te sirve, puedes <a href="http://www.phpost.net/" class="text-info" target="_blank">visitarnos para solicitar ayuda</a> acerca de tu problema.</p></div>
   </div>
   <hr class="separator" />
   <div class="row">
      <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
         <div class="phpost">
            <h1 class="h5 m-0 p-2 bg-light">{$tsConfig.titulo} en directo</h1>
            <ul id="news_pp" class="pp_list">
               <div class="hero hero-info text-center hero-lg">
                  <div class="hero-body">
                     <h1>Cargando...</h1>
                  </div>
               </div>
            </ul>
         </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
         <div class="phpost version">
            <h1 class="h5 m-0 p-2 bg-light">Informaci&oacute;n de versiones:</h1>
            PHP: <b>{$tsVersion.php}</b><br />
            MySQL: <b>{$tsVersion.mysql.0}</b><br />
            Servidor: <b>{$tsVersion.server}</b><br />
            GD: <b>{$tsVersion.gd}</b>
            <h1 class="h5 m-0 mt-2 p-2 bg-light">{$tsConfig.titulo}</h1>
            <ul id="version_pp" class="pp_list">
               <li>
                  <div class="title">Versi&oacute;n instalada</div>
                  <div class="body"><b>v{$tsConfig.version}</b></div>
               </li>
            </ul>
            <h1 class="h5 m-0 mt-2 p-2 bg-light">Administradores</h1>
            <ul class="pp_list">                                    
               {foreach from=$tsAdmins item=admin}
                  <li><div class="title"><a href="{$tsConfig.url}/perfil/{$admin.user_name}" data-vcard="{$admin.user_id}">{$admin.user_name}</a></div></li>                                    
               {/foreach}
            </ul>
            <h1 class="h5 m-0 mt-2 p-2 bg-light">Instalaciones</h1>
            <ul class="pp_list">
			      <li class="px-1 py-2">Fundaci&oacute;n<span class="float-right small badge badge-info" title="{$tsInst.0|fecha}">{$tsInst.0|hace:true}</span></li>
			      <li class="px-1 py-2">Actualizado<span class="float-right small badge badge-info" title="{$tsInst.1|fecha}">{$tsInst.1|hace:true}</span></li>
	        </ul>
         </div>
      </div>
   </div>
</div>
{literal}
<script type="text/javascript">
$(document).ready(function(){
    $.ajax({
        type: "GET",
        url: global_data.url + "/feed-support.php",
        dataType: "json",
        success: function(r) {
            $('#news_pp').html('');
            for(var i = 0; i < r.length; i++){
                //
                var html = '<li>';
                html += '<div class="title"><a href="' + r[i].link + '" target="_blank">' + r[i].title +'</a></div>';
                html += '<div class="body">' + r[i].info +'</div>';
                html += '</li>';
                //
                $('#news_pp').append(html);
            }
    	}
    });
    $.ajax({
        type: "GET",
        url: global_data.url + "/feed-version.php?v=risus",
        dataType: "json",
        success: function(r) {
            for(var i = 0; i < r.length; i++){
                //
                var html = '<li>';
                html += '<div class="title">' + r[i].title +'</div>';
                html += '<div class="body">' + r[i].text +'</div>';
                html += '</li>';
                //
                $('#version_pp').append(html);
            }
    	}
    });
});
</script>
{/literal}