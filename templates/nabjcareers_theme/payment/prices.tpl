{breadcrumbs}Rate Plans{/breadcrumbs}
<h1>Rate Plans</h1>

<table>
	<thead class="">
	    <tr height="30" class="">
	        <th class="white_label">Name</th>

	        <th class="white_label">Price</th>

	    </tr>
    </thead>
        
    <tbody>
	    {foreach from=$membership_plans item=membership_plan}
		    {if $membership_plan.id != "40" && $membership_plan.id != "39" && $membership_plan.id != "135"}
		    	{if $membership_plan.id != '35'}
			    	<tr class="evenrow prices_table_row">
			        	<td><b>{$membership_plan.name}</b></td>

			        	<td>{if $membership_plan.price==0}Free{else}{$GLOBALS.settings.listing_currency}{$membership_plan.price}{/if}</td>
			    	</tr>
			    	{foreach from=$plan_packages item=plan_package_field}
					{if $membership_plan.id == $plan_package_field.membership_plan_id && ($plan_package_field.plan_id=='40' || $plan_package_field.plan_id=='41' || $plan_package_field.plan_id=='42')}
						<tr class="oddrow prices_table_row">
							<td> - {$plan_package_field.name}</td>

							<td>{if $plan_package_field.price =='0'}Free{else}{$GLOBALS.settings.listing_currency}{$plan_package_field.price}{/if}</td>	
						</tr>
					{/if}
		    		 {/foreach}
			    	
			{else} {* postings plan *}
				 <tr class="evenrow prices_table_row">
			        	<td><b>Job postings</b></td>

			        	<td></td>
			    	</tr>
				{foreach from=$plan_packages item=plan_package_field}
					{if $membership_plan.id == $plan_package_field.membership_plan_id && ($plan_package_field.plan_id=='40' || $plan_package_field.plan_id=='41' || $plan_package_field.plan_id=='42')}
						<tr class="oddrow prices_table_row">
							<td> - {$plan_package_field.name}</td>

							<td>{if $plan_package_field.price =='0'}	Free{else}{$GLOBALS.settings.listing_currency}{$plan_package_field.price}	{/if}</td>								
						</tr>
					{/if}
		    		 {/foreach}
		    		
			    	<tr class="oddrow prices_table_row">
					<td><i> - featured option</i></td>

					<td><i>$35</i></td>								
				</tr>
				<tr class="oddrow prices_table_row">
					<td><i> - priority option</i></td>

					<td><i>$35</i></td>								
				</tr>
				
			{/if}
				
			
		    {/if}
	    {/foreach}
	    	
	</tbody>


</table>