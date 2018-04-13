<?php  /* Smarty version 2.6.14, created on 2015-07-30 20:38:21
         compiled from my_listings.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'my_listings.tpl', 3, false),array('modifier', 'cat', 'my_listings.tpl', 6, false),array('modifier', 'count', 'my_listings.tpl', 10, false),array('modifier', 'regex_replace', 'my_listings.tpl', 138, false),array('modifier', 'default', 'my_listings.tpl', 150, false),array('function', 'image', 'my_listings.tpl', 46, false),array('function', 'cycle', 'my_listings.tpl', 135, false),)), $this); ?>
<?php  if ($this->_tpl_vars['url'] != "/new-listings-activate/"): ?> 
	<?php  if ($this->_tpl_vars['acl']->isAllowed('bulk_job_import')): ?><p><a href='<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/job-import/'><strong><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Bulk job import from exl/csv file<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong></a></p><?php  endif; ?>

	<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['group']['id'] == 'Employer'): ?>
		<?php  $this->assign('url', ((is_array($_tmp=$this->_tpl_vars['GLOBALS']['site_url'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/add-listing/?listing_type_id=Job") : smarty_modifier_cat($_tmp, "/add-listing/?listing_type_id=Job"))); ?>
	<?php  else: ?>
		<?php  $this->assign('url', ((is_array($_tmp=$this->_tpl_vars['GLOBALS']['site_url'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/add-listing/?listing_type_id=Resume") : smarty_modifier_cat($_tmp, "/add-listing/?listing_type_id=Resume"))); ?>
	<?php  endif; ?>
	<p><?php  if (! count($this->_tpl_vars['listings']) && empty ( $this->_tpl_vars['search_criteria'] )):   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You have no listings now<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   endif; ?> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Click<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <a href="<?php  echo $this->_tpl_vars['url']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>here<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>to add a new listing.<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>

<?php  endif; ?> 
<?php  if (! count($this->_tpl_vars['listings'])): ?>
	<?php  if (! empty ( $this->_tpl_vars['search_criteria'] )): ?>
		<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No listings found.<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
	<?php  endif; ?>
<?php  else: ?>

<script type="text/javascript" language="JavaScript">
	<?php  echo '
	function submit()
	{
		form = document.getElementById("listings_per_page_form");
		form.submit();
	}
	'; ?>

</script>

<!-- PER PAGE / NAVIGATION -->
<br />
<div class="numberPerPage">
	<form id="listings_per_page_form" method="get" action="">
		<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Number of listings per page<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:
		<select name="listings_per_page" onchange="submit()">
			<option value="10" <?php  if ($this->_tpl_vars['listing_search']['listings_per_page'] == 10): ?>selected="selected"<?php  endif; ?>>10</option>
			<option value="20" <?php  if ($this->_tpl_vars['listing_search']['listings_per_page'] == 20): ?>selected="selected"<?php  endif; ?>>20</option>
			<option value="50" <?php  if ($this->_tpl_vars['listing_search']['listings_per_page'] == 50): ?>selected="selected"<?php  endif; ?>>50</option>
			<option value="100" <?php  if ($this->_tpl_vars['listing_search']['listings_per_page'] == 100): ?>selected="selected"<?php  endif; ?>>100</option>
		</select>
		<input type="hidden" name="restore" value="" />
		<input type="hidden" name="page" value="1" />
	</form>
	<br />
	<span class="prevBtn">
		<?php  if ($this->_tpl_vars['listing_search']['current_page']-1 > 0): ?><a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
prev_btn.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" border="0"/><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
		<?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
prev_btn.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" border="0"/><a><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  endif; ?>
	</span>
	<span class="navigationItems">
		<?php  if ($this->_tpl_vars['listing_search']['current_page']-3 > 0): ?><a href="?restore=1&amp;page=1">1</a><?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']-3 > 1): ?>...<?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']-2 > 0): ?><a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-2; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']-2; ?>
</a><?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']-1 > 0): ?><a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
</a><?php  endif; ?>
		<strong><?php  echo $this->_tpl_vars['listing_search']['current_page']; ?>
</strong>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']+1 <= $this->_tpl_vars['listing_search']['pages_number']): ?><a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
</a><?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']+2 <= $this->_tpl_vars['listing_search']['pages_number']): ?><a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+2; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']+2; ?>
</a><?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']+3 < $this->_tpl_vars['listing_search']['pages_number']): ?>...<?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']+3 < $this->_tpl_vars['listing_search']['pages_number'] + 1): ?><a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['pages_number']; ?>
"><?php  echo $this->_tpl_vars['listing_search']['pages_number']; ?>
</a><?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']+1 <= $this->_tpl_vars['listing_search']['pages_number']): ?>
	</span>
	<span class="nextBtn">
		<a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
next_btn.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" border="0" /></a>
		<?php  else: ?><a><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> <img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
next_btn.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" border="0" /><?php  endif; ?>
	</span>
</div>
<div class="pageNavigation">
	<form method="post" action="">
	<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Actions with Selected<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:
	<input type="submit" name="action_activate" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Activate<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" />
	<input type="submit" name="action_deactivate" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Deactivate<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" />
	<input type="submit" name="action_delete" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" onclick="return confirm('<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Are you sure?<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>')" />
</div>

<!-- END PER PAGE / NAVIGATION -->

<div class="clr"><br/></div>
<div class="results">
<table cellspacing="0">
	<thead>
		<tr>
			<th class="tableLeft"> </th>
			<th width="1"><input type="checkbox" id="all_checkboxes_control" /></th>
			<th width="30%">
				<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sort by<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <a href="?restore=1&amp;sorting_field=Title&amp;sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'Title'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Title<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
				<?php  if ($this->_tpl_vars['sorting_field'] == 'Title'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Up<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Down<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /><?php  endif;   endif; ?>
			</th>
			<th width="10%">
				<?php  if ($this->_tpl_vars['hasSubusersWithListings']): ?>
					<a href="?restore=1&amp;sorting_field=subuser_sid&amp;sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'subuser_sid'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Listing Owner<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
					<?php  if ($this->_tpl_vars['sorting_field'] == 'subuser_sid'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Up<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Down<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /><?php  endif;   endif; ?>
				<?php  endif; ?>
			</th>
			<th width="10%">
				<a href="?restore=1&amp;sorting_field=id&amp;sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'id'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>"><?php  if ($this->_tpl_vars['GLOBALS']['current_user']['group']['id'] == 'Employer'):   $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Job ID<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   else:   $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Resume ID<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   endif; ?></a>
				<?php  if ($this->_tpl_vars['sorting_field'] == 'id'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Up<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Down<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /><?php  endif;   endif; ?>
			</th>
			<th width="10%">
				<?php  if ($this->_tpl_vars['property']['activation_date']['is_sortable']): ?>
					<a href="?restore=1&amp;sorting_field=activation_date&amp;sorting_order=<?php  if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC' && $this->_tpl_vars['listing_search']['sorting_field'] == 'activation_date'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Posted<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
					<?php  if ($this->_tpl_vars['sorting_field'] == 'activation_date'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.png" alt="Up" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="Down" /><?php  endif;   endif; ?>
				<?php  else: ?>
					<?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Posted<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php  endif; ?>
			</th>
			<th width="7%">
				<a href="?restore=1&amp;sorting_field=active&amp;sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'active'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Active<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
				<?php  if ($this->_tpl_vars['sorting_field'] == 'active'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.png" alt="Up" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="Down" /><?php  endif;   endif; ?>
			</th>
			<th width="9%">
				<a href="?restore=1&amp;sorting_field=views&amp;sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'views'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Number of Views<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
				<?php  if ($this->_tpl_vars['sorting_field'] == 'views'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.png" alt="Up" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="Down" /><?php  endif;   endif; ?>
			</th>
			<th width="10%">
				<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['group']['id'] == 'Employer'): ?>
					<a href="?restore=1&amp;sorting_field=applications&amp;sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'applications'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Applications<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
					<?php  if ($this->_tpl_vars['sorting_field'] == 'applications'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.png" alt="Up" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="Down" /><?php  endif;   endif; ?>
				<?php  endif; ?>
			</th>
			<th width="10%">
				<?php  if ($this->_tpl_vars['waitApprove'] == 1): ?>
					<a href="?restore=1&amp;sorting_field=status&amp;sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'status'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Approval Status<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
					<?php  if ($this->_tpl_vars['sorting_field'] == 'status'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.png" alt="Up" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="Down" /><?php  endif;   endif; ?>
				<?php  endif; ?>
			</th>
			<th class="tableRight"> </th>
		</tr>
	</thead>
	<tbody>
		<?php  $_from = $this->_tpl_vars['listings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['listings_block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['listings_block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['listing']):
        $this->_foreach['listings_block']['iteration']++;
?>
		<?php  if ($this->_tpl_vars['listing']['type']['id'] == 'Job'): ?>
			<?php  $this->assign('link', 'my-job-details'); ?>
		<?php  elseif ($this->_tpl_vars['listing']['type']['id'] == 'Resume'): ?>
			<?php  $this->assign('link', 'my-resume-details'); ?>
		<?php  endif; ?>
		<tr <?php  if ($this->_tpl_vars['listing']['priority'] == 1): ?>class="priorityListing"<?php  else: ?>class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => false), $this);?>
"<?php  endif; ?>>
			<td> </td>
			<td class="noTdPad"><input type="checkbox" name="listings[<?php  echo $this->_tpl_vars['listing']['id']; ?>
]" value="1" id="checkbox_<?php  echo $this->_foreach['listings_block']['iteration']; ?>
" /></td>
			<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/<?php  echo $this->_tpl_vars['link']; ?>
/<?php  echo $this->_tpl_vars['listing']['id']; ?>
/<?php  echo ((is_array($_tmp=$this->_tpl_vars['listing']['Title'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-") : smarty_modifier_regex_replace($_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-")); ?>
.html"><strong><?php  echo $this->_tpl_vars['listing']['Title']; ?>
 <?php  if ($this->_tpl_vars['listing']['anonymous'] == 1): ?>(anonymous)<?php  endif; ?></strong></a></td>
			<td>
				<?php  if ($this->_tpl_vars['hasSubusersWithListings']): ?>
					<?php  if ($this->_tpl_vars['listing']['subuser']):   echo $this->_tpl_vars['listing']['subuser']['username'];   else:   echo $this->_tpl_vars['listing']['user']['username'];   endif; ?>
				<?php  endif; ?>
			</td>
			<td>#&nbsp;<?php  echo $this->_tpl_vars['listing']['id']; ?>
</td>
			<td><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['activation_date'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['activation_date'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
			<td>&nbsp;&nbsp;<?php  if ($this->_tpl_vars['listing']['active']):   echo $this->_tpl_vars['listing']['active'];   else: ?>-<?php  endif; ?></td>
			<td><?php  echo $this->_tpl_vars['listing']['views']; ?>
</td>
			<td>
				<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['group']['id'] == 'Employer'): ?>	
					<?php  if (! $this->_tpl_vars['apps'][$this->_tpl_vars['listing']['id']]): ?>-<?php  else: ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/applications/view/?appJobId=<?php  echo $this->_tpl_vars['listing']['id']; ?>
"><?php  echo ((is_array($_tmp=@$this->_tpl_vars['apps'][$this->_tpl_vars['listing']['id']])) ? $this->_run_mod_handler('default', true, $_tmp, "-") : smarty_modifier_default($_tmp, "-")); ?>
</a><?php  endif; ?>
				<?php  endif; ?>
			</td>
			<td>
				<?php  if ($this->_tpl_vars['waitApprove'] == 1): ?>
					<?php  if ($this->_tpl_vars['listing']['reject_reason'] != '' && $this->_tpl_vars['listing']['approveStatus'] != 'approved'): ?>
						<a title="Reject reason: <?php  echo $this->_tpl_vars['listing']['reject_reason']; ?>
"><?php  echo $this->_tpl_vars['listing']['approveStatus']; ?>
</a> | <a href="?action_sendToApprove=1&amp;listings[<?php  echo $this->_tpl_vars['listing']['id']; ?>
]=1">Submit for approval</a>
					<?php  else: ?>
						<?php  echo $this->_tpl_vars['listing']['approveStatus']; ?>

					<?php  endif; ?>
				<?php  endif; ?>
			</td>
			<td> </td>
		</tr>
		<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => true), $this);?>
">
			<td> </td>
			<td> </td>
			<td colspan="8">
				<ul>
					<li><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/<?php  echo $this->_tpl_vars['link']; ?>
/<?php  echo $this->_tpl_vars['listing']['id']; ?>
/<?php  echo ((is_array($_tmp=$this->_tpl_vars['listing']['Title'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-") : smarty_modifier_regex_replace($_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-")); ?>
.html"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>View details<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> |</li>
					<li><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-listing/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> |</li>
					<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['group']['caption'] == 'Employer'): ?><li><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/clone-job/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Clone<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> |</li><?php  endif; ?>
					<li>
						<?php  if ($this->_tpl_vars['listing']['active']): ?>
							<a href="?action_deactivate=1&amp;listings[<?php  echo $this->_tpl_vars['listing']['id']; ?>
]=1"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Deactivate<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> |
						<?php  else: ?>
							<?php  if ($this->_tpl_vars['listing']['complete'] == 1): ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/pay-for-listing/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Activate<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> |<?php  endif; ?>
						<?php  endif; ?>
					</li>
					<li><a href="?action_delete=1&amp;listings[<?php  echo $this->_tpl_vars['listing']['id']; ?>
]=1" onclick="return confirm('<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Are you sure?<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>')"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
					<?php  if ($this->_tpl_vars['acl']->isAllowed('add_featured_listings') && ! $this->_tpl_vars['listing']['featured']): ?>
						<li> | <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/make-featured/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Upgrade to Featured<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
					<?php  endif; ?>
					
					<?php  if (! $this->_tpl_vars['listing']['priority']): ?>
						<li> | <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/make-priority/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Upgrade to Priority<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
					<?php  endif; ?>
				</ul>
			</td>
			<td> </td>
		</tr>
		<tr>
			<td colspan="11" class="separateListing"> </td>
		</tr>
		<?php  endforeach; endif; unset($_from); ?>
</table>
</div>
<div class="clr"><br/></div>
<input type="submit" name="action_activate" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Activate<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" />
<input type="submit" name="action_deactivate" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Deactivate<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" />
<input type="submit" name="action_delete" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" onclick="return confirm('<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Are you sure?<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>')" />

<div class="pageNavigation">
	<span class="prevBtn">
	<?php  if ($this->_tpl_vars['listing_search']['current_page']-1 > 0): ?>
		<a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
">
			<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
prev_btn.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" border="0"/>
			<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</a>
	<?php  else: ?>
		<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
prev_btn.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"  border="0" /><a><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  endif; ?>
	</span>
	<span class="navigationItems">
		<?php  if ($this->_tpl_vars['listing_search']['current_page']-3 > 0): ?><a href="?restore=1&amp;page=1">1</a><?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']-3 > 1): ?>...<?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']-2 > 0): ?><a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-2; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']-2; ?>
</a><?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']-1 > 0): ?><a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
</a><?php  endif; ?>
		<strong><?php  echo $this->_tpl_vars['listing_search']['current_page']; ?>
</strong>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']+1 <= $this->_tpl_vars['listing_search']['pages_number']): ?><a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
</a><?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']+2 <= $this->_tpl_vars['listing_search']['pages_number']): ?><a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+2; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']+2; ?>
</a><?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']+3 < $this->_tpl_vars['listing_search']['pages_number']): ?>...<?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']+3 < $this->_tpl_vars['listing_search']['pages_number'] + 1): ?><a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['pages_number']; ?>
"><?php  echo $this->_tpl_vars['listing_search']['pages_number']; ?>
</a><?php  endif; ?>
	</span>
	<span class="nextBtn">
		<?php  if ($this->_tpl_vars['listing_search']['current_page']+1 <= $this->_tpl_vars['listing_search']['pages_number']): ?>
			<a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
" ><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> <img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
next_btn.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"  border="0"/>
		<?php  else: ?>
			<a><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> <img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
next_btn.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" border="0"/>
		<?php  endif; ?>
	</span>
</div>
</form>

<script language="JavaScript" type="text/javascript" >
var total=<?php  echo $this->_foreach['listings_block']['total']; ?>
;
<?php  echo '
function set_checkbox(param) {
	for (i = 1; i <= total; i++) {
		if (checkbox = document.getElementById(\'checkbox_\' + i))
			checkbox.checked = param;
	}
}
$("#all_checkboxes_control").click(function() {
	if ( this.checked == false)
		set_checkbox(false);
	else
		set_checkbox(true);
});
'; ?>

</script>

<?php  endif; ?>