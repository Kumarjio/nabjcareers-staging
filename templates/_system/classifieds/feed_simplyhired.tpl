<?xml version="1.0" encoding="utf-8"?>
<jobs>
{foreach from=$listings item=listing}
<job>
	<title><![CDATA[{$listing.Title}]]></title>
	<job-code>{$listing.id}</job-code>
	<action/>
	<job-board-name>SmartJobBoard</job-board-name>
	<job-board-url><![CDATA[{$GLOBALS.site_url}]]></job-board-url>
	<detail-url><![CDATA[{$listing.listing_url}]]></detail-url>
	<apply-url/>
	<job-category><![CDATA[{$listing.JobCategory}]]></job-category>

	<description>
		<summary><![CDATA[{$listing.JobDescription|strip_tags:false}]]></summary>
		<required-skills><![CDATA[{$listing.JobRequirements|strip_tags:false}]]></required-skills>
		<required-education/>
		<required-experience/>
		
		<full-time><![CDATA[{$listing.myEmploymentType.Fulltime}]]></full-time>
		<part-time><![CDATA[{$listing.myEmploymentType.Parttime}]]></part-time>
		<flex-time/>
		<internship><![CDATA[{$listing.myEmploymentType.Intern}]]></internship>
		<volunteer/>
		<exempt/>
		<contract><![CDATA[{$listing.myEmploymentType.Contractor}]]></contract>
		<permanent/>
		<temporary><![CDATA[{$listing.myEmploymentType.Seasonal}]]></temporary>
		<telecommute/>
	</description>

	<compensation>
		<salary-range/>
		<salary-amount><![CDATA[{$listing.Salary} {$listing.SalaryType}]]></salary-amount>
		<salary-currency></salary-currency>
		<benefits/>
	</compensation>

	<posted-date>{$listing.activation_date}</posted-date>
	<close-date>{$listing.expiration_date}</close-date>

	<location>
		<address><![CDATA[{$listing.Address}]]></address>
		<city><![CDATA[{$listing.City}]]></city>
		<state><![CDATA[{$listing.State}]]></state>
		<zip><![CDATA[{$listing.ZipCode}]]></zip>
		<country><![CDATA[{$listing.Country}]]></country>
		<area-code/>
	</location>

	<contact>
		<name><![CDATA[{$listing.user.ContactName}]]></name>
		<email>{$listing.user.email}</email>
		<hiring-manager-name/>
		<hiring-manager-email/>
		<phone>{$listing.user.PhoneNumber}</phone>
		<fax/>
	</contact>

	<company>
		<name><![CDATA[{$listing.user.CompanyName}]]></name>
		<description><![CDATA[{$listing.user.CompanyDescription|strip_tags:false}]]></description>
		<industry/>
		<url><![CDATA[{$listing.user.WebSite}]]></url>
	</company>
</job>
{/foreach}
</jobs>