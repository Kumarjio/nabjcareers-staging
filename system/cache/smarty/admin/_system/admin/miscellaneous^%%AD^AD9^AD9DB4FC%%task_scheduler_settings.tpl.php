<?php  /* Smarty version 2.6.14, created on 2018-02-28 00:55:57
         compiled from task_scheduler_settings.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'task_scheduler_settings.tpl', 1, false),array('function', 'cycle', 'task_scheduler_settings.tpl', 16, false),array('modifier', 'date_format', 'task_scheduler_settings.tpl', 18, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Task Scheduler Settings<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Task Scheduler Settings</h1>
<small>
<p>Task Scheduler script performs system tasks such as: user subscriptions expiration, listings expiration and job/resume alerts mailing.</p>
<p>To run Task Scheduler manually use the following link:<br />
<a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/task-scheduler/" target="_blank">Run Task Scheduler</a></p>
<p>To see task scheduler logs use the following link:<br />
<a href="?action=log_view">View Task Scheduler Log</a></p>
<br />
<table>
	<thead>
		<tr>
			<th colspan="2">Task Scheduler Quick Statistics</th>
		</tr>
	</thead>
	<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
		<td>Last Run Date:</td>
		<td><?php  echo ((is_array($_tmp=$this->_tpl_vars['last_executed_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A, %B %e, %Y") : smarty_modifier_date_format($_tmp, "%A, %B %e, %Y")); ?>
</td>
	</tr>
	<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
		<td>Alerts Sent:</td>
		<td><?php  echo $this->_tpl_vars['task_scheduler_log']['notifieds_sent']; ?>
</td>
	</tr>
	<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
		<td>Expired Listings:</td>
		<td><?php  echo $this->_tpl_vars['task_scheduler_log']['expired_listings']; ?>
</td>
	</tr>
	<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
		<td>Expired Users:</td>
		<td><?php  echo $this->_tpl_vars['task_scheduler_log']['expired_contracts']; ?>
</td>
	</tr>
</table>


<p>To make task scheduler run automatically you should configure CRON job to run task scheduler script every day. There are two ways to do that: via command line (e.g. SSH) or via control panel (cPanel, Plesk, H-Shere or whatever). Below you can find the description of each method.</p>

<h3>Configuring CRON via cPanel</h3>

<p>
Go to the “<i>Advanced tools -> Cron jobs</i>” section from the cPanel main page. Choose “<i>Standard</i>” level. 
Enter your email address to the corresponding field in order to get notification when cron job runs.  
Enter the following text to the “<i>Command to run</i>” field:<br />
<b>wget --tries=1 http://www.YourSiteDomain.com/task-scheduler/</b>
</p>

<p>
Set “<i>Minute(s)</i>” to “<i>0</i>”, “<i>Hour(s)</i>” to “<i>0 = 12 AM/Midnight</i>”, “<i>Day(s)</i>” to “<i>Every Day</i>”, “<i>Month(s)</i>” to “<i>Every Month</i>”, “<i>Weekday(s)</i>” to “<i>Every Weekday</i>”. Then click “<i>Save Crontab</i>” button. This cron job will run task scheduler every day at midnight.
Notice: Cron job configuration interface may vary depending on control panel software and version used on your hosting server. Review your control panel documentation or contact your hosting provider if you have troubles with configuring cron job on your hosting.
</p>

<h3>Configuring CRON via command line</h3>
<p>
Run the following command in your command line:<br />
<b>crontab -e</b>
</p>

<p>
This will open text editor for modifying CRON configuration file. Put the following line there and save:<br />
<b>0  0  *  *  *  wget --tries=1 http://www.YourSiteDomain.com/task-scheduler/</b>
</p>
<p>This will run task scheduler every day in midnight.</p>
<p>For more information about CRON use the following link: <a href="http://en.wikipedia.org/wiki/Cron">http://en.wikipedia.org/wiki/Cron</a></p>

</small>