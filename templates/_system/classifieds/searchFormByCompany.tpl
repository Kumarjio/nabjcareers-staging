<form action="{$GLOBALS.site_url}/browse-by-company/" >
	<input type="hidden" name="action" value="search" />
	<fieldset>
		<div class="bcName">[[Company name]]</div>
		<div class="bcField">{search property=CompanyName  template="string.like.tpl"}</div>
		<div class="bcName">[[FormFieldCaptions!Country]]</div>
		<div class="bcFieldSmall">{search property=Country}</div>
	</fieldset>
	<fieldset>
		<div class="bcName">[[FormFieldCaptions!City]]</div>
		<div class="bcField">{search property=City template="string.like.tpl"}</div>
		<div class="bcName">[[FormFieldCaptions!State]]</div>
		<div class="bcFieldSmall">{search property=State}</div>
	</fieldset>
	<input type="submit" class="button" value="[[Find:raw]]" style="float: right;" />
</form>