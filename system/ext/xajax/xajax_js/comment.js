function pBar()
{
	 $("#ProgBar").show("normal");
}
function pBarIn()
{
	$("#ProgBar").hide("normal");
}
function add_comment()
{
	message = $("#message").val();
	listing_id = $("#listing_id").val();

	if(message == '')
	{
		alert('Message empty!'); 
		return false;
	}
	else 
	{
		pBar();
    	xajax_add_comment(message,listing_id,id_form);
    	$("#message").val(" ");
    	return false;
	}
}
