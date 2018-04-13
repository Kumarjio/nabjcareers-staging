{if $errors}
	{foreach from=$errors item=error key=error_code}
		<p class="error">{$error_code}</p>
	{/foreach}
{else}
{title}{$article.title}{/title}
{description}{$article.brief|strip_tags}{/description}
	<div class="NewsItems">
		<h2>{$article.title}</h2>
		<small>posted: {$article.date}</small> 
		<div class="newsPreview">
			{* if $article.image}<img src="{$article.image_link}" align="left" vspace="10" hspace="10">{/if *}
			
			
			{if $article.text}{$article.text}{else}
			{$article.brief}{/if}
			<br /><br />
			<a href="{$article.link}" target="_blank">Read full text</a> 		
			<br /><br />
		</div>
	</div>
{/if}

{if $GLOBALS.plugins.ShareThisPlugin.active == 1 && $GLOBALS.settings.display_on_news_page == 1}
	{$GLOBALS.settings.header_code}
	{$GLOBALS.settings.code}
{/if}
<div class="clr"><br/></div>
<a href="{$GLOBALS.site_url}/news-rss/" id="newsRss">RSS</a>&nbsp;<strong><a href="{$GLOBALS.site_url}/all-news/">[[View All News]]</a></strong>