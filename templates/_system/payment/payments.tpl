<div class="clr"><br/></div>
<table>
	<thead>
	    <tr>
	    	<th class="tableLeft"> </th>
	        <th>
	            <a href="?restore=1&amp;sorting_field=id&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'id'}DESC{else}ASC{/if}">[[ID]]</a>
				{if $sorting_field == 'id'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.png" alt="" />{else}<img src="{image}b_up_arrow.png" alt="" />{/if}{/if}
	        </th>
	        <th>
	            <a href="?restore=1&amp;sorting_field=creation_date&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'creation_date'}DESC{else}ASC{/if}">[[Date]]</a>
				{if $sorting_field == 'creation_date'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.png" alt="" />{else}<img src="{image}b_up_arrow.png" alt="" />{/if}{/if}
	        </th>
			{if $subuser}
	        <th nowrap>
		            <a href="?restore=1&sorting_field=subusername&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'subusername'}DESC{else}ASC{/if}">Payer</a>
		            {if $sorting_field == 'subusername'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.png">{else}<img src="{image}b_up_arrow.png">{/if}{/if}
	        </th>
			{/if}
	        <th>[[Description]]</th>
	        <th>
	            <a href="?restore=1&amp;sorting_field=price&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'price'}DESC{else}ASC{/if}">[[Debit]]</a>
				{if $sorting_field == 'price'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.png" alt="" />{else}<img src="{image}b_up_arrow." alt="" />{/if}{/if}
	        </th>
		    <th>
			    <a href="?restore=1&amp;sorting_field=credit&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'credit'}DESC{else}ASC{/if}">[[Credit]]</a>
			    {if $sorting_field == 'credit'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.png" alt="" />{else}<img src="{image}b_up_arrow." alt="" />{/if}{/if}
		    </th>

	        <th>
	            <a href="?restore=1&amp;sorting_field=status&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'status'}DESC{else}ASC{/if}">[[Status]]</a>
				{if $sorting_field == 'status'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.png" alt="" />{else}<img src="{image}b_up_arrow.png" alt="" />{/if}{/if}
	        </th>
	        <th>[[Action]]</th>
	        <th class="tableRight"> </th>
	    </tr>
	   </thead>
	{foreach from=$found_payments_ids item=payment_id}
	    <tr class="{cycle values="oddrow,evenrow"}">
	    	<td></td>
	        <td>{display property='id' object_id=$payment_id}</td>
	        <td>{display property='creation_date' object_id=$payment_id}</td>
	        {if $subuser > 0}
		        <td>{display property='subusername' object_sid=$payment_id}</td>
	        {/if}
	        <td>{display property='name' object_id=$payment_id}</td>
	        <td>{display property='price' object_id=$payment_id assign=debit}</td>
		    <td>{display property='credit' object_id=$payment_id assign=credit}{$credit}</td>
	        <td>{display property='status' object_id=$payment_id assign=status}
		        {if ($credit < $debit)}
	                {if $status=='Completed'}[[Paid]] {elseif $status=='Pending'}[[Pending]]
	                {elseif $status=='Unpaid'}[[Unpaid]]{else}{$status}{/if}
		        {else}
			        [[Paid]]
		        {/if}
	        </td>
	        <td>{if ($credit < $debit)}<a href="?action=Complete&amp;payments[{$payment_id}]=1">[[Complete]]</a>{/if}</td>
	        <td></td>
	    </tr>
	{/foreach}
	<tr>
		<td colspan="9" class="separateListing"><br/></td>
	</tr>
    <tr>
        <td colspan="4"><strong>[[Total Amount]]</strong></td>
        <td><strong>{$total_debit_price}</strong></td>
	    <td><strong>{$total_credit_price}</strong></td>
	    <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td></td>
    </tr>
</table>