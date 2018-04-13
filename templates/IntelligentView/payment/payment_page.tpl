{$p = 0}
{$f = 0}
<h1>Confirm Total </h1><br/>
	
{if !$product_info.featured_listing_id && !$product_info.priority_listing_id}
	<div id="larger_font">
		{if $product_info.membership_plan_id != 33 && $product_info.membership_plan_id != 37} {* except resume acess plans *}
			<table>
				<thead>
					<tr>
						<th width="20%"><b>Job Title</b></th>
						<th width="15%" style="text-align: center!important;">Job Posting Fee</th>
						<th width="15%" style="text-align: center!important;">Featured Job Add-on Fee</th>
						<th width="15%" style="text-align: center!important;">Priority Job Add-on Fee</th>
					</tr>
				</thead>
				
				<tbody> {* missed tag <tbody>. Added 13-06-2014 *}			
				
					{** 1 **}	
					{if $product_info.listings_ids && $listingsInfo.listingsIDs_payment.0.package }		
						{foreach from=$product_info.listings_ids.0 item=listing_to_pay}
							<tr class="evenrow">
								{foreach from=$listingsInfo.listingsIDs_payment item=listingid}
									{if $listingid.id == $listing_to_pay}		
										<td>
											{$listingid.Title}
											{if count($product_info.listings_ids.0) > 1} 
												<span style="color: #333; font-size: 10px;">
												(<a style="text-decoration: underline;" href="{$GLOBALS.site_url}/payment-page/?payment_id={$payment->getId()}&action=exclude_and_delete_listing&listing_sid={$listingid.id}" onclick="return confirm('[[Are you sure?:raw]]')">[[Delete]]</a>)
												</span>
											{/if}</td>
										
										<td style="text-align: center;">$
											{if $listingid.package.featured == 1 && $listingid.package.priority == 0}
												{math equation="x - y" x=$listingid.package.price y=$listingid.package.featured_price}
						
											{elseif  $listingid.package.featured == 0 && $listingid.package.priority == 1}
												{math equation="x - y" x=$listingid.package.price y=$listingid.package.priority_price}
						
											{elseif  $listingid.package.featured == 1 && $listingid.package.priority == 1}
												{math equation="x - y - z" x=$listingid.package.price y=$listingid.package.featured_price z=$listingid.package.priority_price}
						
											{elseif  $listingid.package.featured == 0 && $listingid.package.priority == 0}
												{$listings.package.price}
											{/if} 
										</td>
				
										<td style="text-align: center;">
											{if $listingid.package.featured == 1}<span style="display: none;">{$f++}</span>+ ${$listingid.package.featured_price} <span style="color: #333; font-size: 10px;">(<a style="text-decoration: underline;" href="{$GLOBALS.site_url}/payment-page/?payment_id={$payment->getId()}&action=cancel_addon&addon=featured&listing_sid={$listingid.id}">delete</a>)</span>{else}-{/if}
										</td>
										<td style="text-align: center;">
											{if $listingid.package.priority == 1}<span style="display: none;">{$p++}</span>+ ${$listingid.package.priority_price} <span style="color: #333; font-size: 10px;">(<a style="text-decoration: underline;" href="{$GLOBALS.site_url}/payment-page/?payment_id={$payment->getId()}&action=cancel_addon&addon=priority&listing_sid={$listingid.id}">delete</a>)</span>{else}-{/if}
										</td>
									{else}
									
									{/if}
								{/foreach}		
							</tr>		
						{/foreach}	
					{** 2 **}
					{elseif $product_info.listings_ids}		
						{foreach from=$product_info.listings_ids.0 item=listing_to_pay}
							<tr class="evenrow">
								{foreach from=$listings item=listingid_2}
									{if $listingid_2.id == $listing_to_pay}		
										<td>
											{$listingid_2.Title}
											{if count($product_info.listings_ids.0) > 1} 
												<span style="color: #333; font-size: 10px;">
												(<a style="text-decoration: underline;" href="{$GLOBALS.site_url}/payment-page/?payment_id={$payment->getId()}&action=exclude_and_delete_listing&listing_sid={$listingid_2.id}" onclick="return confirm('[[Are you sure?:raw]]')">[[Delete]]</a>)
												</span>
											{/if}</td>
										
										<td style="text-align: center;">$
											{if $listingid_2.package.featured == 1 && $listingid_2.package.priority == 0}
												{math equation="x - y" x=$listingid_2.package.price y=$listingid_2.package.featured_price}
						
											{elseif  $listingid_2.package.featured == 0 && $listingid_2.package.priority == 1}
												{math equation="x - y" x=$listingid_2.package.price y=$listingid_2.package.priority_price}
						
											{elseif  $listingid_2.package.featured == 1 && $listingid_2.package.priority == 1}
												{math equation="x - y - z" x=$listingid_2.package.price y=$listingid_2.package.featured_price z=$listingid_2.package.priority_price}
						
											{elseif  $listingid_2.package.featured == 0 && $listingid_2.package.priority == 0}
												{$listingid_2.package.price}
											{/if} 
										</td>
				
										<td style="text-align: center;">
											{if $listingid_2.package.featured == 1}<span style="display: none;">{$f++}</span>+ ${$listingid_2.package.featured_price} <span style="color: #333; font-size: 10px;">(<a style="text-decoration: underline;" href="{$GLOBALS.site_url}/payment-page/?payment_id={$payment->getId()}&action=cancel_addon&addon=featured&listing_sid={$listingid_2.id}">delete</a>)</span>{else}-{/if}
										</td>
										<td style="text-align: center;">
											{if $listingid_2.package.priority == 1}<span style="display: none;">{$p++}</span>+ ${$listingid_2.package.priority_price} <span style="color: #333; font-size: 10px;">(<a style="text-decoration: underline;" href="{$GLOBALS.site_url}/payment-page/?payment_id={$payment->getId()}&action=cancel_addon&addon=priority&listing_sid={$listingid.id}">delete</a>)</span>{else}-{/if}
										</td>
									{else}				
									{/if}
								{/foreach}		
							</tr>		
						{/foreach}	
						
		
					{** 3 **}	{* 05-04-2014 *}
					{elseif $smarty.get.listigid}
						<tr class="evenrow">{$listing_id_from_url}
							{foreach from=$listings item=listingid_second}
								{if $listingid_second.id == $smarty.get.listigid}		
									<td>
										{$listingid_second.Title}
										{if count($product_info.listings_ids.0) > 1} 
											<span style="color: #333; font-size: 10px;">
											(<a style="text-decoration: underline;" href="{$GLOBALS.site_url}/payment-page/?payment_id={$payment->getId()}&action=exclude_and_delete_listing&listing_sid={$listingid_second.id}" onclick="return confirm('[[Are you sure?:raw]]')">[[Delete]]</a>)
											</span>
										{/if}</td>
									
									<td style="text-align: center;">$
										{if $listingid_second.package.featured == 1 && $listingid_second.package.priority == 0}
											{math equation="x - y" x=$listingid_second.package.price y=$listingid_second.package.featured_price}
					
										{elseif  $listingid_second.package.featured == 0 && $listingid_second.package.priority == 1}
											{math equation="x - y" x=$listingid_second.package.price y=$listingid_second.package.priority_price}
					
										{elseif  $listingid_second.package.featured == 1 && $listingid_second.package.priority == 1}
											{math equation="x - y - z" x=$listingid_second.package.price y=$listingid_second.package.featured_price z=$listingid_second.package.priority_price}
					
										{elseif  $listingid_second.package.featured == 0 && $listingid_second.package.priority == 0}
											{$listingid_second.package.price}
										{/if} 
									</td>
			
									<td style="text-align: center;">
										{if $listingid_second.package.featured == 1}<span style="display: none;">{$f++}</span>+ ${$listingid_second.package.featured_price} <span style="color: #333; font-size: 10px;">(<a style="text-decoration: underline;" href="{$GLOBALS.site_url}/payment-page/?payment_id={$payment->getId()}&action=cancel_addon&addon=featured&listing_sid={$listingid_second.id}">delete</a>)</span>{else}-{/if}
									</td>
									<td style="text-align: center;">
										{if $listingid_second.package.priority == 1}<span style="display: none;">{$p++}</span>+ ${$listingid_second.package.priority_price} <span style="color: #333; font-size: 10px;">(<a style="text-decoration: underline;" href="{$GLOBALS.site_url}/payment-page/?payment_id={$payment->getId()}&action=cancel_addon&addon=priority&listing_sid={$listingid_second.id}">delete</a>)</span>{else}-{/if}
									</td>
								{/if}
							{/foreach}
						</tr>
					
					{** 4 **}					
					{elseif $checked_listings_in_url}
						{* 16-05-2014 fix 2 checked_listings_in_url  *}
							{foreach from=$checked_listings_in_url item=listing_in_url}
								<tr>
									{foreach from=$listings item=listing_all}								
										{if $listing_in_url == $listing_all.id}							
											<td>
												{$listing_all.Title}
												{if count($product_info.listings_ids.0) > 1} 
													<span style="color: #333; font-size: 10px;">
													(<a style="text-decoration: underline;" href="{$GLOBALS.site_url}/payment-page/?payment_id={$payment->getId()}&action=exclude_and_delete_listing&listing_sid={$listing_all.id}" onclick="return confirm('[[Are you sure?:raw]]')">[[Delete]]</a>)
													</span>
												{/if}</td>
											
											<td style="text-align: center;">$
												{if $listing_all.package.featured == 1 && $listing_all.package.priority == 0}
													{math equation="x - y" x=$listing_all.package.price y=$listing_all.package.featured_price}
							
												{elseif  $listing_all.package.featured == 0 && $listing_all.package.priority == 1}
													{math equation="x - y" x=$listingid_second.package.price y=$listingid_second.package.priority_price}
							
												{elseif  $listing_all.package.featured == 1 && $listing_all.package.priority == 1}
													{math equation="x - y - z" x=$listing_all.package.price y=$listing_all.package.featured_price z=$listing_all.package.priority_price}
							
												{elseif  $listing_all.package.featured == 0 && $listing_all.package.priority == 0}
													{$listing_all.package.price}
												{/if} 
											</td>
					
											<td style="text-align: center;">
												{if $listing_all.package.featured == 1}<span style="display: none;">{$f++}</span>+ ${$listing_all.package.featured_price} <span style="color: #333; font-size: 10px;">(<a style="text-decoration: underline;" href="{$GLOBALS.site_url}/payment-page/?payment_id={$payment->getId()}&action=cancel_addon&addon=featured&listing_sid={$listing_all.id}">delete</a>)</span>{else}-{/if}
											</td>
											<td style="text-align: center;">
												{if $listing_all.package.priority == 1}<span style="display: none;">{$p++}</span>+ ${$listing_all.package.priority_price} <span style="color: #333; font-size: 10px;">(<a style="text-decoration: underline;" href="{$GLOBALS.site_url}/payment-page/?payment_id={$payment->getId()}&action=cancel_addon&addon=priority&listing_sid={$listing_all.id}">delete</a>)</span>{else}-{/if}
											</td>				
										{/if}
									{/foreach}										
								</tr>
									
							{/foreach}									
						{* END 16-05-2014 fix 2 *}
					{/if}
				</tbody>	
			</table>

			<p style="font-size: 10px;">In order to exclude a job from the payment or cancel an add-on for the listing click the "delete" near the appropriate item.</p>
			<h3 style="margin-top: 20px; font-size: 14px;">Total Job(s) to Activate: <b>{if $product_info.listings_ids.0|@count == 0}1{else}{$product_info.listings_ids.0|@count}{/if}</b> </h3>
			<p><b>Total Fee: USD$ {$product_info.price}</b></p>	
		{/if}
	</div>	
{/if} 

