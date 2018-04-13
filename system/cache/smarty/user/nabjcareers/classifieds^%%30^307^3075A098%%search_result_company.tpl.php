<?php  /* Smarty version 2.6.14, created on 2014-10-20 00:10:45
         compiled from search_result_company.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'search_result_company.tpl', 15, false),array('function', 'image', 'search_result_company.tpl', 33, false),array('function', 'display', 'search_result_company.tpl', 80, false),array('function', 'cycle', 'search_result_company.tpl', 85, false),)), $this); ?>
<?php  $this->assign('previous_title', '1'); ?>
<script type="text/javascript" language="JavaScript">
<?php  echo '
function submitForm(id) {
	lpp = document.getElementById("listings_per_page" + id);
	location.href = \'?'; ?>
searchId=<?php  echo $this->_tpl_vars['searchId'];   echo '&action=search&page=1&listings_per_page=\' + lpp.value;
}
</script>
'; ?>

<div class="SearchResultsCompany">
	<?php  if ($this->_tpl_vars['ERRORS']): ?>
		<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php  else: ?>
		<?php  if ($this->_tpl_vars['tmp_listing']['user']['CompanyName'] == ''): ?>
			<h1><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Company Search Results<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1>
		<?php  endif; ?>
	<!-- RESULTS / PER PAGE / NAVIGATION -->
	<div class="topNavBarLeft"></div>
	<div class="topNavBar">
		<div class="numberResults"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Results: $usersCount Company<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
		<div class="numberPerPage">
			<form id="listings_per_page_form" method="get" action="" class="tableSRNavPerPage">
			<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Number of company per page<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:
				<select id="listings_per_page1" name="listings_per_page1" onchange="submitForm(1); return false;">
				<option value="10" <?php  if ($this->_tpl_vars['listings_per_page'] == 10): ?>selected="selected"<?php  endif; ?>>10</option>
				<option value="20" <?php  if ($this->_tpl_vars['listings_per_page'] == 20): ?>selected="selected"<?php  endif; ?>>20</option>
				<option value="50" <?php  if ($this->_tpl_vars['listings_per_page'] == 50): ?>selected="selected"<?php  endif; ?>>50</option>
				<option value="100" <?php  if ($this->_tpl_vars['listings_per_page'] == 100): ?>selected="selected"<?php  endif; ?>>100</option>
			</select>
			</form>
		</div>
		<div class="pageNavigation">
			<span class="prevBtn"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
prev_btn.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"/>
			<?php  if ($this->_tpl_vars['current_page']-1 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['current_page']-1; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  else: ?><a><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  endif; ?></span>
			<?php  if ($this->_tpl_vars['current_page']-3 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=1">1</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['current_page']-3 > 1): ?>...<?php  endif; ?>
			<?php  if ($this->_tpl_vars['current_page']-2 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['current_page']-2; ?>
"><?php  echo $this->_tpl_vars['current_page']-2; ?>
</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['current_page']-1 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['current_page']-1; ?>
"><?php  echo $this->_tpl_vars['current_page']-1; ?>
</a><?php  endif; ?>
			<strong><?php  echo $this->_tpl_vars['current_page']; ?>
</strong>
			<?php  if ($this->_tpl_vars['current_page']+1 <= $this->_tpl_vars['pages_number']): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['current_page']+1; ?>
"><?php  echo $this->_tpl_vars['current_page']+1; ?>
</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['current_page']+2 <= $this->_tpl_vars['pages_number']): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['current_page']+2; ?>
"><?php  echo $this->_tpl_vars['current_page']+2; ?>
</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['current_page']+3 < $this->_tpl_vars['pages_number']): ?>...<?php  endif; ?>
			<?php  if ($this->_tpl_vars['current_page']+3 < $this->_tpl_vars['pages_number'] + 1): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['pages_number']; ?>
"><?php  echo $this->_tpl_vars['pages_number']; ?>
</a><?php  endif; ?>
			<span class="nextBtn"><?php  if ($this->_tpl_vars['current_page']+1 <= $this->_tpl_vars['pages_number']): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['current_page']+1; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  else: ?><a><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  endif; ?>
			<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
next_btn.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"/></span>
		</div>
	</div>
	<div class="topNavBarRight"></div>
	<div class="clr"><br/></div>
	<!-- END RESULTS / PER PAGE / NAVIGATION -->

	<?php  if ($this->_tpl_vars['found_users_sids']): ?>
	<table cellspacing="0">
		<thead>
			<tr>
				<th class="tableLeft"> </th>
				<th width="10%">&nbsp;</th>
				<th>
					<a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&sorting_field=CompanyName&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'CompanyName'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Company name<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
					<?php  if ($this->_tpl_vars['sorting_field'] == 'CompanyName'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.png" alt="Up" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="Down" /><?php  endif;   endif; ?>
				</th>
				<th>
					<a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&sorting_field=City&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'City'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>City<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
					<?php  if ($this->_tpl_vars['sorting_field'] == 'City'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.png" alt="Up" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="Down" /><?php  endif;   endif; ?>
				</th>
				<th>
					<a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&sorting_field=State&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'State'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>State<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
					<?php  if ($this->_tpl_vars['sorting_field'] == 'State'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.png" alt="Up" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="Down" /><?php  endif;   endif; ?>
				</th>
				<th>
					<a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&sorting_field=number_of_jobs&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'number_of_jobs'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>" style="float: right;"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No of jobs<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
					<?php  if ($this->_tpl_vars['sorting_field'] == 'number_of_jobs'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="Up" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.png" alt="Down" /><?php  endif;   endif; ?>
				</th>
				<th class="tableRight"> </th>
			</tr>
		</thead>
		<tbody>
			<?php  $_from = $this->_tpl_vars['found_users_sids']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['users_block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['users_block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['user_sid']):
        $this->_foreach['users_block']['iteration']++;
?>

			<?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'username','object_sid' => $this->_tpl_vars['user_sid'],'assign' => 'username'), $this);?>

			<?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'CompanyName','object_sid' => $this->_tpl_vars['user_sid'],'assign' => 'companyNameAlias'), $this);?>


				<?php  if ($this->_tpl_vars['previous_title'] !== $this->_tpl_vars['companyNameAlias']): ?>
					
					<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => true), $this);?>
">
						
						<td class="compLogo" colspan="2">
							<center>
								<?php  if (strpos ( $this->_tpl_vars['companyNameAlias'] , '-' ) !== false): ?>
																			<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/search-results-jobs/?action=search&CompanyName[multi_like][]=<?php  echo $this->_tpl_vars['companyNameAlias']; ?>
&userProfile=<?php  echo $this->_tpl_vars['user_sid']; ?>
><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'Logo','object_sid' => $this->_tpl_vars['user_sid']), $this);?>
</a>
								<?php  else: ?>
																		<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/search-results-jobs/?action=search&CompanyName[multi_like][]=<?php  echo $this->_tpl_vars['companyNameAlias']; ?>
&userProfile=<?php  echo $this->_tpl_vars['user_sid']; ?>
"><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'Logo','object_sid' => $this->_tpl_vars['user_sid']), $this);?>
</a>
								<?php  endif; ?>
							</center>
						</td>
						<td>
							<strong>
								<?php  if (strpos ( $this->_tpl_vars['companyNameAlias'] , '-' ) !== false): ?>
																			<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/search-results-jobs/?action=search&CompanyName[multi_like][]=<?php  echo $this->_tpl_vars['companyNameAlias']; ?>
&userProfile=<?php  echo $this->_tpl_vars['user_sid']; ?>
"><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'CompanyName','object_sid' => $this->_tpl_vars['user_sid']), $this);?>
</a>
								<?php  else: ?>
																			<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/search-results-jobs/?action=search&CompanyName[multi_like][]=<?php  echo $this->_tpl_vars['companyNameAlias']; ?>
&userProfile=<?php  echo $this->_tpl_vars['user_sid']; ?>
"><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'CompanyName','object_sid' => $this->_tpl_vars['user_sid']), $this);?>
</a>								
								<?php  endif; ?>
							</strong>
						</td>
						<td><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'City','object_sid' => $this->_tpl_vars['user_sid']), $this);?>
</td>
						<td><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'State','object_sid' => $this->_tpl_vars['user_sid']), $this);?>
</td>
						<td align="right"><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'countListings','object_sid' => $this->_tpl_vars['user_sid']), $this);?>
</td>
						<td></td>
					</tr>
	
				<?php  endif; ?>
				<?php  $this->assign('previous_title', $this->_tpl_vars['companyNameAlias']); ?>
			<?php  endforeach; endif; unset($_from); ?>
		</tbody>
	</table>
	
	<!-- RESULTS / PER PAGE / NAVIGATION -->
	<div class="clr"><br/></div>
	<div class="topNavBarLeft"></div>
	<div class="topNavBar">
		<div class="numberResults"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Results: $usersCount Company<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
		<div class="numberPerPage">
			<form id="listings_per_page_form" method="get" action="" class="tableSRNavPerPage">
			<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Number of jobs per page<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:
				<select id="listings_per_page2" name="listings_per_page2" onchange="submitForm(2); return false;">
				<option value="10" <?php  if ($this->_tpl_vars['listings_per_page'] == 10): ?>selected="selected"<?php  endif; ?>>10</option>
				<option value="20" <?php  if ($this->_tpl_vars['listings_per_page'] == 20): ?>selected="selected"<?php  endif; ?>>20</option>
				<option value="50" <?php  if ($this->_tpl_vars['listings_per_page'] == 50): ?>selected="selected"<?php  endif; ?>>50</option>
				<option value="100" <?php  if ($this->_tpl_vars['listings_per_page'] == 100): ?>selected="selected"<?php  endif; ?>>100</option>
			</select>
			</form>
		</div>
		<div class="pageNavigation">
			<span class="prevBtn"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
prev_btn.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"/>
		    <?php  if ($this->_tpl_vars['current_page']-1 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['current_page']-1; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  else: ?><a><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  endif; ?></span>
			<?php  if ($this->_tpl_vars['current_page']-3 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=1">1</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['current_page']-3 > 1): ?>...<?php  endif; ?>
			<?php  if ($this->_tpl_vars['current_page']-2 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['current_page']-2; ?>
"><?php  echo $this->_tpl_vars['current_page']-2; ?>
</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['current_page']-1 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['current_page']-1; ?>
"><?php  echo $this->_tpl_vars['current_page']-1; ?>
</a><?php  endif; ?>
			<strong><?php  echo $this->_tpl_vars['current_page']; ?>
</strong>
			<?php  if ($this->_tpl_vars['current_page']+1 <= $this->_tpl_vars['pages_number']): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['current_page']+1; ?>
"><?php  echo $this->_tpl_vars['current_page']+1; ?>
</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['current_page']+2 <= $this->_tpl_vars['pages_number']): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['current_page']+2; ?>
"><?php  echo $this->_tpl_vars['current_page']+2; ?>
</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['current_page']+3 < $this->_tpl_vars['pages_number']): ?>...<?php  endif; ?>
			<?php  if ($this->_tpl_vars['current_page']+3 < $this->_tpl_vars['pages_number'] + 1): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['pages_number']; ?>
"><?php  echo $this->_tpl_vars['pages_number']; ?>
</a><?php  endif; ?>
			<span class="nextBtn"><?php  if ($this->_tpl_vars['current_page']+1 <= $this->_tpl_vars['pages_number']): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['current_page']+1; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  else: ?><a><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  endif; ?>
			<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
next_btn.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"/></span>
		</div>
	</div>
	<div class="topNavBarRight"></div>
	<!-- END RESULTS / PER PAGE / NAVIGATION -->
	<?php  endif; ?>
	<?php  endif; ?>
</div>