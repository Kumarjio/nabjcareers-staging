<?xml version="1.0"?>
<rss version="2.0">
  <channel>
    <title><![CDATA[{$feed.name}]]></title>
    <link><![CDATA[{$GLOBALS.site_url}]]></link>
    <description><![CDATA[{$DESCRIPTION}]]></description>
    <language>{$GLOBALS.current_language}-us</language>
    <pubDate>{$lastBuildDate} GMT</pubDate>
  <lastBuildDate>{$lastBuildDate} GMT</lastBuildDate>
    <docs><![CDATA[{$GLOBALS.site_url}{$GLOBALS.user_page_uri}?feedId={$feed.sid}]]></docs>
    <generator>Weblog Editor 2.0</generator>
    <managingEditor>editor@example.com</managingEditor>
    <webMaster>webmaster@example.com</webMaster>
   {foreach from=$listings item=listing name=listings_block}
   	<item>
		<title><![CDATA[{$listing.Title}]]></title>
		<link>{$GLOBALS.site_url}/display-job/{$listing.id}/{$listing.Title|regex_replace:"/[\\/\\\:*?\"<>|%#$\s]/":"-"}.html</link>
		<description><![CDATA[{$listing.City}, [[$listing.State]]
		{$listing.user.CompanyName}<br/>
		{$listing.JobDescription }]]></description>
		<pubDate>{$listing.formatted_date} GMT</pubDate>
		<guid><![CDATA[{$GLOBALS.site_url}/display-job/{$listing.id}/{$listing.Title|regex_replace:"/[\\/\\\:*?\"<>|%#$\s]/":"-"}.html]]></guid>
	</item>
	{/foreach}
  </channel>
</rss>