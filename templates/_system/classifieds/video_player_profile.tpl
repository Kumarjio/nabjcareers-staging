<div id="videoContainer"><a href="http://www.macromedia.com/go/getflashplayer">Get the Flash Player</a> to see this player.</div>
<script type="text/javascript" src="{$GLOBALS.site_url}/files/video/swfobject.js"></script>
<script type="text/javascript">
	var s1 = new SWFObject("{$GLOBALS.site_url}/files/video/player.swf","ply","100%","250","9","#FFFFFF");
	s1.addParam("allowscriptaccess","always");
	s1.addParam("allowfullscreen","true");
	s1.addParam("wmode", "opaque");
	s1.addParam("flashvars","file={$userInfo.video.file_url}&image={$userInfo.video.file_url|regex_replace:"/flv/":"png"}&fullscreen=true");
	s1.write("videoContainer");
</script>
