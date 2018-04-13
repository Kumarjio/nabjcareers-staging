{literal}
<style type="text/css">
ul.tree, ul.tree * {
	list-style-type: none;
	list-style-position: inside;
	margin: 0;
	padding: 0 0 0px 0;
}
ul.tree img.arrow {
	padding: 2px 0 0 0;
	border: 0;
	width: 15px;
}
ul.tree li {
    padding: 0 0 0 0;
    clear:both;
}
ul.tree li ul {
	padding: 0 0 0 20px;
	margin: 0;
}
ul.tree label {
	cursor: pointer;
	padding: 2px 0;
}
ul.tree label.hover {
	color: red;
}
p {
	margin: 5px 15px;
}
ul.tree {
	margin-top: 5px;
	margin-bottom: 5px;
}
ul.tree li .arrow {
	width: 16px;
	height: 16px;
	padding: 0;
	margin: 0;
	cursor: pointer;
	float: left;
	background: transparent no-repeat 0 0px;
	background-image: url({/literal}{$GLOBALS.user_site_url}{literal}/system/ext/jquery/ltL_nes.gif);
}
ul.tree li .collapsed {
	background-image: url({/literal}{$GLOBALS.user_site_url}{literal}/system/ext/jquery/ltP_nes.gif);
}
ul.tree li .expanded {
	background-image: url({/literal}{$GLOBALS.user_site_url}{literal}/system/ext/jquery/ltM_ne.gif);
}

ul.tree li .checkbox {
    width: 16px;
    height: 16px;
    padding: 0;
    margin: 0;
    cursor: pointer;
    float: left;
    background: url({/literal}{$GLOBALS.user_site_url}{literal}/system/ext/jquery/cbUnchecked.gif) no-repeat center top;
}

ul.tree li .checked {
	background-image: url({/literal}{$GLOBALS.user_site_url}{literal}/system/ext/jquery/cbChecked.gif);
}
ul.tree li .half_checked {
	background-image: url({/literal}{$GLOBALS.user_site_url}{literal}/system/ext/jquery/cbIntermediate.gif);
}


div.tree_button {
		cursor:pointer;
        width:313px;
        height:17px;
        padding-top: 3px;
        border:1px solid #B3B3B3;
		color:#484846;
		font-family:verdana;
		font-size:12px;
		background:url({/literal}{$GLOBALS.user_site_url}{literal}/system/ext/jquery/arrow_tree.png) right center no-repeat #fff;
}

.select-free-fix
{
 position:absolute;
 z-index:10;
 overflow:hidden;/*must have*/
 width:700px;/*must have for any value*/;
 display:none;
 height:250px;
 background-color: white;
 padding-bottom: 2px;
}

.select-free-fix iframe
{
 display:none;/*sorry for IE5*/
 display/**/:block;/*sorry for IE5*/
 position:absolute;/*must have*/
 top:0;/*must have*/
 left:0;/*must have*/
 z-index:-1;/*must have*/
 filter:mask();/*must have*/
 width:3000px;/*must have for any big value*/
 height:3000px/*must have for any big value*/;
}

.select-free-fix .bd{
	border:solid 1px #aaaaaa;
	overflow: auto;
	height:250px;
	border: 1px solid black;
}

.inner-content-div {
	height: 232px; 
	overflow: auto; 
	margin-top: 3px; 
	overflow-x: auto;
}

*html .inner-content-div {
	width: 700px;
}

</style>
{/literal}
<input type='hidden' name="{if $complexField}{$complexField}[{$id}][{$complexStep}][tree]{else}{$id}[tree]{/if}" id='tree_{$id}_selected' class="{if $complexField}complexField{/if}" value="" />
<script language='JavaScript' type='text/javascript'>

var tree_{$id}_select = new Array({foreach from=$value item=sel key=k}{if $k>0},{/if}{$sel}{/foreach});
var tree_{$id}_select_string = '{foreach from=$value item=sel key=k}{if $k>0},{/if}{$sel}{/foreach}';

var default_frase = '[[Click to select]]';

