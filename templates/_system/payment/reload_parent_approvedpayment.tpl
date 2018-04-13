<!--  Thank you! The payment has been sent! 
<p> If you are not redirected automatically, follow the <a href="{$succes_url}">link to proceed</a></p -->
	<script language="javascript" type="text/javascript">
	{literal}
		function redirectParent() {			
			var isInIFrame = (window.location != window.parent.location);
		//	if(isInIFrame==true){
	  			window.top.location.href = "{/literal}{$succes_url}{literal}"; 
		//	}
		} {/literal}
</script>
