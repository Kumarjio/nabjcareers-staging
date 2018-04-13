{assign var="complexField" value=$id} {* nwy: Ð•Ñ�Ð»Ð¸ Ð½Ðµ Ð¾Ñ‡Ð¸Ñ�Ñ‚Ð¸Ñ‚ÑŒ Ð¿ÐµÑ€ÐµÐ¼ÐµÐ½Ð½ÑƒÑŽ Ñ‚Ð¾ Ð² Ð¿Ð¾Ñ�Ð»ÐµÐ´ÑƒÑŽÑ‰Ð¸Ñ… Ð¿Ð¾Ð»Ñ�Ñ… Ð½Ð°Ñ‡Ð¸Ð½Ð°ÑŽÑ‚Ñ�Ñ� Ð¿Ñ€Ð¾Ð±Ð»ÐµÐ¼Ñ‹ (Ð½ÐµÐºÐ¾Ñ‚Ð¾Ñ€Ñ‹Ðµ Ð²Ð¾Ñ�Ð¿Ñ€Ð¸Ð½Ð¸Ð¼Ð°ÑŽÑ‚Ñ�Ñ� ÐºÐ°Ðº ÐºÐ¾Ð¼Ð¿Ð»ÐµÐºÑ�Ð½Ñ‹Ðµ)*}
{if $complexField == "Education"}
	{foreach from=$complexElements key="complexElementKey" item="complexElementItem"}
		<div class="leftDisplaySIde">
			<strong>{display property=$form_fields.EntranceDate.id complexParent=$complexField complexStep=$complexElementKey} - {display property=$form_fields.GraduationDate.id complexParent=$complexField complexStep=$complexElementKey}</strong>
		</div>
		<div class="rightDisplaySIde">
			{display property=$form_fields.InstitutionName.id complexParent=$complexField complexStep=$complexElementKey}<br/>
			<strong>{display property=$form_fields.Major.id complexParent=$complexField complexStep=$complexElementKey}</strong><br/>
			{display property=$form_fields.DegreeLevel.id complexParent=$complexField complexStep=$complexElementKey}
			{display property=$form_fields.testFile.id complexParent=$complexField complexStep=$complexElementKey}
		</div>
		<div class="clrBorder"><br/></div>
	{/foreach}
{elseif $complexField == "WorkExperience"}
	{foreach from=$complexElements key="complexElementKey" item="complexElementItem"}
		<div class="leftDisplaySIde">
				<strong>{display property=$form_fields.JobTitle.id complexParent=$complexField complexStep=$complexElementKey}</strong>
				
		</div>
		<div class="rightDisplaySIde workdates">
			{display property=$form_fields.StartDate.id complexParent=$complexField complexStep=$complexElementKey} - {display property=$form_fields.EndDate.id complexParent=$complexField complexStep=$complexElementKey}<br/>
			{display property=$form_fields.CompanyName.id complexParent=$complexField complexStep=$complexElementKey} | {display property=$form_fields.Industry.id complexParent=$complexField complexStep=$complexElementKey}<br/>
			<span class="workdescrip">{display property=$form_fields.Description.id complexParent=$complexField complexStep=$complexElementKey}</span>
		</div>
		<div class="clrBorder"><br/></div>
	{/foreach}
{else}
	{foreach from=$complexElements key="complexElementKey" item="complexElementItem"}
		<div class="complexField">
			{foreach from=$form_fields item=form_field}
				<fieldset>
					<strong> [[$form_field.caption]]:&nbsp;</strong>
					{display property=$form_field.id complexParent=$complexField complexStep=$complexElementKey}
				</fieldset>
			{/foreach}
		</div>
	{/foreach}
{/if}
{assign var="complexField" value=false} {* nwy: Ð•Ñ�Ð»Ð¸ Ð½Ðµ Ð¾Ñ‡Ð¸Ñ�Ñ‚Ð¸Ñ‚ÑŒ Ð¿ÐµÑ€ÐµÐ¼ÐµÐ½Ð½ÑƒÑŽ Ñ‚Ð¾ Ð² Ð¿Ð¾Ñ�Ð»ÐµÐ´ÑƒÑŽÑ‰Ð¸Ñ… Ð¿Ð¾Ð»Ñ�Ñ… Ð½Ð°Ñ‡Ð¸Ð½Ð°ÑŽÑ‚Ñ�Ñ� Ð¿Ñ€Ð¾Ð±Ð»ÐµÐ¼Ñ‹ (Ð½ÐµÐºÐ¾Ñ‚Ð¾Ñ€Ñ‹Ðµ Ð²Ð¾Ñ�Ð¿Ñ€Ð¸Ð½Ð¸Ð¼Ð°ÑŽÑ‚Ñ�Ñ� ÐºÐ°Ðº ÐºÐ¾Ð¼Ð¿Ð»ÐµÐºÑ�Ð½Ñ‹Ðµ)*}