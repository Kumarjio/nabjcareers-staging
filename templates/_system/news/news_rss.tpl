<?xml version="1.0" encoding="utf-8" ?>
	<rss version="2.0">
		<channel>
		    <title>Asiamediajobs news feed</title>
		    <link><![CDATA[{$GLOBALS.site_url}]]></link>
		    <description><![CDATA[{$DESCRIPTION}]]></description>
		    <language>{$GLOBALS.current_language}-us</language>
		    <pubDate>{$lastBuildDate} GMT</pubDate>
		  <lastBuildDate>{$lastBuildDate} GMT</lastBuildDate>
		    <docs><![CDATA[{$GLOBALS.site_url}{$GLOBALS.user_page_uri}?feedId={$feed.sid}]]></docs>
		    <generator>Weblog Editor 2.0</generator>
		    <managingEditor>editor@example.com</managingEditor>
		    <webMaster>webmaster@example.com</webMaster>
			
			{foreach from=$articles item=item name=listings_block}
			   	<item>
					<title><![CDATA[{$item.title}]]></title>
					<description><![CDATA[{$item.brief}]]></description>
					<pubDate><![CDATA[{$item.date}]]></pubDate>
					<source><![CDATA[{$item.link}]]></source>
					
			   		<link><![CDATA[{$GLOBALS.site_url}/news/{$item.sid}/{$item.title|regex_replace:"/[\\/\\\:*?\"<>|%#$\s]/":"-"}.html]]></link>
								
				</item>
			{/foreach}
		</channel>
	</rss>