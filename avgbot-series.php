<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
include "Carbon.php";
use Carbon\Carbon;
define('WP_ADMIN', true);
$is_admin = current_user_can( 'administrator' );
if(!$is_admin) { die("AVG BOT!"); }
$siteurl = get_site_url();
?>
<div class="wrap">
<h1 class="wp-heading-inline">AvgBot TV Series Importer</h1>
 <a href="admin.php?page=avgbotSeries" class="page-title-action">Series Importer</a> <a href="admin.php?page=avgbotSeries" class="page-title-action">Series Importer</a> <a href="admin.php?page=avgbotVideos" class="page-title-action">Video Importer</a> 
<hr>
<div class="avgfilter">
	<ul class="filter-links">
<?php 
set_time_limit(0);
$playerUrl=get_option('avgbot-player-url');
$token=get_option('avgbot-token');
$CatUrl = $playerUrl.'/token/'.$token;
	$ShowVidCats = startAvgBot($CatUrl);
	preg_match_all('@<a id="seriecats" href="(.*?)">(.*?)</a>@si' , $ShowVidCats , $vidCat);
    $countall=count($vidCat[2]);
	if ($countall>0){
		echo '<br><select name="forma" onchange="location = this.value;"><option value"admin.php?page=avgbotSeries">-- Select A TV Series Category --</option>';
		for($i=0;$i<$countall;$i++){
			echo'<option value="admin.php?page=avgbotSeries&newUrl='.$vidCat[1][$i].'"> '.$vidCat[2][$i].' </option>';
		}
		echo '</select>';
	}
	echo ' Please Select a category from our '.$countall.' series categories';
	?>
	</ul>
