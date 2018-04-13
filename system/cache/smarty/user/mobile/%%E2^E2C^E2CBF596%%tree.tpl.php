<?php  /* Smarty version 2.6.14, created on 2015-07-30 20:38:50
         compiled from ../field_types/input/tree.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', '../field_types/input/tree.tpl', 134, false),)), $this); ?>
<?php  echo '
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
	background-image: url(';   echo $this->_tpl_vars['GLOBALS']['user_site_url'];   echo '/system/ext/jquery/ltL_nes.gif);
}
ul.tree li .collapsed {
	background-image: url(';   echo $this->_tpl_vars['GLOBALS']['user_site_url'];   echo '/system/ext/jquery/ltP_nes.gif);
}
ul.tree li .expanded {
	background-image: url(';   echo $this->_tpl_vars['GLOBALS']['user_site_url'];   echo '/system/ext/jquery/ltM_ne.gif);
}

ul.tree li .checkbox {
    width: 16px;
    height: 16px;
    padding: 0;
    margin: 0;
    cursor: pointer;
    float: left;
    background: url(';   echo $this->_tpl_vars['GLOBALS']['user_site_url'];   echo '/system/ext/jquery/cbUnchecked.gif) no-repeat center top;
}

ul.tree li .checked {
	background-image: url(';   echo $this->_tpl_vars['GLOBALS']['user_site_url'];   echo '/system/ext/jquery/cbChecked.gif);
}
ul.tree li .half_checked {
	background-image: url(';   echo $this->_tpl_vars['GLOBALS']['user_site_url'];   echo '/system/ext/jquery/cbIntermediate.gif);
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
		background:url(';   echo $this->_tpl_vars['GLOBALS']['user_site_url'];   echo '/system/ext/jquery/arrow_tree.png) right center no-repeat #fff;
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
'; ?>

<input type='hidden' name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
][tree]<?php  else:   echo $this->_tpl_vars['id']; ?>
[tree]<?php  endif; ?>" id='tree_<?php  echo $this->_tpl_vars['id']; ?>
_selected' class="<?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>" value="" />
<script language='JavaScript' type='text/javascript'>

var tree_<?php  echo $this->_tpl_vars['id']; ?>
_select = new Array(<?php  $_from = $this->_tpl_vars['value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['sel']):
  if ($this->_tpl_vars['k'] > 0): ?>,<?php  endif;   echo $this->_tpl_vars['sel'];   endforeach; endif; unset($_from); ?>);
var tree_<?php  echo $this->_tpl_vars['id']; ?>
_select_string = '<?php  $_from = $this->_tpl_vars['value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['sel']):
  if ($this->_tpl_vars['k'] > 0): ?>,<?php  endif;   echo $this->_tpl_vars['sel'];   endforeach; endif; unset($_from); ?>';

var default_frase = '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Click to select<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>';

</script>
<script language='JavaScript' type='text/javascript'>

function change_tree_<?php  echo $this->_tpl_vars['id']; ?>
_title(){
	//var boxes = $("#tree_<?php  echo $this->_tpl_vars['id']; ?>
").find(".checked:only-child").length;
	var count = 0;
	$("#tree_<?php  echo $this->_tpl_vars['id']; ?>
").find(".checked").each(function(){
		if ($(this).parent("li").children("ul").length == 0) count++; 
	});

	var text = default_frase;
	if (count > 0) 
		text = count+" <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>selected<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> ";
	
	$("#tree_title_<?php  echo $this->_tpl_vars['id']; ?>
").html(text);
}


//SUBMIT SEARCH FORM
$("form").submit(function() {
	var request_str = '';
	$("#tree_<?php  echo $this->_tpl_vars['id']; ?>
").find(".checked").each(function(){
		if ($(this).parent("li").children("ul").length == 0) {
			if (request_str != '')
				request_str = request_str + ",";
			
			request_str = request_str + $(this).parent("li").children("input").val();
		}
	});
	
	// save request string in hidden field
	$("#tree_<?php  echo $this->_tpl_vars['id']; ?>
_selected").val(request_str);

	// remove all checkboxes and add string with elements ids to form
	$("#tree_<?php  echo $this->_tpl_vars['id']; ?>
").find(".checked").each(function(){
		$(this).parent("li").children("input").removeAttr("checked");
	});
	
});


//DESELECT ALL
$("#tree_<?php  echo $this->_tpl_vars['id']; ?>
_deselect_all").live("click", function() {
	$("#tree_<?php  echo $this->_tpl_vars['id']; ?>
").find(".checked").each(function(){
		// need check CURRENT status: if we uncheck parent, then childrens will removed class 'checked'
		if ( $(this).hasClass('checked') ) {
		    fn = $(this).attr('onclick');
			// get params from click event of checked element
			// we need get params from pattern as 'Occupation_tree_check(301, 300, 1)'
		    re = /<?php  echo $this->_tpl_vars['id']; ?>
[a-zA-Z0-9_]*\((\w+),\s*(\w+),\s*(\w+)\)/;
		    
		    myArr = re.exec(fn);
		    myId = myArr[1];
		    myParentId = myArr[2];
		    myLevel = myArr[3];
		    
		    // uncheck element
		    tree_check_<?php  echo $this->_tpl_vars['id']; ?>
(myId, myParentId, myLevel);
		    
		}
	});
	change_tree_<?php  echo $this->_tpl_vars['id']; ?>
_title();
});

</script>

<div id="tree_drop_down_<?php  echo $this->_tpl_vars['id']; ?>
" class="tree_button">&nbsp;<span id="tree_title_<?php  echo $this->_tpl_vars['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Click to select<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></div>
<div id="tree_div_<?php  echo $this->_tpl_vars['id']; ?>
" class="select-free-fix">
<div id="div_content_<?php  echo $this->_tpl_vars['id']; ?>
" class="bd"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <img src='<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/system/ext/jquery/progbar.gif' alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" />
</div>
<!--[if lte IE 6.5]><iframe></iframe><![endif]--></div>

<script type="text/javascript">

var tree_compile_<?php  echo $this->_tpl_vars['id']; ?>
 = false;

<?php  if ($this->_tpl_vars['url'] == '/edit-profile/' || $this->_tpl_vars['url'] == '/registration/'): ?>
	var link = "<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/get-users-tree/";
<?php  else: ?>
	var link = "<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/get-tree/";
<?php  endif; ?>


$.get(link, { id: "<?php  echo $this->_tpl_vars['sid']; ?>
", name: "<?php  echo $this->_tpl_vars['id']; ?>
", check: tree_<?php  echo $this->_tpl_vars['id']; ?>
_select_string },
		  function(data){
				tree_compile_<?php  echo $this->_tpl_vars['id']; ?>
 = true;
				tree_<?php  echo $this->_tpl_vars['id']; ?>
_control_line = 	'<div style="float: left;">' + 
												'<span id="tree_<?php  echo $this->_tpl_vars['id']; ?>
_deselect_all" style="vertical-align: top; cursor: pointer;"><small><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Deselect all<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></small></span>' + 
											'</div>' +  
											'<div style="float: right;">' + 
												'<span id="tree_<?php  echo $this->_tpl_vars['id']; ?>
_close_text" style="vertical-align:top; cursor:pointer;"><small><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Close<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></small></span>' +
												'<img id="tree_<?php  echo $this->_tpl_vars['id']; ?>
_close_button" src="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/system/ext/jquery/x.gif" style="margin: 2px; cursor: pointer;">' + 
											'</div>';
				$("#div_content_<?php  echo $this->_tpl_vars['id']; ?>
").html(tree_<?php  echo $this->_tpl_vars['id']; ?>
_control_line + "<br /><div class=\"inner-content-div\" style=\"height: 232px; overflow: auto; margin-top: 3px; overflow-x: auto;\">" + data + "</div>");
		    	change_tree_<?php  echo $this->_tpl_vars['id']; ?>
_title();
		 });

<?php  echo '

function tree_expand_';   echo $this->_tpl_vars['id'];   echo '(id)
{
        if ($("#tree_ul_"+id).css("display") == "block"){
        	$("#tree_ul_"+id).hide();
            $("#tree_arrow_"+id).removeClass().addClass("arrow").addClass("collapsed");
        } else {
        	$("#tree_ul_"+id).show();
            $("#tree_arrow_"+id).removeClass().addClass("arrow").addClass("expanded");
        }
 
}

function setChildrenStatus_';   echo $this->_tpl_vars['id']; ?>
(myId, act)<?php  echo '
{
    $("#tree_li_"+myId).children("ul").each(function(ul){
            $(this).children("li").each(function(li){
                $(this).children(".checkbox").removeClass().addClass("checkbox").addClass(act);
                $(this).children(":checkbox").attr("checked", act);
                    if ($(this).children("ul").size() > 0){
                        var new_my_id = $(this).attr("id");
                        new_my_id = new_my_id.substr(8);
                        '; ?>
setChildrenStatus_<?php  echo $this->_tpl_vars['id']; ?>
(new_my_id, act);<?php  echo '
                    }
            });
     });
}

function setParentStatus_';   echo $this->_tpl_vars['id']; ?>
(parent_id)<?php  echo '
{
     // if all checked - class checked if none - none else half-checked
     var par_li = $("#tree_li_"+parent_id);
     var total = $(\'ul > li\', par_li).size();
     var sel = $(\'ul > li .checked\', par_li).size();
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

function tree_check_';   echo $this->_tpl_vars['id'];   echo '(id, parent_id, level){
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
    if ($("#tree_li_"+id).children("ul").size() > 0) setChildrenStatus_';   echo $this->_tpl_vars['id'];   echo '(id, act);
    // parent
    if ( level > 0 ) setParentStatus_';   echo $this->_tpl_vars['id'];   echo '(parent_id);
    if (level == 2){ // 3th level change status root parent
           var root_parent_id = $("#tree_li_"+parent_id).parent("ul").attr("id");
           root_parent_id = root_parent_id.substr(8);
           setParentStatus_';   echo $this->_tpl_vars['id'];   echo '(root_parent_id);
        }
    change_tree_';   echo $this->_tpl_vars['id'];   echo '_title();
}

'; ?>


$("#tree_drop_down_<?php  echo $this->_tpl_vars['id']; ?>
, #tree_<?php  echo $this->_tpl_vars['id']; ?>
_close_button, #tree_<?php  echo $this->_tpl_vars['id']; ?>
_close_text").live("click", function() //click(function () 
		{
			if ($("#tree_div_<?php  echo $this->_tpl_vars['id']; ?>
").css('display') == 'block')
				{ 
						$("#tree_div_<?php  echo $this->_tpl_vars['id']; ?>
").css('display', 'none'); 
				} else {
	       			 var pos = $("#tree_drop_down_<?php  echo $this->_tpl_vars['id']; ?>
").position();
	        		var pos_top = pos.top + $("#tree_drop_down_<?php  echo $this->_tpl_vars['id']; ?>
").scrollTop();
			        var h = $("#tree_drop_down_<?php  echo $this->_tpl_vars['id']; ?>
").innerHeight();
					var tree_h = $("#tree_div_<?php  echo $this->_tpl_vars['id']; ?>
").height();
					var doc_h = $(window).height();
					
			        if ((pos.top + tree_h + h) > doc_h) 	
				        var top = pos.top - tree_h;
			        						 else 			
				        var top = pos.top+h+2;
			        
			        $("#tree_div_<?php  echo $this->_tpl_vars['id']; ?>
").css("top",top).css("left",pos.left);
       				$("#tree_div_<?php  echo $this->_tpl_vars['id']; ?>
").css('display', 'block');
		        }  
		});


</script>