<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <title>SmartJobBoard Admin Panel {if $TITLE ne ""} :: {$TITLE} {/if}</title>
	<link rel="StyleSheet" type="text/css" href="{image src="design.css"}" />
    <link type="text/css" href="{$GLOBALS.site_url}/../system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />	
    <link type="text/css" href="{$GLOBALS.site_url}/../system/ext/jquery/themes/green/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
    <script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery.js"></script>
    <script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery-ui.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
	{capture name=url_for_wiki}
	{* Dashboard *}
  		{if $url === '/system/dashboard/view/' || $url === '/'}
  			http://www.smartjobboard.com/wiki/Dashboard
  		{elseif $url === '/upload-logo'}
  			http://www.smartjobboard.com/wiki/Upload_Your_Logo
  		{elseif $url === '/edit-listing-field/' && $params || $url === '/edit-listing-field/edit-list/' && $params}
  			{if $params === 'sid=198' || $params == 'field_sid=198'}
  				http://www.smartjobboard.com/wiki/Edit_Job_Categories_List
  			{elseif $params === 'sid=214' || $params === 'field_sid=214'}
  				http://www.smartjobboard.com/wiki/Edit_Countries_List
  			{/if}
  		{elseif $url === '/edit-css/' && $params}
  			{if $params === 'action=edit&amp;file=../templates/IntelligentView/main/images/design.css'}
  				http://www.smartjobboard.com/wiki/Edit_CSS_File
  			{elseif $params === 'action=edit&amp;file=../templates/_system/main/images/css/form.css'}
  				http://www.smartjobboard.com/wiki/Edit_Forms_CSS_file
  			{/if}
  	{* Listing Configuration *}
  		{elseif $url === '/listing-fields/'}
  			http://www.smartjobboard.com/wiki/Common_Fields
  		{elseif $url === '/add-listing-field/'}
  			http://www.smartjobboard.com/wiki/Common_Fields#Adding_a_New_Listing_Field
  		{elseif $url === '/edit-listing-field/'}
  			http://www.smartjobboard.com/wiki/Common_Fields#Editing_Listing_Field
  		{elseif $url === '/listing-types/'}
  			http://www.smartjobboard.com/wiki/Listing_Types
  		{elseif $url === '/add-listing-type/'}
  			http://www.smartjobboard.com/wiki/Listing_Types#Addin_a_New_Listing_Type
  		{elseif $url === '/edit-listing-type/'}
  			http://www.smartjobboard.com/wiki/Listing_Types#Editing_a_Listing_Type
  		{elseif $url === '/add-listing-type-field/'}
  			http://www.smartjobboard.com/wiki/Listing_Types#Adding_a_New_Listing_Field
  		{elseif $url === '/edit-listing-type-field/'}	
  			http://www.smartjobboard.com/wiki/Listing_Types  			
  	{* Listing Management *}
  		{elseif $url === '/manage-listings/'}
  			http://www.smartjobboard.com/wiki/Manage_Listings
  		{elseif $url === '/import_listings/'}
  			http://www.smartjobboard.com/wiki/Import_Listings
  		{elseif $url === '/export-listings/'}
  			http://www.smartjobboard.com/wiki/Export_Listings
  		{elseif $url === '/listing-feeds/'}
  			http://www.smartjobboard.com/wiki/XML_Feeds
  		{elseif $url === '/show-import/'}
  			http://www.smartjobboard.com/wiki/XML_Import
  		{elseif $url === '/edit-import/'}
  			http://www.smartjobboard.com/wiki/XML_Import
  		{elseif $url === '/flagged-listings/'}
  			http://www.smartjobboard.com/wiki/Flagged_listings
  	{* Users *}
  		{elseif $url === '/user-groups/'}
  			http://www.smartjobboard.com/wiki/User_Groups
  		{elseif $url === '/add-user-group/'}
  			http://www.smartjobboard.com/wiki/User_Groups#Adding_a_New_User_Group
  		{elseif $url === '/edit-user-group/'}
  			http://www.smartjobboard.com/wiki/User_Groups#Editing_a_User_Group
  		{elseif $url === '/edit-user-profile/'}
  			http://www.smartjobboard.com/wiki/User_Groups#Edit_User_Group_Profile_Fields
  		{elseif $url === '/systems/users/acl/' && $params}
  			http://www.smartjobboard.com/wiki/User_Groups#Managing_User_Group_Permissions	
  		{elseif $url === '/users/'}
  			http://www.smartjobboard.com/wiki/Manage_Users
  		{elseif $url === '/add-user/'}
  			http://www.smartjobboard.com/wiki/Manage_Users#Adding_a_New_User
  		{elseif $url === '/edit-user/'}
  			http://www.smartjobboard.com/wiki/Manage_Users#Editing_User_Details
  		{elseif $url === '/system/applications/view/'}
  			http://www.smartjobboard.com/wiki/Manage_Users#Managing_User.27s_Applications	
  		{elseif $url === '/private-messages/pm-main/' || $url === '/private-messages/pm-inbox/' || $url === '/private-messages/pm-outbox/'}
  			http://www.smartjobboard.com/wiki/Manage_Users#Manage_User.27s_Personal_Messages	
  		{elseif $url === '/import-users/'}
  			http://www.smartjobboard.com/wiki/Import_Users  			
  		{elseif $url === '/system/users/acl/' && strpos($params, 'user') !== false}
  			http://www.smartjobboard.com/wiki/Manage_Users#View_User.27s_Permissions
  		{elseif $url === '/mailing/'}
  			http://www.smartjobboard.com/wiki/Mass_Mailing
  		{elseif $url === '/membership-plans/'}
  			http://www.smartjobboard.com/wiki/Membership_Plans
  		{elseif $url === '/membership-plan/add/'}
  			http://www.smartjobboard.com/wiki/Membership_Plans#Adding_a_New_Membership_Plan
  		{elseif $url === '/membership-plan/' && $params }
  			http://www.smartjobboard.com/wiki/Membership_Plans#Editing_Membership_Plan
  		{elseif $url === '/system/users/acl/' && strpos($params, 'plan') !== false }
  			http://www.smartjobboard.com/wiki/Membership_Plans#Editing_Membership_Plan
  		{elseif $url === '/membership-plan/package/'}
  			http://www.smartjobboard.com/wiki/Membership_Plans#Packages
  		{elseif $url === '/banned-ips/'}
  			http://www.smartjobboard.com/wiki/Banned_IPs
  	{* Layout and Content *}
  		{elseif $url === '/edit-templates/'}
  			http://www.smartjobboard.com/wiki/Edit_Templates
  		{elseif $url === '/edit_themes/'}
  			http://www.smartjobboard.com/wiki/Themes
  		{elseif $url === '/user-pages/'}
  			{if strpos($params, 'action=new_page') !== false }
  				http://www.smartjobboard.com/wiki/Site_Pages#Adding_a_New_User_Page
  			{elseif strpos($params, 'action=edit_page') !== false }
  				http://www.smartjobboard.com/wiki/Site_Pages#Editing_User_Pages
  			{else}
  				http://www.smartjobboard.com/wiki/Site_Pages
  			{/if}
  		{elseif $url === '/stat-pages/'}
  			{if strpos($params, 'action=edit') !== false}
  				http://www.smartjobboard.com/wiki/Static_Content#Editing_Static_Content
  			{else}
  				http://www.smartjobboard.com/wiki/Static_Content
  			{/if}
  		{elseif $url === '/manage-banner-groups/'}
  			http://www.smartjobboard.com/wiki/Banners
  		{elseif $url === '/add-banner-group/'}
  			http://www.smartjobboard.com/wiki/Banners#Adding_a_New_Banner_Group
  		{elseif $url === '/edit-banner-group/'}
  			http://www.smartjobboard.com/wiki/Banners#Editing_Banners_Group
  		{elseif $url === '/edit-banner/'}
  			http://www.smartjobboard.com/wiki/Banners#Editing_a_Banner
  	{* Payments *}
  		{elseif $url === '/system/payment/gateways/'}
  			http://www.smartjobboard.com/wiki/Payment_Gateways
  		{elseif $url === '/configure-gateway/' && $params}
  			{if $params === 'gateway=2checkout'}
  				http://www.smartjobboard.com/wiki/2checkout
  			{elseif $params === 'gateway=authnet_sim'}
  				http://www.smartjobboard.com/wiki/Authorize.Net_SIM
  			{elseif $params === 'gateway=cash_gateway'}
  				http://www.smartjobboard.com/wiki/Cash_Payment
  			{elseif $params === 'gateway=paypal_standard'}
  				http://www.smartjobboard.com/wiki/Paypal_Standard
  			{elseif $params === 'gateway=wire_transfer'}
  				http://www.smartjobboard.com/wiki/Wire_Transfer
  			{/if}
  		{elseif $url === '/system/payment/payments/'}
  			http://www.smartjobboard.com/wiki/Transaction_History
  	{* System Configuration *}
  		{elseif $url === '/adminpswd/'}
  			http://www.smartjobboard.com/wiki/Admin_Password  		
  		{elseif $url === '/settings/'}
  			http://www.smartjobboard.com/wiki/System_Settings
  		{elseif $url === '/alphabet-letters/'}
  			{if strpos($params, 'action=edit') !== false}
  				 http://www.smartjobboard.com/wiki/Alphabet_Letters_for_%E2%80%9CSearch_by_Company%E2%80%9D#Editing_Alphabet
  			{elseif strpos($params, 'action=new') !== false}
  				http://www.smartjobboard.com/wiki/Alphabet_Letters_for_%E2%80%9CSearch_by_Company%E2%80%9D#Adding_a_New_Alphabet
  			{else}
  				http://www.smartjobboard.com/wiki/Alphabet_Letters_for_%E2%80%9CSearch_by_Company%E2%80%9D
  			{/if}  		
  		{elseif $url === '/geographic-data/'}
  			http://www.smartjobboard.com/wiki/ZipCode_Database
  		{elseif $url === '/manage-breadcrumbs/'}
  			http://www.smartjobboard.com/wiki/Breadcrumbs_Config
  		{elseif $url === '/filters/'}
  			http://www.smartjobboard.com/wiki/HTML_filters
  		{elseif $url === '/currency-list/'}
  			{if strpos($params, 'action=add') !== false}
  				http://www.smartjobboard.com/wiki/Manage_Currencies#Adding_a_New_Currency
  			{elseif strpos($params, 'action=edit') !== false}
  				http://www.smartjobboard.com/wiki/Manage_Currencies#Editing_Currencies
  			{else}
  				http://www.smartjobboard.com/wiki/Manage_Currencies
  			{/if}
  		{elseif $url === '/task-scheduler-settings/'}
  			http://www.smartjobboard.com/wiki/Task_Scheduler
  		{elseif $url === '/system/miscellaneous/plugins/' && !$params}
  			http://www.smartjobboard.com/wiki/Plugins
  		{elseif $url === '/system/miscellaneous/plugins/' && $params}
  			{if $params === 'action=settings&amp;plugin=PhpBBBridgePlugin'}
  				http://www.smartjobboard.com/wiki/PhpBB_forum_integration_plugin
  			{elseif $params === 'action=settings&amp;plugin=WordPressBridgePlugin'}
  				http://www.smartjobboard.com/wiki/Wordpress_integration_plugin
  			{elseif $params === 'action=settings&amp;plugin=TwitterIntegrationPlugin'}
  				http://www.smartjobboard.com/wiki/Twitter_Integration_Plugin
  			{/if}
  		{elseif $url === '/refine-search-settings/'}
  			http://www.smartjobboard.com/wiki/Refine_Search_Settings
  		{elseif $url === '/backup/'}
  			http://www.smartjobboard.com/wiki/Backup/Restore
  		{elseif $url === '/flag-listing-settings/'}
  			http://www.smartjobboard.com/wiki/Flag_Listing_Settings
  	{* Language Management *}
  		{elseif $url === '/manage-languages/'}
  			http://www.smartjobboard.com/wiki/Manage_Languages
  		{elseif $url === '/add-language/'}
  			http://www.smartjobboard.com/wiki/Manage_Languages#Adding_a_New_Language
  		{elseif $url === '/edit-language/'}
  			http://www.smartjobboard.com/wiki/Manage_Languages#Editing_Languages  			
  		{elseif $url === '/manage-phrases/'}
  			http://www.smartjobboard.com/wiki/Translate_Phrases
  		{elseif $url === '/import-language/'}
  			http://www.smartjobboard.com/wiki/Import_Language
  		{elseif $url === '/export-language/'}
  			http://www.smartjobboard.com/wiki/Export_Language
  		{else}
  			http://www.smartjobboard.com/wiki/
  		{/if}
	{/capture}
	<table border="0" cellpadding="0" cellspacing="0" width="100%" id="structure"  height="100%">
		<tr>
			<td id="left" valign="top" height="100%">
				{include file="../../../../packageinfo.txt" assign=packagever}
				<div id="leftHeader" style="text-align:right">
					<a href="{$GLOBALS.user_site_url}" id="logoLink"></a>
					<span class="packageVersion">{$packagever|replace:"SmartJobBoard ":""}</span>
				</div>
				<div class="clr"><br/></div>
				{if $GLOBALS.subAdminSID > 0}
					{module name="menu" function="show_subadmin_menu"}
				{/if}
				{module name="menu" function="show_left_menu"}
				<div class="clr"><br/></div>
			</td>
			<td valign="top" height="100%">
				<div class="manual"><a href="{$smarty.capture.url_for_wiki}" target="_blank"><img width="45" src="{image}faq.png" border="0" alt="User Manual"/></a></div>
				<div id="messageBox"></div>
				
				<div id="topGray">
					<div id="breadCrumbs">{$ADMIN_BREADCRUMBS}</div>
					<div id="topRight"><a href="{$GLOBALS.site_url}/">Dashboard</a> &nbsp; <img src="{image}dot.png" border="0" alt=""/> &nbsp; <a href="{$GLOBALS.site_url}/system/users/logout/" style="font-weight: normal;">Log out</a></div>
				</div>
				
				<div class="InContent">
					{$MAIN_CONTENT}
					<div class="clr"><br/></div>
				</div>
			
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div id="footer">
					<span></span>
					&copy; 2010 Powered by SmartJobBoard.com
				</div>
			</td>
		</tr>
	</table>
</body>
</html>