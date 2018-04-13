<div style="padding: 5px; margin: 0; {if $iteration_last is even};background-color: #efefef;border: 1px solid #eee{else};
background-color: #fefefe;border: 1px solid #ccc{/if}" class="comment_item">
<table><tr><td rowspan="2">
</td>
<td>
	<a href="#comment_{$comment.id}">#</a>
		[[Author]]: <strong>{$comment.user.user_name}</strong>
	<br /><small>{$comment.added|date_format:"%d.%m.%Y %H:%M"}</small>
</td></tr>
<tr><td>
	{$comment.message}
</td></tr>
</table>
</div>