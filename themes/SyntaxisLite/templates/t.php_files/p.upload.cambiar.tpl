<div class="row">
   <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
      <div onclick="cambiar.type('pc'); return false" class="box-type type-pc bg-info d-flex flex-column justify-content-center align-items-center"><i feather="monitor"></i> <span>Desde PC</span></div>
      <div onclick="cambiar.type('url'); return false" class="box-type type-url bg-primary d-flex flex-column justify-content-center align-items-center"><i feather="link-2"></i> <span>Desde URL</span></div>
   </div>
   <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
   	<div class="grid-avatares">
      {foreach $tsAvatares item=ava}
      	<div class="avatar justify-content-center align-items-center flex-column">
      		<img src="{$tsConfig.url}/files/avatares/{$tsCarpeta}/{$ava}" alt="Avatar #{$ava|replace:'.webp':''}" />
      		<div class="select">
      			<img style="width:50px;height:50px" onclick="cambiar.select('{$tsUser->uid}', '{$ava|replace:'.jpg':''}');return false" class="rounded shadow" src="{$tsConfig.url}/files/avatares/{$tsCarpeta}/{$ava}" alt="Avatar #{$ava|replace:'.webp':''}" />
      			<a href="javascript:cambiar.select('{$tsUser->uid}', '{$ava|replace:'.jpg':''}')" class="btn btn-info">Seleccionar</a>
      		</div>
      	</div>
      {/foreach}
      </div>
      <div id="type-selection"></div>
   </div>
</div>
<script>
	feather.replace({ class: 'featherIcons', 'stroke-width': 1})
</script>