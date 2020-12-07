{include file='sections/main_header.tpl'}
<script type="text/javascript" src="{$tsConfig.js}/cuenta.js?{$smarty.now}"></script>
<script type="text/javascript">
$(document).ready(function(){
   avatar.uid = '{$tsUser->uid}';
   avatar.current = '{$tsConfig.url}/files/avatar/{if $tsPerfil.p_avatar}{$tsPerfil.user_id}{else}avatar{/if}.jpg';
   if (typeof location.href.split('#')[1] != 'undefined') 
      $('ul.menu-tab > li > a:contains('+location.href.split('#')[1]+')').click();
});
</script>
<div class="row">
   <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12">
      <ul class="menu-tab d-flex justify-content-start align-items-center">
         <li class="active"><a onclick="cuenta.chgtab(this)">Cuenta</a></li>
         <li><a onclick="cuenta.chgtab(this)">Perfil</a></li>    
         <li><a onclick="cuenta.chgtab(this)">Bloqueados</a></li>
         <li><a onclick="cuenta.chgtab(this)">Cambiar Clave</a></li>
			<li><a onclick="cuenta.chgtab(this)">Cambiar Nick</a></li>
         <li><a onclick="cuenta.chgtab(this)">Privacidad</a></li>
      </ul>
      <a name="alert-cuenta"></a>
      <div class="avatares" style="display:none;"></div>
      <form class="horizontal" method="post" action="" name="editarcuenta">
         {include "$tsModulos/m.cuenta_cuenta.tpl"}
         {include "$tsModulos/m.cuenta_perfil.tpl"}
         {include "$tsModulos/m.cuenta_block.tpl"}
         {include "$tsModulos/m.cuenta_clave.tpl"}
			{include "$tsModulos/m.cuenta_nick.tpl"}
         {include "$tsModulos/m.cuenta_config.tpl"}
      </form>
   </div>
   <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
	   {include "$tsModulos/m.cuenta_sidebar.tpl"}
   </div>
</div>             
{include file='sections/main_footer.tpl'}