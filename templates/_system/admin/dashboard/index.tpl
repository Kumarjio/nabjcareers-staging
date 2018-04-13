{breadcrumbs}Dashboard{/breadcrumbs}

<div class="dashboardBlocks">
	<h1 class="usersOnline">Users online</h1>
	<table width="100%">
		<tbody>
			<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
				<td><strong>Total Users</strong></td>
				{if $onlineUsers}
				<td align="center"><a href="{$GLOBALS.site_url}/users/?online=1&amp;action=search">{$onlineUsers.JobSeeker.count+$onlineUsers.Employer.count} online</a></td>
				{else}
				<td align="center">0</td>
				{/if}
			</tr>
			{if $onlineUsers}
			{foreach key=key name=outer item=value from=$onlineUsers}
			<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
				<td><strong>{$value.caption}</strong></td>
				<td align="center"><a href="{$GLOBALS.site_url}/users/?user_group%5Bequal%5D={$key}&amp;online=1&amp;action=search">{$value.count} online</a></td>
			</tr>
			{/foreach}
			{else}
			<tr class="{cycle values = 'evenrow,oddrow' advance=false}">
				<td colspan="2"><strong>No online users</strong></td>
			</tr>
			{/if}
		</tbody>
	</table>
</div>

<div class="dashboardBlocks">
	<h1 class="payments"><a href="{$GLOBALS.site_url}/system/payment/payments/?creation_date%5Bnot_less%5D=&amp;creation_date%5Bnot_more%5D=&amp;action=filter&amp;status%5Bequal%5D=">Payments</a></h1>
	<table width="100%">
		<thead>
			<tr>
				<th align="center">Period</th>
				<th align="center">Completed</th>
				<th align="center">Pending</th>
			</tr>
		</thead>
		<tbodY>
			{foreach key=key name=outer item=paymentPeriod from=$paymentsInfo}
			<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
				<td>{$key}{$test.payment}</td>
				{foreach key=key1 item=paymentInfo from=$paymentPeriod}
					{foreach key=key2 item=Info from=$paymentInfo}
						<td align="center"><a href="{$GLOBALS.site_url}/system/payment/payments/?creation_date%5Bnot_less%5D={if $key == "Today"}{$today}{/if}{if $key == "This Week"}{$weekAgo}{/if}{if $key == "This Month"}{$monthAgo}{/if}&amp;creation_date%5Bnot_more%5D={$today}&amp;action=filter&amp;status%5Bequal%5D={if $key1 =="completed"}Completed{else}Pending{/if}">{$GLOBALS.settings.transaction_currency}{$Info.payment|string_format:"%.2f"}</a></td>
					{/foreach}
				{/foreach}
			</tr>
			{/foreach}
			<tr class="{cycle values = 'evenrow,oddrow' advance=false}">
				<td><strong>Total</strong></td>
				<td align="center"><strong><a href="{$GLOBALS.site_url}/system/payment/payments/?creation_date%5Bnot_less%5D=&amp;creation_date%5Bnot_more%5D=&amp;action=filter&amp;status%5Bequal%5D=Completed"><b>{$GLOBALS.settings.transaction_currency}{$totalPayments|string_format:"%.2f"}</b></a></strong></td>
				<td align="center"><strong><a href="{$GLOBALS.site_url}/system/payment/payments/?creation_date%5Bnot_less%5D=&amp;creation_date%5Bnot_more%5D=&amp;action=filter&amp;status%5Bequal%5D=Pending"><b>{$GLOBALS.settings.transaction_currency}{$pendingPayments|string_format:"%.2f"}</b></a></strong></td>
			</tr>
		</tbodY>
	</table>
</div>
<div class="clr"><br/></div>

