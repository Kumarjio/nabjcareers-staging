<div class="Box">
	<h1>[[Find Jobs]]</h1>
	<form action="{$GLOBALS.site_url}/search-results-jobs/">
			<input type="hidden" name="action" value="search" />
			<input type="hidden" name="listing_type[equal]" value="Job" />
			[[FormFieldCaptions!Keywords]]<br/>{search property=keywords}<br/>
			[[FormFieldCaptions!City]]<br/>{search property=City template="string.like.tpl"}<br/>
			[[FormFieldCaptions!State]]<br/>{search property=State}<br/>
			[[FormFieldCaptions!Category]]<br/>{search property=JobCategory template="list.tpl"}<br/>
			<input type="submit" class="button" value="[[Find:raw]]"/></div>
	</form>
</div>