{*
 * Template for apply to JobG8 listings. 
 * It opened after click 'Apply Now' button of JobG8 listings. 
 *}

{if $errors}

{foreach from=$errors item=error key=error_code}
<p class="error">
{if $error_code == 'UNDEFINED_LISTING_ID'}[[Undefined Listing ID for apply]]
{elseif $error_code == 'WRONG_LISTING_ID_SPECIFIED'} [[There is no listing in the system with the specified ID]]
{/if}
</p>
{/foreach}


{else}

<center>
<h2>Apply Now</h2>
<!-- Jobg8 iframe -->
<iframe border="0" runat="server" height="450px" width="700px" frameborder="0"
src="{$applicationURL}">
</iframe>
<!-- /Jobg8 iframe -->
</center>

{/if}