{title} {$listing.Title} {/title}
{keywords} {$listing.Title} {/keywords}
{description} {$listing.Title} {/description}
<div class="printPage">
	<div class="printLeft">
		<strong><u>[[Company Info]]</u></strong> <br/><br/>
		{if $listing.user.Logo.file_url}
			<br/><img src="{$listing.user.Logo.file_url}" alt="" />
		{/if}
		<br/><br/>
		<strong>{$listing.user.CompanyName}</strong><br/>
		{$listing.user.Address} <br/>
		{if $listing.user.City}{$listing.user.City}, {/if}[[$listing.user.State]] {if $listing.user.Country}([[$listing.user.Country]]){/if}<br/>
		<strong>[[FormFieldCaptions!Phone]]</strong>:{$listing.user.PhoneNumber} <br />
		<strong>[[FormFieldCaptions!Web]]</strong>:{$listing.user.WebSite} <br/>
	</div>
	<div class="printRight">
		<h1>{$listing.Title}</h1>
		<strong>[[Location]]:</strong> {$listing.City}, [[$listing.State]]<br/>		
		<strong>[[FormFieldCaptions!Job Category]]:</strong> [[$listing.JobCategory]]<br/>
		<strong>[[FormFieldCaptions!Job ID]]</strong>: [[$listing.id]] <br/>
		<strong>[[FormFieldCaptions!Employment Type]]:</strong> [[$listing.EmploymentType]]<br/>
		<strong>[[FormFieldCaptions!Salary]]:</strong>[[$listing.Salary]] [[$listing.SalaryType]] <br/>
		<strong>[[FormFieldCaptions!Posted]]:</strong> [[$listing.activation_date]]<br/>
		<br/><hr><br/>
		<h2>[[FormFieldCaptions!Occupations]]:</h2>
		{$listing.Occupations}<br/>
		
		<h2>[[FormFieldCaptions!Job Description]]:</h2>
		{$listing.JobDescription}<br/>
		
		<h2>[[FormFieldCaptions!Job Requirements]]:</h2>
		{$listing.JobRequirements}<br/>
	</div>
</div>