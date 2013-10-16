<?php

function getcompat($w, $h, $file, $alt, $class)
{
 return "
<div class=\"iecompat\">
        <img src=\"$file\" alt=\"$alt\" class=\"$class\"/>
		</div>
 <!--[if lt IE 8]>
		<style type=\"text/css\">
			div.iecompat{display: none;}
			div.iecompat img{display: none;}
			div.boarditem{	width: 100%;}
		</style>
		<div style=\"width:$w; height:$h; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(
		src='$file', sizingMethod='scale');\"></div>
		<![endif]-->";
}

?>