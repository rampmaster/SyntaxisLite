function login_ajax(){
   var params = '';
   if (empty($('input[name="nick"]').val())) {$('input[name="nick"]').focus();return;}
   if (empty($('input[name="pass"]').val())) {$('input[name="pass"]').focus();return;}
   $('#login_error').css('display', 'none');
   $('#loading').show(300);
   $('input[type="submit"]').addClass('disabled');
   var remember = ($('#rem').is(':checked')) ? 'true' : 'false';
   params = 'nick='+encodeURIComponent($('input[name="nick"]').val());
   params += '&pass='+encodeURIComponent($('input[name="pass"]').val());
   params += '&rem='+remember;
   $('.btn-login').attr('value', 'Accediendo...').fadeIn(250);
   $('#loading').fadeIn(250);    
   $.ajax({
      type: 'post', url: global_data.url + '/login-user.php', cache: false, data: params,
      success: function (h) {
         switch(h.charAt(0)){
            case '0':
               $('#login_error').html(h.substring(3)).show();
               $('input[name="nick"]').focus();
               $('input[type="submit"]').removeClass('disabled');
               $('.btn-login').attr('value', 'Iniciar sesión');
            break;
            case '1':
               if (h.substring(3)=='Home') location.href='/';
               else if (h.substr(3) == 'Cuenta') location.href = '/cuenta/';
               else location.reload();
               $('#loading').fadeOut(350);
            break;
            case '2':
               $('.login_cuerpo').css('text-align', 'center').css('line-height', '150%').html(h.substring(3));
            break;
            case '3':
               close_login_box();
               registro_load_form();
            break;
         }
      },
      error: function() {
         $('#login_error').html('Error al intentar procesar lo solicitado').show();
         $('#loading').hide(300);
      },
      complete: function(){
         $('#loading').show(300);
      }
   });
}
var form_ff = 0;
//Cargo el formulario
function registro_load_form(data){
   if (typeof data == 'undefined') var data = '';
   mydialog.class_aux = 'registro backLogin';
   mydialog.mask_close = false;
   mydialog.close_button = true;
   mydialog.show(true);
   mydialog.title('Registro');
   mydialog.body('<br /><br />', 305);
   mydialog.buttons(false);
   mydialog.procesando_inicio('Cargando...', 'Registro');
   mydialog.center();
    $('#loading').fadeIn(250);
   $.ajax({
      type: 'POST',
      url: global_data.url + '/registro-form.php?ts=false',
      data: data,
      success: function(h){
         switch(h.charAt(0)){
            case '0': //Error
               mydialog.procesando_fin();
               mydialog.alert('Error', h.substring(3));
            break;
            case '1': //OK. Ya es miembro
               mydialog.body(h.substring(3), 305);
            break;
         }
         $('#loading').fadeOut(350);
         mydialog.center();
      },
      error: function(){
         mydialog.procesando_fin();
         mydialog.error_500("registro.load_form("+data+")");
         $('#loading').fadeOut(350);
      }
   });
}

var form = '';
form += '<div id="AFormInputs">';
form += '<div class="form-group">';
form += '<label class="form-label" for="r_email">Correo electr&oacute;nico:</label>';
form += '<input type="text" tabindex="1" placeholder="Ingresa tu correo." class="form-input" name="r_email" id="r_email" maxlength="35"/>';
form += '</div>';
form += '</div>';
function remind_password(gew) {
   close_login_box();
   if (!gew) {
      mydialog.show(true);
      mydialog.title('Recuperar Contrase&ntilde;a');
      mydialog.body(form);
      mydialog.buttons(true, true, 'Continuar', 'javascript:remind_password(true)', true, true, true, 'Cancelar', 'close', true, false);
      mydialog.center();
   } else {
      var r_email = $('#r_email').val();
      $.post(global_data.url + '/recover-pass.php', 'r_email=' + r_email, function(a) {
         mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
         mydialog.center();
      });
   }
}

function resend_validation(gew) {
   close_login_box();
   if (!gew) {
      mydialog.show(true);
      mydialog.title('Reenviar validaci&oacute;n');
      mydialog.body(form);
      mydialog.buttons(true, true, 'Reenviar', 'javascript:resend_validation(true)', true, true, true, 'Cancelar', 'close', true, false);
      mydialog.center();
   } else {
      var r_email = $('#r_email').val();
      $('#loading').fadeIn(250);
      $.post(global_data.url + '/recover-validation.php', 'r_email=' + r_email, function(a) {
         mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
         mydialog.center();
         $('#loading').fadeOut(350);
      });
   }
}