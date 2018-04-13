{foreach from=$errors item=message key=error}

{if $error eq 'PARAMETERS_MISSED'}

<p class="error">[[The system cannot proceed as some key parameters are missed]]</p>

{elseif $error eq 'WRONG_PARAMETERS_SPECIFIED'}

<p class="error">[[Wrong parameters specified]]</p>

{elseif $error eq 'NOT_OWNER'}

<p class="error">[[You are not owner of this listing]]</p>

{/if}

{foreachelse}

<p>[[File deleted successfully]]</p>

<a href="{$GLOBALS.site_url}/edit-listing/?listing_id={$listing_id}">[[Back to edit listing]]</a>

{/foreach}