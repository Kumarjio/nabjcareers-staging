<select name="{$id}[geo][radius]">
	<option value="any">[[Miscellaneous!Any Distance:raw]]</option>
	<option value="10" {if $value.radius == 10}selected{/if}>[[Miscellaneous!Within:raw]] 10 [[Miscellaneous!{$GLOBALS.radius_search_unit}:raw]]</option>
	<option value="20" {if $value.radius == 20}selected{/if}>[[Miscellaneous!Within:raw]] 20 [[Miscellaneous!{$GLOBALS.radius_search_unit}:raw]]</option>
	<option value="30" {if $value.radius == 30}selected{/if}>[[Miscellaneous!Within:raw]] 30 [[Miscellaneous!{$GLOBALS.radius_search_unit}:raw]]</option>
	<option value="40" {if $value.radius == 40}selected{/if}>[[Miscellaneous!Within:raw]] 40 [[Miscellaneous!{$GLOBALS.radius_search_unit}:raw]]</option>
	<option value="50" {if $value.radius == 50}selected{/if}>[[Miscellaneous!Within:raw]] 50 [[Miscellaneous!{$GLOBALS.radius_search_unit}:raw]]</option>
</select>