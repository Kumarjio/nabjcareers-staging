<table width="99%" border="0" cellspacing="0" cellpadding="2" align="center" bgcolor="#999999" style="margin:8px; border:1px; width:99%">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="3" cellpadding="6" align="center" bgcolor="#ffffff" >
				<tr>
					<td colspan="2">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr valign="top" class="bodytext2">
								<td>
									<span class="bodytext3"><strong>{$GLOBALS.settings.company_name}</strong></span><br>
									{$GLOBALS.settings.address}<br>
									{$GLOBALS.settings.city}, {$GLOBALS.settings.state} {$GLOBALS.settings.postal_code}<br>
									USA<br>
								</td>
								<td align="right" width="220">
									<table width="220" border="0" cellspacing="0" cellpadding="0">
										<tr align="center">
											<td><span class="bodytext4"><strong>Invoice</strong></span></td>
										</tr>
									</table>
									<br>
									<table width="200" border="1" cellspacing="0" cellpadding="0" style="border:1px solid #000;">
										<tr class="bodytext2">
											<th>[[Date]]</th>
											<th>[[Invoice]]#</th>
										</tr>
										<tr align="center" class="bodytext2">
											<td>{$payment_info.creation_date|date_format:"%B %d %Y"}</td>
											<td>{$payment_info.sid}</td>
										</tr>
									</table>
									<br>
								</td>
							</tr>
						</table>

						<table width="100%" border="1" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #000;">
							<tr class="bodytext2"><th width="50%">[[Bill To]]</th><th width="50%">[[Send Payment To]]</th></tr>
							<tr class="bodytext2" align="center">
								<td>
									{$user_info.billingFirstName}<br>
									{$user_info.billingCompany}<br>
									{$user_info.billingAddress}<br>
									{$user_info.billingCity}{if $user_info.billingState != "No State-Outside of the US"}, {$user_info.billingState}{/if} {$user_info.billingZip}<br>
								</td>
								<td>
									{$GLOBALS.settings.company_name}<br>
									{$GLOBALS.settings.address}<br>
									{$GLOBALS.settings.city}, {$GLOBALS.settings.state} {$GLOBALS.settings.postal_code}<br>
									Phone: {$GLOBALS.settings.phone}<br>
								{*	Fax: {$GLOBALS.settings.fax *}
								</td>
							</tr>
						</table>

						<br><br>
						<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border:1px solid #000;">
							<tr class="bodytext2" height="50">
								<th>Description</th><th>[[Date]]</th><th>[[Amount]]</th>
							</tr>
							<tr valign="top" class="bodytext2" height="540">
								<td width="50%">
									{$payment_info.name}
									{if $priority_listing_info}{$priority_listing_info.Title}{/if}
									{if $featured_listing_info}{$featured_listing_info.Title}{/if}
									{foreach from=$listings item=listing}
										<br>{$listing.Title}
										{if $listing.featured && $listing.priority} (featured and priority){/if}
										{if !$listing.featured  && $listing.priority} (priority){/if}
										{if $listing.featured  && !$listing.priority} (featured){/if}
		<br>{if $listing.duration} Duration: {$listing.duration} days{/if}
		{*	<br>{if $listing.0.duration} Duration: {$listing.0.duration} days{/if}
{*		----------								<br>{if $listing.package.listing_lifetime} Duration: {$listing.package.listing_lifetime} days{/if} *}
									<br><br>			
									{/foreach}
								</td>
								<td align="center">
										{if $listing.activation_date}{$listing.activation_date|date_format:"%B %d %Y"}{else}{$payment_info.creation_date|date_format:"%B %d %Y"}{/if}<br>
								</td>
								<td align="center">{$GLOBALS.settings.transaction_currency}{$payment_info.price}</td>
							</tr>
							<tr class="bodytext2" height="50">
								<td colspan="2">Please Make Checks Payable to {$GLOBALS.settings.site_title}</td>
								<td align="center" class="bodytext2"><strong>[[Total]]: {$GLOBALS.settings.transaction_currency}{$payment_info.price}</strong></td>
							</tr>
						</table>
					</td>
				</tr>
			{*	<tr><td>{if $send_email}Invoice successfully send{/if}</td></tr> *}
			</table>
		</td>
	</tr>
</table>
