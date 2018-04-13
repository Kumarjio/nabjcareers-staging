{foreach from=$errors item=message key=error}

{if $error eq 'PARAMETERS_MISSED'}

<p class="error">[[The system cannot proceed as some key parameters are missed]]</p>

{elseif $error eq 'WRONG_PARAMETERS_SPECIFIED'}

<p class="error">[[Wrong parameters specified]]</p>

{/if}

{foreachelse}

<p>[[File deleted successfully]]</p>

<a href="{$GLOBALS.site_url}/edit-profile/">[[Back to edit profile]]</a>

{/foreach}