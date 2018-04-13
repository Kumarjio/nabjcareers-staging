<div class="in_CompanyInsiderWidget">
	{literal}<script src="http://www.linkedin.com/companyInsider?script&useBorder=no" type="text/javascript"></script>{/literal}
	<span id="bofa"></span>
	<script type="text/javascript">
		new LinkedIn.CompanyInsiderBox("bofa","{$companyName}");
	</script>
</div>
{literal}
<script type="text/javascript">
	$("document").ready(function(){
		$("#bofa iframe").attr("width", $("div.compProfileInfo").width());
	});
</script>
{/literal}
