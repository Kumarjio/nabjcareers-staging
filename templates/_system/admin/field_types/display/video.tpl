<div id="videoContainer"><a href="http://www.macromedia.com/go/getflashplayer">Get the Flash Player</a> to see this player.</div>
<script type="text/javascript" src="{$GLOBALS.user_site_url}/files/video/swfobject.js"></script>

<script type="text/javascript">
	var s1 = new SWFObject("{$GLOBALS.user_site_url}/files/video/player.swf","ply","250","250","9","#FFFFFF");
	s1.addParam("allowscriptaccess","always");
	s1.addParam("allowfullscreen","true");
	s1.addParam("wmode", "opaque");
	s1.addParam("flashvars","file={$listing.video.file_url}&image={$listing.video.file_url|regex_replace:"/flv/":"png"}&fullscreen=true");
	s1.write("videoContainer");
</script>