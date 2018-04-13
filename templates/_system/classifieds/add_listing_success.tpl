<img src="{image}point_left_menu.gif" class="headerImg" alt="" />
<h1>[[Add Listing]]</h1>

[[Your listing was successfully added to the system!]]

<p><a href="{$GLOBALS.site_url}/display-listing/{$listing_id}/"> [[Preview Listing]]</a></p>
<p><a href="{$GLOBALS.site_url}/edit-listing/?listing_id={$listing_id}"> [[Edit Listing]]</a></p>

{if $no_more_active_listing}

[[You've got the limit of the number of the active listings]]

{elseif !$is_free}

<p><a href="{$GLOBALS.site_url}/pay-for-listing/?listing_id={$listing_id}"> [[Pay For Listing]] </a></p>

{/if}