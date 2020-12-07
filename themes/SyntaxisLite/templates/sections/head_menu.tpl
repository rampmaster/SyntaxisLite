{if !$tsMobile}  
   <nav class="position-sticky navbar-pill w-100">
      <ul class="{if !$tsMobile}container {/if}nav d-flex justify-content-start align-items-center position-relative">
         {if $tsConfig.c_allow_portal && $tsUser->is_member == true}
            <li class="nav-item{if $tsPage == 'mi'} active{/if}">
               <a title="Ir a Inicio" href="{$tsConfig.url}/mi/"><span>Portal</span> <i feather="home"></i></a>
            </li>
         {/if}
         <li class="nav-item{if $tsPage == 'posts' || $tsPage == 'home'} active{/if}">
            <a title="Ir a Posts" href="{$tsConfig.url}/posts/"><span>Posts</span>  <i feather="file-text"></i></a>
         </li>   
         {if $tsConfig.c_fotos_private == '1' && !$tsUser->is_member}{else}                      
            <li class="nav-item {if $tsPage == 'fotos'}active{/if}">
               <a title="Ir a Fotos" href="{$tsConfig.url}/fotos/"><span>Fotos</span> <i feather="camera"></i></a>
            </li>                        
         {/if}
         <li class="nav-item{if $tsPage == 'tops'} active{/if}">
            <a title="Ir a TOPs" href="{$tsConfig.url}/top/"><span>TOPs</span> <i feather="trending-up"></i></a>
         </li>
         <li class="nav-item{if $tsPage == 'files'} active{/if}">
            <a title="Ir a Archivos" href="{$tsConfig.url}/files/"><span>Archivos</span> <i feather="archive"></i></a>
         </li>
         {if $tsUser->is_member}
            {if $tsUser->is_admod == 1}
               <li class="nav-item{if $tsPage == 'admin'} active{/if}">
                  <a title="Panel de Administrador" href="{$tsConfig.url}/admin/"><span>Administraci&oacute;n</span> <i feather="sliders"></i></a>
               </li>
            {/if}
         {else}
            <li class="nav-item">
               <a alt="Iniciar sesión" class="text-info font-weight-bold" href="javascript:open_login_box()">Acceder</a>
            </li>
            <li class="nav-item">
               <a alt="Crear mi cuenta" class="text-success font-weight-bold" href="javascript:registro_load_form()">Registrate!</a>
            </li>
         {/if}
         {if !$tsMobile}
            <li class="nav-search position-absolute d-flex justify-content-center align-items-center">
               <input type="text" name="q" placeholder="Buscar..." class="form-input closed">
               <span><a class="d-flex justify-content-center align-items-center" title="Buscar" href="javascript:buscar_en_web(3)"><i feather="search"></i></a></span>
            </li>
         {else}
            <li class="nav-item">
               <a title="Buscar" href="javascript:buscar_en_web(1)"><i feather="search"></i></a>
            </li>
         {/if}
         <div id="results"></div>
      </ul>
   </nav>
   {include file='sections/head_submenu.tpl'}
{/if}

{if !$tsUser->is_member}
<div class="backLogin backdrop-blur-x3" style="display:none;">
   <div class="login_box bg-white shadow rounded overflow-hidden position-relative">
      {if !$tsMobile}
      <div class="lader position-relative d-flex justify-content-center align-items-center saludo-{$tsLader}">
         <h3>{$tsMessage}</h3>
         <div class="position-absolute mx-auto bottom-5 right-3 left-0 w-25" style="display:none;" id="loading">
            <div class="loading loading-lg success"></div>
         </div>
      </div>
      {/if}
      <div class="offset-content">
         <a href="javascript:close_login_box()" data-close><i feather="x-circle"></i></a>
         <div class="login_cuerpo">
            <div id="login_error" class="alert alert-danger position-absolute" style="display: none;"></div>
            <form action="javascript:login_ajax()" method="post">
               <div class="form-group">
                  <label class="form-label" for="nickname">Usuario</label>
                  <input class="form-input" type="text" id="nickname" name="nick" maxlength="64" placeholder="Nick">
               </div>
               <div class="form-group">
                  <label class="form-label" for="password">Contraseña</label>
                  <input class="form-input" type="password" id="password" name="pass" maxlength="64" placeholder="Contraseña">
               </div>
               <div class="form-group">
                  <label class="form-checkbox cb-success" for="rem">
                     <input type="checkbox" id="rem" name="rem" value="true" checked="checked">
                     <i class="form-icon"></i> Recordar usuario
                  </label>
               </div>
               <input type="submit" value="Iniciar sesión" class="btn btn-login btn-gradient-three mr-2">
               <a href="javascript:registro_load_form()" class="btn btn-gradient-seven mr-2">Crear cuenta</a>
            </form>
         </div>
         <div class="d-flex justify-content-around align-items-center py-2">
            <a class="text-info" href="javascript:remind_password()">&#191;Olvidaste tu contrase&#241;a?</a>
         </div>
      </div>
   </div>
</div>
{/if}