<!--
   ################################################
   Hola, veo que estas mirando el código fuente.
   ################################################
   Quieres ser parte de mi equipo?
   Discord: Miguel92#0693
   ################################################
-->
<meta name="keywords" content="{$tsKey}" />
<meta name="robots" content="index, follow">
<meta name="rating" content="public" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="publisher" content="{$tsAuthor}">
<link rel="alternate" hreflang="es-ES" href="{$tsConfig.domain}/"/>

<!-- apple mobile -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="{$tsColor}">
<meta name="theme-color" content="{$tsColor}">
<link rel="apple-touch-icon" href="{$tsImagen}">

<!-- google -->
<meta name="description" content="{$tsSeoDescripcion|NoHtmlTrim}" />
<meta name="author" content="{$tsAuthor}" />

<!-- Primary Meta Tags -->
<meta name="title" content="{$tsTitle}">
<meta name="description" content="{$tsSeoDescripcion|NoHtmlTrim}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{$tsUrl}">
<meta property="og:title" content="{$tsTitle}">
<meta property="og:description" content="{$tsSeoDescripcion|NoHtmlTrim}">
<meta property="og:image" content="{$tsImagen}">
<meta property="og:locale" content="{$Lenguaje}">
<meta property="og:site_name" content="{$tsTitle}">
<meta property="article:published_time" content="{$tsPublished}">
<meta property="article:author" content="{$tsAuthor}">
<meta property="article:section" content="website">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{$tsUrl}">
<meta property="twitter:title" content="{$tsTitle}">
<meta property="twitter:description" content="{$tsSeoDescripcion|NoHtmlTrim}">
<meta property="twitter:image" content="{$tsImagen}">
<meta name="twitter:image:alt" content="{$tsTitle}">

<!-- job -->
<meta name="job:site" content="{$jobSite}">
<link rel="canonical" href="{$canonical}" />

<!-- Api y User -->
{if $AppFb != ''}
<meta property="fb:app_id" content="{$AppFb}">
{/if}{if $TwUser != ''}
<meta name="twitter:site" content="{$TwUser}">
{/if}