</script>
<script language='JavaScript' type='text/javascript'>

function change_tree_{$id}_title(){ldelim}
	//var boxes = $("#tree_{$id}").find(".checked:only-child").length;
	var count = 0;
	$("#tree_{$id}").find(".checked").each(function(){ldelim}
		if ($(this).parent("li").children("ul").length == 0) count++; 
	{rdelim});

	var text = default_frase;
	if (count > 0) 
		text = count+" [[selected]] ";
	
	$("#tree_title_{$id}").html(text);
{rdelim}


//SUBMIT SEARCH FORM
$("form").submit(function() {ldelim}
	var request_str = '';
	$("#tree_{$id}").find(".checked").each(function(){ldelim}
		if ($(this).parent("li").children("ul").length == 0) {ldelim}
			if (request_str != '')
				request_str = request_str + ",";
			
			request_str = request_str + $(this).parent("li").children("input").val();
		{rdelim}
	{rdelim});
	
	// save request string in hidden field
	$("#tree_{$id}_selected").val(request_str);

	// remove all checkboxes and add string with elements ids to form
	$("#tree_{$id}").find(".checked").each(function(){ldelim}
		$(this).parent("li").children("input").removeAttr("checked");
	{rdelim});
	
{rdelim});


//DESELECT ALL
$("#tree_{$id}_deselect_all").live("click", function() {ldelim}
	$("#tree_{$id}").find(".checked").each(function(){ldelim}
		// need check CURRENT status: if we uncheck parent, then childrens will removed class 'checked'
		if ( $(this).hasClass('checked') ) {ldelim}
		    fn = $(this).attr('onclick');
			// get params from click event of checked element
			// we need get params from pattern as 'Occupation_tree_check(301, 300, 1)'
		    re = /{$id}[a-zA-Z0-9_]*\((\w+),\s*(\w+),\s*(\w+)\)/;
		    
		    myArr = re.exec(fn);
		    myId = myArr[1];
		    myParentId = myArr[2];
		    myLevel = myArr[3];
		    
		    // uncheck element
		    tree_check_{$id}(myId, myParentId, myLevel);
		    
		{rdelim}
	{rdelim});
	change_tree_{$id}_title();
{rdelim});

</script>

<div id="tree_drop_down_{$id}" class="tree_button">&nbsp;<span id="tree_title_{$id}">[[Click to select]]</span></div>
<div id="tree_div_{$id}" class="select-free-fix">
<div id="div_content_{$id}" class="bd">[[Please wait ...]] <img src='{$GLOBALS.user_site_url}/system/ext/jquery/progbar.gif' alt="[[Please wait ...]]" />
</div>
<!--[if lte IE 6.5]><iframe></iframe><![endif]--></div>

<script type="text/javascript">

var tree_compile_{$id} = false;

{if $url == '/edit-profile/' || $url == '/registration/'}
	var link = "{$GLOBALS.site_url}/get-users-tree/";
{else}
	var link = "{$GLOBALS.site_url}/get-tree/";
{/if}


$.get(link, {ldelim} id: "{$sid}", name: "{$id}", check: tree_{$id}_select_string {rdelim},
		  function(data){ldelim}
				tree_compile_{$id} = true;
				tree_{$id}_control_line = 	'<div style="float: left;">' + 
												'<span id="tree_{$id}_deselect_all" style="vertical-align: top; cursor: pointer;"><small>[[Deselect all]]</small></span>' + 
											'</div>' +  
											'<div style="float: right;">' + 
												'<span id="tree_{$id}_close_text" style="vertical-align:top; cursor:pointer;"><small>[[Close]]</small></span>' +
												'<img id="tree_{$id}_close_button" src="{$GLOBALS.user_site_url}/system/ext/jquery/x.gif" style="margin: 2px; cursor: pointer;">' + 
											'</div>';
				$("#div_content_{$id}").html(tree_{$id}_control_line + "<br /><div class=\"inner-content-div\" style=\"height: 232px; overflow: auto; margin-top: 3px; overflow-x: auto;\">" + data + "</div>");
		    	change_tree_{$id}_title();
		 {rdelim});

