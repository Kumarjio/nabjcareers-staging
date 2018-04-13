<div class="clr"><br/></div>
{foreach from=$tpl_error item=theError}
    {if $theError eq 'FILE_EXISTS'}
        <p class="error">such template already exists</p>
    {elseif $theError eq 'MODULE_ERROR'}
        <p class="error">there is no such module in system</p>
    {elseif $theError eq 'NOT_VALID_FILENAME_FORMAT'}
        <p class="error">not valid filename format</p>
    {/if}
{/foreach}
<div class="clr"><br/></div>
<form action="{$GLOBALS.site_url}/edit-templates/" method="post">
    <fieldset  style="max-width: 660px;">
        <legend>{if $template_name}Edit Template{else}Add a New Template{/if}</legend>
        <label for="templ_name">Template Name</label>
        <input type="text" value="{$template_name}" name="templ_name" id="templ_name"/>
        <label for="templ_module">Module Name</label>
        <select name="templ_module" id="templ_module">
            {foreach from=$module_list item="module_info" key="system_module_name"}
            <option {if $system_module_name == $module_name}selected{/if} value="{$system_module_name}">{$module_info.display_name}</option>
            {foreachelse}
            <option value="">[[No module is available]]</option>
            {/foreach}
        </select>
        {if $template_name}
	        <input type="hidden" name="action" value="edit"/>
	        <input type="hidden" name="templ_module_or" value="{$module_name}"/>
	        <input type="hidden" name="templ_name_or" value="{$template_name}"/>
	        <span class="greenButtonEnd"><input type="submit" value="Save" name="edit_template" onclick="return confirm('Changing Template name may affect the front-end pages work. Are you sure you want to rename/move this Template?');" class="greenButton" /></span>
        {else}
	        <input type="hidden" name="action" value="add"/>
	        <span class="greenButtonEnd"><input type="submit" value="Add" name="add_template" class="greenButton"/></span>
        {/if}
    </fieldset>
</form>