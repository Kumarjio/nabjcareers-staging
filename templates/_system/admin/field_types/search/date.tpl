{capture name="input_text_field_from"}<input type="text" name="{$id}[not_less]" value="{$value.not_less}" id="{$id}_notless"/>{/capture}
{capture name="input_text_field_to"}<input type="text" name="{$id}[not_more]" value="{$value.not_more}" id="{$id}_notmore"/>{/capture}
{assign var="input_text_field_from" value="`$smarty.capture.input_text_field_from`"}
{assign var="input_text_field_to" value="`$smarty.capture.input_text_field_to`"}
[[$input_text_field_from to $input_text_field_to]]
<br/>{$GLOBALS.languages.0.date_format}