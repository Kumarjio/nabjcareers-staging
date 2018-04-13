{include file="errors.tpl"}
{foreach from=$pages item=page}
	{if $page == $currentPage}
		<strong>{$page}</strong>
	{else}
		{if $page == $totalPages && $currentPage < $totalPages-3} ... {/if}
		<a href="?restore=1&page={$page}{if $sorting_field ne null}&sorting_field={$sorting_field}{/if}{if $sorting_order ne null}&sorting_order={$sorting_order}{/if}{$searchFields}">{$page}</a>
		{if $page == 1 && $currentPage > 4} ... {/if}
	{/if}
{/foreach}

	<div class="clr"><br/></div>

	{foreach from=$found_open_invoices_sids item=open_invoice_sid name=open_invoices_block}
	<form method="post" name="open_invoices_form_{$open_invoice_sid}" id="open_invoices_form_{$open_invoice_sid}">
		<input type="hidden" name="action" id="action_{$open_invoice_sid}" value="" />
		<input type="hidden" name="open_invoice_sid" id="{$open_invoice_sid}" value="" />
		<fieldset>
		    <table width="100%" cellspacing="0" cellpadding="3" border="0" bgcolor="#ffffff">
			    <thead>
				    <tr>
					    <th>
						    {display property='username' object_sid=$open_invoice_sid assign=username}
						    <a href="{$GLOBALS.site_url}/edit-user/?username={$username}">{$username} - </a>
						

						    {display property='compname' object_sid=$open_invoice_sid assign=compname}
							<a href="{$GLOBALS.site_url}/edit-user/?username={$username}">{$compname}</a>
							
					    </th>
					    <th>
						    <a name="delete" onclick="submitForm('delete', {$open_invoice_sid});" href="#"> [[[delete invoice]]]</a>
						    <a name="close" onclick="submitForm('close', {$open_invoice_sid});" href="#"> [[[close invoice]]]</a>
					    </th>
				    </tr>
			    <thead>
			    <tbody>
			        <tr>
				        <td width="60%">
				            <br>Invoice ID: {display property='payment_sid' object_sid=$open_invoice_sid assign=payment_sid}{$payment_sid}
                            <br>Date: {display property='creation_date' object_sid=$open_invoice_sid}
                            <br>Amount: {display property='amount' object_sid=$open_invoice_sid}
                            <br>Description: {display property='name' object_sid=$open_invoice_sid}
					        {foreach from=$listings_titles.$open_invoice_sid item=title}
					            <br>&nbsp;-&nbsp;{$title}
							{/foreach}
	                    </td>
					    <td>
						    <span>[[Enter credit to apply below]]</span>
						    <input type="text" name="amount" id="amount_{$open_invoice_sid}"/>
						    <span class="greenButtonInEnd"><input type="button" class="greenButtonIn" name="action" value="Apply Credit" onclick="submitForm('apply_credit', {$open_invoice_sid});"></span>
					    </td>
					    					    
					    
{* 18-06-2017 *}			    
    <td>
	    <span>[[Enter new amount]]</span>
	    <input type="text" name="new_amount" id="new_amount_{$open_invoice_sid}"/>
	    <span class="greenButtonInEnd"><input type="button" class="greenButtonIn" name="action" value="Change amount" onclick="submitForm('change_amount', {$open_invoice_sid});"></span>
    </td>
  
{* END 18-06-2017 *}			    

					    
			        </tr>
			    </tbody>
		    </table>
		</fieldset>
	</form>
	{/foreach}


<script>
	var total={$smarty.foreach.open_invoices_block.total};
	{literal}
	
	function submitForm(action, id) {
		document.getElementById('action_'+id).value = action;
		document.getElementById(id).value = id;

		var form = document.getElementById('open_invoices_form_'+id);
		form.submit();
	}
	{/literal}
</script>