<div class="dashboardBlocks">
	<h1 class="registered"><a title="Total registered users"href="{$GLOBALS.site_url}/users/">Registered Users: {$usersInfo.count}</a></h1>
	{foreach key=key name=outer item=groupInfo from=$groupsInfo}
	{if $groupInfo.approveInfo neq ''}
		{if $groupInfo.approveInfo.Pending neq ''}
				<a href="{$GLOBALS.site_url}/users/?user_group%5Bequal%5D={$groupInfo.approveInfo.user_group_id}&amp;approval%5Bequal%5D=pending"><strong>Waiting for approval: {$groupInfo.approveInfo.Pending}</strong></a>
		{else}
				<strong>Waiting for approval: 0</strong>
		{/if}
	{/if}
	<table width="100%">
		<thead>
			<tr>
				<th><b>{$groupInfo.caption}</b></th>
				<th align="center">Active</th>
				<th align="center">Not active</th>
				<th align="center">Total</th>
			</tr>
		</thead>
		<tbody>
			{foreach item=group key=period from=$groupInfo.periods}
				<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
					<td>{$period}</td>
					<td align="center"><a href="{$GLOBALS.site_url}/users/?user_group%5Bequal%5D={$key}&amp;action=search&amp;active%5Bequal%5D=1&amp;registration_date%5Bnot_less%5D={if $period == "Today"}{$today}{/if}{if $period == "This Week"}{$weekAgo}{/if}{if $period == "This Month"}{$monthAgo}{/if}">{$group.active}</a></td>
					<td align="center"><a href="{$GLOBALS.site_url}/users/?user_group%5Bequal%5D={$key}&amp;action=search&amp;active%5Bequal%5D=0&amp;registration_date%5Bnot_less%5D={if $period == "Today"}{$today}{/if}{if $period == "This Week"}{$weekAgo}{/if}{if $period == "This Month"}{$monthAgo}{/if}">{$group.count-$group.active}</a></td>
					<td align="center"><a href="{$GLOBALS.site_url}/users/?user_group%5Bequal%5D={$key}&amp;action=search&amp;registration_date%5Bnot_less%5D={if $period == "Today"}{$today}{/if}{if $period == "This Week"}{$weekAgo}{/if}{if $period == "This Month"}{$monthAgo}{/if}">{$group.count}</a></td>
				</tr>
			{/foreach}
			<tr class="{cycle values = 'evenrow,oddrow' advance=false}">
				<td><strong>Totals</strong></td>
				<td align="center"><strong><a href="{$GLOBALS.site_url}/users/?user_group%5Bequal%5D={$key}&amp;action=search&amp;active%5Bequal%5D=1">{$groupInfo.total.active}</a></strong></td>
				<td align="center"><strong><a href="{$GLOBALS.site_url}/users/?user_group%5Bequal%5D={$key}&amp;action=search&amp;active%5Bequal%5D=0">{$groupInfo.total.count-$groupInfo.total.active}</a></strong></td>
				<td align="center"><strong><a href="{$GLOBALS.site_url}/users/?user_group%5Bequal%5D={$key}&amp;action=search">{$groupInfo.total.count}</a></strong></td>
			</tr>
		</tbody>
	</table>
	<br/>
	{/foreach}
</div>

