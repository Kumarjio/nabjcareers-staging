{assign var="listing" value=$tmp_listing}
<center><h1>[[Company Profile]]</h1></center>
<!--- PROFILE BLOCK --->
<div class="userInfo">
	<div class="compProfileTitle">[[Company Info]]</div>
	<div class="compProfileInfo">
		{if isset($smarty.get.userProfile)}				
			{foreach from=$listings key=listing_key item=listing_profile name=listing_profiles}
				
				{if $listing_profile.user.id == $smarty.get.userProfile}
					{if $listing_profile.user.Logo.file_url}
						<center><img src="{$listing_profile.user.Logo.file_url}" alt="" /></center><br/>
					{/if}
	
					<strong>{if isset($smarty.get.company_name)}{$smarty.get.company_name.equal}{else}{$listing_profile.user.CompanyName}{/if} </strong>
					<br />{$listing_profile.user.Address}
					<br />{if $listing_profile.user.City}{$listing_profile.user.City}, {/if}[[$listing_profile.user.State]] 
					{if $listing_profile.user.Country}([[Property_Country!{$listing_profile.user.Country}]]){/if}
					<br/><br/>
					
					{if !$listing.company_name}
						<strong>[[FormFieldCaptions!Phone]]</strong>: {$listing_profile.user.PhoneNumber}<br/>
						<strong>[[FormFieldCaptions!Web]]</strong>: <a href="{if strpos($listing_profile.user.WebSite, 'http://') === false}http://{/if}{$listing_profile.user.WebSite}" target="_blank">{$listing_profile.user.WebSite}</a><br /><br />
						<a href="{$GLOBALS.site_url}/private-messages/send/?to={$listing_profile.user.id}" onclick="popUpWindow('{$GLOBALS.site_url}/private-messages/aj-send/?to={$listing_profile.user.id}', 560, 420, '[[Send Private Message]]', true, {if $GLOBALS.current_user.logged_in}true{else}false{/if}); return false;" class="pm_send_link">[[Send Private Message]]</a>
						<br/>
					{/if}
					
					{if $listing_profile.user.video.file_url != ""}
						<br/><center>{include file="video_player_profile.tpl"}</center><br/>
					{/if}
							
					
					<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery-ui.js"></script>
					<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.bgiframe.js"></script>
					<script language="JavaScript" type="text/javascript"><!--
						{literal}
							$.ui.dialog.defaults.bgiframe = true;
							function popUpWindow(url, widthWin, heightWin, title, parentReload, userLoggedIn){
								reloadPage = false;
								$("#messageBox").dialog( 'destroy' ).html('{/literal}<img style="vertical-align: middle;" src="{$GLOBALS.site_url}/system/ext/jquery/progbar.gif" alt="[[Please, wait ...]]" /> [[Please, wait ...]]{literal}');
								$("#messageBox").dialog({
									width: widthWin,
									height: heightWin,
									modal: true,
									title: title,
									close: function(event, ui) {
										if(parentReload == true && !userLoggedIn) {
											if(reloadPage == true)
												parent.document.location.reload();
										}
									}
								}).dialog( 'open' );
								
								$.get(url, function(data){
									$("#messageBox").html(data);  
								});
								return false;
							}
							function windowMessage() {
								$("#messageBox").dialog( 'destroy' ).html('You already applied');
								$("#messageBox").dialog({
									bgiframe: true,
									modal: true,
									title: 'Error',
									buttons: {
										Ok: function() {
											$(this).dialog('close');
										}
									}
								});
							}
						{/literal}
					--></script>
				
								
								
					<div class="compProfileBottom">&nbsp;</div>
					<center>
						{foreach from=$listing.pictures key=key item=picture name=picimages }
							<a target="_black" href="{$picture.picture_url}"> <img src="{$picture.thumbnail_url}" border="0" title="{$picture.caption}" alt="{$picture.caption}" /></a><br />
						{/foreach}
					</center>
				
					<!--- END PROFILE BLOCK --->
					
					<div class="listingInfoCompProfile">
						<h2>[[FormFieldCaptions!Company Description]]:</h2>
						 $listing_profile.user.CompanyDescription {*previous solution !!!*}
						{$userInfo.CompanyDescription}
					</div>
					{break}
				{/if}
			{/foreach}
			
			
			
				
		{else}
			{if $userInfo.Logo.file_url}
				<center><img src="{$userInfo.Logo.file_url}" alt="" /></center><br/>
			{/if}
			{* Check for JobG8 company info *}
				<strong>{if isset($smarty.get.company_name)}{$smarty.get.company_name.equal}{else}{$userInfo.CompanyName}{/if} </strong>
				<br />{$userInfo.Address}
				<br />{if $userInfo.City}{$userInfo.City}, {/if}[[$userInfo.State]] {if $userInfo.Country}([[Property_Country!{$userInfo.Country}]]){/if}
				<br/><br/>
			
				{if !$listing.company_name}
					<strong>[[FormFieldCaptions!Phone]]</strong>: {$userInfo.PhoneNumber}<br/>
					<strong>[[FormFieldCaptions!Web]]</strong>: <a href="{if strpos($userInfo.WebSite, 'http://') === false}http://{/if}{$userInfo.WebSite}" target="_blank">{$userInfo.WebSite}</a><br /><br />
					<a href="{$GLOBALS.site_url}/private-messages/send/?to={$userInfo.id}" onclick="popUpWindow('{$GLOBALS.site_url}/private-messages/aj-send/?to={$userInfo.id}', 560, 420, '[[Send Private Message]]', true, {if $GLOBALS.current_user.logged_in}true{else}false{/if}); return false;" class="pm_send_link">[[Send Private Message]]</a>
					<br/>
				{/if}
			
				{if $userInfo.video.file_url != ""}
					<br/><center>{include file="video_player_profile.tpl"}</center><br/>
				{/if}
	
				<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery-ui.js"></script>
				<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.bgiframe.js"></script>

				<script language="JavaScript" type="text/javascript"><!--
					{literal}
						$.ui.dialog.defaults.bgiframe = true;
						function popUpWindow(url, widthWin, heightWin, title, parentReload, userLoggedIn){
							reloadPage = false;
							$("#messageBox").dialog( 'destroy' ).html('{/literal}<img style="vertical-align: middle;" src="{$GLOBALS.site_url}/system/ext/jquery/progbar.gif" alt="[[Please, wait ...]]" /> [[Please, wait ...]]{literal}');
							$("#messageBox").dialog({
								width: widthWin,
								height: heightWin,
								modal: true,
								title: title,
								close: function(event, ui) {
									if(parentReload == true && !userLoggedIn) {
										if(reloadPage == true)
											parent.document.location.reload();
									}
								}
							}).dialog( 'open' );
							
							$.get(url, function(data){
								$("#messageBox").html(data);  
							});
							return false;
						}
						function windowMessage() {
							$("#messageBox").dialog( 'destroy' ).html('You already applied');
							$("#messageBox").dialog({
								bgiframe: true,
								modal: true,
								title: 'Error',
								buttons: {
									Ok: function() {
										$(this).dialog('close');
									}
								}
							});
						}
					{/literal}
				--></script>
		
			
				<div class="compProfileBottom">&nbsp;</div>
				<center>
					{foreach from=$listing.pictures key=key item=picture name=picimages }
						<a target="_black" href="{$picture.picture_url}"> <img src="{$picture.thumbnail_url}" border="0" title="{$picture.caption}" alt="{$picture.caption}" /></a><br />
					{/foreach}
				</center>
			
			<!--- END PROFILE BLOCK --->
	
				<div class="listingInfoCompProfile">
					<h2>[[FormFieldCaptions!Company Description]]:</h2>
					{$userInfo.CompanyDescription}
				</div>
		{/if}
	</div>
</div>

<div class="clr"><br /></div>