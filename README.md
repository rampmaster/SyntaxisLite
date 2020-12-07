# Syntaxis Lite (BETA)

> Al ser la versión beta no contendrá el instalador, es más la pueden usar en un sitio que ya tengan instalado, solo deberán reemplazar todo y agregar lo que contiene el archivo install_sql.sql

Esta es una actualización del risus 1.2 a risus 1.3, en cuanto se lance la seguna versión de New Risus se realizará otra actualización con las funciones de new risus para que sea mucho más compatibles y de esta forma se eliminará la sección de administración y moderación que trae este theme.

## Actualizador:
 * Se agregan las consultas necesarias

## Core:
 * Mejor soporte a [http/https](https://github.com/isidromlc/PHPost/issues/10#issue-568723224).
 * Arreglo del redireccionamiento en la [función setLevel()](https://github.com/isidromlc/PHPost/issues/15#issue-568745572).
 * Se agregó función para comprobar si tiene o no protocolo SSL (https).
 * Se mejoró el manejó de la [función currentUrl()](https://github.com/isidromlc/PHPost/issues/16#issue-568747029).
 * Se actualizó la función setJSON.
 * Se eliminaron las funciones koxEncode y koxDecode.

## Theme:
 * Se realizo cambios en el Modal
 * Se quitarón algunos plugins
 * Se utiliza funciones nativas de javascript
 * Se simplificó el registro
 * Se separaron algunas funciones de acciones.js y funciones.js
 * Se elimino funciones.js

## Extras:
 * Se ha agregado un archivo de ajustes
 * Redireccionamiento de http => https
 * Redireccionamiento sin(www)

Para esto deben ir a **.htaccess** y editar las 3 líneas que estan debajo de `RewriteEngine On` y le borran el hash que y en donde dice: "**_TU-SITIO-WEB_**" le agregan el de ustedes obviamente que si no termina en **.com** lo deben cambiar por su dominio

### PHP = 7.4.x
### Smarty = 3.1.34
### jQuery = 3.5.1

> El archivo ajustes.php contiene algunas configuraciones para el sitio 

Luego de instalar deben agregar las consultas que estan en el archivo **install_sql.sql**

---

# Syntaxis Lite es una versión bastante mejorada

### Cuenta con:
 * [Licencia Creative Commons "BY-NC-SA"](https://creativecommons.org/licenses/by-nc-sa/4.0/deed.es)
 * Buscar de forma mas "**completa**" ya que se puede buscar posts, tags, usuarios y fotos
 * Buscar al instante cualquier post! _(Sin filtros por ahora)_
 * Se puede subir archivos
 * Se puede cambiar el avatar rápidamente y usandolo con la extensión "**webp**"
 * Se puede usar portada en el perfil
 * Tiene un generador de post en el caso que quieras realizar un post sobre peliculas o juegos
 * Se adapta a dispositivos moviles _(solo con css, muy básico)_
 * Se puede compartir con facebook, twitter y tus seguidores
 * Se puede buscar usuarios _(independiente del buscador original)_
 * Se puede cambiar el header del sitio _(no administrable)_
 * Login da saludo dependiendo la hora!
 * Portadas automáticas o agregada por el usuario para posts
 * Reemplazo de imagen rota por una del sitio predefinida
 * Notificación si comentan en tu archivo
 * Menciones en los comentarios
 * Instalación automática de themes
 * Limpieza automática del caché
 * Noticias de manera global
 * Especial para SEO
 * Página que explica como cambiar la portada de su perfil
 * Hay 6 formas para usar la url para el posts _(Aun no esta aplicada, pero funciona)_

### ADMINISTRACIÓN ESPECIAL
 * SEO **https://TU-SITIO-WEB.com/page/settings**
 * Header **https://TU-SITIO-WEB.com/page/settings**

> Esto se guardará en un archivo .json, y no se guardará en la base de datos. Por defecto habrá info como ejemplo

### BETA:
 * Un tour en el perfil
 * Se puede cambiar el avatar desde el perfil sin acceder a "**Editar cuenta**"
 * Inicio de sesión dependiendo del dispositivo

## EN CURSO:
 * Sistema de configuración del sitio
 * ~Sistema de puntuación de 1 a 5 estrellas en post~ (Debo quitarlo)
 * Sistema de votos con emociones (Debo aplicarlo)

### Próximamente
 * Configurar colores para el sitio
 * Configurar el header para cualquier usuario
 * Sistema de contacto
 * Avatar con Gravatar
 * Modo dark / oscuro ()
 * Diseño solo para dispositivos moviles