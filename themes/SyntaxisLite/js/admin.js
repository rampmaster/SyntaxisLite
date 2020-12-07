var admin = {
   afs: {
      borrar: function(aid, gew) {
         if (!gew) {
            mydialog.show();
            mydialog.title('Borrar Afiliado');
            mydialog.body('&#191;Quiere borrar este afiliado?');
            mydialog.buttons(true, true, 'S&iacute;', 'admin.afs.borrar(' + aid + ', 1)', true, false, true, 'No', 'close', true, true);
            mydialog.center();
         } else {
            $('#loading').fadeIn(250);
            $.post(global_data.url + '/afiliado-borrar.php', 'afid=' + aid, function(a) {
               mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
               mydialog.center();
               success: if (a.charAt(0) == '1') $('#few_' + aid).fadeOut().remove;
               $('#loading').fadeOut(350);
            });
         }
      },
      accion: function(aid) {
         $('#loading').fadeIn(250);
         $.ajax({
            type: 'POST',
            url: global_data.url + '/afiliado-setactive.php',
            data: 'aid=' + aid,
            success: function(h) {
               switch (h.charAt(0)) {
                  case '0': //Error
                     mydialog.alert('Error', h.substring(3));
                     break;
                  case '1':
                     //
                     $('#status_afiliado_' + aid).html('<font color="green">Activo</font>');
                     break;
                  case '2':
                     //
                     $('#status_afiliado_' + aid).html('<font color="purple">Inactivo</font>');
                     break;
               }
               $('#loading').fadeOut(250);
            }
         });
      },
   },
   news: {
      accion: function(nid) {
         $('#loading').fadeIn(250);
         $.ajax({
            type: 'POST',
            url: global_data.url + '/admin-noticias-setInActive.php',
            data: 'nid=' + nid,
            success: function(h) {
               switch (h.charAt(0)) {
                  case '0': //Error
                     mydialog.alert('Error', h.substring(3));
                     break;
                  case '1':
                     //
                     $('#status_noticia_' + nid).html('<font color="green">Activa</font>');
                     break;
                  case '2':
                     //
                     $('#status_noticia_' + nid).html('<font color="purple">Inactiva</font>');
                     break;
               }
               $('#loading').fadeOut(350);
            }
         });
      },
   },
   nicks: {
      accion: function(nid, accion, gew) {
         if (!gew) {
            mydialog.show();
            mydialog.title((accion == 'aprobar' ? 'Aprobar Cambio' : 'Denegar Cambio'));
            mydialog.body((accion == 'aprobar' ? '&#191;Quiere aprobar el cambio?' : '&#191;Quiere denegar el cambio?'));
            mydialog.buttons(true, true, 'S&iacute;', "admin.nicks.accion(" + nid + ",'" + accion + "' ,true)", true, false, true, 'No', 'close', true, false);
            mydialog.center();
         } else {
            $('#loading').fadeIn(250);
            $.post(global_data.url + '/admin-nicks-change.php', 'nid=' + nid + '&accion=' + accion, function(a) {
               mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
               mydialog.center();
               success: if (a.charAt(0) == '1') $('#nick_' + nid).fadeOut();
               $('#loading').fadeOut(350);
            });
         }
      },
   },
   sesiones: {
      borrar: function(sid, gew) {
         if (!gew) {
            mydialog.show();
            mydialog.title('Cerrar sesi&oacute;n');
            mydialog.body('&#191;Quiere cerrar la sesi&oacute;n de este usuario/visitante? Se borrar&aacute; la sesi&oacute;n');
            mydialog.buttons(true, true, 'S&iacute;', "admin.sesiones.borrar('" + sid + "', true)", true, false, true, 'No', 'close', true, true);
            mydialog.center();
         } else {
            $('#loading').fadeIn(250);
            $.post(global_data.url + '/admin-sesiones-borrar.php', 'sesion_id=' + sid, function(a) {
               mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
               mydialog.center();
               success: if (a.charAt(0) == '1') $('#sesion_' + sid).fadeOut();
               $('#loading').fadeOut(350);
            });
         }
      },
   },
   posts: {
      borrar: function(pid, gew) {
         if (!gew) {
            mydialog.show();
            mydialog.title('Borrar Post');
            mydialog.body('&#191;Quiere borrar este post permanentemente?');
            mydialog.buttons(true, true, 'S&iacute;', 'admin.posts.borrar(' + pid + ', 1)', true, false, true, 'No', 'close', true, true);
            mydialog.center();
         } else {
            $('#loading').fadeIn(250);
            $.post(global_data.url + '/posts-admin-borrar.php', 'postid=' + pid, function(a) {
               mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
               mydialog.center();
               success: if (a.charAt(0) == '1') $('#post_' + pid).fadeOut();
               $('#loading').fadeOut(350);
            });
         }
      },
   },
   file: {
      borrar: function(pid, gew) {
         if (!gew) {
            mydialog.show();
            mydialog.title('Borrar Arvhivo');
            mydialog.body('&#191;Quiere borrar este archivo permanentemente?');
            mydialog.buttons(true, true, 'S&iacute;', 'admin.file.borrar(' + pid + ', 1)', true, false, true, 'No', 'close', true, true);
            mydialog.center();
         } else {
            $('#loading').fadeIn(250);
            $.post(global_data.url + '/files-admin-borrar.php', 'fileid=' + pid, function(a) {
               mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
               mydialog.center();
               success: if (a.charAt(0) == '1') $('#file_' + pid).fadeOut();
               $('#loading').fadeOut(350);
            });
         }
      },
   },
   blacklist: {
      borrar: function(id, gew) {
         if (!gew) {
            mydialog.show();
            mydialog.title('Retirar Bloqueo');
            mydialog.body('&#191;Quiere retirar este bloqueo?');
            mydialog.buttons(true, true, 'S&iacute;', 'admin.blacklist.borrar(' + id + ', true)', true, false, true, 'No', 'close', true, true);
            mydialog.center();
         } else {
            $('#loading').fadeIn(250);
            $.post(global_data.url + '/admin-blacklist-delete.php', 'bid=' + id, function(a) {
               mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
               mydialog.center();
               success: if (a.charAt(0) == '1') $('#block_' + id).fadeOut();
               $('#loading').fadeOut(350);
            });
         }
      },
   },
   badwords: {
      borrar: function(wid, gew) {
         if (!gew) {
            mydialog.show();
            mydialog.title('Retirar Filtro');
            mydialog.body('&#191;Quiere retirar este filtro?');
            mydialog.buttons(true, true, 'S&iacute;', 'admin.badwords.borrar(' + wid + ', true)', true, false, true, 'No', 'close', true, true);
            mydialog.center();
         } else {
            $('#loading').fadeIn(250);
            $.post(global_data.url + '/admin-badwords-delete.php', 'wid=' + wid, function(a) {
               mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
               mydialog.center();
               success: if (a.charAt(0) == '1') $('#wid_' + wid).fadeOut();
               $('#loading').fadeOut(350);
            });
         }
      },
   },
   fotos: {
      borrar: function(fid, gew) {
         if (!gew) {
            mydialog.show();
            mydialog.title('Borrar Foto');
            mydialog.body('&#191;Quiere borrar esta foto permanentemente?');
            mydialog.buttons(true, true, 'S&iacute;', 'admin.fotos.borrar(' + fid + ', 1)', true, false, true, 'No', 'close', true, true);
            mydialog.center();
         } else {
            $('#loading').fadeIn(250);
            $.post(global_data.url + '/admin-foto-borrar.php', 'foto_id=' + fid, function(a) {
               mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
               mydialog.center();
               success: $('#foto_' + fid).fadeOut();
               $('#loading').fadeOut(350);
            });
         }
      },
      setOpenClosed: function(fid) {
         $('#loading').fadeIn(250);
         $.ajax({
            type: 'POST',
            url: global_data.url + '/admin-foto-setOpenClosed.php',
            data: 'fid=' + fid,
            success: function(h) {
               switch (h.charAt(0)) {
                  case '0': //Error
                     mydialog.alert('Error', h.substring(3));
                     break;
                  case '1':
                     //
                     $('#comments_foto_' + fid).html('<font color="red">Cerrados</font>');
                     break;
                  case '2':
                     //
                     $('#comments_foto_' + fid).html('<font color="green">Abiertos</font>');
                     break;
               }
               $('#loading').fadeOut(350);
            }
         });
      },
      setShowHide: function(fid) {
         $('#loading').fadeIn(250);
         $.ajax({
            type: 'POST',
            url: global_data.url + '/admin-foto-setShowHide.php',
            data: 'fid=' + fid,
            success: function(h) {
               switch (h.charAt(0)) {
                  case '0': //Error
                     mydialog.alert('Error', h.substring(3));
                     break;
                  case '1':
                     //
                     $('#status_foto_' + fid).html('<font color="purple">Oculta</font>');
                     break;
                  case '2':
                     //
                     $('#status_foto_' + fid).html('<font color="green">Visible</font>');
                     break;
               }
               $('#loading').fadeOut(350);
            }
         });
      },
   },
   medallas: {
      borrar: function(mid, gew) {
         mydialog.show();
         mydialog.title('Borrar Medalla');
         if (!gew) {
            mydialog.body('&#191;Quiere borrar esta medalla?');
            mydialog.buttons(true, true, 'S&iacute;', 'admin.medallas.borrar(' + mid + ', 2)', true, false, true, 'No', 'close', true, true);
         } else if (gew == '2') {
            mydialog.body('Si borra la medalla, los usuarios que tengan esta medalla la perder&aacute;n, &#191;seguro que quiere continuar?');
            mydialog.buttons(true, true, 'S&iacute;', 'admin.medallas.borrar(' + mid + ', 3)', true, false, true, 'No', 'close', true, true);
         } else {
            $('#loading').fadeIn(250);
            $.post(global_data.url + '/admin-medalla-borrar.php', 'medal_id=' + mid, function(a) {
               mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
               mydialog.center();
               success: $('#medal_id_' + mid).fadeOut();
               $('#loading').fadeOut(350);
            });
         }
         mydialog.center();
      },
      borrar_asignacion: function(aid, mid, gew) {
         if (!gew) {
            mydialog.show();
            mydialog.title('Borrar Asignacion');
            mydialog.body('&#191;Quiere continuar borrando esta asignaci&oacute;n?');
            mydialog.buttons(true, true, 'S&iacute;', 'admin.medallas.borrar_asignacion(' + aid + ',' + mid + ', true)', true, false, true, 'No', 'close', true, true);
            mydialog.center();
         } else {
            $('#loading').fadeIn(250);
            $.post(global_data.url + '/admin-medallas-borrar-asignacion.php', 'aid=' + aid + '&mid=' + mid, function(a) {
               mydialog.alert((a.charAt(0) == '0' ? 'Opps!' : 'Hecho'), a.substring(3), false);
               mydialog.center();
               success: $('#assign_id_' + aid).fadeOut();
               $('#loading').fadeOut(350);
            });
         }
      },
      asignar: function(mid, gew) {
         if (!gew) {
            var form = '';
            form += '<div id="AFormInputs">'
            form += '<div class="form-group">'
            form += '<label for="m_usuario">Al usuario (nombre):</label>'
            form += '<input name="m_usuario" class="form-input" id="m_usuario"/></div>'
            form += '<div class="form-group">'
            form += '<label for="m_post">Al post (id):</label>'
            form += '<input name="m_post" class="form-input" id="m_post"/></div>'
            form += '<div class="form-group">'
            form += '<label for="m_foto">A la foto (id):</label>'
            form += '<input name="m_foto" class="form-input" id="m_foto"/></div>'
            form += '</div>'
            form += '</div>'
            //
            mydialog.class_aux = 'registro';
            mydialog.show(true);
            mydialog.title('Asignar medalla');
            mydialog.body(form);
            mydialog.buttons(true, true, 'Asignar', 'admin.medallas.asignar(' + mid + ',true)', true, true, true, 'Cancelar', 'close', true, false);
            mydialog.center();
         } else {
            var m_usuario = $('#m_usuario').val();
            var m_post = $('#m_post').val();
            var m_foto = $('#m_foto').val();
            $('#loading').fadeIn(250);
            $.post(global_data.url + '/admin-medalla-asignar.php', 'mid=' + mid + '&m_usuario=' + m_usuario + '&pid=' + m_post + '&fid=' + m_foto, function(c) {
               mydialog.alert((c.charAt(0) == '0' ? 'Opps!' : 'Hecho'), '<div class="dialog_box">' + c.substring(3) + '</div>', false);
               success: if (c.charAt(0) != '0') {
                  var nmeds = parseInt($('#total_med_assig_' + mid).text());
                  $('#total_med_assig_' + mid).text(nmeds + 1);
                  $('#loading').fadeOut(350);
               }
               mydialog.center();
            });
         }
      },
   },
   users: {
      setInActive: function(uid) {
         $('#loading').fadeIn(250);
         $.ajax({
            type: 'POST',
            url: global_data.url + '/admin-users-InActivo.php',
            data: 'uid=' + uid,
            success: function(h) {
               switch (h.charAt(0)) {
                  case '0': //Error
                     mydialog.alert('Error', h.substring(3));
                     break;
                  case '1':
                     //
                     $('#status_user_' + uid).html('<font color="green">Activo</font>');
                     break;
                  case '2':
                     //
                     $('#status_user_' + uid).html('<font color="purple">Inactivo</font>');
                     break;
               }
               $('#loading').fadeOut(350);
            }
         });
      },
   },
}
/* AFILIADOS */
var ad_afiliado = {
   cache: {},
   detalles: function(aid) {
      $.ajax({
         type: 'POST',
         url: global_data.url + '/afiliado-detalles.php',
         data: 'ref=' + aid,
         success: function(h) {
            mydialog.show(true);
            mydialog.title('Detalles del Afiliado');
            mydialog.body(h);
            mydialog.buttons(true, true, 'Aceptar', 'mydialog.close()', true, true);
            mydialog.center();
         }
      });
   }
}
$(document).ready(function() {
   $("#themesClick").change(function(e) {
      const ThemeActual = e.target.classList[1].replace('_', ' ');
      var Nombre = e.target.selectedOptions[0].innerText,
         tid = $(this).val();
      var html = '';
      if (tid != 0) {
         html += '<div class="p-2">';
         html += '<a class="btn btn-info" href="?act=editar&tid=' + tid + '">Editar</a>';
         if (ThemeActual != Nombre) {
            html += '<a class="btn btn-success" href="?act=usar&tid=' + tid + '&tt=' + Nombre + '">Activar</a>';
            html += '<a class="btn btn-danger" href="?act=borrar&tid=' + tid + '&tt=' + Nombre + '">Eliminar</a>';
         }
         html += '</div>';
      }
      $('#theme').html(html);
   });
});
$(document).ready(function(){    
   var msj = $("#message"),
   percent = $('#percent'),
   bar = $("#bar");

   if ( $("#New_upload").length ) {
      document.getElementById('New_upload').onsubmit = function(e) {
         $('#start_upload').hide().attr('disabled','disabled');
         bar.width('0%');
         msj.html("").hide();
         percent.html("0%");
         $("#progress").fadeIn(250);
         var xhr = new XMLHttpRequest();  
         xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
               var percentage = Math.round((e.loaded * 100) / e.total);
               percent.html(percentage + '%');
               bar.width(percentage+'%');
            }
         }, false);
         xhr.open('post', global_data.url+'/admin-instalar-tema.php', true);
         xhr.onreadystatechange = function(e) {
            if (xhr.readyState == 4 && xhr.status == 200) {
               var result = xhr.responseText;
               if(result.charAt(0) != 1) {
                  msj.removeClass('upload_ok').addClass('upload_error');
                  msj.html(result); 
               } else {
                  location.href = global_data.url + '/admin/temas?ttSave=Instalado'; 
                  msj.removeClass('upload_error').addClass('upload_ok');
                  $('.install').slideUp(100);
                  msj.html(result.substring(3)).append('Se esta instalando el theme, espera!');  
                  setTimeout(function(){ 
                     $('#progress').hide();
                     msj.hide();
                  }, 8000);
               }
               msj.show();
               $('#start_upload').removeAttr('disabled');
            }
         }
         xhr.send(new FormData());   
      };
   }
   $('#New_file').on('change', function() {
      if($('#New_file').val() == '') {
         $('.result_text').hide().html('');
         $('#start_upload').hide();
      } else {
         $('.result_text').html($('#New_file').val().substring(12)).fadeIn(100);
         $('#start_upload').fadeIn(100);
      }
      $("#progress").hide();
      bar.width('0%');
      msj.html("").hide();
      percent.html("0%");
   });
   $("#New_upload").ajaxForm();
});   