</div>		
<br class="clear">
<?php
$formid= sanitize_avgbot_array_text($_POST['addAvgform']);
$avg_user = wp_get_current_user();
$avgauthor=$avg_user->ID;
if(isset($_POST[''.$formid.''])) {
	if (wp_verify_nonce($_POST['_avgnonce'], 'avgbot-serie-nonce')) {
	include "avgBotClass.php";
	$avgBot = new avgBotClass();
	$avgBot->title = sanitize_avgbot_array_text($_POST['avgTitle']);
	$metas = array(
		'avgimported'	=> sanitize_avgbot_array_text($_POST['avgserieHash'])
	);
	$meta_added = array();
	$iframecode = "";
	$useiframe=get_option('avgbot-useiframe');
	$iframelabel=get_option('avgbot-iframelabel');
	$useiframeheight=get_option('avgbot-iframe-height');
	if( !empty( $useiframeheight )){ $iframeheight =$useiframeheight; }else { $iframeheight ='315';} 
	$newiFrameCode = "<iframe src='".$siteurl."/avgwatch/".sanitize_avgbot_array_text($_POST['avgFrameCode'])."' style='top:0px; left:0px; bottom:0px; right:0px; width:100%; height: 100vh; max-height:".$iframeheight."px; border:none; margin:0; padding:0;' webkitallowfullscreen='true' mozallowfullscreen='true' allowfullscreen='true' scrolling='no' frameBorder='0'></iframe>";
	if ($useiframe == 'yes'){ $metas[''.$iframelabel.''] = $newiFrameCode; }else { $iframecode = $newiFrameCode; }
	$content = "";
	$usecontent=get_option('avgbot-usecontentlabel');
	$contentlabel=get_option('avgbot-contentlabel');
	if ($usecontent == 'yes'){ $metas[''.$contentlabel.''] = sanitize_avgbot_array_text($_POST['avgDesc']);	$content .= $iframecode; }else { $content .= $iframecode.'<p>'.sanitize_avgbot_array_text($_POST['avgDesc']).'</p>';} 	
	$serietime = "";
	$usetime=get_option('avgbot-usetimelabel');
	$timelabel=get_option('avgbot-timelabel');
	if ($usetime == 'yes'){ $metas[''.$timelabel.''] = sanitize_avgbot_array_text($_POST['avgTime']); }	
    $tags = "";
	$usetags=get_option('avgbot-usetagslabel');
	$tagslabel=get_option('avgbot-tagslabel');
	if ($usetags == 'yes'){ $metas[''.$tagslabel.''] = sanitize_avgbot_array_text($_POST['avgTags']); }else { $tags = sanitize_avgbot_array_text($_POST['avgTags']); }	
	$newimglink = $avgBot->save_image($_POST['avgImg']);
	$thumbnail = "";
	$useimg=get_option('avgbot-useimglabel');
	$imglabel=get_option('avgbot-imglabel');
	if ($useimg == 'yes'){$metas[''.$imglabel.''] = sanitize_avgbot_array_text($newimglink); $thumbnail=$metas[''.$imglabel.'']; }else {$thumbnail = sanitize_avgbot_array_text($newimglink);}
	$categories = sanitize_avgbot_array_text($_POST['post_category']);
	$avgBot->thumbnail 	= $thumbnail;
	$avgBot->content 		= $content;
	$avgBot->tags 		= $tags;
	$avgBot->status="publish";
	$avgBot->time 		= Carbon::now();
	$avgBot->cat 			= $categories;
	$avgBot->author 		= $avgauthor;
	$avgBot->metas 		= $metas;
	$avgBot->addPost(true,true);
	echo '<div id="message" class="updated notice notice-success is-dismissible"><p><strong>'.sanitize_avgbot_array_text($_POST["avgTitle"]).'</strong> titled serie succesfully imported!</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Bu mesajı gizle.</span></button></div>';
}else{
	die ('Avg Bot! Security');
}}
?>
<br class="clear">
<?php
	$CatLink=$playerUrl.'/token/'.$token.'/'.sanitize_avgbot_array_text($_GET["newUrl"]);
	$Showseries = startAvgBot($CatLink);
	preg_match_all('@<div class="catserielist" style="display:none">
				<serietitle>(.*?)</serietitle>
				<serieimage>(.*?)</serieimage>
				<serieembedurl>(.*?)</serieembedurl>
				<seriedescription>(.*?)</seriedescription>
				<seriecategory>(.*?)</seriecategory>
				<seriedate>(.*?)</seriedate>
				<serietime>(.*?)</serietime>
				<serietags>(.*?)</serietags>
				</div>@si' , $Showseries , $catVid);
    preg_match_all('@<li><a class="scatpage" href="(.*?)">(.*?)</a>@si' , $Showseries , $catVidPage);
	$countall=count($catVid[1]); 
	$countpage=count($catVidPage[1]); 
	if ($countall>0){
	echo '
		<div class="wp-list-table widefat plugin-install">
<h2 class="screen-reader-text">serie List</h2>
<div id="the-list">';
		for($i=0;$i<$countall;$i++){
			echo '<div class="plugin-card">
			<div class="plugin-card-top"><form action="" method="post">
				
				<iframe src="'.$siteurl.'/avgwatch/'.$catVid[3][$i].'" height="315" width="100%" webkitallowfullscreen="true" mozallowfullscreen="true" allowfullscreen="true" scrolling="no" frameBorder="0">
</iframe>
				
			</div>
			<div class="plugin-card-bottom">
			<input name="avgFrameCode" type="hidden" value="'.$catVid[3][$i].'">
			<div class="form-field"><strong>Title:</strong><input name="avgTitle" type="text" value="'.$catVid[1][$i].'" size="30"></div><br class="clear">
			<div class="form-field"><strong>Description:</strong><textarea name="avgDesc" rows="4" cols="40">'.$catVid[4][$i].'</textarea></div><br class="clear">
			<div class="form-field"><strong>Tags:</strong> <input name="avgTags" type="text" value="'.$catVid[8][$i].'" size="40"></div><br class="clear">';

echo '<div class="form-field"><strong>Select Your Categories:</strong><br>';
echo '<div class="tabs-panel">';
echo '<ul class="categorychecklist form-no-clear">';
	  wp_category_checklist();
echo '</ul>';
echo '</div>';
echo '</div><br class="clear">';
			
			 $isadded=$catVid[3][$i];
			 global $wpdb;
			 $avgimported = 'avgimported';
			 $meta = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->postmeta." WHERE meta_key=%s AND meta_value=%s", $avgimported, $isadded ) );
			 if($meta){
				 echo '<ul class="community-events-results activity-block last" aria-hidden="false">
		<li class="event-none">
			
				<span class="msg-info"><strong>#This serie was previously imported!</strong> Also you can import it again with a Unique Title...</span>
		</li>
	</ul><br class="clear">';
			 }
			 $avgnonce = wp_create_nonce('avgbot-serie-nonce');
			echo '<div class="vers column-rating"><input name="avgImg" type="hidden" value="'.$catVid[2][$i].'">
			<strong>Original Cat: </strong> '.$catVid[5][$i].'</div>
				<div class="column-updated">
				<input name="avgTime" type="hidden" value="'.$catVid[7][$i].'">
					<strong>Time: </strong>'.$catVid[7][$i].'</div>
				<div class="column-downloaded">
					<strong>Original Date: </strong>'.$catVid[6][$i].'</div>
				<div class="column-compatibility">
					 <input type="hidden" value="addserie-'.$i.'"  name="addAvgform">
					 <input type="hidden" value="'.$catVid[3][$i].'"  name="avgserieHash">
                     <input type="hidden" name="_avgnonce" value="'.$avgnonce.'">';						 
						 echo'<input type="submit" class="button button-primary button-large" name="addserie-'.$i.'"  value="Add serie">';
						 echo'</form></div>
			</div>
		</div>';
		} echo '</div>
</div>';
?>
			  
<?php
	}
	if ($countpage>0){
		echo '<div class="plugins-popular-tags-wrapper"><p>';
		for($i=0;$i<$countpage;$i++){
			echo'<a class="button button-primary" href="admin.php?page=avgbotSeries&newUrl='.$catVidPage[1][$i].'">'.$catVidPage[2][$i].'</a>';
		}
		echo' <span class="alignright">Total Page: <strong>'.$countpage.'</strong></span>';
		echo '</p></div>';
	}
?>
</div>