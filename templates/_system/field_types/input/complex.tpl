{assign var="complexField" value=$form_field.id} {* nwy: Если не очистить переменную то в последующих полях начинаются проблемы (некоторые воспринимаются как комплексные)*}
<div id='complexFields_{$complexField}' class="complex">
    {foreach from=$complexElements key="complexElementKey" item="complexElementItem"}
            {if $complexElementKey != 1}
            <div id='complexFieldsAdd_{$complexField}_{$complexElementKey}' class="complex">
        {/if}
        {foreach from=$form_fields item=form_field}
            {if $form_field.id == 'video' || $form_field.id == 'youtube'}
                {if $package.video_allowed}
                    <fieldset>
                        <div class="inputName">[[$form_field.caption]]</div>
                        <div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
                        <div class="inputField">{input property=$form_field.id complexParent=$complexField complexStep=$complexElementKey}</div>
						{if $form_field.instructions}{assign var="instructionsExist" value="1"}{include file="instructions.tpl" form_field=$form_field}{/if}
                    </fieldset>
                {/if}
            {elseif $listing_type_id == "Job" && $form_field.id == "anonymous"}
                {* this empty place of 'anonymous' checkbox in 'Job' listing *}
            {elseif $form_field.id == "access_type"}
                {if $listing_type_id != "Job" && $listing.type.id != "Job"}{* *}
                    <fieldset>
                        <div class="inputName">[[$form_field.caption]]</div>
                        <div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
                        <div class="inputField">{input property=$form_field.id template='resume_access.tpl' complexParent=$complexField complexStep=$complexElementKey}</div>
						{if $form_field.instructions}{assign var="instructionsExist" value="1"}{include file="instructions.tpl" form_field=$form_field}{/if}
                    </fieldset>
                {/if}
            {elseif ($listing_type_id == "Job" || $listing.type.id == "Job") && $form_field.id =='ApplicationSettings'}
                <fieldset>
                    <div class="inputName">[[$form_field.caption]]</div>
                    <div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
                    <div class="inputField">{input property=$form_field.id template='applicationSettings.tpl' complexParent=$complexField complexStep=$complexElementKey}</div>
					{if $form_field.instructions}{assign var="instructionsExist" value="1"}{include file="instructions.tpl" form_field=$form_field}{/if}
                </fieldset>
            {else}
                <fieldset>
                    <div class="inputName">[[$form_field.caption]]</div>
                    <div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
                    <div class="inputField">{input property=$form_field.id complexParent=$complexField complexStep=$complexElementKey}</div>
					{if $form_field.instructions}{assign var="instructionsExist" value="1"}{include file="instructions.tpl" form_field=$form_field}{/if}
                </fieldset>
            {/if}
        {/foreach}
        {if $complexElementKey == 1}
            </div><div id='complexFieldsAdd_{$complexField}'>
        {else}
            <a href='' class="remove" onclick='removeComplexField_{$complexField}({$complexElementKey}); return false;' >[[Remove]]</a></div>
        {/if}
    {/foreach}
</div>
<a href='#' class="add" onclick='addComplexField_{$complexField}(); return false;' >[[Add]]</a>

<script>

	var i_{$complexField} = {$complexElementKey} + 1;

	var dFormat = '{$GLOBALS.current_language_data.date_format}';
	dFormat = dFormat.replace('%m', "mm");
	dFormat = dFormat.replace('%d', "dd");
	dFormat = dFormat.replace('%Y', "yy");

	function addComplexField_{$complexField}() {ldelim}
		var id = "complexFieldsAdd_{$complexField}_" + i_{$complexField};
		var newField = $('#complexFields_{$complexField}').clone();
		newField.append('<a class="remove" href="" onclick="removeComplexField_{$complexField}(' + i_{$complexField} + '); return false;">[[Remove]]</a><br/>');
		$("<div id='" + id + "' />").appendTo("#complexFieldsAdd_{$complexField}");
		newField.appendTo('#' + id);
		$('#'+ id +' input[type=text]').val('');
		$('#'+ id +' input[type=file]').val('');
		$('#'+ id +' select').val('');
		$('#'+ id +' textarea').val('');
		$('#'+ id +' .complexField').each(function() {ldelim}
				$(this).attr( 'name',  $(this).attr( 'name' ).replace('[1]', '['+i_{$complexField}+']'));
			{rdelim}
		);
		$('#'+ id +' .complex-view-file-caption').remove();

		var img = $('#'+ id +' input').next('.ui-datepicker-trigger');
		var el = img.prev('.input-date');
		el.removeAttr('id').removeClass('hasDatepicker').unbind();
		el.datepicker({literal}{
                dateFormat: dFormat,
                showOn: 'button',
                changeMonth: true,
                changeYear: true,
                minDate: new Date(1940, 1 - 1, 1),
                maxDate: '+0m +0w',
                yearRange: '-99:+99',
                buttonImage: '{/literal}{$GLOBALS.user_site_url}/system/ext/jquery/calendar.gif{literal}',
                buttonImageOnly: true
            });
            img.remove();
		if(typeof window.instructionFunc == 'function') {
			instructionFunc();
		}
        {/literal}
		i_{$complexField}++;

	{rdelim}

    function removeComplexField_{$complexField}(id) {ldelim}
        $('#complexFieldsAdd_{$complexField}_' + id).remove();
	{rdelim}

</script>

{assign var="complexField" value=false} {* nwy: Если не очистить переменную то в последующих полях начинаются проблемы (некоторые воспринимаются как комплексные)*}