{breadcrumbs}Users{/breadcrumbs}
<h1>Manage {$page_title}s</h1>
<p><a href="{$GLOBALS.site_url}/add-user/?user_group_id={$user_group_name}">Add a New {$page_title}</a></p>

<div class="setting_button" id="mediumButton"><strong>Click to modify search criteria</strong><div class="setting_icon"><div id="accordeonClosed"></div></div></div>
<div class="setting_block" style="display: none"  id="clearTable">
	<form method="get" name="search_form">
		<table  width="100%">
			<tr><td>User ID:</td><td>{search property="sid"}</td></tr>
			<tr><td>Username:</td><td>{search property="username" template="string.like.tpl"}</td></tr>
            
             {if $user_group_name == 'Employer'}
             <tr><td>Company Name:</td><td><input type="text" name="CompanyName" value="{$CompanyName}"/></td></tr>
             {else}
             <tr><td>Last Name:</td><td><input type="text" name="LastName" value="{$LastName}"/></td></tr>
             {/if}
             
           			{* search by First Name 21-05-2017 *}
             <tr><td>First Name:</td><td><input type="text" name="FirstName" value="{$FirstName}"/></td></tr>
					{* END 21-05-2017*}
 
		    <tr><td>Email:</td><td>{search property="email" template="string.like.tpl"}</td></tr>
		    <!--<tr><td>User Group:</td><td>{search property="user_group"}</td></tr>-->
		    <tr><td>Registration Date:</td><td>{search property="registration_date"}</td></tr>
			<tr>
				<td>Membership Plan:</td>
				<td><select name="membership_plan[simple_equal]">
						<option value="">Any</option>
					{foreach from=$plans item=plan}
						<option value="{$plan.id}" {if $membership_plan.simple_equal eq $plan.id}selected="selected"{/if}>{$plan.caption}</option>
					{/foreach}
					</select>
				</td>
			</tr>
		    <tr><td>Status:</td><td>{search property="active"}</td></tr>
		    <tr><td>Online:</td><td><input type="checkbox" value="1" name="online" {if $online}checked="checked"{/if} /></td></tr>
		
	{* Eldar 03-04-2014 *}
	 {if $user_group_name == 'Employer'}
		  <tr>	
		  	<td>Browse Company Name:</td>
		  	<td>
				{foreach from = $alphabets item = alphabet name=alphabet}  
				<div>
					<div class="browseCompanyAB">
						<a class='browseItem' href="{$GLOBALS.site_url}/browse-by-company-admin/?first_char=any_char">#</a>
					</div>
					{foreach from = $alphabet item = char name=char}  
					<div class="browseCompanyAB">
						<a class='browseItem' href="{$GLOBALS.site_url}/browse-by-company-admin/?first_char={$char}">{$char}</a>
					</div>
					{/foreach}
					<div class="clr"></div>
				</div>
				{/foreach}
			</td>
		  </tr>
		  
		  
		  
		  
		  	{* ELDAR 09-04-2017*}	
	{else}
		  <tr>	
		  	<td>Browse Job Seeker's Name:</td>
		  	<td>
				{foreach from = $alphabets item = alphabet name=alphabet}  
				<div>
					<div class="browseCompanyAB">
						<a class='browseItem' href="{$GLOBALS.site_url}/browse-by-usernamejs-admin/?first_char=any_char">#</a>
					</div>
					{foreach from = $alphabet item = char name=char}  
					<div class="browseCompanyAB">
						<a class='browseItem' href="{$GLOBALS.site_url}/browse-by-usernamejs-admin/?first_char={$char}">{$char}</a>
					</div>
					{/foreach}
					<div class="clr"></div>
				</div>
				{/foreach}
			</td>
		  </tr>		  
	{/if}
	{* end of 03-04-2014 *}			
			
			<tr>
				<td>&nbsp;</td>
				<td>
		            <input type="hidden" name="action" value="search" />
                    <input type="hidden" name="user_group_id" value="{$user_group_name}" />
					<span class="greenButtonEnd"><input type="submit" value="Search" class="greenButton" /></span>
				</td>
			</tr>
		</table>
	</form>
</div>

<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery-ui.js"></script>
<script>
	$( function () {ldelim}
	
		var dFormat = '{$GLOBALS.current_language_data.date_format}';
		{literal}
		dFormat = dFormat.replace('%m', "mm");
		dFormat = dFormat.replace('%d', "dd");
		dFormat = dFormat.replace('%Y', "yy");
		
		$("#registration_date_notless, #registration_date_notmore").datepicker({dateFormat: dFormat, showOn: 'button', yearRange: '-99:+99', buttonImage: '{/literal}{$GLOBALS.site_url}/../system/ext/jquery/calendar.gif{literal}', buttonImageOnly: true });
				
		$(".setting_button").click(function(){
			var butt = $(this);
			$(this).next(".setting_block").slideToggle("normal", function(){
					if ($(this).css("display") == "block") {
						butt.children(".setting_icon").html("<div id='accordeonOpen'></div>");
						butt.children("strong").text("Click to hide search criteria");
					} else {
						butt.children(".setting_icon").html("<div id='accordeonClosed'></div>");
						butt.children("strong").text("Click to modify search criteria");
					}
				});
		});
	
		{/literal}
	
	{rdelim});
</script>