{foreach from=$checkPaymentErrors key=error item=value}
	{if $error == 'NOT_OWNER'}
		<p class="error">[[You're not the owner of this payment]]</p>
	{elseif $error == 'NOT_LOGGED_IN'}
		<p class="error">[[Please log in to place a listing. If you do not have an account, please]] <a href="{$GLOBALS.site_url}">[[Register]]</a></p>
		<br/><br/>
		{module name="users" function="login"}
	{/if}
{foreachelse}
	<br />
	[[Dear customer!]]<br /><br />

	{capture name=product_info_price}
		[[$product_info.price]]
	{/capture}

	{assign var="product_info_price" value=$smarty.capture.product_info_price}
	{assign var="product_info_name" value=$product_info.name}
	{assign var="product_info_subscription_period" value=$product_info.subscription_period}
	{assign var="currency_sign" value=$GLOBALS.settings.transaction_currency}

	{if $payment->isRecurring()}
		[[You are going to sign up for a recurring Subscription. Once in $product_info_subscription_period days period a charge in the amount of $currency_sign $product_info_price will automatically be placed on your credit card to renew your subscription.]]
	{else}
		[[Please make a payment in the amount of {$GLOBALS.settings.listing_currency} {$product_info.price} for the]] 
		<b>
		{if $product_info_name|count_words == 9}{$product_info_name|regex_replace:"/(Payment for subscription to)/":" "}
		{else}{$product_info_name|regex_replace:"/(Payment for)/":" "}
		{/if}</b>
	
		{if $paymentfor != "L3NlYXJjaC1yZXN1bWVzLw==" }	
			{assign var="paid_listing_id" value=$product_info_name|regex_replace:"/(Payment for listing ID )/":""}			
			{foreach from=$listings item=listing_summary}		
				{if $listing_summary.id == $paid_listing_id}
					<p>Title: <b>{$listings[$listing_summary.id].Title}</b></p>
					<p>Featured: <b>{if $listings[$listing_summary.id].featured} yes {else} no {/if}</b></p>
					<p>Priority: <b>{if $listings[$listing_summary.id].priority} yes {else} no {/if}</b></p>
					<p>ID: {$listings[$listing_summary.id].id}</p>			
				{/if}
			{/foreach}
		{/if}
	{/if}


	{if $errors}
		[[The following errors occured:]]<br />
		{foreach from=$errors key=error item=error_data}
			{if $error == 'NOT_IMPLEMENTED'}<p class="error">[[There is something missing in the code]]</p>{/if}
			{if $error == 'PRODUCT_PRICE_IS_NOT_SET'}<p class="error">[[No price is defined for this payment]]</p>{/if}
			{if $error == 'PRODUCT_NAME_IS_NOT_SET'}<p class="error">[[Product name is not defined]]</p>{/if}
		{/foreach}
	{/if}

	<br /><br /><p>[[Please choose from the following payment methods:]]</p>
	{foreach from=$gateways item=gateway}	
	
		{if $gateway.url=="https://secure.quantumgateway.com/cgi/web_order.php"}
			<form action="{$gateway.url}" method="post">
				<br>
				<a type='submit' value='[[$gateway.caption]]' class="paymentButtonA" href='{$GLOBALS.site_url}/quantumgateway/?payment_sid={$payment->getId()}'>
					<span>[[$gateway.caption]]</span>
				</a>
			</form>		
		{else}
				<form action="{$gateway.url}" method="post">
				{$gateway.hidden_fields}
				<br/><input type='submit' 
				{if $gateway.caption=="Authorize.Net"} 
				value ='Pay by credit card' 
				{else}
				value='[[$gateway.caption]]'
				{/if}
				class="paymentButton gatewayLabel" />
			</form>
		{/if}
	
	
	{/foreach}
{/foreach}

