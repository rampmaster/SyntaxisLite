{include file='sections/main_header.tpl'}
<script src="{$tsConfig.js}/home.js?{$smarty.now}"></script>
{$tsInstall}
<div class="row">
   <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
      <div class="row">
         {include "$tsModulos/m.home_last_posts.tpl"}
      </div>
   </div>
   <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 box-home">
      {include "$tsModulos/m.home_top_posts.tpl"}
      <div class="box-lateral">
         <div class="box-header">&Uacute;ltimos comentarios <a class="float-right" href="javascript:actualizar_comentarios('-1','0')"><i feather="refresh-cw"></i></a></div>
         <div class="box-body" id="ult_comm">
            {include file="t.php_files/p.posts.last-comentarios.tpl"}
         </div>
      </div>
      {include "$tsModulos/m.home_afiliados.tpl"}

      {include "modules/m.global_ads_160.tpl"}
   </div>
</div>
{include file='sections/main_footer.tpl'}