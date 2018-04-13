{if !empty($articles)}
	<div id="news">
		<input type="hidden" name="news_count" id="news_count" value="{$news_count}">
		<ul>
			{foreach from=$articles item=elem name=news_block}
				<li>
					{*
						{if $elem.image}
							<img src="{$elem.image_link}" width="80" align="left" vspace="3" hspace="3">
						{/if}
					*}
					<small>{$elem.date}</small><br/>
					{* if $elem.link}
						<a href="{$elem.link}" target="_blank" class="newsLink">{$elem.title}</a>
					{else *}
						<a href="{$GLOBALS.site_url}/news/{$elem.sid}/{$elem.title|regex_replace:"/[\\/\\\:*?\"<>|%#$\s]/":"-"}.html" class="newsLink">{$elem.title}</a>
					{* /if *}
					<br/>{$elem.brief}
				</li>
			{foreachelse}
				<li><center>[[There is no news in the system.]]</center></li>	
			{/foreach}
		</ul>
		<a href="{$GLOBALS.site_url}/all-news/" class="smallLink">[[View All News]]</a>
	</div>
{/if}