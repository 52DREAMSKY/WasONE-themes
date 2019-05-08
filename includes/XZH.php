<?php
if(is_single()){
	echo '<script type="application/ld+json">{
	"@context": "https://ziyuan.baidu.com/contexts/cambrian.jsonld",
	"@id": "'.get_the_permalink().'",
 	"appid": "1605666832135593",
	"title": "'.get_the_title().'",
	"images": ["'.fanly_post_imgs().'"],
	"description": "'.fanly_excerpt().'",
	"pubDate": "'.get_the_time('Y-m-d\TH:i:s').'"
}</script>
';}
?>