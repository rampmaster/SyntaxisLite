		<!--end-cuerpo-->
</div>
{if $tsMobile}
   {include "sections/footer_menu_mobile.tpl"}
{/if}
<footer class="pb-4 pt-2">
   <div class="container">
      <div class="row columnas">
         <div class="col-6">
            <h3 class="m-0 p-2 mt-3 mb-2">Sobre nosotros!</h3>
            <p class="position-relative py-3 pr-2 font-weight-bold">
               <img src="{$tsImagen}" alt="{$tsConfig.titulo}" class="float-left mr-3 img-fit-cover">
               {$tsFooterDes}
            </p>
         </div>
         <div class="col-3">
            <h3 class="m-0 p-2 mt-3 mb-2">Información</h3>
            <ul class="list-unstyled">
               <li><a class="text-dark font-weight-bold" href="{$tsConfig.url}/pages/protocolo/">Protocolo</a></li>
               <li><a class="text-dark font-weight-bold" href="{$tsConfig.url}/pages/dmca/">Report Abuse - DMCA</a></li>
               <li><a class="text-dark font-weight-bold" href="{$tsConfig.url}/pages/portada/">¿Como cambiar portada/header?</a></li>
            </ul>
         </div>
         <div class="col-3">
            <h3 class="m-0 p-2 mt-3 mb-2">Más enlaces</h3>
            <ul class="list-unstyled">
               {if $tsUser->is_admod}
               <li><a class="text-dark font-weight-bold" href="{$tsConfig.url}/pages/settings/">Configurar sitio</a></li>
               {/if}
               <li><a class="text-dark font-weight-bold" href="{$tsConfig.url}/cuenta/">Configurar mi cuenta</a></li>
            </ul>
         </div>
      </div>
      <hr>
      <div class="footdown d-flex justify-content-between align-items-center">
         <div class="list-footer-down">
            <a href="{$tsConfig.url}/pages/terminos-y-condiciones/">T&eacute;rminos & condiciones</a> &bull; 
            <a href="{$tsConfig.url}/pages/privacidad/">Privacidad de datos</a> &bull; 
            <a href="{$tsConfig.url}/sitemap.xml">Sitemap</a>
            <small class="font-italic d-block">Theme creado por <a class="font-weight-bold text-info" href="https://newrisus.com/perfil/Miguel92">Miguel92</a></small>
         </div>
         <div class="d-flex justify-content-center align-items-end flex-column">
            <span><strong>{$tsConfig.titulo}</strong> © {$smarty.now|date_format:"%Y"}.</span>
            <div class="footer__top-link">
               <small>Powered by <a href="https://www.phpost.net/foro/" class="text-info" target="_blank"><strong>PHPost</strong></a> & <a href="https://newrisus.com/" class="text-info" target="_blank"><strong>New Risus</strong></a></small>
            </div>
         </div>
      </div>
   </div>
</footer>

{if !$tsUser->is_member}
<script src="{$tsConfig.js}/login.js?{$smarty.now}"></script>
<script src="https://www.google.com/recaptcha/api.js?render={$tsKeyPbulic}"></script>
<script src="{$tsConfig.js}/registro.js?{$smarty.now}"></script>
{/if}
<script src="{$tsConfig.js}/feathericons.min.js?{$smarty.now}"></script>
<script src="{$tsConfig.js}/script.js?{$smarty.now}"></script>
{if $tsUser->is_admod && $tsConfig.c_see_mod && $tsConfig.novemods.total}
<div id="stickymsg" class="position-fixed bottom-5 right-2 shadow-3 rounded p-2 bg-danger text-white"  data-url="{$tsConfig.url}/moderacion/">Hay {$tsConfig.novemods.total} contenido{if $tsConfig.novemods.total != 1}s{/if} esperando revisi&oacute;n</div>
{/if}
{if $tsUser->is_admod == '1'}{if $tsConfig.cambiodenicks.total}
<div id="stickymsg" class="position-fixed bottom-1 right-2 shadow-3 rounded p-2 bg-dark text-white" data-url="{$tsConfig.url}/admin/nicks/">Hay {$tsConfig.cambiodenicks.total} usuario{if $tsConfig.cambiodenicks.total != 1}s{/if} esperando la aprobación del nick!</div>
{/if}{/if}
</body>
</html>