<div class="dashboardBlocks">
	{assign var="totalPostings" value="0"}
	{foreach key=key name=outer item=listingInfo from=$listingsInfo}
		{assign var="totalPostings" value="`$listingInfo.total.count+$totalPostings`"}
	{/foreach}
	<h1 class="postings"><a title="Total postings" href="{$GLOBALS.site_url}/manage-listings/?action=search">Postings: {$totalPostings}</a></h1>
	{foreach key=key name=outer item=listingInfo from=$listingsInfo}
		{assign var="totalPostings" value="`$listingInfo.total.count+$totalPostings`"}
	{/foreach}
	
	{foreach key=key name=outer item=listingInfo from=$listingsInfo}
		{if $listingInfo.approveInfo neq ''}
			{if $listingInfo.approveInfo.pending neq ''}
					<a href="{$GLOBALS.site_url}/manage-listings/?action=search&amp;listing_type%5Bequal%5D={$listingInfo.approveInfo.listing_type_id}&amp;status%5Bequal%5D=pending"><strong>Waiting for approval: {$listingInfo.approveInfo.pending}</strong></a>
			{else}
					<strong>Waiting for approval: 0</strong>
			{/if}
		{/if}
		<table width="100%">
			<thead>
				<tr class="headrow">
					<th>
						{$key}<br/>
						{if $totalFlagsNum.$key > 0}<a href="{$GLOBALS.site_url}/flagged-listings/?listing_type_id={$key}"><strong>Flagged: {$totalFlagsNum.$key}</strong></a>{/if}
					</th>
					<th>Active</th>
					<th>Not active</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				{foreach item=listingType key=period from=$listingInfo.periods}
				<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
					<td>{$period}</td>
					<td align="center"><a href="{$GLOBALS.site_url}/manage-listings/?active[equal]=1&amp;listing_type[equal]={$key}&amp;action=search&amp;activation_date[not_less]={if $period == "Today"}{$today}{/if}{if $period == "This Week"}{$weekAgo}{/if}{if $period == "This Month"}{$monthAgo}{/if}"><b>{$listingType.active}</b></a></td>
					<td align="center"><a href="{$GLOBALS.site_url}/manage-listings/?active[equal]=0&amp;listing_type[equal]={$key}&amp;action=search&amp;activation_date[not_less]={if $period == "Today"}{$today}{/if}{if $period == "This Week"}{$weekAgo}{/if}{if $period == "This Month"}{$monthAgo}{/if}"><b>{$listingType.count-$listingType.active}</b></a></td>
					<td align="center"><a href="{$GLOBALS.site_url}/manage-listings/?listing_type[equal]={$key}&amp;action=search&amp;activation_date[not_less]={if $period == "Today"}{$today}{/if}{if $period == "This Week"}{$weekAgo}{/if}{if $period == "This Month"}{$monthAgo}{/if}"><b>{$listingType.count}</b></a></td>
				</tr>
				{/foreach}
				<tr class="{cycle values = 'evenrow,oddrow' advance=false}">
					<td><strong>Totals</strong></td>
					<td align="center"><strong><a href="{$GLOBALS.site_url}/manage-listings/?listing_type[equal]={$key}&amp;action=search&amp;active%5Bequal%5D=1">{$listingInfo.total.active}</a></strong></td>
					<td align="center"><strong><a href="{$GLOBALS.site_url}/manage-listings/?listing_type[equal]={$key}&amp;action=search&amp;active%5Bequal%5D=0">{$listingInfo.total.count-$listingInfo.total.active}</a></strong></td>
					<td align="center"><strong><a href="{$GLOBALS.site_url}/manage-listings/?listing_type[equal]={$key}&amp;action=search">{$listingInfo.total.count}</a></strong></td>
				</tr>
			</tbody>
		</table>
	<br/>
	{/foreach}
</div>

<div class="clr"><br/></div>

<div class="dashboardBlocks">
	<h1 class="quickLinks">Quick links</h1>
	<table width="100%">
		<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
			<td><a href="http://www.smartjobboard.com/wiki/" target="_blank">[[User Manual]]</a></td>
		</tr>
		<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
			<td><a href="{$GLOBALS.site_url}/upload-logo/">[[Upload your logo]]</a></td>
		</tr>
		<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
			<td><a href="{$GLOBALS.site_url}/edit-listing-field/edit-list/?field_sid=198">[[Edit job categories list]]</a></td>
		</tr>
		<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
			<td><a href="{$GLOBALS.site_url}/edit-listing-field/edit-list/?field_sid=214">[[Edit countries list]]</a></td>
		</tr>
		<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
			<td><a href="{$GLOBALS.site_url}/edit-templates/?module_name=main&amp;template_name=main.tpl">[[Edit Home page template]]</a></td>
		</tr>
		<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
			<td><a href="{$GLOBALS.site_url}/edit-templates/?module_name=main&amp;template_name=index.tpl">[[Edit all pages template]]</a></td>
		</tr>
		<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
			<td><a href="{$GLOBALS.site_url}/edit-css/?action=edit&amp;file={$file}">[[Edit CSS file]]</a></td>
		</tr>
		<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
			<td><a href="{$GLOBALS.site_url}/edit-css/?action=edit&amp;file=../templates/_system/main/images/css/form.css">[[Edit Forms CSS file]]</a></td>
		</tr>	
	</table>
</div>

<br />