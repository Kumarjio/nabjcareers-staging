{$v = 44}
{assign var="v" value=$value|truncate:17:""}

<object width="250" height="225">

<param name="movie" value='http://www.youtube.com/v/
{if $v=="https://youtu.be/"}{$value|replace:"https://youtu.be/":""}
{elseif $v=="http://www.youtub"}{$value|replace:"http://www.youtube.com/watch?v=":""}
{elseif $v=="https://www.youtu"}{$value|replace:"https://www.youtube.com/watch?v=":""}{/if}
&hl=ru&fs=1'></param>


<param name="allowFullScreen" value="true"></param>
<param name="allowscriptaccess" value="always"></param>
<embed src='http://www.youtube.com/v/
{if $v=="https://youtu.be/"}{$value|replace:"https://youtu.be/":""}
{elseif $v=="http://www.youtub"}{$value|replace:"http://www.youtube.com/watch?v=":""}
{elseif $v=="https://www.youtu"}{$value|replace:"https://www.youtube.com/watch?v=":""}{/if}
&hl=ru&fs=1' type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="250" height="225"></embed>
</object>