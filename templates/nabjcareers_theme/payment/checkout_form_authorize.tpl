{foreach from=$errors item=error key=error_code}
	<p class="error">
     {if $error_code == 'card_num'}
            	[[Enter Card Number]]
     {elseif $error_code == 'exp_date'}
    		 [[Please enter Expiry Date]]
    	{elseif $error_code == 'card_code'}
    		 [[Please Enter CCV Number]]
    	{/if}
	</p>
{/foreach}
<form id="formPayment" method="post" action="">
	<table>
		<tr>
			<td>&nbsp;</td>
			<td>
				<img src="{image}/creditcards/visa.gif" width="43" height="26" title="[[Visa]]" alt="[[Visa]]" />
				<img src="{image}/creditcards/mastercard.gif" width="41" height="26" title="[[MasterCard]]" alt="[[MasterCard]]" />
				<img src="{image}/creditcards/amex.gif" width="40" height="26" title="[[American Express]]" alt="[[American Express]]" />
				<img src="{image}/creditcards/discovery.gif" width="40" height="26" title="[[Discover]]" alt="[[Discover]]" />
				<img src="{image}/creditcards/dclub.gif" width="35" height="26" title="[[DinersClub]]" alt="[[DinersClub]]" />
				<img src="{image}/creditcards/jcb.gif" width="21" height="26" title="[[JCB]]" alt="[[JCB]]" />
			</td>
		</tr>
		<tr>
			<td>[[Card Number]] <span style="color:#ff0000;">*</span>:</td>
			<td>
				<input type="text" class="input_text" id="x_card_num" name="x_card_num" maxLength="16"  />&nbsp;([[enter number without spaces or dashes]])
			</td>
		</tr>
		<tr>
			<td>[[Expiration Date]] <span style="color:#ff0000;">*</span>:</td>
			<td>
				<input type="text" class="input_text" id="x_exp_date" name="x_exp_date" maxLength="20" value="{$form_data_source.x_exp_date}" />&nbsp;(mmyy)
			</td>
		</tr>
        <tr>
			<td>[[CCV]] <span style="color:#ff0000;">*</span>:</td>
			<td>
				<input type="text" class="input_text" id="x_card_code" name="x_card_code" maxLength="20" value="{$form_data_source.x_exp_date}" />&nbsp;(3 or 4 digit code)
			</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" value="[[Submit]]" name="Submit" />
				<input type="reset" value="[[Reset]]" />
			</td>
		</tr>
	</table>
</form>
<div style = "float:left;width:253px;height:150px;margin:20px;" >
<!-- GeoTrust QuickSSL [tm] Smart  Icon tag. Do not edit. -->
<div style = "float:left;width:100px;margin-right:20px;" ><script language="javascript" type="text/javascript" src="//smarticon.geotrust.com/si.js"></script></div>
<!-- end  GeoTrust Smart Icon tag -->
<!-- end GeoTrust Smart Icon tag --> <!-- (c) 2005, 2014. Authorize.Net is a registered trademark of CyberSource Corporation -->
<div style = "float:left;width:100px;"  > <script type="text/javascript" language="javascript">var ANS_customer_id="8f0a8315-c5ea-4f5c-85ec-8884bb4be2cd";</script> <script type="text/javascript" language="javascript" src="//verify.authorize.net/anetseal/seal.js" ></script> 
</div>
</div>

