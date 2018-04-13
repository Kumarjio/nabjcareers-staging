{if $subject eq ''}
    {breadcrumbs}Newsletter{/breadcrumbs}
    {else}
    {breadcrumbs}<a href="{$GLOBALS.site_url}/mailing/">Newsletter</a> &#187; Edit '{$subject}'{/breadcrumbs}
{/if}

<div id="massMailling">
	<h1><img src="{image}/icons/mailstar32.png" border="0" alt="" class="titleicon"/>Newsletter</h1>
	{if $is_data_submitted && !$errors}
		<p class="message">Newsletter saved successfully</p>
	{else}
		{if $is_test_run && !$errors}
			<p class="message">Test Newsletter send successfully</p>
		{else}
			{foreach from=$errors key=error_code item=error_message}
					<p class="error">
						{$error_message}
					</p>
			{/foreach}
		{/if}	
	{/if}
	<form method="POST" enctype="multipart/form-data" action="{$GLOBALS.site_url}/newsletter/">
	    <input type="hidden" id="submit" name="action_add" value="save" />
		<input type="hidden" id="submit" name="newsletter_id" value="{$info.id}" />
	    <table id="clear"  width="100%">
	        <tr>
	            <td>Subject:</td>
				<td class="productInputReq">*</td>
	            <td ><input type="text" name="subject" value="{$info.subject}" size="50"  /></td>
	        </tr>
			<tr>
	            <td>Interval(In Days):</td>
				<td></td>
	            <td>
					<select id="intervals" name="intervals">
						<option value="0" {if $info.intervals eq 0} selected="selected"{/if}>0</option>
						<option value="1" {if $info.intervals eq 1} selected="selected"{/if}>1</option>
						<option value="2" {if $info.intervals eq 2} selected="selected"{/if}>2</option>
						<option value="3" {if $info.intervals eq 3} selected="selected"{/if}>3</option>
						<option value="4" {if $info.intervals eq 4} selected="selected"{/if}>4</option>
						
						<option value="5" {if $info.intervals eq 5} selected="selected"{/if}>5</option>
						<option value="6" {if $info.intervals eq 6} selected="selected"{/if}>6</option>
						<option value="7" {if $info.intervals eq 7} selected="selected"{/if}>7</option>
						<option value="8" {if $info.intervals eq 8} selected="selected"{/if}>8</option>
						<option value="9" {if $info.intervals eq 9} selected="selected"{/if}>9</option>
						
						<option value="10" {if $info.intervals eq 10} selected="selected"{/if}>10</option>
						<option value="11" {if $info.intervals eq 11} selected="selected"{/if}>11</option>
						<option value="12" {if $info.intervals eq 12} selected="selected"{/if}>12</option>
						<option value="13" {if $info.intervals eq 13} selected="selected"{/if}>13</option>
						<option value="14" {if $info.intervals eq 14} selected="selected"{/if}>14</option>
						
						<option value="15" {if $info.intervals eq 15} selected="selected"{/if}>15</option>
						<option value="16" {if $info.intervals eq 16} selected="selected"{/if}>16</option>
						<option value="17" {if $info.intervals eq 17} selected="selected"{/if}>17</option>
						<option value="18" {if $info.intervals eq 18} selected="selected"{/if}>18</option>
						<option value="19" {if $info.intervals eq 19} selected="selected"{/if}>19</option>
						
						<option value="20" {if $info.intervals eq 20} selected="selected"{/if}>20</option>
						<option value="21" {if $info.intervals eq 21} selected="selected"{/if}>21</option>
						<option value="22" {if $info.intervals eq 22} selected="selected"{/if}>22</option>
						<option value="23" {if $info.intervals eq 23} selected="selected"{/if}>23</option>
						<option value="24" {if $info.intervals eq 24} selected="selected"{/if}>24</option>
						
						<option value="25" {if $info.intervals eq 25} selected="selected"{/if}>25</option>
						<option value="26" {if $info.intervals eq 26} selected="selected"{/if}>26</option>
						<option value="27" {if $info.intervals eq 27} selected="selected"{/if}>27</option>
						<option value="28" {if $info.intervals eq 28} selected="selected"{/if}>28</option>
						<option value="29" {if $info.intervals eq 29} selected="selected"{/if}>29</option>
						
						<option value="30" {if $info.intervals eq 30} selected="selected"{/if}>30</option>
					</select>
				</td>
	        </tr>
	        <tr>
	            <td>Header:</td>
				<td></td>
				<td>{WYSIWYGEditor name="header" width="100%" height="200" type="fckeditor" value="$header" conf="BasicAdmin"}</td>
	        </tr>
			<tr>
	            <td>Footer:</td>
				<td></td>
				<td>{WYSIWYGEditor name="footer" width="100%" height="200" type="fckeditor" value="$footer" conf="BasicAdmin"}</td>
	        </tr>
			<tr>
	            <td>Last Mailing Date:</td>
				<td></td>
				<td><input type="text" name="lastrun" value="{$info.lastrun}" /> (mm/dd/yyyy)</td>
	        </tr>
			<tr>
	            <td>Post to Facebook:</td>
				<td></td>
				<td><input type="checkbox" name="facebook" value="1" {if $info.facebook	==	1 } checked="checked" {/if} /></td>
	        </tr>
			<tr>
	            <td>Post to Twitter:</td>
				<td></td>
				<td><input type="checkbox" name="twitter" value="1" {if $info.twitter	==	1 } checked="checked" {/if}/></td>
	        </tr>
	        <tr>
				<td></td>
				<td></td>
	        	<td style="float:left" >
                    <div class="floatRight">
                        <input type="submit" id="apply" name="save" value="Update" class="grayButton" />
                    </div>
                </td>
	        </tr>
			<tr>
	            <td colspan="3"><br /></td>
	        </tr>
			<tr>
	            <td colspan="3"><br /></td>
	        </tr>
			<tr>
	            <td>Send Sample Email to Admin::</td>
				<td></td>
				<td><input type="submit" id="testrun" name="testrun" value="Preview Email" class="grayButton" /></td>
	        </tr>
	    </table>
	</form>
	
		
</div>