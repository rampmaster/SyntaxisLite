{include file='sections/main_header.tpl'}
<link rel="stylesheet" href="{$tsConfig.css}/admin.css?{$smarty.now}">
<script src="{$tsConfig.js}/admin.js?{$smarty.now}"></script>
<div id="borradores" class="row">
   <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
      <div id="admin_menu">
			{include file='admin_mods/m.admin_sidemenu.tpl'}
      </div><!-- boxy-content -->
   </div>
   <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12">
      <div class="boxy" id="admin_panel">
         {if $tsAction == ''}
            {include file='admin_mods/m.admin_welcome.tpl'}
         {elseif $tsAction == 'creditos'}
            {include file='admin_mods/m.admin_creditos.tpl'}
         {elseif $tsAction == 'configs'}
            {include file='admin_mods/m.admin_configs.tpl'}
         {elseif $tsAction == 'temas'}
            {include file='admin_mods/m.admin_temas.tpl'}
         {elseif $tsAction == 'news'}
            {include file='admin_mods/m.admin_noticias.tpl'}
         {elseif $tsAction == 'ads'}
            {include file='admin_mods/m.admin_publicidad.tpl'}
         {elseif $tsAction == 'medals'}
            {include file='admin_mods/m.admin_medallas.tpl'}
         {elseif $tsAction == 'stats'}
            {include file='admin_mods/m.admin_stats.tpl'}
         {elseif $tsAction == 'posts'}
            {include file='admin_mods/m.admin_posts.tpl'}
         {elseif $tsAction == 'fotos'}
            {include file='admin_mods/m.admin_fotos.tpl'}
         {elseif $tsAction == 'files'}
            {include file='admin_mods/m.admin_files.tpl'}
         {elseif $tsAction == 'afs'}
            {include file='admin_mods/m.admin_afiliados.tpl'}
         {elseif $tsAction == 'pconfigs'}
            {include file='admin_mods/m.admin_posts_configs.tpl'}
         {elseif $tsAction == 'cats'}
            {include file='admin_mods/m.admin_cats.tpl'}
         {elseif $tsAction == 'users'}
            {include file='admin_mods/m.admin_users.tpl'}
         {elseif $tsAction == 'sesiones'}
            {include file='admin_mods/m.admin_sesiones.tpl'}
         {elseif $tsAction == 'nicks'}
            {include file='admin_mods/m.admin_nicks.tpl'}
         {elseif $tsAction == 'blacklist'}
            {include file='admin_mods/m.admin_blacklist.tpl'}
         {elseif $tsAction == 'badwords'}
            {include file='admin_mods/m.admin_badwords.tpl'}
         {elseif $tsAction == 'rangos'}
            {include file='admin_mods/m.admin_rangos.tpl'}
         {elseif $tsAction == 'actualizaciones'}
            {include file='admin_mods/m.admin_actualizaciones.tpl'}
         {/if}
      </div>
   </div>
</div>
{include file='sections/main_footer.tpl'}