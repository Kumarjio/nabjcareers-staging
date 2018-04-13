{if $GLOBALS.current_user.group.id == "Employer"}
	<h1>Preview Job</h1>
	{if $previous_page != "edit_job"}
		<p>Please review your job posting. <br />If you find an error, click on the 
		<b>"Edit this Job"</b> button below and make any necessary changes. When finished, please click the 
		<b>"Activate Jobs"</b> button below to proceed to the payment screen. </p>
	{/if}
	{if $waitApprove == 1}	
		<p>Your {$listing.type.id|strtolower} posting is successfully created and waiting for approval</p>
	{/if}

	{if $errors == null}
	
		{if $previous_page == "edit_job"}
			{if $listing.type.id eq "Job"}
				{assign var='link' value='my-job-details'}
			{/if}		
			<p>
				<a class="twoabuttons" href="{$GLOBALS.site_url}/my-listings/">[[Finished]]</a>
				<a class="twoabuttons" href="{$GLOBALS.site_url}/edit-listing/?listing_id={$listing.id}">[[Edit Job]]</a>
			</p>
		<div class="clear"></div>	
			<p class="message">[[Your job has successfully been updated]]</p>
			
			<p>Please review your job update below. <br />If you find an error please edit this posting 
			by clicking on the 'Edit Job' button.</p>
			<p>[<a class="orange" href="{$GLOBALS.site_url}/my-listings/">Click here to manage your jobs</a>]</p>
				<!--- LISTING INFO BLOCK --->
				<div>
					<div class=""><strong>[[FormFieldCaptions!Job Category]]: </strong>{$listing.JobCategory}</div>
					
					<div class=""><strong>[[FormFieldCaptions!Title]]: </strong>{$listing.Title}</div>
					
					
					<div class=""><strong>[[FormFieldCaptions!Job Reference]]: </strong>[[$listing.id]]</div>
					
					{if $listing.JobDescription}
						<div class=""><strong>[[FormFieldCaptions!Job Description]]: </strong>
						{$listing.JobDescription}</div>
						<div class="clr"></div>
					{/if}
					
					{if !$listing.company_name}
						{if $listing.JobRequirements}
							<div class=""><strong>[[FormFieldCaptions!Job Requirements]]: </strong> 
							{$listing.JobRequirements}</div>
							<div class="clr"></div>
						{/if}
					{/if}
					
					{if !$listing.company_name}
						{if $listing.Occupations}
							<div class=""><strong>[[Occupations]]: </strong> 
							{$listing.Occupations}</div>
							<div class="clr"><br/></div>
						{/if}
					{/if}
					
					<div class=""><strong>[[FormFieldCaptions!Location]]: </strong> 
						{if $listing.City}{$listing.City}, {/if}
						{if $listing.State !='Outside The US (No State)'}[[$listing.State]], {/if}
						[[Property_Country!{$listing.Country}]]
					</div>
					<div class=""><strong>[[FormFieldCaptions!Zip Code]]: </strong>{$listing.ZipCode}</div>				
					<div class=""><strong>[[FormFieldCaptions!Employment Type]]: </strong>{$listing.EmploymentType}</div>
					<div class=""><strong>[[FormFieldCaptions!Salary]]: </strong>{$listing.Salary.value} [[$listing.SalaryType]]</div>
					<div class=""><strong>[[FormFieldCaptions!Posted]]: </strong>[[$listing.activation_date]]</div>
					<div class="clr"><br/></div>
				</div>
				<!--- END LISTING INFO BLOCK --->
			<div class="clr"><br/></div>
			<p>[<a class="orange" href="{$GLOBALS.site_url}/my-listings/">Click here to manage your jobs</a>]</p>
		{else}
		
			{if $listing.type.id eq "Job"}
				{assign var='link' value='my-job-details'}
			{elseif $listing.type.id eq 'Resume'}
				{assign var='link' value='my-resume-details'}
			{/if}
			
			<a class="abutton" href="{$GLOBALS.site_url}/add-listing/?listing_type_id=Job">[[Add another job]]</a>
			<a class="abutton" href="{$GLOBALS.site_url}/edit-job-preview/?listing_id={$listing.id}"> [[Edit Listing]]</a>
			{if $listing.type.id eq "Job" && !$listing.active}
				<a class="abutton" href="{$GLOBALS.site_url}/new-listings-activate/?action_activate=1&listings[{$listing.id}]=1&new_listings=1&new_listing={$listing.id}"> [[Activate Jobs]]</a>
			{/if}
			
			{if $listing.type.id eq "Job"}
				<p>
					<iframe src="{$GLOBALS.site_url}/manage-job/?listing_id={$listing.id}" style="border: 0; height: 300px; width: 100%;">
					</iframe>
				</p>
				<script type="text/javascript">
					{literal}document.getElementById("listingsResults").style.marginRight = "-8px";	{/literal}	
				</script>
			{/if}
		{/if}		
	{else}	
		{foreach from=$errors key=error item=error_message}
			{if $error == 'PARAMETERS_MISSED'}
				<p class="error">[[The key parameters are not specified]]</p>
			{elseif $error == 'WRONG_PARAMETERS_SPECIFIED'}	
				<p class="error">[[Wrong parameters are specified]]</p>
			{elseif $error == 'NOT_OWNER'}
				<p class="error">[[You are not owner of this listing]]</p>
			{elseif $error == 'NOT_LOGGED_IN'}
				{assign var="url" value=$GLOBALS.site_url|cat:"/registration/"}
				<p class="error">[[Please log in to access this page. If you do not have an account, please]] <a href="{$url}">[[Register]]</a></p>
				<br/><br/>	
				{module name="users" function="login"}
			{/if}
		{/foreach}
	{/if}
{/if}



