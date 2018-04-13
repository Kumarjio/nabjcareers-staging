<?php  /* Smarty version 2.6.14, created on 2014-10-20 16:00:39
         compiled from payment_page.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'payment_page.tpl', 30, false),array('function', 'math', 'payment_page.tpl', 36, false),array('function', 'module', 'payment_page.tpl', 200, false),array('modifier', 'count', 'payment_page.tpl', 188, false),array('modifier', 'count_words', 'payment_page.tpl', 220, false),array('modifier', 'regex_replace', 'payment_page.tpl', 220, false),)), $this); ?>
<?php  echo $this->_tpl_vars['p']; ?>

<?php  echo $this->_tpl_vars['f']; ?>

<h1>Confirm Total </h1><br/>
	
<?php  if (! $this->_tpl_vars['product_info']['featured_listing_id'] && ! $this->_tpl_vars['product_info']['priority_listing_id']): ?>
	<div id="larger_font">
		<?php  if ($this->_tpl_vars['product_info']['membership_plan_id'] != 33 && $this->_tpl_vars['product_info']['membership_plan_id'] != 37): ?> 			<table>
				<thead>
					<tr>
						<th width="20%"><b>Job Title</b></th>
						<th width="15%" style="text-align: center!important;">Job Posting Fee</th>
						<th width="15%" style="text-align: center!important;">Featured Job Add-on Fee</th>
						<th width="15%" style="text-align: center!important;">Priority Job Add-on Fee</th>
					</tr>
				</thead>
				
				<tbody> 			
				
						
					<?php  if ($this->_tpl_vars['product_info']['listings_ids'] && $this->_tpl_vars['listingsInfo']['listingsIDs_payment']['0']['package']): ?>		
						<?php  $_from = $this->_tpl_vars['product_info']['listings_ids']['0']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['listing_to_pay']):
?>
							<tr class="evenrow">
								<?php  $_from = $this->_tpl_vars['listingsInfo']['listingsIDs_payment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['listingid']):
?>
									<?php  if ($this->_tpl_vars['listingid']['id'] == $this->_tpl_vars['listing_to_pay']): ?>		
										<td>
											<?php  echo $this->_tpl_vars['listingid']['Title']; ?>

											<?php  if (count ( $this->_tpl_vars['product_info']['listings_ids']['0'] ) > 1): ?> 
												<span style="color: #333; font-size: 10px;">
												(<a style="text-decoration: underline;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/payment-page/?payment_id=<?php  echo $this->_tpl_vars['payment']->getId(); ?>
&action=exclude_and_delete_listing&listing_sid=<?php  echo $this->_tpl_vars['listingid']['id']; ?>
" onclick="return confirm('<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Are you sure?<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>')"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>)
												</span>
											<?php  endif; ?></td>
										
										<td style="text-align: center;">$
											<?php  if ($this->_tpl_vars['listingid']['package']['featured'] == 1 && $this->_tpl_vars['listingid']['package']['priority'] == 0): ?>
												<?php  echo smarty_function_math(array('equation' => "x - y",'x' => $this->_tpl_vars['listingid']['package']['price'],'y' => $this->_tpl_vars['listingid']['package']['featured_price']), $this);?>

						
											<?php  elseif ($this->_tpl_vars['listingid']['package']['featured'] == 0 && $this->_tpl_vars['listingid']['package']['priority'] == 1): ?>
												<?php  echo smarty_function_math(array('equation' => "x - y",'x' => $this->_tpl_vars['listingid']['package']['price'],'y' => $this->_tpl_vars['listingid']['package']['priority_price']), $this);?>

						
											<?php  elseif ($this->_tpl_vars['listingid']['package']['featured'] == 1 && $this->_tpl_vars['listingid']['package']['priority'] == 1): ?>
												<?php  echo smarty_function_math(array('equation' => "x - y - z",'x' => $this->_tpl_vars['listingid']['package']['price'],'y' => $this->_tpl_vars['listingid']['package']['featured_price'],'z' => $this->_tpl_vars['listingid']['package']['priority_price']), $this);?>

						
											<?php  elseif ($this->_tpl_vars['listingid']['package']['featured'] == 0 && $this->_tpl_vars['listingid']['package']['priority'] == 0): ?>
												<?php  echo $this->_tpl_vars['listings']['package']['price']; ?>

											<?php  endif; ?> 
										</td>
				
										<td style="text-align: center;">
											<?php  if ($this->_tpl_vars['listingid']['package']['featured'] == 1): ?><span style="display: none;"><?php  echo $this->_tpl_vars['f']++; ?>
</span>+ $<?php  echo $this->_tpl_vars['listingid']['package']['featured_price']; ?>
 <span style="color: #333; font-size: 10px;">(<a style="text-decoration: underline;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/payment-page/?payment_id=<?php  echo $this->_tpl_vars['payment']->getId(); ?>
&action=cancel_addon&addon=featured&listing_sid=<?php  echo $this->_tpl_vars['listingid']['id']; ?>
">delete</a>)</span><?php  else: ?>-<?php  endif; ?>
										</td>
										<td style="text-align: center;">
											<?php  if ($this->_tpl_vars['listingid']['package']['priority'] == 1): ?><span style="display: none;"><?php  echo $this->_tpl_vars['p']++; ?>
</span>+ $<?php  echo $this->_tpl_vars['listingid']['package']['priority_price']; ?>
 <span style="color: #333; font-size: 10px;">(<a style="text-decoration: underline;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/payment-page/?payment_id=<?php  echo $this->_tpl_vars['payment']->getId(); ?>
&action=cancel_addon&addon=priority&listing_sid=<?php  echo $this->_tpl_vars['listingid']['id']; ?>
">delete</a>)</span><?php  else: ?>-<?php  endif; ?>
										</td>
									<?php  else: ?>
									
									<?php  endif; ?>
								<?php  endforeach; endif; unset($_from); ?>		
							</tr>		
						<?php  endforeach; endif; unset($_from); ?>	
										<?php  elseif ($this->_tpl_vars['product_info']['listings_ids']): ?>		
						<?php  $_from = $this->_tpl_vars['product_info']['listings_ids']['0']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['listing_to_pay']):
?>
							<tr class="evenrow">
								<?php  $_from = $this->_tpl_vars['listings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['listingid_2']):
?>
									<?php  if ($this->_tpl_vars['listingid_2']['id'] == $this->_tpl_vars['listing_to_pay']): ?>		
										<td>
											<?php  echo $this->_tpl_vars['listingid_2']['Title']; ?>

											<?php  if (count ( $this->_tpl_vars['product_info']['listings_ids']['0'] ) > 1): ?> 
												<span style="color: #333; font-size: 10px;">
												(<a style="text-decoration: underline;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/payment-page/?payment_id=<?php  echo $this->_tpl_vars['payment']->getId(); ?>
&action=exclude_and_delete_listing&listing_sid=<?php  echo $this->_tpl_vars['listingid_2']['id']; ?>
" onclick="return confirm('<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Are you sure?<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>')"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>)
												</span>
											<?php  endif; ?></td>
										
										<td style="text-align: center;">$
											<?php  if ($this->_tpl_vars['listingid_2']['package']['featured'] == 1 && $this->_tpl_vars['listingid_2']['package']['priority'] == 0): ?>
												<?php  echo smarty_function_math(array('equation' => "x - y",'x' => $this->_tpl_vars['listingid_2']['package']['price'],'y' => $this->_tpl_vars['listingid_2']['package']['featured_price']), $this);?>

						
											<?php  elseif ($this->_tpl_vars['listingid_2']['package']['featured'] == 0 && $this->_tpl_vars['listingid_2']['package']['priority'] == 1): ?>
												<?php  echo smarty_function_math(array('equation' => "x - y",'x' => $this->_tpl_vars['listingid_2']['package']['price'],'y' => $this->_tpl_vars['listingid_2']['package']['priority_price']), $this);?>

						
											<?php  elseif ($this->_tpl_vars['listingid_2']['package']['featured'] == 1 && $this->_tpl_vars['listingid_2']['package']['priority'] == 1): ?>
												<?php  echo smarty_function_math(array('equation' => "x - y - z",'x' => $this->_tpl_vars['listingid_2']['package']['price'],'y' => $this->_tpl_vars['listingid_2']['package']['featured_price'],'z' => $this->_tpl_vars['listingid_2']['package']['priority_price']), $this);?>

						
											<?php  elseif ($this->_tpl_vars['listingid_2']['package']['featured'] == 0 && $this->_tpl_vars['listingid_2']['package']['priority'] == 0): ?>
												<?php  echo $this->_tpl_vars['listingid_2']['package']['price']; ?>

											<?php  endif; ?> 
										</td>
				
										<td style="text-align: center;">
											<?php  if ($this->_tpl_vars['listingid_2']['package']['featured'] == 1): ?><span style="display: none;"><?php  echo $this->_tpl_vars['f']++; ?>
</span>+ $<?php  echo $this->_tpl_vars['listingid_2']['package']['featured_price']; ?>
 <span style="color: #333; font-size: 10px;">(<a style="text-decoration: underline;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/payment-page/?payment_id=<?php  echo $this->_tpl_vars['payment']->getId(); ?>
&action=cancel_addon&addon=featured&listing_sid=<?php  echo $this->_tpl_vars['listingid_2']['id']; ?>
">delete</a>)</span><?php  else: ?>-<?php  endif; ?>
										</td>
										<td style="text-align: center;">
											<?php  if ($this->_tpl_vars['listingid_2']['package']['priority'] == 1): ?><span style="display: none;"><?php  echo $this->_tpl_vars['p']++; ?>
</span>+ $<?php  echo $this->_tpl_vars['listingid_2']['package']['priority_price']; ?>
 <span style="color: #333; font-size: 10px;">(<a style="text-decoration: underline;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/payment-page/?payment_id=<?php  echo $this->_tpl_vars['payment']->getId(); ?>
&action=cancel_addon&addon=priority&listing_sid=<?php  echo $this->_tpl_vars['listingid']['id']; ?>
">delete</a>)</span><?php  else: ?>-<?php  endif; ?>
										</td>
									<?php  else: ?>				
									<?php  endif; ?>
								<?php  endforeach; endif; unset($_from); ?>		
							</tr>		
						<?php  endforeach; endif; unset($_from); ?>	
						
		
											<?php  elseif ($_GET['listigid']): ?>
						<tr class="evenrow"><?php  echo $this->_tpl_vars['listing_id_from_url']; ?>

							<?php  $_from = $this->_tpl_vars['listings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['listingid_second']):
?>
								<?php  if ($this->_tpl_vars['listingid_second']['id'] == $_GET['listigid']): ?>		
									<td>
										<?php  echo $this->_tpl_vars['listingid_second']['Title']; ?>

										<?php  if (count ( $this->_tpl_vars['product_info']['listings_ids']['0'] ) > 1): ?> 
											<span style="color: #333; font-size: 10px;">
											(<a style="text-decoration: underline;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/payment-page/?payment_id=<?php  echo $this->_tpl_vars['payment']->getId(); ?>
&action=exclude_and_delete_listing&listing_sid=<?php  echo $this->_tpl_vars['listingid_second']['id']; ?>
" onclick="return confirm('<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Are you sure?<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>')"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>)
											</span>
										<?php  endif; ?></td>
									
									<td style="text-align: center;">$
										<?php  if ($this->_tpl_vars['listingid_second']['package']['featured'] == 1 && $this->_tpl_vars['listingid_second']['package']['priority'] == 0): ?>
											<?php  echo smarty_function_math(array('equation' => "x - y",'x' => $this->_tpl_vars['listingid_second']['package']['price'],'y' => $this->_tpl_vars['listingid_second']['package']['featured_price']), $this);?>

					
										<?php  elseif ($this->_tpl_vars['listingid_second']['package']['featured'] == 0 && $this->_tpl_vars['listingid_second']['package']['priority'] == 1): ?>
											<?php  echo smarty_function_math(array('equation' => "x - y",'x' => $this->_tpl_vars['listingid_second']['package']['price'],'y' => $this->_tpl_vars['listingid_second']['package']['priority_price']), $this);?>

					
										<?php  elseif ($this->_tpl_vars['listingid_second']['package']['featured'] == 1 && $this->_tpl_vars['listingid_second']['package']['priority'] == 1): ?>
											<?php  echo smarty_function_math(array('equation' => "x - y - z",'x' => $this->_tpl_vars['listingid_second']['package']['price'],'y' => $this->_tpl_vars['listingid_second']['package']['featured_price'],'z' => $this->_tpl_vars['listingid_second']['package']['priority_price']), $this);?>

					
										<?php  elseif ($this->_tpl_vars['listingid_second']['package']['featured'] == 0 && $this->_tpl_vars['listingid_second']['package']['priority'] == 0): ?>
											<?php  echo $this->_tpl_vars['listingid_second']['package']['price']; ?>

										<?php  endif; ?> 
									</td>
			
									<td style="text-align: center;">
										<?php  if ($this->_tpl_vars['listingid_second']['package']['featured'] == 1): ?><span style="display: none;"><?php  echo $this->_tpl_vars['f']++; ?>
</span>+ $<?php  echo $this->_tpl_vars['listingid_second']['package']['featured_price']; ?>
 <span style="color: #333; font-size: 10px;">(<a style="text-decoration: underline;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/payment-page/?payment_id=<?php  echo $this->_tpl_vars['payment']->getId(); ?>
&action=cancel_addon&addon=featured&listing_sid=<?php  echo $this->_tpl_vars['listingid_second']['id']; ?>
">delete</a>)</span><?php  else: ?>-<?php  endif; ?>
									</td>
									<td style="text-align: center;">
										<?php  if ($this->_tpl_vars['listingid_second']['package']['priority'] == 1): ?><span style="display: none;"><?php  echo $this->_tpl_vars['p']++; ?>
</span>+ $<?php  echo $this->_tpl_vars['listingid_second']['package']['priority_price']; ?>
 <span style="color: #333; font-size: 10px;">(<a style="text-decoration: underline;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/payment-page/?payment_id=<?php  echo $this->_tpl_vars['payment']->getId(); ?>
&action=cancel_addon&addon=priority&listing_sid=<?php  echo $this->_tpl_vars['listingid_second']['id']; ?>
">delete</a>)</span><?php  else: ?>-<?php  endif; ?>
									</td>
								<?php  endif; ?>
							<?php  endforeach; endif; unset($_from); ?>
						</tr>
					
										
					<?php  elseif ($this->_tpl_vars['checked_listings_in_url']): ?>
													<?php  $_from = $this->_tpl_vars['checked_listings_in_url']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['listing_in_url']):
?>
								<tr>
									<?php  $_from = $this->_tpl_vars['listings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['listing_all']):
?>								
										<?php  if ($this->_tpl_vars['listing_in_url'] == $this->_tpl_vars['listing_all']['id']): ?>							
											<td>
												<?php  echo $this->_tpl_vars['listing_all']['Title']; ?>

												<?php  if (count ( $this->_tpl_vars['product_info']['listings_ids']['0'] ) > 1): ?> 
													<span style="color: #333; font-size: 10px;">
													(<a style="text-decoration: underline;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/payment-page/?payment_id=<?php  echo $this->_tpl_vars['payment']->getId(); ?>
&action=exclude_and_delete_listing&listing_sid=<?php  echo $this->_tpl_vars['listing_all']['id']; ?>
" onclick="return confirm('<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Are you sure?<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>')"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>)
													</span>
												<?php  endif; ?></td>
											
											<td style="text-align: center;">$
												<?php  if ($this->_tpl_vars['listing_all']['package']['featured'] == 1 && $this->_tpl_vars['listing_all']['package']['priority'] == 0): ?>
													<?php  echo smarty_function_math(array('equation' => "x - y",'x' => $this->_tpl_vars['listing_all']['package']['price'],'y' => $this->_tpl_vars['listing_all']['package']['featured_price']), $this);?>

							
												<?php  elseif ($this->_tpl_vars['listing_all']['package']['featured'] == 0 && $this->_tpl_vars['listing_all']['package']['priority'] == 1): ?>
													<?php  echo smarty_function_math(array('equation' => "x - y",'x' => $this->_tpl_vars['listingid_second']['package']['price'],'y' => $this->_tpl_vars['listingid_second']['package']['priority_price']), $this);?>

							
												<?php  elseif ($this->_tpl_vars['listing_all']['package']['featured'] == 1 && $this->_tpl_vars['listing_all']['package']['priority'] == 1): ?>
													<?php  echo smarty_function_math(array('equation' => "x - y - z",'x' => $this->_tpl_vars['listing_all']['package']['price'],'y' => $this->_tpl_vars['listing_all']['package']['featured_price'],'z' => $this->_tpl_vars['listing_all']['package']['priority_price']), $this);?>

							
												<?php  elseif ($this->_tpl_vars['listing_all']['package']['featured'] == 0 && $this->_tpl_vars['listing_all']['package']['priority'] == 0): ?>
													<?php  echo $this->_tpl_vars['listing_all']['package']['price']; ?>

												<?php  endif; ?> 
											</td>
					
											<td style="text-align: center;">
												<?php  if ($this->_tpl_vars['listing_all']['package']['featured'] == 1): ?><span style="display: none;"><?php  echo $this->_tpl_vars['f']++; ?>
</span>+ $<?php  echo $this->_tpl_vars['listing_all']['package']['featured_price']; ?>
 <span style="color: #333; font-size: 10px;">(<a style="text-decoration: underline;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/payment-page/?payment_id=<?php  echo $this->_tpl_vars['payment']->getId(); ?>
&action=cancel_addon&addon=featured&listing_sid=<?php  echo $this->_tpl_vars['listing_all']['id']; ?>
">delete</a>)</span><?php  else: ?>-<?php  endif; ?>
											</td>
											<td style="text-align: center;">
												<?php  if ($this->_tpl_vars['listing_all']['package']['priority'] == 1): ?><span style="display: none;"><?php  echo $this->_tpl_vars['p']++; ?>
</span>+ $<?php  echo $this->_tpl_vars['listing_all']['package']['priority_price']; ?>
 <span style="color: #333; font-size: 10px;">(<a style="text-decoration: underline;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/payment-page/?payment_id=<?php  echo $this->_tpl_vars['payment']->getId(); ?>
&action=cancel_addon&addon=priority&listing_sid=<?php  echo $this->_tpl_vars['listing_all']['id']; ?>
">delete</a>)</span><?php  else: ?>-<?php  endif; ?>
											</td>				
										<?php  endif; ?>
									<?php  endforeach; endif; unset($_from); ?>										
								</tr>
									
							<?php  endforeach; endif; unset($_from); ?>									
											<?php  endif; ?>
				</tbody>	
			</table>

			<p style="font-size: 10px;">In order to exclude a job from the payment or cancel an add-on for the listing click the "delete" near the appropriate item.</p>
			<h3 style="margin-top: 20px; font-size: 14px;">Total Job(s) to Activate: <b><?php  if (count($this->_tpl_vars['product_info']['listings_ids']['0']) == 0): ?>1<?php  else:   echo count($this->_tpl_vars['product_info']['listings_ids']['0']);   endif; ?></b> </h3>
			<p><b>Total Fee: USD$ <?php  echo $this->_tpl_vars['product_info']['price']; ?>
</b></p>	
		<?php  endif; ?>
	</div>	
<?php  endif; ?> 

<?php  $_from = $this->_tpl_vars['checkPaymentErrors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error'] => $this->_tpl_vars['value']):
?>
	<?php  if ($this->_tpl_vars['error'] == 'NOT_OWNER'): ?>
		<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You're not the owner of this payment<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
	<?php  elseif ($this->_tpl_vars['error'] == 'NOT_LOGGED_IN'): ?>
		<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please log in to place a listing. If you do not have an account, please<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Register<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
		<br/><br/>
		<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'users','function' => 'login'), $this);?>

	<?php  endif;   endforeach; else: ?>
	<br />
	<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Dear customer!<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br /><br />

	<?php  ob_start(); ?>
		<?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['product_info']['price'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['product_info']['price'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php  $this->_smarty_vars['capture']['product_info_price'] = ob_get_contents(); ob_end_clean(); ?>

	<?php  $this->assign('product_info_price', $this->_smarty_vars['capture']['product_info_price']); ?>
	<?php  $this->assign('product_info_name', $this->_tpl_vars['product_info']['name']); ?>
	<?php  $this->assign('product_info_subscription_period', $this->_tpl_vars['product_info']['subscription_period']); ?>
	<?php  $this->assign('currency_sign', $this->_tpl_vars['GLOBALS']['settings']['transaction_currency']); ?>

	<?php  if ($this->_tpl_vars['payment']->isRecurring()): ?>
		<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You are going to sign up for a recurring Subscription. Once in $product_info_subscription_period days period a charge in the amount of $currency_sign $product_info_price will automatically be placed on your credit card to renew your subscription.<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php  else: ?>
		<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please make a payment in the amount of <?php  echo $this->_tpl_vars['GLOBALS']['settings']['listing_currency']; ?>
 <?php  echo $this->_tpl_vars['product_info']['price']; ?>
 for the<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 
		<b>
		<?php  if (((is_array($_tmp=$this->_tpl_vars['product_info_name'])) ? $this->_run_mod_handler('count_words', true, $_tmp) : smarty_modifier_count_words($_tmp)) == 9):   echo ((is_array($_tmp=$this->_tpl_vars['product_info_name'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/(Payment for subscription to)/", ' ') : smarty_modifier_regex_replace($_tmp, "/(Payment for subscription to)/", ' ')); ?>

		<?php  else:   echo ((is_array($_tmp=$this->_tpl_vars['product_info_name'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/(Payment for)/", ' ') : smarty_modifier_regex_replace($_tmp, "/(Payment for)/", ' ')); ?>

		<?php  endif; ?></b>
	
		<?php  if ($this->_tpl_vars['paymentfor'] != "L3NlYXJjaC1yZXN1bWVzLw=="): ?>	
			<?php  $this->assign('paid_listing_id', ((is_array($_tmp=$this->_tpl_vars['product_info_name'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/(Payment for listing ID )/", "") : smarty_modifier_regex_replace($_tmp, "/(Payment for listing ID )/", ""))); ?>			
			<?php  $_from = $this->_tpl_vars['listings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['listing_summary']):
?>		
				<?php  if ($this->_tpl_vars['listing_summary']['id'] == $this->_tpl_vars['paid_listing_id']): ?>
					<p>Title: <b><?php  echo $this->_tpl_vars['listings'][$this->_tpl_vars['listing_summary']['id']]['Title']; ?>
</b></p>
					<p>Featured: <b><?php  if ($this->_tpl_vars['listings'][$this->_tpl_vars['listing_summary']['id']]['featured']): ?> yes <?php  else: ?> no <?php  endif; ?></b></p>
					<p>Priority: <b><?php  if ($this->_tpl_vars['listings'][$this->_tpl_vars['listing_summary']['id']]['priority']): ?> yes <?php  else: ?> no <?php  endif; ?></b></p>
					<p>ID: <?php  echo $this->_tpl_vars['listings'][$this->_tpl_vars['listing_summary']['id']]['id']; ?>
</p>			
				<?php  endif; ?>
			<?php  endforeach; endif; unset($_from); ?>
		<?php  endif; ?>
	<?php  endif; ?>


	<?php  if ($this->_tpl_vars['errors']): ?>
		<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>The following errors occured:<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br />
		<?php  $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error'] => $this->_tpl_vars['error_data']):
?>
			<?php  if ($this->_tpl_vars['error'] == 'NOT_IMPLEMENTED'): ?><p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There is something missing in the code<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p><?php  endif; ?>
			<?php  if ($this->_tpl_vars['error'] == 'PRODUCT_PRICE_IS_NOT_SET'): ?><p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No price is defined for this payment<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p><?php  endif; ?>
			<?php  if ($this->_tpl_vars['error'] == 'PRODUCT_NAME_IS_NOT_SET'): ?><p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Product name is not defined<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p><?php  endif; ?>
		<?php  endforeach; endif; unset($_from); ?>
	<?php  endif; ?>

	<br /><br /><p><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose from the following payment methods:<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
	<?php  $_from = $this->_tpl_vars['gateways']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['gateway']):
?>		
		<form action="<?php  echo $this->_tpl_vars['gateway']['url']; ?>
" method="post">
			<?php  echo $this->_tpl_vars['gateway']['hidden_fields']; ?>

			<br/><input type='submit' 
			<?php  if ($this->_tpl_vars['gateway']['caption'] == "Authorize.Net"): ?> 
			value ='Pay by credit card' 
			<?php  else: ?>
			value='<?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['gateway']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['gateway']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>'
			<?php  endif; ?>
			class="paymentButton gatewayLabel" />
		</form>
	<?php  endforeach; endif; unset($_from);   endif; unset($_from); ?>
