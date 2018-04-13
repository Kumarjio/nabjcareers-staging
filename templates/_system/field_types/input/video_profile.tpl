{if $value.file_url}
	<div id="container"><a href="http://www.macromedia.com/go/getflashplayer">Get the Flash Player</a> to see this player.</div>
	<script type="text/javascript" src="{$GLOBALS.site_url}/files/video/swfobject.js"></script>
	<div>
        <script type="text/javascript">
            var s1 = new SWFObject("{$GLOBALS.site_url}/files/video/player.swf","ply","250","250","9","#FFFFFF");
            s1.addParam("allowscriptaccess","always");
            s1.addParam("allowfullscreen","true");
            s1.addParam("wmode", "opaque");
            s1.addParam("flashvars","file={$value.file_url}&image={$value.file_url|regex_replace:"/flv/":"png"}&fullscreen=true");
            s1.write("container");
        </script>
        <br />
        |
        <a href="{$GLOBALS.site_url}/users/delete-uploaded-file/?field_id={$id}">[[Delete]]</a>
	</div>
	<br />
{/if}
<input type="file" class="inputVideo" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{else}{$id}{/if}" class="{if $complexField}complexField{/if}" />