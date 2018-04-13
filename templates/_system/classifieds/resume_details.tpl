{title} {$listing.Title} {/title}
{keywords} {$listing.Title} {/keywords}
{description} {$listing.Title} {/description}
<div class="printPage">
	<div class="printLeft">
		<strong><u>[[User Info]]</u></strong> <br/><br/>
		{if $listing.anonymous != 1 || $applications.anonymous === 0 }
			{foreach from=$listing.pictures key=key item=picture name=picimages }
					<br/><a target="_blank" href ="{$picture.picture_url}"> <img src="{$picture.thumbnail_url}" border="0" title="{$picture.caption}" alt="{$picture.caption}" /> </a>
			{/foreach}
			<br/><br/>
			<strong>{$listing.user.FirstName} {$listing.user.LastName}</strong><br />
			{$listing.user.Address}<br />
			{if $listing.user.City}{$listing.user.City}, {/if}<strong>[[$listing.user.State]]</strong> {if $listing.user.Country}([[$listing.user.Country]]){/if}<br />
			<strong>[[FormFieldCaptions!Phone]]</strong>:{$listing.user.PhoneNumber}<br />
			<strong>[[FormFieldCaptions!Email]]</strong>:{$listing.user.email}
		{else}
			<tr><td><strong>[[Anonymous User Info]]</strong></td></tr>
		{/if}
	</div>
	<div class="printRight">
		<h1>{$listing.Title}</h1>
		<strong>[[FormFieldCaptions!Resumes ID]]</strong>: [[$listing.id]]<br />
		<strong>[[Location]]:</strong> {$listing.City}, [[$listing.State]]<br />
		<strong>[[FormFieldCaptions!Posted]]:</strong> [[$listing.activation_date]]<br />
		<br/><hr><br/>
		<h2>[[FormFieldCaptions!Objective]]:</h2>
		{$listing.Objective}<br />
		
		<h2>[[FormFieldCaptions!Work Experience]]:</h2>
		{display property='WorkExperience'}<br />
		
		<h2>[[FormFieldCaptions!Total Years Experience]]:</h2>
		{$listing.TotalYearsExperience} years<br />
		
		<h2>[[FormFieldCaptions!Education]]:</h2>
		{display property='Education'}<br />
		
		<h2>[[FormFieldCaptions!Skills]]:</h2>
		{$listing.Skills}<br />
		
		<h2>[[FormFieldCaptions!Occupations]]:</h2>
		{$listing.Occupations}<br />
		
		<h2>[[FormFieldCaptions!Desired Salary]]:</h2>
		[[$listing.DesiredSalary]] [[$listing.DesiredSalaryType]]<br />
	</div>
</div>