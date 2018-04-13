<?php  /* Smarty version 2.6.14, created on 2018-02-08 10:35:40
         compiled from index.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'image', 'index.tpl', 6, false),array('function', 'module', 'index.tpl', 219, false),array('modifier', 'replace', 'index.tpl', 215, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <title>SmartJobBoard Admin Panel <?php  if ($this->_tpl_vars['TITLE'] != ""): ?> :: <?php  echo $this->_tpl_vars['TITLE']; ?>
 <?php  endif; ?></title>
	<link rel="StyleSheet" type="text/css" href="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array('src' => "design.css"), $this);?>
" />
    <link type="text/css" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />	
    <link type="text/css" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/themes/green/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
    <script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/jquery.js"></script>
    <script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/jquery-ui.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
	<?php  ob_start(); ?>
	  		<?php  if ($this->_tpl_vars['url'] === '/system/dashboard/view/' || $this->_tpl_vars['url'] === '/'): ?>
  			http://www.smartjobboard.com/wiki/Dashboard
  		<?php  elseif ($this->_tpl_vars['url'] === '/upload-logo'): ?>
  			http://www.smartjobboard.com/wiki/Upload_Your_Logo
  		<?php  elseif ($this->_tpl_vars['url'] === '/edit-listing-field/' && $this->_tpl_vars['params'] || $this->_tpl_vars['url'] === '/edit-listing-field/edit-list/' && $this->_tpl_vars['params']): ?>
  			<?php  if ($this->_tpl_vars['params'] === 'sid=198' || $this->_tpl_vars['params'] == 'field_sid=198'): ?>
  				http://www.smartjobboard.com/wiki/Edit_Job_Categories_List
  			<?php  elseif ($this->_tpl_vars['params'] === 'sid=214' || $this->_tpl_vars['params'] === 'field_sid=214'): ?>
  				http://www.smartjobboard.com/wiki/Edit_Countries_List
  			<?php  endif; ?>
  		<?php  elseif ($this->_tpl_vars['url'] === '/edit-css/' && $this->_tpl_vars['params']): ?>
  			<?php  if ($this->_tpl_vars['params'] === 'action=edit&amp;file=../templates/IntelligentView/main/images/design.css'): ?>
  				http://www.smartjobboard.com/wiki/Edit_CSS_File
  			<?php  elseif ($this->_tpl_vars['params'] === 'action=edit&amp;file=../templates/_system/main/images/css/form.css'): ?>
  				http://www.smartjobboard.com/wiki/Edit_Forms_CSS_file
  			<?php  endif; ?>
  	  		<?php  elseif ($this->_tpl_vars['url'] === '/listing-fields/'): ?>
  			http://www.smartjobboard.com/wiki/Common_Fields
  		<?php  elseif ($this->_tpl_vars['url'] === '/add-listing-field/'): ?>
  			http://www.smartjobboard.com/wiki/Common_Fields#Adding_a_New_Listing_Field
  		<?php  elseif ($this->_tpl_vars['url'] === '/edit-listing-field/'): ?>
  			http://www.smartjobboard.com/wiki/Common_Fields#Editing_Listing_Field
  		<?php  elseif ($this->_tpl_vars['url'] === '/listing-types/'): ?>
  			http://www.smartjobboard.com/wiki/Listing_Types
  		<?php  elseif ($this->_tpl_vars['url'] === '/add-listing-type/'): ?>
  			http://www.smartjobboard.com/wiki/Listing_Types#Addin_a_New_Listing_Type
  		<?php  elseif ($this->_tpl_vars['url'] === '/edit-listing-type/'): ?>
  			http://www.smartjobboard.com/wiki/Listing_Types#Editing_a_Listing_Type
  		<?php  elseif ($this->_tpl_vars['url'] === '/add-listing-type-field/'): ?>
  			http://www.smartjobboard.com/wiki/Listing_Types#Adding_a_New_Listing_Field
  		<?php  elseif ($this->_tpl_vars['url'] === '/edit-listing-type-field/'): ?>	
  			http://www.smartjobboard.com/wiki/Listing_Types  			
  	  		<?php  elseif ($this->_tpl_vars['url'] === '/manage-listings/'): ?>
  			http://www.smartjobboard.com/wiki/Manage_Listings
  		<?php  elseif ($this->_tpl_vars['url'] === '/import_listings/'): ?>
  			http://www.smartjobboard.com/wiki/Import_Listings
  		<?php  elseif ($this->_tpl_vars['url'] === '/export-listings/'): ?>
  			http://www.smartjobboard.com/wiki/Export_Listings
  		<?php  elseif ($this->_tpl_vars['url'] === '/listing-feeds/'): ?>
  			http://www.smartjobboard.com/wiki/XML_Feeds
  		<?php  elseif ($this->_tpl_vars['url'] === '/show-import/'): ?>
  			http://www.smartjobboard.com/wiki/XML_Import
  		<?php  elseif ($this->_tpl_vars['url'] === '/edit-import/'): ?>
  			http://www.smartjobboard.com/wiki/XML_Import
  		<?php  elseif ($this->_tpl_vars['url'] === '/flagged-listings/'): ?>
  			http://www.smartjobboard.com/wiki/Flagged_listings
  	  		<?php  elseif ($this->_tpl_vars['url'] === '/user-groups/'): ?>
  			http://www.smartjobboard.com/wiki/User_Groups
  		<?php  elseif ($this->_tpl_vars['url'] === '/add-user-group/'): ?>
  			http://www.smartjobboard.com/wiki/User_Groups#Adding_a_New_User_Group
  		<?php  elseif ($this->_tpl_vars['url'] === '/edit-user-group/'): ?>
  			http://www.smartjobboard.com/wiki/User_Groups#Editing_a_User_Group
  		<?php  elseif ($this->_tpl_vars['url'] === '/edit-user-profile/'): ?>
  			http://www.smartjobboard.com/wiki/User_Groups#Edit_User_Group_Profile_Fields
  		<?php  elseif ($this->_tpl_vars['url'] === '/systems/users/acl/' && $this->_tpl_vars['params']): ?>
  			http://www.smartjobboard.com/wiki/User_Groups#Managing_User_Group_Permissions	
  		<?php  elseif ($this->_tpl_vars['url'] === '/users/'): ?>
  			http://www.smartjobboard.com/wiki/Manage_Users
  		<?php  elseif ($this->_tpl_vars['url'] === '/add-user/'): ?>
  			http://www.smartjobboard.com/wiki/Manage_Users#Adding_a_New_User
  		<?php  elseif ($this->_tpl_vars['url'] === '/edit-user/'): ?>
  			http://www.smartjobboard.com/wiki/Manage_Users#Editing_User_Details
  		<?php  elseif ($this->_tpl_vars['url'] === '/system/applications/view/'): ?>
  			http://www.smartjobboard.com/wiki/Manage_Users#Managing_User.27s_Applications	
  		<?php  elseif ($this->_tpl_vars['url'] === '/private-messages/pm-main/' || $this->_tpl_vars['url'] === '/private-messages/pm-inbox/' || $this->_tpl_vars['url'] === '/private-messages/pm-outbox/'): ?>
  			http://www.smartjobboard.com/wiki/Manage_Users#Manage_User.27s_Personal_Messages	
  		<?php  elseif ($this->_tpl_vars['url'] === '/import-users/'): ?>
  			http://www.smartjobboard.com/wiki/Import_Users  			
  		<?php  elseif ($this->_tpl_vars['url'] === '/system/users/acl/' && strpos ( $this->_tpl_vars['params'] , 'user' ) !== false): ?>
  			http://www.smartjobboard.com/wiki/Manage_Users#View_User.27s_Permissions
  		<?php  elseif ($this->_tpl_vars['url'] === '/mailing/'): ?>
  			http://www.smartjobboard.com/wiki/Mass_Mailing
  		<?php  elseif ($this->_tpl_vars['url'] === '/membership-plans/'): ?>
  			http://www.smartjobboard.com/wiki/Membership_Plans
  		<?php  elseif ($this->_tpl_vars['url'] === '/membership-plan/add/'): ?>
  			http://www.smartjobboard.com/wiki/Membership_Plans#Adding_a_New_Membership_Plan
  		<?php  elseif ($this->_tpl_vars['url'] === '/membership-plan/' && $this->_tpl_vars['params']): ?>
  			http://www.smartjobboard.com/wiki/Membership_Plans#Editing_Membership_Plan
  		<?php  elseif ($this->_tpl_vars['url'] === '/system/users/acl/' && strpos ( $this->_tpl_vars['params'] , 'plan' ) !== false): ?>
  			http://www.smartjobboard.com/wiki/Membership_Plans#Editing_Membership_Plan
  		<?php  elseif ($this->_tpl_vars['url'] === '/membership-plan/package/'): ?>
  			http://www.smartjobboard.com/wiki/Membership_Plans#Packages
  		<?php  elseif ($this->_tpl_vars['url'] === '/banned-ips/'): ?>
  			http://www.smartjobboard.com/wiki/Banned_IPs
  	  		<?php  elseif ($this->_tpl_vars['url'] === '/edit-templates/'): ?>
  			http://www.smartjobboard.com/wiki/Edit_Templates
  		<?php  elseif ($this->_tpl_vars['url'] === '/edit_themes/'): ?>
  			http://www.smartjobboard.com/wiki/Themes
  		<?php  elseif ($this->_tpl_vars['url'] === '/user-pages/'): ?>
  			<?php  if (strpos ( $this->_tpl_vars['params'] , 'action=new_page' ) !== false): ?>
  				http://www.smartjobboard.com/wiki/Site_Pages#Adding_a_New_User_Page
  			<?php  elseif (strpos ( $this->_tpl_vars['params'] , 'action=edit_page' ) !== false): ?>
  				http://www.smartjobboard.com/wiki/Site_Pages#Editing_User_Pages
  			<?php  else: ?>
  				http://www.smartjobboard.com/wiki/Site_Pages
  			<?php  endif; ?>
  		<?php  elseif ($this->_tpl_vars['url'] === '/stat-pages/'): ?>
  			<?php  if (strpos ( $this->_tpl_vars['params'] , 'action=edit' ) !== false): ?>
  				http://www.smartjobboard.com/wiki/Static_Content#Editing_Static_Content
  			<?php  else: ?>
  				http://www.smartjobboard.com/wiki/Static_Content
  			<?php  endif; ?>
  		<?php  elseif ($this->_tpl_vars['url'] === '/manage-banner-groups/'): ?>
  			http://www.smartjobboard.com/wiki/Banners
  		<?php  elseif ($this->_tpl_vars['url'] === '/add-banner-group/'): ?>
  			http://www.smartjobboard.com/wiki/Banners#Adding_a_New_Banner_Group
  		<?php  elseif ($this->_tpl_vars['url'] === '/edit-banner-group/'): ?>
  			http://www.smartjobboard.com/wiki/Banners#Editing_Banners_Group
  		<?php  elseif ($this->_tpl_vars['url'] === '/edit-banner/'): ?>
  			http://www.smartjobboard.com/wiki/Banners#Editing_a_Banner
  	  		<?php  elseif ($this->_tpl_vars['url'] === '/system/payment/gateways/'): ?>
  			http://www.smartjobboard.com/wiki/Payment_Gateways
  		<?php  elseif ($this->_tpl_vars['url'] === '/configure-gateway/' && $this->_tpl_vars['params']): ?>
  			<?php  if ($this->_tpl_vars['params'] === 'gateway=2checkout'): ?>
  				http://www.smartjobboard.com/wiki/2checkout
  			<?php  elseif ($this->_tpl_vars['params'] === 'gateway=authnet_sim'): ?>
  				http://www.smartjobboard.com/wiki/Authorize.Net_SIM
  			<?php  elseif ($this->_tpl_vars['params'] === 'gateway=cash_gateway'): ?>
  				http://www.smartjobboard.com/wiki/Cash_Payment
  			<?php  elseif ($this->_tpl_vars['params'] === 'gateway=paypal_standard'): ?>
  				http://www.smartjobboard.com/wiki/Paypal_Standard
  			<?php  elseif ($this->_tpl_vars['params'] === 'gateway=wire_transfer'): ?>
  				http://www.smartjobboard.com/wiki/Wire_Transfer
  			<?php  endif; ?>
  		<?php  elseif ($this->_tpl_vars['url'] === '/system/payment/payments/'): ?>
  			http://www.smartjobboard.com/wiki/Transaction_History
  	  		<?php  elseif ($this->_tpl_vars['url'] === '/adminpswd/'): ?>
  			http://www.smartjobboard.com/wiki/Admin_Password  		
  		<?php  elseif ($this->_tpl_vars['url'] === '/settings/'): ?>
  			http://www.smartjobboard.com/wiki/System_Settings
  		<?php  elseif ($this->_tpl_vars['url'] === '/alphabet-letters/'): ?>
  			<?php  if (strpos ( $this->_tpl_vars['params'] , 'action=edit' ) !== false): ?>
  				 http://www.smartjobboard.com/wiki/Alphabet_Letters_for_%E2%80%9CSearch_by_Company%E2%80%9D#Editing_Alphabet
  			<?php  elseif (strpos ( $this->_tpl_vars['params'] , 'action=new' ) !== false): ?>
  				http://www.smartjobboard.com/wiki/Alphabet_Letters_for_%E2%80%9CSearch_by_Company%E2%80%9D#Adding_a_New_Alphabet
  			<?php  else: ?>
  				http://www.smartjobboard.com/wiki/Alphabet_Letters_for_%E2%80%9CSearch_by_Company%E2%80%9D
  			<?php  endif; ?>  		
  		<?php  elseif ($this->_tpl_vars['url'] === '/geographic-data/'): ?>
  			http://www.smartjobboard.com/wiki/ZipCode_Database
  		<?php  elseif ($this->_tpl_vars['url'] === '/manage-breadcrumbs/'): ?>
  			http://www.smartjobboard.com/wiki/Breadcrumbs_Config
  		<?php  elseif ($this->_tpl_vars['url'] === '/filters/'): ?>
  			http://www.smartjobboard.com/wiki/HTML_filters
  		<?php  elseif ($this->_tpl_vars['url'] === '/currency-list/'): ?>
  			<?php  if (strpos ( $this->_tpl_vars['params'] , 'action=add' ) !== false): ?>
  				http://www.smartjobboard.com/wiki/Manage_Currencies#Adding_a_New_Currency
  			<?php  elseif (strpos ( $this->_tpl_vars['params'] , 'action=edit' ) !== false): ?>
  				http://www.smartjobboard.com/wiki/Manage_Currencies#Editing_Currencies
  			<?php  else: ?>
  				http://www.smartjobboard.com/wiki/Manage_Currencies
  			<?php  endif; ?>
  		<?php  elseif ($this->_tpl_vars['url'] === '/task-scheduler-settings/'): ?>
  			http://www.smartjobboard.com/wiki/Task_Scheduler
  		<?php  elseif ($this->_tpl_vars['url'] === '/system/miscellaneous/plugins/' && ! $this->_tpl_vars['params']): ?>
  			http://www.smartjobboard.com/wiki/Plugins
  		<?php  elseif ($this->_tpl_vars['url'] === '/system/miscellaneous/plugins/' && $this->_tpl_vars['params']): ?>
  			<?php  if ($this->_tpl_vars['params'] === 'action=settings&amp;plugin=PhpBBBridgePlugin'): ?>
  				http://www.smartjobboard.com/wiki/PhpBB_forum_integration_plugin
  			<?php  elseif ($this->_tpl_vars['params'] === 'action=settings&amp;plugin=WordPressBridgePlugin'): ?>
  				http://www.smartjobboard.com/wiki/Wordpress_integration_plugin
  			<?php  elseif ($this->_tpl_vars['params'] === 'action=settings&amp;plugin=TwitterIntegrationPlugin'): ?>
  				http://www.smartjobboard.com/wiki/Twitter_Integration_Plugin
  			<?php  endif; ?>
  		<?php  elseif ($this->_tpl_vars['url'] === '/refine-search-settings/'): ?>
  			http://www.smartjobboard.com/wiki/Refine_Search_Settings
  		<?php  elseif ($this->_tpl_vars['url'] === '/backup/'): ?>
  			http://www.smartjobboard.com/wiki/Backup/Restore
  		<?php  elseif ($this->_tpl_vars['url'] === '/flag-listing-settings/'): ?>
  			http://www.smartjobboard.com/wiki/Flag_Listing_Settings
  	  		<?php  elseif ($this->_tpl_vars['url'] === '/manage-languages/'): ?>
  			http://www.smartjobboard.com/wiki/Manage_Languages
  		<?php  elseif ($this->_tpl_vars['url'] === '/add-language/'): ?>
  			http://www.smartjobboard.com/wiki/Manage_Languages#Adding_a_New_Language
  		<?php  elseif ($this->_tpl_vars['url'] === '/edit-language/'): ?>
  			http://www.smartjobboard.com/wiki/Manage_Languages#Editing_Languages  			
  		<?php  elseif ($this->_tpl_vars['url'] === '/manage-phrases/'): ?>
  			http://www.smartjobboard.com/wiki/Translate_Phrases
  		<?php  elseif ($this->_tpl_vars['url'] === '/import-language/'): ?>
  			http://www.smartjobboard.com/wiki/Import_Language
  		<?php  elseif ($this->_tpl_vars['url'] === '/export-language/'): ?>
  			http://www.smartjobboard.com/wiki/Export_Language
  		<?php  else: ?>
  			http://www.smartjobboard.com/wiki/
  		<?php  endif; ?>
	<?php  $this->_smarty_vars['capture']['url_for_wiki'] = ob_get_contents(); ob_end_clean(); ?>
	<table border="0" cellpadding="0" cellspacing="0" width="100%" id="structure"  height="100%">
		<tr>
			<td id="left" valign="top" height="100%">
				<?php  ob_start();
$_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../../../packageinfo.txt", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->assign('packagever', ob_get_contents()); ob_end_clean();
 ?>
				<div id="leftHeader" style="text-align:right">
					<a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
" id="logoLink"></a>
					<span class="packageVersion"><?php  echo ((is_array($_tmp=$this->_tpl_vars['packagever'])) ? $this->_run_mod_handler('replace', true, $_tmp, 'SmartJobBoard ', "") : smarty_modifier_replace($_tmp, 'SmartJobBoard ', "")); ?>
</span>
				</div>
				<div class="clr"><br/></div>
				<?php  if ($this->_tpl_vars['GLOBALS']['subAdminSID'] > 0): ?>
					<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'menu','function' => 'show_subadmin_menu'), $this);?>

				<?php  endif; ?>
				<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'menu','function' => 'show_left_menu'), $this);?>

				<div class="clr"><br/></div>
			</td>
			<td valign="top" height="100%">
				<div class="manual"><a href="<?php  echo $this->_smarty_vars['capture']['url_for_wiki']; ?>
" target="_blank"><img width="45" src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
faq.png" border="0" alt="User Manual"/></a></div>
				<div id="messageBox"></div>
				
				<div id="topGray">
					<div id="breadCrumbs"><?php  echo $this->_tpl_vars['ADMIN_BREADCRUMBS']; ?>
</div>
					<div id="topRight"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/">Dashboard</a> &nbsp; <img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
dot.png" border="0" alt=""/> &nbsp; <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/users/logout/" style="font-weight: normal;">Log out</a></div>
				</div>
				
				<div class="InContent">
					<?php  echo $this->_tpl_vars['MAIN_CONTENT']; ?>

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