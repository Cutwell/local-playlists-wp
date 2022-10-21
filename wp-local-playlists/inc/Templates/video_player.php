<?php
$videos = get_option('videoFields');
$type = '';
$list = array();
foreach($videos as $video):
	if(strpos($video['mediaUri'], 'youtube.com') > 0 || strpos($video['mediaUri'], 'youtu.be') > 0):
		$type = 'youtube';
	endif;

	$title = str_replace(['"', '\''], '\"', $video['post_type']);
	$url = str_replace(['"', '\''], '\"', $video['mediaUri']);

	array_push($list, ['type' => $type, 'title' => $title, 'm4v' => $url]);
endforeach;
?>


<video id="wp_video">
	<?php foreach($list as $video): ?>
	<source src="<?php echo $video['m4v']; ?>" type="video/mp4">
	<?php endforeach; ?>
	Your browser does not support the video tag.
</video>


<script>
var wp_video = document.getElementById('wp_video');

wp_video.addEventListener('ended', function (e) {
	// get the active source and the next video source.
	// I set it so if there's no next, it loops to the first one
	var activesource = document.querySelector("#wp_video source.active");
	var nextsource = document.querySelector("#wp_video source.active + source") || document.querySelector("#wp_video source:first-child");

	// deactivate current source, and activate next one
	activesource.className = "";
	nextsource.className = "active";

	// update the video source and play
	wp_video.src = nextsource.src;
	wp_video.play();
});

// add controls if mouseover (controls autohide on mouseout event)
wp_video.addEventListener("mouseover", function () {
	wp_video.controls = true;
});

// wait till page has loaded
window.addEventListener("load", function () {
	// resize video to be 50% of window width
	wp_video.width = window.innerWidth * 0.5;
	// make height proportional to width
	wp_video.height = wp_video.width * 0.5625;

	// play the first video
	document.querySelector("#wp_video source:first-child").className = "active";
	wp_video.play();
});
</script>
