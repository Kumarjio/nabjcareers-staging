<?php  /* Smarty version 2.6.14, created on 2018-02-08 10:36:43
         compiled from company_insider_widget.tpl */ ?>
<div class="in_CompanyInsiderWidget">
	<?php  echo '<script src="http://www.linkedin.com/companyInsider?script&useBorder=no" type="text/javascript"></script>'; ?>

	<span id="bofa"></span>
	<script type="text/javascript">
		new LinkedIn.CompanyInsiderBox("bofa","<?php  echo $this->_tpl_vars['companyName']; ?>
");
	</script>
</div>
<?php  echo '
<script type="text/javascript">
	$("document").ready(function(){
		$("#bofa iframe").attr("width", $("div.compProfileInfo").width());
	});
</script>
'; ?>
