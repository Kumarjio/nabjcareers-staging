{if $liNumResults > 0}
<h1 class="Results">[[LinkedIn People Search Results]]:</h1>
{if $liKeywordEmpty}
<p class="message">[[To see people outside your network, please enter a search keyword.]]</p>
{/if}
<table border="0" class="tableSearchResult" cellpadding="0" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th class="tableLeft">&nbsp;</th>
            <th>&nbsp;</th>
			<th width="25%">[[FormFieldCaptions!Name]]</th>
			<th width="30%">[[FormFieldCaptions!Title]]</th>
			<th>[[Industry]]</th>
			<th>&nbsp;</th>
			<th class="tableRight">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		{*<tr class="sortby">
			<td class="TableSR-L">&nbsp;</td>
			<td class="TableSR-L">&nbsp;</td>
			<td width="200px">[[N</td>
			<td width="200px">[[Name]]</td>
			<td>[[Title]]</td>
			<td>[[Industry]]</td>
			<td class="TableSR-R">&nbsp;</td>
			<td class="TableSR-R">&nbsp;</td>
		</tr>*}
		{foreach item="liPerson" from=$liResults name="liPersons"}
		<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
			<td id="userlist" ></td>
			<td id="userlist" ><div class="linkedinIcon"></div></td>
			<td valign="top" class="pointedInListingInfo">{$liPerson.firstName} {$liPerson.lastName}</td>
			<td style="margin: 0px 0 0 0;" class="pointedInListingInfo">{$liPerson.headline}</td>
			<td class="pointedInListingInfo">{$liPerson.industry}</td>
			<td class="pointedInListingInfo">
				{if $liPerson.url}
				<div style="float: right;margin-left: 7px;">
					<a href="{$liPerson.url}" target="_blank"><img src="{image}viewresume.png" alt="[[go to linkedin profile page]]" class="call"/></a><br />
				</div>
				{/if}
			</td>
			<td class="pointedInListingInfo"></td>
		</tr>
		{/foreach}
	</tbody>
</table>
{elseif isset($liNumResults)}
<div class="headerText">[[LinkedIn People Search Results]]:</div>
{if $liKeywordEmpty}
<p class="message">[[To see people outside your network, please enter a search keyword.]]</p>
{/if}
<p class="message">[[no results from linkedin]]</p>
{/if}