{if $listing.type.id eq 'Resume'}

	<h1>Preview Resume</h1>

	<p>Please review your resume posting. <br />If you find an error, click on the <b>"Edit Resume"</b> 
	button below and make any necessary changes. When finished, please click the <b>"Activate Resume"</b> 
	button below to proceed to the payment screen. </p>
	
	{if $waitApprove == 1}
		<p>Your {$listing.type.id|strtolower} posting is successfully created and waiting for approval</p>
	{/if}

	{if $errors == null}
		{if $listing.type.id eq "Job"}	
			{assign var='link' value='my-job-details'}
		{elseif $listing.type.id eq 'Resume'}	
			{assign var='link' value='my-resume-details'}
		{/if}

		<a class="resbutton" style="margin: 0 160px;" href="{$GLOBALS.site_url}/edit-listing/?listing_id={$listing.id}"> [[Edit Resume]]</a>
		<a class="resbutton" style="margin: 0 160px;" href="{$GLOBALS.site_url}/my-account/?page=1"> [[Activate Resume]]</a>
		
			<div class="clr"><br></div>
				<p><iframe src="{$GLOBALS.site_url}/manage-resume/?listing_id={$listing.id}" style="border: 0; height: 300px; width: 100%;"></iframe></p>
				
			<script type="text/javascript">		
				{literal}	document.getElementById("listingsResults").style.marginRight = "-8px";{/literal}	
			</script>						
	{else}	
		
		{foreach from=$errors key=error item=error_message}
				{if $error == 'PARAMETERS_MISSED'}
						<p class="error">[[The key parameters are not specified]]</p>
				{elseif $error == 'WRONG_PARAMETERS_SPECIFIED'}
						<p class="error">[[Wrong parameters are specified]]</p>
				{elseif $error == 'NOT_OWNER'}
						<p class="error">[[You are not owner of this listing]]</p>
				{elseif $error == 'NOT_LOGGED_IN'}
					{assign var="url" value=$GLOBALS.site_url|cat:"/registration/"}		
					<p class="error">[[Please log in to access this page. If you do not have an account, please]]
					 <a href="{$url}">[[Register]]</a></p>		
					 <br/><br/>		
					{module name="users" function="login"}		
				{/if}	
		{/foreach}
		
	{/if}
{/if}
	
