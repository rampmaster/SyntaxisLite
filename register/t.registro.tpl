<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="{$Lenguaje|replace:'_ES':''}" xml:lang="{$Lenguaje|replace:'_ES':''}">
<head>
<meta http-equiv="Content-Language" content="{$Lenguaje|replace:'_':'-'}" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="{$tsKey}" />
<meta name="robots" content="index, follow">
<meta name="rating" content="public" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="publisher" content="{$tsAuthor} en {$tsConfig.titulo}">
<link rel="alternate" hreflang="es-ES" href="{$tsConfig.domain}/"/>
<!-- apple mobile -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="{$tsColor}">
<meta name="theme-color" content="{$tsColor}">
<link rel=apple-touch-icon href="{$tsImagen}">

<link rel="canonical" href="{$canonical}" />
<title>{$tsTitle}</title>
<link href="{$tsConfig.tema.t_url}/Legion.min.css?{$smarty.now}" rel="stylesheet"/>
<link href="{$tsConfig.url}/register/registro.css?{$smarty.now}" rel="stylesheet"/>
<link rel="shortcut icon" href="{$tsConfig.images}/favicon.ico?{$smarty.now}" type="image/png" />
<script src="{$tsConfig.js}/jquery.min.js?{$smarty.now}"></script>
<script>
var global_data = {
	user_key:'{$tsUser->uid}',
	img:'{$tsConfig.tema.t_url}/',
	url:'{$tsConfig.url}',
	domain:'{$tsConfig.domain}',
	s_title: '{$tsConfig.titulo}',
	s_slogan: '{$tsConfig.slogan}',
}; 
</script>
<style>
html {
	/*background-image: url('{$tsConfig.tema.t_url}/images/legion-bg/legion-bg-0{$tsRandbg}.webp');*/
	background-image: url('{$tsConfig.tema.t_url}/images/legion-bg/legion-bg-03.webp');
}
</style>
</head>

