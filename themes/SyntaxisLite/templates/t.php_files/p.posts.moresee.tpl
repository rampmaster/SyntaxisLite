{if $tsMoreSeeComment}
   <ul class="list-unstyled">
      {foreach from=$tsMoreSeeComment item=p}
         <li>
            <img class="rounded shadow" src="{if $p.post_portada}{$p.post_portada}{elseif $p.post_cover}{$p.post_cover}{/if}"/>
				<a href="{$tsConfig.url}/posts/{$p.c_seo}/{$p.post_id}/{$p.post_title|seo}.html">
               {$p.post_title|truncate:32}
            </a>
			</li>
      {/foreach}
   </ul>
{else}
   <div class="alert alert-warning text-center">No se encontraron posts relacionados.</div>
{/if}