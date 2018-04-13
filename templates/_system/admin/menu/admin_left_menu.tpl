<script language="JavaScript" type="text/javascript">
{literal}
function trim(str)
{
	while(str.substring(0,1) == " ")
	    str = str.substring(1,str.length);
	while(str.substring(str.length,1) == " ")
	    str = str.substr(0,str.length - 1);
	return str;
}

function get_cookie(rname)
{
	var tmp = "" + document.cookie;
	var newcookie = "";
	var result = "";
	while(tmp.length)
	{
	    splitter = tmp.indexOf(";");
	    if(splitter < 0)
	            splitter = tmp.length + 1;
	    subject = tmp.substring(0, splitter);
	    if(unescape(trim(subject.substring(0,subject.indexOf('=')))) == rname)
	            result = subject.substring(subject.indexOf('=')+1,subject.length);
	    tmp = tmp.substring(splitter + 1, tmp.length);
	}
	return result;
}

function set_cookie(name, value)
{
	document.cookie = escape(name) + "=" + escape(value) + "; path=/;";
}

function Show(cur_id)
{
	set_cookie(cur_id,'v');
	document.getElementById('v'+cur_id).style.display = 'block';
	document.getElementById('s'+cur_id).innerHTML = "<img src='{/literal}{image}menu_opened.png{literal}' style='margin-top:13px; margin-left:10px;' border='0' alt=''/>&nbsp;";
	document.getElementById('ImgId'+cur_id).className = "leftMenuOpen";
}
	
function highlight_menu_title(title_id) 
{
	document.getElementById(title_id).style.color = '#fffff';//'#CA1641';
}

function Hide(cur_id)
{
	set_cookie(cur_id,'h');
	document.getElementById('v'+cur_id).style.display = 'none';
	document.getElementById('s'+cur_id).innerHTML = "<img src='{/literal}{image}menu_closed.png{literal}' style='margin-top:13px' border='0' alt=''/>&nbsp;";
	document.getElementById('ImgId'+cur_id).className = "leftMenu";
}

function ShowHide(cur_id, obj)
{
	if(document.getElementById('v'+cur_id).style.display != 'none') {
	    Hide(cur_id);
	    $(obj).removeClass('leftMenuOpen');
		$(obj).addClass('leftMenu');
	}	else {
		Show(cur_id);
		$(obj).removeClass('leftMenu');
		$(obj).addClass('leftMenuOpen');
	}
}

function Restore(cur_id, hide_def)
{
	if(get_cookie(cur_id)=='h')
	    Hide(cur_id);
	else
	if(get_cookie(cur_id)=='v')
	    Show(cur_id);
	else
	{
	    if(hide_def)
	            Hide(cur_id);
	    else
	            Show(cur_id);
	}
}
{/literal}

</script>

{foreach from=$left_admin_menu key="section" item="section_items" name='menu_block'}
	<div onclick="ShowHide('{$section_items.id}', this)" id="ImgId{$section_items.id}" class="leftMenu">
		<span id="st{$section_items.id}" class="menuName"><span class="borders">{$section}</span></span>
		<span id="s{$section_items.id}" class="menuArrow"></span>
	</div>
	
	<div id="v{$section_items.id}">
	  <div class="menuItems">
			{foreach from=$section_items item="item"}
				{if not $item.id}
                    {assign var=div_id value=$item.title}
					{if $item.title != ""}<div class="{if $item.active}lmsih{else}lmsi{/if}" id="{$div_id|replace:' ':'_'}"><a href="{$item.reference}">{$item.title}</a></div>{/if}
				{/if}
			{/foreach}

			{if $section_items.id=="Users"}
					<div class="lmsi"><a href="{$GLOBALS.site_url}/resume-plans/">Resume plans</a></div>
					<div class="lmsi"><a href="{$GLOBALS.site_url}/job_fairs/?field_sid=334">Manage Job fairs</a></div>
			{/if}

			{if $section_items.id=="Payments"}
					<div class="lmsi"><a href="{$GLOBALS.site_url}/system/payment/payments/">Invoice Log</a></div>
					<div class="lmsi"><a href="{$GLOBALS.site_url}/system/payment/open_invoices">Open Invoices</a></div>
			{/if}
			
			{if $section_items.id=="Listing_Management"}
					<div class="lmsi"><a href="{$GLOBALS.site_url}/deleted-listings/?action=search&listing_type%5Bequal%5D=Job&deleted%5Bequal%5D=1&sorting_field=username&sorting_order=ASC">Deleted jobs</a></div>
					{* <div class="lmsi"><a href="{$GLOBALS.site_url}/deleted-listings/?action=search&listing_type%5Bequal%5D=Job&active%5Bequal%5D=0">Deactivated jobs</a></div> *}
			{/if}
	  </div>
	</div>
	{if $smarty.foreach.menu_block.iteration != $smarty.foreach.menu_block.total}{/if}
	<script type="text/javascript">Restore('{$section_items.id}',true);	</script>
	{if $section_items.active}<script type="text/javascript">Show('{$section_items.id}')</script>{/if}
{/foreach}