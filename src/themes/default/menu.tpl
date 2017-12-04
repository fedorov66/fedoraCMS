{template menu data}
  {foreach $data entry}
	<li><a href="{$entry.path}" class="{if $entry.isCurrent}selected{/if}">{$entry.name}</a></li>
 
    {if $entry.children}
      {* recursive calls are allowed which makes subtemplates
       * especially good to output trees
       *}
		<ul>
		{menu $entry.children}
		</ul>
    {/if}
  {/foreach}
{/template}

{menu $menuTree ">"}