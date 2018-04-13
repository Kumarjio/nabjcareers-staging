{if $field.listing_type_sid}

<div class="location">

<a href="{$GLOBALS.site_url}/listing-types/">Listing Types</a> > <a href="{$GLOBALS.site_url}/edit-listing-type/?sid={$type_sid}">{$type_info.name}</a>

 > <a href="{$GLOBALS.site_url}/edit-listing-type-field/?sid={$field_sid}">{$field.caption}</a>

 > <a href="{$GLOBALS.site_url}/edit-listing-field/edit-tree/?field_sid={$field_sid}">Edit Tree</a>

 > Import Tree Data</div>

{else}

<div class="location"><a href="{$GLOBALS.site_url}/listing-fields/">Listing Fields</a>

 > <a href="{$GLOBALS.site_url}/edit-listing-field/?sid={$field_sid}">{$field.caption}</a>

 > <a href="{$GLOBALS.site_url}/edit-listing-field/edit-tree/?field_sid={$field_sid}">Edit Tree</a>
 
 > Import Tree Data</div>

{/if}


<p class="page_title">Import Tree Data</p>

Number of imported items: {$count}