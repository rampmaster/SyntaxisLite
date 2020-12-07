<div class="box-lateral">
   <div class="box-header">Avatar 
      <a class="float-right" id="cambiar" href="javascript:cambiar.avatar('{$tsUser->uid}')"><i feather="refresh-cw"></i></a>
      <a class="float-right" id="ccambiar" style="display:none!important;" href="javascript:cambiar.close()"><i feather="x"></i></a>
   </div>
   <div class="box-body">
      <div class="avatar-big-cont shadow rounded">
         <div style="display: none" class="avatar-loading"></div>
         <img alt="Avatar" src="{$tsConfig.url}/files/avatar/{if $tsPerfil.p_avatar}{$tsPerfil.user_id}{else}avatar{/if}.webp?t={$smarty.now}" class="img-fit-cover w-100 h-100 avatar-big" id="avatar-img"/>
      </div>
   </div>
   <a class="btn btn-block btn-info btn-sm" id="cambiar" href="javascript:cambiar.avatar('{$tsUser->uid}')">Cambiar avatar</a>
   <br>
   <div class="progress">
      <div class="percente" style="width: {$tsPerfil.porcentaje}%;">
         <span>{$tsPerfil.porcentaje}%</span>
      </div>
   </div>
</div>
<div id="prueba"></div>