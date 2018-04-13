<?xml version="1.0" encoding="utf-8"?>
<source>
<publisher>SmartJobBoard</publisher>
<publisherurl><![CDATA[{$GLOBALS.site_url}]]></publisherurl>
<lastBuildDate>{$lastBuildDate}</lastBuildDate>
{foreach from=$listings item=listing}
<job>
<title><![CDATA[{$listing.Title}]]></title>
<date><![CDATA[{$listing.activation_date}]]></date>
<referencenumber><![CDATA[{$listing.id}]]></referencenumber>
<url><![CDATA[{$listing.listing_url}]]></url>
<company><![CDATA[{$listing.user.CompanyName}]]></company>
<city><![CDATA[{$listing.City}]]></city>
<state><![CDATA[{$listing.State}]]></state>
<country><![CDATA[{$listing.Country}]]></country>
<postalcode><![CDATA[{$listing.ZipCode}]]></postalcode>
<description><![CDATA[{$listing.JobDescription|strip_tags:false} {$listing.JobRequirements|strip_tags:false}]]></description>
<salary><![CDATA[{$listing.Salary} {$listing.SalaryType}]]></salary>
<education><![CDATA[]]></education>
<jobtype><![CDATA[{$listing.EmploymentType}]]></jobtype>
<category><![CDATA[{$listing.JobCategory}]]></category>
<experience><![CDATA[{$listing.JobExpirience}]]></experience>
</job>
{/foreach}
</source>