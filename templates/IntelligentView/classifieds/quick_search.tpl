<div class="clr"></div>
<div class="quickSearchTop">[[Job Search]]</div>
<div class="quickSearch">
	<form action="{$GLOBALS.site_url}/search-results-jobs/">
		<input type="hidden" name="action" value="search" />
		<input type="hidden" name="listing_type[equal]" value="Job" />
		<div style="text-align:center; margin-top:20px"></div>
		<fieldset>
			<div class="quickSearchInputField">[[FormFieldCaptions!Keywords]]<br/>{search property=keywords}</div>
			<div class="quickSearchInputField">[[FormFieldCaptions!Category]]<br/>{search property=JobCategory  template='list.tpl'}</div>
		</fieldset>
		<fieldset>
			<div class="quickSearchInputName">[[FormFieldCaptions!City]]<br/>{search property=City template="string.like.tpl"}</div>
			<div class="quickSearchInputField">[[FormFieldCaptions!Country]]<br/>{search property=Country}</div>
		</fieldset>
		<fieldset>
			<div class="quickSearchInputName"><br/><input type="submit" id="btn-search" class="button" value="[[Search:raw]]"/></div>
			<div class="quickSearchInputName">
				<br/><a href="{$GLOBALS.site_url}/find-jobs/">[[Advanced search]]</a>
				{if $acl->isAllowed('open_search_by_company_form')}
					<br/><a href="{$GLOBALS.site_url}/browse-by-company/">[[Search by Company]]</a>
				{/if}
			</div>
		</fieldset>
	</form>
</div>
<div class="quickSearchBottom"> </div>
<div class="InputStat">{module name="classifieds" function="count_listings"}</div>
<div class="clr"><br/></div>