<body name="superior" id="body" class="bg-dark-x6">
<div id="brandday">
	<div class="px-2 py-1 rounded text-white d-flex justify-content-center align-items-center">
		<div class="container">
			<div class="contboth backdrop-blur-x3 shadow-4{if $tsConfig.c_reg_active == 0} reg_desactivado{/if}" id="boxms">
				{if $tsConfig.c_reg_active == 1}
				<h2 class="registro-heading text-light mb-4 text-shadow">Crear una cuenta</h2>
			   <div id="RegistroForm" class="px-3 pb-3">
			   	<div class="pasoUno pasoDos">

			   		<div class="form-group position-relative">
			            <label for="nick">Crea tu nick</label>
			            <input name="nick" onfocus="registro.focus(this);this.removeAttribute('readonly');" readonly type="text" id="nick" class="form-input" tabindex="1" title="Ingresa un nick &uacute;nico" onblur="registro.blur(this)" onkeydown="registro.clear_time(this.name)" onkeyup="registro.set_time(this.name)" autocomplete="off" /> 
			            <div class="help"><span><em></em></span></div>
			         </div>

			         <div class="form-group position-relative">
			            <label for="password">Contrase&ntilde;a</label>
			            <input name="password" type="password" id="password" class="form-input" tabindex="2" onfocus="registro.focus(this); this.removeAttribute('readonly');" readonly title="Ingresa una contrase&ntilde;a segura" onblur="registro.blur(this)" autocomplete="off" /> 
			            <a title="Mostrar contraseña" id="show_password">Mostrar contraseña</a>
			            <div class="help"><span><em></em></span></div>
			         </div>

			         <div class="form-group">
			            <label for="email">E-mail</label>
			            <input name="email" type="text" id="email" class="form-input" tabindex="4" title="Ingresa tu direcci&oacute;n de email" onblur="registro.blur(this)" onfocus="registro.focus(this);this.removeAttribute('readonly');" readonly onkeydown="registro.clear_time(this.name)" onkeyup="registro.set_time(this.name)" autocomplete="off" /> 
			            <div class="help"><span><em></em></span></div>
			         </div>

			         <div class="form-group">
							<label class="d-block">Fecha de Nacimiento</label>
								<select class="form-select fleft" id="dia" name="dia" tabindex="5" onblur="registro.blur(this)" onfocus="registro.focus(this)" autocomplete="off" title="Ingrese d&iacute;a de nacimiento">
					            <option value="">D&iacute;a</option>
					            {section name=dias start=1 loop=32}
					               <option value="{$smarty.section.dias.index}">{$smarty.section.dias.index}</option>
					            {/section}
								</select>
								<select class="form-select fleft" id="mes" name="mes" tabindex="6" onblur="registro.blur(this)" onfocus="registro.focus(this)" autocomplete="off" title="Ingrese mes de nacimiento">
									<option value="">Mes</option>
					            {foreach from=$tsMeces key=mid item=mes}
					               <option value="{$mid}">{$mes}</option>
					            {/foreach}	
					            </select>
								<select class="form-select fleft" id="anio" name="anio" tabindex="7" onblur="registro.blur(this)" onfocus="registro.focus(this)" autocomplete="off" title="Ingrese a&ntilde;o de nacimiento">
									<option value="">A&ntilde;o</option>
					            {section name=year start=$tsEndY loop=$tsEndY step=-1 max=$tsMax}
					               <option value="{$smarty.section.year.index}">{$smarty.section.year.index}</option>
					            {/section}
								</select>
							<div class="help"><span><em></em></span></div>
						</div>

			         <div class="form-group">
			            <label for="sexo">G&eacute;nero</label>
			            <select id="genero" class="form-select" name="sexo" tabindex="8" onblur="registro.blur(this)" onchange="registro.blur(this)" onfocus="registro.focus(this)" autocomplete="off" title="Selecciona tu g&eacute;nero">
			               <option value="">Seleccionar g&eacute;nero</option>
			               <option value="1" id="sexo_m">Masculino</option>
			               <option value="0" id="sexo_f">Femenino</option>
			            </select> 
			            <div class="help"><span><em></em></span></div>
			         </div>  

			         <div class="form-line form-group">
			            <input type="hidden" name="g-recaptcha-response" id="response" class="g-recaptcha">
			            <div class="help"><span><em></em></span></div>
			         </div>

			         <div class="footerReg bg-dark-x2 p-2 mb-2">
			            <div class="custom-control custom-checkbox mb-3">
				   			<input type="checkbox" class="custom-control-input" id="terminos" name="terminos" tabindex="14" onblur="registro.blur(this)" onfocus="registro.focus(this)">
			               <label class="custom-control-label text-light text-shadow" for="terminos"><b>Términos y condiciones.</b><br><small>He leído los Términos y condiciones de {$tsConfig.titulo}.</small></label>
			               <p class="d-block small text-white">Al hacer clic en Crear cuenta, reconozco que he leído y aceptado los <a href="{$tsConfig.url}/pages/terminos-y-condiciones/" class="text-info" target="_blank">T&eacute;rminos y Condiciones de uso</a> y la <a href="{$tsConfig.url}/pages/privacidad/" class="text-info">Política de privacidad</a> de {$tsConfig.titulo}.</p>
			               <div class="help"><span><em></em></span></div>
			            </div>
			         </div>
			      </div>
			      <div class="d-flex justify-content-center align-items-center">
			      	<a href="javascript:registro.submit();" class="bg-dark-xa py-1 px-3 rounded text-primary btn-registro font-weight-bolder mr-2">Crear cuenta</a>
			      	<a href="{$tsConfig.url}/login/" class="bg-dark-xa py-1 px-3 rounded text-success btn-login font-weight-bolder">Iniciar sesión!</a>
			      </div>
			   </div>
			   {else}
					<h1>Bienvenido a {$tsConfig.titulo}!</h1>
					<p class="my-3">Temporalmente el registro de nuevas cuentas esta desactivado</p>
					<p>Pero, si ya tienes una cuenta, por favor <a class="text-success btn-login font-weight-bolder" href="{$tsConfig.url}/login/">inicia sesión</a></p>
			   {/if}
			</div>
		</div>
	<!--end-cuerpo-->	
	</div>
</div>

{if $tsConfig.c_reg_active == 1}
<!-- Flotante -->
<div class="frase shadow-3 bg-dark-xa rounded p-2 text-shadow text-white-50">El grupo <a href="{$tsConfig.url}" class="text-white">{$tsConfig.titulo}</a> puede mantenerme informado con correos electrónicos personalizado sobre productos y servicios. Consulta nuestra <a href="{$tsConfig.url}/pages/privacidad/" class="text-white">Política de privacidad</a> para conocer más detalles o darte de baja en cualquier momento.</div>
<script src="https://www.google.com/recaptcha/api.js?render={$tsKeyPbulic}"></script>
<script type="text/javascript">

$.getScript("{$tsConfig.url}/register/registro.js{literal}", function(){
   registro.change_paso(1);
});
$('#show_password').click(function(e){
   e.preventDefault();
   var newType = $('#password').attr('type') == 'text' ? 'password' : 'text';
   $('#password').attr('type', newType);
   var text = $(this).text();
   if(text == 'Mostrar contraseña') $(this).html('Ocultar contraseña');
   else $(this).html('Mostrar contraseña');
});
</script>
{/literal}

<script type="text/javascript">
   var keyv3 = '{$tsKeyPbulic}';
   grecaptcha.ready(function () {
      grecaptcha.execute(keyv3{literal}, {action: 'homepage'}).then(function (token) {
         var response = document.getElementById('response');
         response.value = token;
      });
   });
   {/literal}
</script>
{/if}
</body>
</html>
<!-- hileez -->