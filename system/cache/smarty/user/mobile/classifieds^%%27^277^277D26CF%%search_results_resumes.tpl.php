<?php  /* Smarty version 2.6.14, created on 2017-08-11 08:20:37
         compiled from search_results_resumes.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'search_results_resumes.tpl', 2, false),array('modifier', 'regex_replace', 'search_results_resumes.tpl', 35, false),)), $this); ?>
<div class="headerBox">
	<h1><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Resume Search Results<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1>
</div>
<?php  if ($this->_tpl_vars['ERRORS']): ?>
	<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php  else: ?>

	<div class="modifySearch">
		<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/search-resumes/?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Modify search<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
	</div>
	<div class="numberResults">
		<?php  $this->assign('listings_number', $this->_tpl_vars['listing_search']['listings_number']); ?>
		<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Results:<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  echo $this->_tpl_vars['listings_number']; ?>
 <?php  if ($this->_tpl_vars['listings_number'] == 1):   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Resume<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   else:   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   endif; ?>
	</div>
	<div class="clr"></div>
	<div class="pagging">
		<?php  if ($this->_tpl_vars['listing_search']['current_page']-1 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;<?php  endif; ?>
			<?php  if ($this->_tpl_vars['listing_search']['current_page']-3 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=1">1</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['listing_search']['current_page']-3 > 1): ?>...<?php  endif; ?>
			<?php  if ($this->_tpl_vars['listing_search']['current_page']-2 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-2; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']-2; ?>
</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['listing_search']['current_page']-1 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
</a><?php  endif; ?>
			<strong><?php  echo $this->_tpl_vars['listing_search']['current_page']; ?>
</strong>
			<?php  if ($this->_tpl_vars['listing_search']['current_page']+1 <= $this->_tpl_vars['listing_search']['pages_number']): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['listing_search']['current_page']+2 <= $this->_tpl_vars['listing_search']['pages_number']): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+2; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']+2; ?>
</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['listing_search']['current_page']+3 < $this->_tpl_vars['listing_search']['pages_number']): ?>...<?php  endif; ?>
			<?php  if ($this->_tpl_vars['listing_search']['current_page']+3 < $this->_tpl_vars['listing_search']['pages_number'] + 1): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['pages_number']; ?>
"><?php  echo $this->_tpl_vars['listing_search']['pages_number']; ?>
</a><?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']+1 <= $this->_tpl_vars['listing_search']['pages_number']): ?>&nbsp;<a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  endif; ?>	
	</div>
	<div class="clr"><br/></div>

	<?php  if ($this->_tpl_vars['listings']): ?>	
		<?php  $_from = $this->_tpl_vars['listings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['listings'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['listings']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['listing']):
        $this->_foreach['listings']['iteration']++;
?>
			<div class="boxResultsResumes">
		    	<a name="listing_<?php  echo $this->_tpl_vars['listing']['id']; ?>
"></a>
		    	<h2><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/display-resume/<?php  echo $this->_tpl_vars['listing']['id']; ?>
/<?php  echo ((is_array($_tmp=$this->_tpl_vars['listing']['Title'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-") : smarty_modifier_regex_replace($_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-")); ?>
.html?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']; ?>
"><?php  echo $this->_tpl_vars['listing']['Title']; ?>
</a></h2>
		    	<?php  if ($this->_tpl_vars['listing']['anonymous'] == 1):   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Anonymous User<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   else:   echo $this->_tpl_vars['listing']['user']['FirstName']; ?>
 <?php  echo $this->_tpl_vars['listing']['user']['LastName'];   endif; ?>, &nbsp;<?php  echo $this->_tpl_vars['listing']['City']; ?>

		    	<br/><br/><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Date posted<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['activation_date'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['activation_date'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			</div>
			<div class="clr"><br/></div>
		<?php  endforeach; endif; unset($_from); ?>
	<?php  else: ?>
		<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no Resumes meeting the selected criteria in the system. <?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
	<?php  endif; ?>

	<div class="modifySearch">
		<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/search-resumes/?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Modify search<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
	</div>
	<div class="numberResults">
		<?php  $this->assign('listings_number', $this->_tpl_vars['listing_search']['listings_number']); ?>
		<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Results:<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  echo $this->_tpl_vars['listings_number']; ?>
 <?php  if ($this->_tpl_vars['listings_number'] == 1):   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Resume<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   else:   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   endif; ?>
	</div>
	<div class="clr"></div>
	<div class="pagging">
		<?php  if ($this->_tpl_vars['listing_search']['current_page']-1 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;<?php  endif; ?>
			<?php  if ($this->_tpl_vars['listing_search']['current_page']-3 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=1">1</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['listing_search']['current_page']-3 > 1): ?>...<?php  endif; ?>
			<?php  if ($this->_tpl_vars['listing_search']['current_page']-2 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-2; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']-2; ?>
</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['listing_search']['current_page']-1 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
</a><?php  endif; ?>
			<strong><?php  echo $this->_tpl_vars['listing_search']['current_page']; ?>
</strong>
			<?php  if ($this->_tpl_vars['listing_search']['current_page']+1 <= $this->_tpl_vars['listing_search']['pages_number']): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['listing_search']['current_page']+2 <= $this->_tpl_vars['listing_search']['pages_number']): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+2; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']+2; ?>
</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['listing_search']['current_page']+3 < $this->_tpl_vars['listing_search']['pages_number']): ?>...<?php  endif; ?>
			<?php  if ($this->_tpl_vars['listing_search']['current_page']+3 < $this->_tpl_vars['listing_search']['pages_number'] + 1): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['pages_number']; ?>
"><?php  echo $this->_tpl_vars['listing_search']['pages_number']; ?>
</a><?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']+1 <= $this->_tpl_vars['listing_search']['pages_number']): ?>&nbsp;<a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  endif; ?>	
	</div>
	<div class="clr"><br/></div>

<?php  endif; ?>