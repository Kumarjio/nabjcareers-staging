{capture name="select_box_field_distance"}
	<select class="searchGeoDistance" name="{$id}[geo][radius]" {$parameters} >
		<option value="any">[[Miscellaneous!Any Distance:raw]]</option>
		<option value="10" {if $value.radius == 10}selected{/if}>[[Miscellaneous!Within:raw]] 10 [[Miscellaneous!{$GLOBALS.radius_search_unit}:raw]]</option>
		<option value="20" {if $value.radius == 20}selected{/if}>[[Miscellaneous!Within:raw]] 20 [[Miscellaneous!{$GLOBALS.radius_search_unit}:raw]]</option>
		<option value="30" {if $value.radius == 30}selected{/if}>[[Miscellaneous!Within:raw]] 30 [[Miscellaneous!{$GLOBALS.radius_search_unit}:raw]]</option>
		<option value="40" {if $value.radius == 40}selected{/if}>[[Miscellaneous!Within:raw]] 40 [[Miscellaneous!{$GLOBALS.radius_search_unit}:raw]]</option>
		<option value="50" {if $value.radius == 50}selected{/if}>[[Miscellaneous!Within:raw]] 50 [[Miscellaneous!{$GLOBALS.radius_search_unit}:raw]]</option>
	</select>
{/capture}

{capture name="input_text_field_location"}   
	<input type="text" class="searchGeoLocation" name="{$id}[geo][location]" value="{$value.location}" {$parameters} />
{/capture}

{assign var="select_box_field_distance" value="`$smarty.capture.select_box_field_distance`"}
{assign var="input_text_field_location" value="`$smarty.capture.input_text_field_location`"}

[[$select_box_field_distance of Zip $input_text_field_location]]