{literal}

function tree_expand_{/literal}{$id}{literal}(id)
{
        if ($("#tree_ul_"+id).css("display") == "block"){
        	$("#tree_ul_"+id).hide();
            $("#tree_arrow_"+id).removeClass().addClass("arrow").addClass("collapsed");
        } else {
        	$("#tree_ul_"+id).show();
            $("#tree_arrow_"+id).removeClass().addClass("arrow").addClass("expanded");
        }
 
}

function setChildrenStatus_{/literal}{$id}(myId, act){literal}
{
    $("#tree_li_"+myId).children("ul").each(function(ul){
            $(this).children("li").each(function(li){
                $(this).children(".checkbox").removeClass().addClass("checkbox").addClass(act);
                $(this).children(":checkbox").attr("checked", act);
                    if ($(this).children("ul").size() > 0){
                        var new_my_id = $(this).attr("id");
                        new_my_id = new_my_id.substr(8);
                        {/literal}setChildrenStatus_{$id}(new_my_id, act);{literal}
                    }
            });
     });
}

function setParentStatus_{/literal}{$id}(parent_id){literal}
{
     // if all checked - class checked if none - none else half-checked
     var par_li = $("#tree_li_"+parent_id);
     var total = $('ul > li', par_li).size();
     var sel = $('ul > li .checked', par_li).size();
     var clas = "";
     if (sel == total){// all checked : checked
        clas = "checked";
     } else if (sel > 0){// some checked: half_checked
        clas = "half_checked";
     }
     
     $("#tree_li_"+parent_id).children(".checkbox").removeClass().addClass("checkbox").addClass(clas);
     if (clas == "checked"){ // set checkbox status
        $("#tree_check_"+parent_id).attr("checked", "checked");
     } else {
        $("#tree_check_"+parent_id).removeAttr("checked");
     }
}

function tree_check_{/literal}{$id}{literal}(id, parent_id, level){
    if ($("#tree_check_"+id).attr("checked") == ""){
         var act = "checked";
         $("#tree_check_"+id).attr("checked", act);
    } else {
         var act = "";
         $("#tree_check_"+id).removeAttr("checked");
    }
    // change div class status
    $("#tree_li_"+id).children(".checkbox").removeClass().addClass("checkbox").addClass(act);
    // children
    if ($("#tree_li_"+id).children("ul").size() > 0) setChildrenStatus_{/literal}{$id}{literal}(id, act);
    // parent
    if ( level > 0 ) setParentStatus_{/literal}{$id}{literal}(parent_id);
    if (level == 2){ // 3th level change status root parent
           var root_parent_id = $("#tree_li_"+parent_id).parent("ul").attr("id");
           root_parent_id = root_parent_id.substr(8);
           setParentStatus_{/literal}{$id}{literal}(root_parent_id);
        }
    change_tree_{/literal}{$id}{literal}_title();
}

{/literal}

$("#tree_drop_down_{$id}, #tree_{$id}_close_button, #tree_{$id}_close_text").live("click", function() //click(function () 
		{ldelim}
			if ($("#tree_div_{$id}").css('display') == 'block')
				{ldelim} 
						$("#tree_div_{$id}").css('display', 'none'); 
				{rdelim} else {ldelim}
	       			 var pos = $("#tree_drop_down_{$id}").position();
	        		var pos_top = pos.top + $("#tree_drop_down_{$id}").scrollTop();
			        var h = $("#tree_drop_down_{$id}").innerHeight();
					var tree_h = $("#tree_div_{$id}").height();
					var doc_h = $(window).height();
					
			        if ((pos.top + tree_h + h) > doc_h) 	
				        var top = pos.top - tree_h;
			        						 else 			
				        var top = pos.top+h+2;
			        
			        $("#tree_div_{$id}").css("top",top).css("left",pos.left);
       				$("#tree_div_{$id}").css('display', 'block');
		        {rdelim}  
		{rdelim});


</script>