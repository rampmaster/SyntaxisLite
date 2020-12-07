<h3 onclick="cuenta.chgsec(this)">4. Intereses y preferencias</h3>
<fieldset style="display:none;">
   <div class="alert-cuenta cuenta-5"></div>
   <div class="form-group">
      <label class="form-label" for="mis_intereses">Mis intereses</label>
      <textarea class="form-input cuenta-save-5" name="intereses" id="mis_intereses">{$tsPerfil.p_intereses}</textarea>
   </div>
   <div class="form-group">
      <label class="form-label" for="hobbies">Hobbies</label>
      <textarea class="form-input cuenta-save-5" name="hobbies" id="hobbies">{$tsPerfil.p_hobbies}</textarea>
   </div>
   <div class="form-group">
      <label class="form-label" for="series_tv_favoritas">Series de TV favoritas:</label>
      <textarea class="form-input cuenta-save-5" name="tv" id="series_tv_favoritas">{$tsPerfil.p_tv}</textarea>
   </div>
   <div class="form-group">
      <label class="form-label" for="musica_favorita">M&uacute;sica favorita</label>
      <textarea class="form-input cuenta-save-5" name="musica" id="musica_favorita">{$tsPerfil.p_musica}</textarea>
   </div>
   <div class="form-group">
      <label class="form-label" for="deportes_y_equipos_favoritos">Deportes y equipos favoritos</label>
      <textarea class="form-input cuenta-save-5" name="deportes" id="deportes_y_equipos_favoritos">{$tsPerfil.p_deportes}</textarea>
   </div>
   <div class="form-group">
      <label class="form-label" for="libros_favoritos">Libros favoritos</label>
      <textarea class="form-input cuenta-save-5" name="libros" id="libros_favoritos">{$tsPerfil.p_libros}</textarea>
   </div>
   <div class="form-group">
      <label class="form-label" for="peliculas_favoritas">Pel&iacute;culas favoritas</label>
      <textarea class="form-input cuenta-save-5" name="peliculas" id="peliculas_favoritas">{$tsPerfil.p_peliculas}</textarea>
   </div>
   <div class="form-group">
      <label class="form-label" for="comida_favorita">Comida favorita</label>
      <textarea class="form-input cuenta-save-5" name="comida" id="comida_favorita">{$tsPerfil.p_comida}</textarea>
   </div> 
   <div class="form-group">
      <label class="form-label" for="mis_heroes_son">Mis h&eacute;roes son</label>
      <textarea class="form-input cuenta-save-5" name="heroes" id="mis_heroes_son">{$tsPerfil.p_heroes}</textarea>
   </div>
   <div class="d-flex justify-content-center align-items-center">
      <input type="button" value="Guardar" onclick="cuenta.save(5)" class="mBtn btnOk">
   </div>
</fieldset>