!function(e){"function"==typeof define&&define.amd?define(["jquery"],e):"object"==typeof module&&module.exports?module.exports=function(t,r){return void 0===r&&(r="undefined"!=typeof window?require("jquery"):require("jquery")(t)),e(r),r}:e(jQuery)}(function(e){"use strict";function t(t){var r=t.data;t.isDefaultPrevented()||(t.preventDefault(),e(t.target).closest("form").ajaxSubmit(r))}function r(t){var r=t.target,a=e(r);if(!a.is("[type=submit],[type=image]")){var n=a.closest("[type=submit]");if(0===n.length)return;r=n[0]}var i=r.form;if(i.clk=r,"image"===r.type)if(void 0!==t.offsetX)i.clk_x=t.offsetX,i.clk_y=t.offsetY;else if("function"==typeof e.fn.offset){var o=a.offset();i.clk_x=t.pageX-o.left,i.clk_y=t.pageY-o.top}else i.clk_x=t.pageX-r.offsetLeft,i.clk_y=t.pageY-r.offsetTop;setTimeout(function(){i.clk=i.clk_x=i.clk_y=null},100)}function a(){if(e.fn.ajaxSubmit.debug){var t="[jquery.form] "+Array.prototype.join.call(arguments,"");window.console&&window.console.log?window.console.log(t):window.opera&&window.opera.postError&&window.opera.postError(t)}}var n=/\r?\n/g,i={};i.fileapi=void 0!==e('<input type="file">').get(0).files,i.formdata=void 0!==window.FormData;var o=!!e.fn.prop;e.fn.attr2=function(){if(!o)return this.attr.apply(this,arguments);var e=this.prop.apply(this,arguments);return e&&e.jquery||"string"==typeof e?e:this.attr.apply(this,arguments)},e.fn.ajaxSubmit=function(t,r,n,s){function u(r){var a,n,i=e.param(r,t.traditional).split("&"),o=i.length,s=[];for(a=0;a<o;a++)i[a]=i[a].replace(/\+/g," "),n=i[a].split("="),s.push([decodeURIComponent(n[0]),decodeURIComponent(n[1])]);return s}function c(r){function n(e){var t=null;try{e.contentWindow&&(t=e.contentWindow.document)}catch(e){a("cannot get iframe.contentWindow document: "+e)}if(t)return t;try{t=e.contentDocument?e.contentDocument:e.document}catch(r){a("cannot get iframe.contentDocument: "+r),t=e.document}return t}function i(){function t(){try{var e=n(v).readyState;a("state = "+e),e&&"uninitialized"===e.toLowerCase()&&setTimeout(t,50)}catch(e){a("Server abort: ",e," (",e.name,")"),s(L),j&&clearTimeout(j),j=void 0}}var r=p.attr2("target"),i=p.attr2("action"),o=p.attr("enctype")||p.attr("encoding")||"multipart/form-data";w.setAttribute("target",m),l&&!/post/i.test(l)||w.setAttribute("method","POST"),i!==f.url&&w.setAttribute("action",f.url),f.skipEncodingOverride||l&&!/post/i.test(l)||p.attr({encoding:"multipart/form-data",enctype:"multipart/form-data"}),f.timeout&&(j=setTimeout(function(){T=!0,s(A)},f.timeout));var u=[];try{if(f.extraData)for(var c in f.extraData)f.extraData.hasOwnProperty(c)&&(e.isPlainObject(f.extraData[c])&&f.extraData[c].hasOwnProperty("name")&&f.extraData[c].hasOwnProperty("value")?u.push(e('<input type="hidden" name="'+f.extraData[c].name+'">',k).val(f.extraData[c].value).appendTo(w)[0]):u.push(e('<input type="hidden" name="'+c+'">',k).val(f.extraData[c]).appendTo(w)[0]));f.iframeTarget||h.appendTo(D),v.attachEvent?v.attachEvent("onload",s):v.addEventListener("load",s,!1),setTimeout(t,15);try{w.submit()}catch(e){document.createElement("form").submit.apply(w)}}finally{w.setAttribute("action",i),w.setAttribute("enctype",o),r?w.setAttribute("target",r):p.removeAttr("target"),e(u).remove()}}function s(t){if(!x.aborted&&!X){if((O=n(v))||(a("cannot access response document"),t=L),t===A&&x)return x.abort("timeout"),void S.reject(x,"timeout");if(t===L&&x)return x.abort("server abort"),void S.reject(x,"error","server abort");if(O&&O.location.href!==f.iframeSrc||T){v.detachEvent?v.detachEvent("onload",s):v.removeEventListener("load",s,!1);var r,i="success";try{if(T)throw"timeout";var o="xml"===f.dataType||O.XMLDocument||e.isXMLDoc(O);if(a("isXml="+o),!o&&window.opera&&(null===O.body||!O.body.innerHTML)&&--C)return a("requeing onLoad callback, DOM not available"),void setTimeout(s,250);var u=O.body?O.body:O.documentElement;x.responseText=u?u.innerHTML:null,x.responseXML=O.XMLDocument?O.XMLDocument:O,o&&(f.dataType="xml"),x.getResponseHeader=function(e){return{"content-type":f.dataType}[e.toLowerCase()]},u&&(x.status=Number(u.getAttribute("status"))||x.status,x.statusText=u.getAttribute("statusText")||x.statusText);var c=(f.dataType||"").toLowerCase(),l=/(json|script|text)/.test(c);if(l||f.textarea){var p=O.getElementsByTagName("textarea")[0];if(p)x.responseText=p.value,x.status=Number(p.getAttribute("status"))||x.status,x.statusText=p.getAttribute("statusText")||x.statusText;else if(l){var m=O.getElementsByTagName("pre")[0],g=O.getElementsByTagName("body")[0];m?x.responseText=m.textContent?m.textContent:m.innerText:g&&(x.responseText=g.textContent?g.textContent:g.innerText)}}else"xml"===c&&!x.responseXML&&x.responseText&&(x.responseXML=q(x.responseText));try{M=N(x,c,f)}catch(e){i="parsererror",x.error=r=e||i}}catch(e){a("error caught: ",e),i="error",x.error=r=e||i}x.aborted&&(a("upload aborted"),i=null),x.status&&(i=x.status>=200&&x.status<300||304===x.status?"success":"error"),"success"===i?(f.success&&f.success.call(f.context,M,"success",x),S.resolve(x.responseText,"success",x),d&&e.event.trigger("ajaxSuccess",[x,f])):i&&(void 0===r&&(r=x.statusText),f.error&&f.error.call(f.context,x,i,r),S.reject(x,"error",r),d&&e.event.trigger("ajaxError",[x,f,r])),d&&e.event.trigger("ajaxComplete",[x,f]),d&&!--e.active&&e.event.trigger("ajaxStop"),f.complete&&f.complete.call(f.context,x,i),X=!0,f.timeout&&clearTimeout(j),setTimeout(function(){f.iframeTarget?h.attr("src",f.iframeSrc):h.remove(),x.responseXML=null},100)}}}var u,c,f,d,m,h,v,x,y,b,T,j,w=p[0],S=e.Deferred();if(S.abort=function(e){x.abort(e)},r)for(c=0;c<g.length;c++)u=e(g[c]),o?u.prop("disabled",!1):u.removeAttr("disabled");(f=e.extend(!0,{},e.ajaxSettings,t)).context=f.context||f,m="jqFormIO"+(new Date).getTime();var k=w.ownerDocument,D=p.closest("body");if(f.iframeTarget?(b=(h=e(f.iframeTarget,k)).attr2("name"))?m=b:h.attr2("name",m):(h=e('<iframe name="'+m+'" src="'+f.iframeSrc+'" />',k)).css({position:"absolute",top:"-1000px",left:"-1000px"}),v=h[0],x={aborted:0,responseText:null,responseXML:null,status:0,statusText:"n/a",getAllResponseHeaders:function(){},getResponseHeader:function(){},setRequestHeader:function(){},abort:function(t){var r="timeout"===t?"timeout":"aborted";a("aborting upload... "+r),this.aborted=1;try{v.contentWindow.document.execCommand&&v.contentWindow.document.execCommand("Stop")}catch(e){}h.attr("src",f.iframeSrc),x.error=r,f.error&&f.error.call(f.context,x,r,t),d&&e.event.trigger("ajaxError",[x,f,r]),f.complete&&f.complete.call(f.context,x,r)}},(d=f.global)&&0==e.active++&&e.event.trigger("ajaxStart"),d&&e.event.trigger("ajaxSend",[x,f]),f.beforeSend&&!1===f.beforeSend.call(f.context,x,f))return f.global&&e.active--,S.reject(),S;if(x.aborted)return S.reject(),S;(y=w.clk)&&(b=y.name)&&!y.disabled&&(f.extraData=f.extraData||{},f.extraData[b]=y.value,"image"===y.type&&(f.extraData[b+".x"]=w.clk_x,f.extraData[b+".y"]=w.clk_y));var A=1,L=2,F=e("meta[name=csrf-token]").attr("content"),E=e("meta[name=csrf-param]").attr("content");E&&F&&(f.extraData=f.extraData||{},f.extraData[E]=F),f.forceSync?i():setTimeout(i,10);var M,O,X,C=50,q=e.parseXML||function(e,t){return window.ActiveXObject?((t=new ActiveXObject("Microsoft.XMLDOM")).async="false",t.loadXML(e)):t=(new DOMParser).parseFromString(e,"text/xml"),t&&t.documentElement&&"parsererror"!==t.documentElement.nodeName?t:null},_=e.parseJSON||function(e){return window.eval("("+e+")")},N=function(t,r,a){var n=t.getResponseHeader("content-type")||"",i=("xml"===r||!r)&&n.indexOf("xml")>=0,o=i?t.responseXML:t.responseText;return i&&"parsererror"===o.documentElement.nodeName&&e.error&&e.error("parsererror"),a&&a.dataFilter&&(o=a.dataFilter(o,r)),"string"==typeof o&&(("json"===r||!r)&&n.indexOf("json")>=0?o=_(o):("script"===r||!r)&&n.indexOf("javascript")>=0&&e.globalEval(o)),o};return S}if(!this.length)return a("ajaxSubmit: skipping submit process - no element selected"),this;var l,f,d,p=this;"function"==typeof t?t={success:t}:"string"==typeof t||!1===t&&arguments.length>0?(t={url:t,data:r,dataType:n},"function"==typeof s&&(t.success=s)):void 0===t&&(t={}),l=t.method||t.type||this.attr2("method"),(d=(d="string"==typeof(f=t.url||this.attr2("action"))?e.trim(f):"")||window.location.href||"")&&(d=(d.match(/^([^#]+)/)||[])[1]),t=e.extend(!0,{url:d,success:e.ajaxSettings.success,type:l||e.ajaxSettings.type,iframeSrc:/^https/i.test(window.location.href||"")?"javascript:false":"about:blank"},t);var m={};if(this.trigger("form-pre-serialize",[this,t,m]),m.veto)return a("ajaxSubmit: submit vetoed via form-pre-serialize trigger"),this;if(t.beforeSerialize&&!1===t.beforeSerialize(this,t))return a("ajaxSubmit: submit aborted via beforeSerialize callback"),this;var h=t.traditional;void 0===h&&(h=e.ajaxSettings.traditional);var v,g=[],x=this.formToArray(t.semantic,g,t.filtering);if(t.data){var y=e.isFunction(t.data)?t.data(x):t.data;t.extraData=y,v=e.param(y,h)}if(t.beforeSubmit&&!1===t.beforeSubmit(x,this,t))return a("ajaxSubmit: submit aborted via beforeSubmit callback"),this;if(this.trigger("form-submit-validate",[x,this,t,m]),m.veto)return a("ajaxSubmit: submit vetoed via form-submit-validate trigger"),this;var b=e.param(x,h);v&&(b=b?b+"&"+v:v),"GET"===t.type.toUpperCase()?(t.url+=(t.url.indexOf("?")>=0?"&":"?")+b,t.data=null):t.data=b;var T=[];if(t.resetForm&&T.push(function(){p.resetForm()}),t.clearForm&&T.push(function(){p.clearForm(t.includeHidden)}),!t.dataType&&t.target){var j=t.success||function(){};T.push(function(r,a,n){var i=arguments,o=t.replaceTarget?"replaceWith":"html";e(t.target)[o](r).each(function(){j.apply(this,i)})})}else t.success&&(e.isArray(t.success)?e.merge(T,t.success):T.push(t.success));if(t.success=function(e,r,a){for(var n=t.context||this,i=0,o=T.length;i<o;i++)T[i].apply(n,[e,r,a||p,p])},t.error){var w=t.error;t.error=function(e,r,a){var n=t.context||this;w.apply(n,[e,r,a,p])}}if(t.complete){var S=t.complete;t.complete=function(e,r){var a=t.context||this;S.apply(a,[e,r,p])}}var k=e("input[type=file]:enabled",this).filter(function(){return""!==e(this).val()}).length>0,D="multipart/form-data",A=p.attr("enctype")===D||p.attr("encoding")===D,L=i.fileapi&&i.formdata;a("fileAPI :"+L);var F,E=(k||A)&&!L;!1!==t.iframe&&(t.iframe||E)?t.closeKeepAlive?e.get(t.closeKeepAlive,function(){F=c(x)}):F=c(x):F=(k||A)&&L?function(r){for(var a=new FormData,n=0;n<r.length;n++)a.append(r[n].name,r[n].value);if(t.extraData){var i=u(t.extraData);for(n=0;n<i.length;n++)i[n]&&a.append(i[n][0],i[n][1])}t.data=null;var o=e.extend(!0,{},e.ajaxSettings,t,{contentType:!1,processData:!1,cache:!1,type:l||"POST"});t.uploadProgress&&(o.xhr=function(){var r=e.ajaxSettings.xhr();return r.upload&&r.upload.addEventListener("progress",function(e){var r=0,a=e.loaded||e.position,n=e.total;e.lengthComputable&&(r=Math.ceil(a/n*100)),t.uploadProgress(e,a,n,r)},!1),r}),o.data=null;var s=o.beforeSend;return o.beforeSend=function(e,r){t.formData?r.data=t.formData:r.data=a,s&&s.call(this,e,r)},e.ajax(o)}(x):e.ajax(t),p.removeData("jqxhr").data("jqxhr",F);for(var M=0;M<g.length;M++)g[M]=null;return this.trigger("form-submit-notify",[this,t]),this},e.fn.ajaxForm=function(n,i,o,s){if(("string"==typeof n||!1===n&&arguments.length>0)&&(n={url:n,data:i,dataType:o},"function"==typeof s&&(n.success=s)),n=n||{},n.delegation=n.delegation&&e.isFunction(e.fn.on),!n.delegation&&0===this.length){var u={s:this.selector,c:this.context};return!e.isReady&&u.s?(a("DOM not ready, queuing ajaxForm"),e(function(){e(u.s,u.c).ajaxForm(n)}),this):(a("terminating; zero elements found by selector"+(e.isReady?"":" (DOM not ready)")),this)}return n.delegation?(e(document).off("submit.form-plugin",this.selector,t).off("click.form-plugin",this.selector,r).on("submit.form-plugin",this.selector,n,t).on("click.form-plugin",this.selector,n,r),this):this.ajaxFormUnbind().on("submit.form-plugin",n,t).on("click.form-plugin",n,r)},e.fn.ajaxFormUnbind=function(){return this.off("submit.form-plugin click.form-plugin")},e.fn.formToArray=function(t,r,a){var n=[];if(0===this.length)return n;var o,s=this[0],u=this.attr("id"),c=t||void 0===s.elements?s.getElementsByTagName("*"):s.elements;if(c&&(c=e.makeArray(c)),u&&(t||/(Edge|Trident)\//.test(navigator.userAgent))&&(o=e(':input[form="'+u+'"]').get()).length&&(c=(c||[]).concat(o)),!c||!c.length)return n;e.isFunction(a)&&(c=e.map(c,a));var l,f,d,p,m,h,v;for(l=0,h=c.length;l<h;l++)if(m=c[l],(d=m.name)&&!m.disabled)if(t&&s.clk&&"image"===m.type)s.clk===m&&(n.push({name:d,value:e(m).val(),type:m.type}),n.push({name:d+".x",value:s.clk_x},{name:d+".y",value:s.clk_y}));else if((p=e.fieldValue(m,!0))&&p.constructor===Array)for(r&&r.push(m),f=0,v=p.length;f<v;f++)n.push({name:d,value:p[f]});else if(i.fileapi&&"file"===m.type){r&&r.push(m);var g=m.files;if(g.length)for(f=0;f<g.length;f++)n.push({name:d,value:g[f],type:m.type});else n.push({name:d,value:"",type:m.type})}else null!==p&&void 0!==p&&(r&&r.push(m),n.push({name:d,value:p,type:m.type,required:m.required}));if(!t&&s.clk){var x=e(s.clk),y=x[0];(d=y.name)&&!y.disabled&&"image"===y.type&&(n.push({name:d,value:x.val()}),n.push({name:d+".x",value:s.clk_x},{name:d+".y",value:s.clk_y}))}return n},e.fn.formSerialize=function(t){return e.param(this.formToArray(t))},e.fn.fieldSerialize=function(t){var r=[];return this.each(function(){var a=this.name;if(a){var n=e.fieldValue(this,t);if(n&&n.constructor===Array)for(var i=0,o=n.length;i<o;i++)r.push({name:a,value:n[i]});else null!==n&&void 0!==n&&r.push({name:this.name,value:n})}}),e.param(r)},e.fn.fieldValue=function(t){for(var r=[],a=0,n=this.length;a<n;a++){var i=this[a],o=e.fieldValue(i,t);null===o||void 0===o||o.constructor===Array&&!o.length||(o.constructor===Array?e.merge(r,o):r.push(o))}return r},e.fieldValue=function(t,r){var a=t.name,i=t.type,o=t.tagName.toLowerCase();if(void 0===r&&(r=!0),r&&(!a||t.disabled||"reset"===i||"button"===i||("checkbox"===i||"radio"===i)&&!t.checked||("submit"===i||"image"===i)&&t.form&&t.form.clk!==t||"select"===o&&-1===t.selectedIndex))return null;if("select"===o){var s=t.selectedIndex;if(s<0)return null;for(var u=[],c=t.options,l="select-one"===i,f=l?s+1:c.length,d=l?s:0;d<f;d++){var p=c[d];if(p.selected&&!p.disabled){var m=p.value;if(m||(m=p.attributes&&p.attributes.value&&!p.attributes.value.specified?p.text:p.value),l)return m;u.push(m)}}return u}return e(t).val().replace(n,"\r\n")},e.fn.clearForm=function(t){return this.each(function(){e("input,select,textarea",this).clearFields(t)})},e.fn.clearFields=e.fn.clearInputs=function(t){var r=/^(?:color|date|datetime|email|month|number|password|range|search|tel|text|time|url|week)$/i;return this.each(function(){var a=this.type,n=this.tagName.toLowerCase();r.test(a)||"textarea"===n?this.value="":"checkbox"===a||"radio"===a?this.checked=!1:"select"===n?this.selectedIndex=-1:"file"===a?/MSIE/.test(navigator.userAgent)?e(this).replaceWith(e(this).clone(!0)):e(this).val(""):t&&(!0===t&&/hidden/.test(a)||"string"==typeof t&&e(this).is(t))&&(this.value="")})},e.fn.resetForm=function(){return this.each(function(){var t=e(this),r=this.tagName.toLowerCase();switch(r){case"input":this.checked=this.defaultChecked;case"textarea":return this.value=this.defaultValue,!0;case"option":case"optgroup":var a=t.parents("select");return a.length&&a[0].multiple?"option"===r?this.selected=this.defaultSelected:t.find("option").resetForm():a.resetForm(),!0;case"select":return t.find("option").each(function(e){if(this.selected=this.defaultSelected,this.defaultSelected&&!t[0].multiple)return t[0].selectedIndex=e,!1}),!0;case"label":var n=e(t.attr("for")),i=t.find("input,select,textarea");return n[0]&&i.unshift(n[0]),i.resetForm(),!0;case"form":return("function"==typeof this.reset||"object"==typeof this.reset&&!this.reset.nodeType)&&this.reset(),!0;default:return t.find("form,input,label,select,textarea").resetForm(),!0}})},e.fn.enable=function(e){return void 0===e&&(e=!0),this.each(function(){this.disabled=!e})},e.fn.selected=function(t){return void 0===t&&(t=!0),this.each(function(){var r=this.type;if("checkbox"===r||"radio"===r)this.checked=t;else if("option"===this.tagName.toLowerCase()){var a=e(this).parent("select");t&&a[0]&&"select-one"===a[0].type&&a.find("option").selected(!1),this.selected=t}})},e.fn.ajaxSubmit.debug=!1});