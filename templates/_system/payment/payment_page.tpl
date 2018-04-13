{$f = 0}

{$f = 0}

<h1>Confirm Total </h1><br/>




{if !$product_info.featured_listing_id && !$product_info.priority_listing_id}
<div id="larger_font">

<table>

	<thead>

		<tr>

			<th width="20%"><b>Title of jobs posted: </b></th>

			<th width="15%">Job posting fee:</th>

		</tr>

	</thead>

			

				

			

			

{* <ul> *} {foreach from=$product_info.listings_ids.0 item=listing_to_pay}

		<tr class="evenrow">

			{* $listing_to_pay *}

			

			{foreach from=$listings item=listingid}

			

			{if $listingid.id == $listing_to_pay}

				<td>{$listingid.Title}</td> 

				<td> USD$ {if $listingid.package.featured == 1 && $listingid.package.priority == 0}{math equation="x - y" x=$listingid.package.price y=50}

				{elseif  $listingid.package.featured == 0 && $listingid.package.priority == 1}{math equation="x - y" x=$listingid.package.price y=50}

				{elseif  $listingid.package.featured == 1 && $listingid.package.priority == 1}{math equation="x - y" x=$listingid.package.price y=100}

				{elseif  $listingid.package.featured == 0 && $listingid.package.priority == 0}{$listingid.package.price}{/if} </td>

				{if $listingid.package.featured == 1}<span style="display: none;">{$f++}</span>{/if} 

				{if $listingid.package.priority == 1}<span style="display: none;">{$p++}</span>{/if} 

			{/if}

			{/foreach}

		</tr>

	{/foreach}



</table>

<h3>Total Job(s) to Activate: <b>{if $product_info.listings_ids.0|@count == 0}1{else}{$product_info.listings_ids.0|@count}{/if}</b> </h3>

<br />

{if $f}<p>Featured Job Fee add-on: +50$</p>

<p>Total Featured Jobs: {$f}</p>

<br />{/if}



{if $p}<p>Priority Job Fee add-on: +50$</p>

<p>Total Priority Jobs: {$p}</p><br />{/if}



<p><b>Total Fee: USD$ {$product_info.price}</b></p>

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

		[[Please make a payment in the amount of $currency_sign $product_info_price for]] <b>{$product_info_name|regex_replace:"/(Payment for)/":" "}</b>

	







	{* ----------- ELDAR ---------------- /my-listings/	*}

	

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

	{* ----------- ELDAR end ---------------------- *}

	

	

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

	{/foreach}



{/foreach}

</div>