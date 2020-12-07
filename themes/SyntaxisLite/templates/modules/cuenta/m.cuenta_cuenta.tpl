<div class="content-tabs cuenta">
   <div class="alert-cuenta cuenta-1"></div>
   <fieldset>
      <div class="form-group">
         <label for="email" class="form-label">E-Mail:</label>
         <input type="text" value="{$tsUser->info.user_email}" maxlength="35" name="email" id="email" class="text cuenta-save-1 form-input">
      </div>
      <div class="form-group">
         <label for="pais" class="form-label">Pa&iacute;s:</label>
         <select onchange="cuenta.chgpais()" class="cuenta-save-1 form-select" name="pais" id="pais">
            <option value="">Pa&iacute;s</option>
            {foreach from=$tsPaises key=code item=pais}
               <option value="{$code}" {if $code == $tsPerfil.user_pais}selected{/if}>{$pais}</option>
            {/foreach}
			</select>
		</div>
      <div class="form-group">
         <label for="estado">Estado/Provincia:</label>
         <select name="estado" id="estado" class="cuenta-save-1 form-select">
            {foreach from=$tsEstados key=code item=estado}
               <option value="{$code+1}" {if $code+1 == $tsPerfil.user_estado}selected{/if}>{$estado}</option>
            {/foreach}
         </select>
      </div>
      <div class="form-group">
         <label class="form-label">Género</label>
         <div>
            <label class="form-radio">
               <input type="radio" value="m" name="sexo" class="cuenta-save-1"{if $tsPerfil.user_sexo == '1'} checked{/if}>
               <i class="form-icon"></i> Masculino
            </label>
            <label class="form-radio">
               <input type="radio" value="f" name="sexo" class="cuenta-save-1"{if $tsPerfil.user_sexo == '0'} checked{/if}>
               <i class="form-icon"></i> Femenino
            </label>
         </div>
      </div>
      <div class="form-group">
			<label class="form-label">Nacimiento:</label>
         <div class="selectgrid">
   			<select class="cuenta-save-1 form-select" name="dia">
               {section name=dias start=1 loop=32}
                  <option value="{$smarty.section.dias.index}" {if $tsPerfil.user_dia ==  $smarty.section.dias.index}selected="selected"{/if}>{$smarty.section.dias.index}</option>
               {/section}                            
   			</select>
   			<select class="cuenta-save-1 form-select" name="mes">
               {foreach from=$tsMeces key=mid item=mes}
                  <option value="{$mid}" {if $tsPerfil.user_mes == $mid}selected="selected"{/if}>{$mes}</option>
               {/foreach}
   			</select>
   			<select class="cuenta-save-1 form-select" name="ano">
               {section name=year start=$tsEndY loop=$tsEndY step=-1 max=$tsMax}
                  <option value="{$smarty.section.year.index}" {if $tsPerfil.user_ano ==  $smarty.section.year.index}selected="selected"{/if}>{$smarty.section.year.index}</option>
               {/section}
   			</select>
         </div>
		</div>
      {if $tsConfig.c_allow_firma}
      <div class="form-group">
         <label for="firma">Firma:<small class="d-block small font-italic">(Acepta BBCode) Max. 300 car.</small></label>
         <textarea name="firma" id="firma" class="form-input cuenta-save-1">{$tsPerfil.user_firma}</textarea>
      </div>
      {/if}
   </fieldset>
   <div class="d-flex justify-content-center align-items-center">
      <input type="button" value="Guardar" onclick="cuenta.save(1)" class="btn btn-success">
      <input type="button" value="Siguiente" onclick="cuenta.save(1, true)" class="btn btn-success">
   </div>
</div>