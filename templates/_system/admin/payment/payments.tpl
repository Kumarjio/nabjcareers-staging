{include file="errors.tpl"}
{foreach from=$pages item=page}
	{if $page == $currentPage}
		<strong>{$page}</strong>
	{else}
		{if $page == $totalPages && $currentPage < $totalPages-3} ... {/if}
		<a href="?restore=1&page={$page}{if $sorting_field ne null}&sorting_field={$sorting_field}{/if}{if $sorting_order ne null}&sorting_order={$sorting_order}{/if}{$searchFields}{if $online}&online=1{/if}">{$page}</a>
		{if $page == 1 && $currentPage > 4} ... {/if}
	{/if}
{/foreach}

<form method="post" name="payments_form">
	<input type="hidden" name="action_name" id="action_name" value="" />
	
	<span class="greenButtonInEnd"><input type="button" name="action" value="Endorse" class="greenButtonIn" onclick="if ( confirm('Are you sure you want to endorse selected payment(s)?') ) submitForm('endorse');"></span>
	<span class="greenButtonInEnd"><input type="button" name="action" value="Open Invoices" class="greenButtonIn" onclick="location.href ='{$GLOBALS.site_url}/system/payment/open_invoices';"></span>
	<span class="deleteButtonEnd"><input type="button" name="action" value="Delete" class="deleteButton" onclick="if ( confirm('Are you sure you want to delete selected payment(s)?') ) submitForm('delete');"></span>
	<div class="clr"><br/></div>
	
	<table>
		<thead>
		    <tr>
		        <th><input type="checkbox" id="all_checkboxes_control"></th>
		        <th>
		            <a href="?restore=1&sorting_field=sid&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'sid'}DESC{else}ASC{/if}">Invoice #</a>
					{if $sorting_field == 'sid'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.gif">{else}<img src="{image}b_up_arrow.gif">{/if}{/if}
		        </th>
		        <th>
		            <a href="?restore=1&sorting_field=creation_date&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'creation_date'}DESC{else}ASC{/if}">Date</a>
					{if $sorting_field == 'creation_date'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.gif">{else}<img src="{image}b_up_arrow.gif">{/if}{/if}
		        </th>
		        <th>Description</th>
		        <th>
		            <a href="?restore=1&sorting_field=username&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'username'}DESC{else}ASC{/if}">User Name</a>
					{if $sorting_field == 'username'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.gif">{else}<img src="{image}b_up_arrow.gif">{/if}{/if}
		        </th>
			    <th>
				    <a href="?restore=1&sorting_field=companyname&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'companyname'}DESC{else}ASC{/if}">Company</a>
			        {if $sorting_field == 'copanyname'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.gif">{else}<img src="{image}b_up_arrow.gif">{/if}{/if}
			    </th>
		        <th>
		            <a href="?restore=1&sorting_field=price&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'price'}DESC{else}ASC{/if}">Debit</a>
					{if $sorting_field == 'price'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.gif">{else}<img src="{image}b_up_arrow.gif">{/if}{/if}
		        </th>
			    <th>
				    <a href="?restore=1&sorting_field=credit&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'price'}DESC{else}ASC{/if}">Credit</a>
			    {if $sorting_field == 'credit'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.gif">{else}<img src="{image}b_up_arrow.gif">{/if}{/if}
			    </th>
		        <th>
		            <a href="?restore=1&sorting_field=status&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'status'}DESC{else}ASC{/if}">Status</a>
					{if $sorting_field == 'status'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.gif">{else}<img src="{image}b_up_arrow.gif">{/if}{/if}
		        </th>
			    <th>Print</th>
			    <th>Email</th>
		    </tr>
		</thead>
		<tbody>
			{foreach from=$found_payments_sids item=payment_sid name=payments_block}
			    <tr class="{cycle values="oddrow,evenrow"}">
			        <td><input type="checkbox" name="payments[{$payment_sid}]" value="1" id="checkbox_{$smarty.foreach.payments_block.iteration}" /></td>
			        <td>{display property='sid' object_sid=$payment_sid}</td>
			        <td>{display property='creation_date' object_sid=$payment_sid}</td>
			        <td>{display property='name' object_sid=$payment_sid}
			        	{foreach from=$listings_titles.$payment_sid.title item=listingtitle}
			        		<br>- {$listingtitle}
						{/foreach}
			        </td>
						
			        <td>
			            {display property='username' object_sid=$payment_sid assign=username}
			            <a href="{$GLOBALS.site_url}/edit-user/?username={$username}">{$username}</a>
			        </td>
				    <td>
	{* CompanyName property added by Eldar *}
					    {* display property='companyname' object_sid=$payment_sid assign=companyname *}
					    {display property='compname' object_sid=$payment_sid assign=compname}
	{* END CompanyName property added by Eldar *}
	
					    <a href="{$GLOBALS.site_url}/edit-user/?companyname={$companyname}">{$compname}</a>
				    </td>
			        <td>{$GLOBALS.settings.transaction_currency}{display property='price' object_sid=$payment_sid}</td>
				    <td>{$GLOBALS.settings.transaction_currency}{display property='credit' object_sid=$payment_sid}</td>
			        <td>{display property='status' object_sid=$payment_sid assign=status}{$status}</td>
				    <td><a href="{$GLOBALS.site_url}/print-invoice/?payment_sid={$payment_sid}">Print</a></td>
				    <td><a href="{$GLOBALS.site_url}/print-invoice/?payment_sid={$payment_sid}&send_email=1">Email</a></td>
			    </tr>
			{/foreach}
		</tbody>
		<thead>
		    <tr>
		        <th colspan="6">Total Amount</th>
		        <th>{$GLOBALS.settings.transaction_currency}{$total_price}</th>
			    <th></th>
			    <th colspan="3">&nbsp;</th>
		    </tr>
	    </thead>
	</table>
	
	<div class="clr"><br/></div>
	<span class="greenButtonInEnd"><input type="button" name="action" value="Endorse" class="greenButtonIn" onclick="if (confirm('Are you sure you want to endorse selected payment(s)?')) submitForm('endorse');"></span>
	<span class="deleteButtonEnd"><input type="button" name="action" value="Delete" class="deleteButton" onclick="if (confirm('Are you sure you want to delete selected payment(s)?')) submitForm('delete');"></span>
</form>

<script>
	var total={$smarty.foreach.payments_block.total};
	{literal}
	
	
	function set_checkbox(param) {
		for (i = 1; i <= total; i++) {
			if (checkbox = document.getElementById('checkbox_' + i))
				checkbox.checked = param;
		}
	}
	
	$("#all_checkboxes_control").click(function() {
		if ( this.checked == false)
			set_checkbox(false);
		else
			set_checkbox(true);
	});
	
	
	function submitForm(action) {
		document.getElementById('action_name').value = action;
		var form = document.payments_form;
		form.submit();
	}
	{/literal}
</script>