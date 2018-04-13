{foreach from=$content item=item}
	<div class="blogAuthor"></div>
	<div class="blogPost">
		<a href="{$item.link}" class="blogLink">{$item.title}</a>
		<span class="blogDate">{$item.date}</span>
		<div class="clr"></div>
		{$item.description}
	</div>
	<div class="blogBottom"></div>
	<div class="clr"><br/></div>
{foreachelse}
	<br/><center>[[There are no blog posts in the system.]]</center><br/>
{/foreach}