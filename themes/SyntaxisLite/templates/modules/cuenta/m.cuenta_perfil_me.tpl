<h3 class="active" onclick="cuenta.chgsec(this)">1. M&aacute;s sobre mi</h3>
<fieldset>
   <div class="alert-cuenta cuenta-2"></div>
   <div class="form-group">
      <label class="form-label" for="nombrez">Nombre completo</label>
      <input type="text" value="{$tsPerfil.p_nombre}" maxlength="60" name="nombrez" id="nombrez" class="form-input cuenta-save-2">
   </div>
   <div class="form-group">
      <label class="form-label" for="sitio">Mensaje Personal</label>
      <textarea value="" maxlength="60" name="mensaje" id="mensaje" class="form-input cuenta-save-2">{$tsPerfil.p_mensaje}</textarea>
   </div>
   <div class="form-group">
      <label class="form-label" for="sitio">Sitio Web</label>
      <input type="text" value="{$tsPerfil.p_sitio}" maxlength="60" name="sitio" id="sitio" class="form-input cuenta-save-2">
   </div>
   <div class="form-group">
      <label class="form-label" for="ft">Redes sociales</label>
      <div>
         <div class="form-group-input">
            <span><i feather="facebook"></i></span>
            <input type="text" value="{$tsPerfil.p_socials.f}" maxlength="64" name="facebook" id="ft" class="form-input cuenta-save-2">
         </div>
         <div class="form-group-input">
            <span><i feather="twitter"></i></span>
            <input type="text" value="{$tsPerfil.p_socials.t}" maxlength="64" name="twitter" id="ft2" class="form-input cuenta-save-2">
         </div>
         <div class="form-group-input">
            <span><i feather="instagram"></i></span>
            <input type="text" value="{$tsPerfil.p_socials.i}" maxlength="64" name="instagram" id="ft3" class="form-input cuenta-save-2">
         </div>
      </div>
   </div>
   <div class="form-group">
      <label>Me gustar&iacute;a</label>
      <ul class="list-unstyled">
         {foreach from=$tsPData.gustos key=val item=text}
            <li><input type="checkbox" name="g_{$val}" class="cuenta-save-2" value="1" {if $tsPerfil.p_gustos.$val == 1}checked="checked"{/if}> {$text}</li>
         {/foreach}
      </ul>
   </div>
   <div class="form-group">
      <label class="form-label" for="estado">Estado Civil</label>
      <select class="form-select cuenta-save-2" name="estado" id="estado">
         {foreach from=$tsPData.estado key=val item=text}
            <option value="{$val}" {if $tsPerfil.p_estado == $val}selected="selected"{/if}>{$text}</option>
         {/foreach}
      </select>
   </div>
   <div class="form-group">
      <label class="form-label" for="hijos">Hijos</label>
      <select class="form-select cuenta-save-2" name="hijos" id="hijos">
         {foreach from=$tsPData.hijos key=val item=text}
            <option value="{$val}" {if $tsPerfil.p_hijos == $val}selected="selected"{/if}>{$text}</option>
         {/foreach}
      </select>
   </div>
   <div class="form-group">
      <label class="form-label" for="vivo">Vivo con</label>
      <select class="form-select cuenta-save-2" name="vivo" id="vivo">
         {foreach from=$tsPData.vivo key=val item=text}
            <option value="{$val}" {if $tsPerfil.p_vivo == $val}selected="selected"{/if}>{$text}</option>
         {/foreach}
      </select>
   </div>
   <div class="d-flex justify-content-center align-items-center">
      <input type="button" value="Guardar y seguir" onclick="cuenta.save(2, true)" class="btn btn-success">
   </div>
</fieldset>