{breadcrumbs}<a href="{$GLOBALS.site_url}/system/miscellaneous/plugins/">Plugins</a> &#187; <a href="{$GLOBALS.site_url}/system/miscellaneous/plugins/?action=settings&amp;plugin={$plugin.name}">{$plugin.name} Settings</a> &#187; Add New Feed{/breadcrumbs}
<h1>Add New Feed</h1>
{foreach from=$field_errors item=error key=field_caption}
        {if $error eq 'EMPTY_VALUE'}
    		{if $field_caption == "Enter code from image"}
            	<p class="error">[[Enter Security code]]</p>
            {else}
            	<p class="error">'[[FormFieldCaptions!{$field_caption}]]' [[is empty]]</p>
            {/if}
        {elseif $error eq 'NOT_UNIQUE_VALUE'}
            <p class="error">'{$field_caption}' [[this value is already used in the system]]</p>
        {elseif $error eq 'DATA_LENGTH_IS_EXCEEDED'}
            <p class="error">'{$field_caption}' [[length is exceeded]]</p>
        {elseif $error eq 'NOT_INT_VALUE'}
            <p class="error">'{$field_caption}' [[is not an integer value]]</p>
        {elseif $error eq 'OUT_OF_RANGE'}
            <p class="error">'{$field_caption}' [[value is out of range]]</p>
        {elseif $error eq 'NOT_FLOAT_VALUE'}
            <p class="error">'{$field_caption}' [[is not an float value]]</p>
        {elseif $error eq 'LOCATION_NOT_EXISTS'}
            <p class="error">'[[FormFieldCaptions!{$field_caption}]]' [[is unknown]]</p>
        {elseif $error eq 'NOT_VALID_ID_VALUE'}
            <p class="error">'{$field_caption}' [[is not valid]]</p>
        {elseif $error eq 'NOT_VALID'}
    		{if $field_caption == "Enter code from image"}
            	<p class="error">[[Security code is not valid]]</p>
            {else}
            	<p class="error">'{$field_caption}' [[is not valid]]</p>
            {/if}
        {elseif $error eq 'HAS_BAD_WORDS'}
        	<p class="error">'{$field_caption}' [[has bad words]]</p>
        {else}
       		<p class="error">{$error}</p>
        {/if}
{/foreach}
<form method="POST" id="addForm">
	<input type="hidden" name="action" value="save_feed" />
	<input type="hidden" name="plugin" value="{$plugin.name}" />
	{if $feed_sid}<input type="hidden" name="sid" value="{$feed_sid}" />{/if}
	<table>
		<thead>
        	<tr>
        		<th colspan="4">Twitter Login</th>
        	</tr>
        </thead>
        {foreach from=$form_fields item=form_field}
            {if $form_field.id == 'update_every'}
            	<thead>
            		<tr>
            			<th colspan="4">Posting Settings</th>
            		</tr>
            	</thead>
            {/if}
            <tr class="{cycle values = 'evenrow,oddrow'}">
                <td>[[$form_field.caption]]</td>
                <td style="color:#ff0000;">{if $form_field.is_required == 1}*{/if}</td>
                <td {if $form_field.id == 'username' || $form_field.id == 'consumerKey' || $form_field.id == 'consumerSecret' || $form_field.id == 'bitLyUsername' || $form_field.id == 'bitLyAPIKey'}{else}colspan="2"{/if}>
                	{if $form_field.is_system == 1}{input property=$form_field.id}{else}{search property=$form_field.id}{/if}
                	{if $form_field.id == 'update_every'}&nbsp;listings{/if}
                </td>
                {if $form_field.id == 'username'}<td><small>Register on <a href="http://twitter.com" target="_blank">twitter.com</a> and paste your Username to this field.</small></td>{/if}
                {if $form_field.id == 'consumerKey'}<td rowspan="2"><small>Register an application on <a href="http://dev.twitter.com" target="_blank">dev.twitter.com</a> using your twitter account details to sign in.<br/>Then paste the generated API Consumer Key and Consumer Secret to these fields.</small></td>{/if}
                {if $form_field.id == 'bitLyUsername'}<td rowspan="2"><small>Please register at <a href="http://bit.ly" target="_blank">bit.ly</a> and after registration insert your username and generated <a href="http://bit.ly/a/your_api_key" target="_blank">API Key</a> in those fields.</small></td>{/if}
            </tr>
            {if $form_field.comment}<tr><td></td><td></td><td style='font-size:10px;' colspan="2">{$form_field.comment}</td></tr>{/if}
            {if $form_field.id == 'password'}
            	<thead>
            		<tr>
            			<th colspan="4">Filter Criteria</th>
            		</tr>
            	</thead>
            {/if}
        {/foreach}
        <tr class="{cycle values = 'evenrow,oddrow'}"><td colspan="4" style="padding: 10px 0 10px 0; font-size:11px; ">If you want a certain field to appear in Twitter posts - copy its code and paste to the "Twitter post template" input field.</td></tr>
        {foreach from=$listingFields item=listingField}
            <tr  class="{cycle values = 'evenrow,oddrow'}">
                <td colspan="2">[[$listingField.caption]]</td>
                <td colspan="2">&#123;$listing.{$listingField.id}&#125;</td>
            </tr>
        {/foreach}
        <tr>
            <td colspan="4"><span class="greenButtonEnd"><input type="submit" name="save" value="Save" class="greenButton" /></span></td>
        </tr>
	</table>
</form>