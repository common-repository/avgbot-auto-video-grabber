<?php
/*  
                                      88                                
                                      88                         ,d     
                                      88                         88     
,adPPYYba,  8b       d8   ,adPPYb,d8  88,dPPYba,    ,adPPYba,  MM88MMM  
""     `Y8  `8b     d8'  a8"    `Y88  88P'    "8a  a8"     "8a   88     
,adPPPPP88   `8b   d8'   8b       88  88       d8  8b       d8   88     
88,    ,88    `8b,d8'    "8a,   ,d88  88b,   ,a8"  "8a,   ,a8"   88,    
`"8bbdP"Y8      "8"       `"YbbdP"Y8  8Y"Ybbd8"'    `"YbbdP"'    "Y888  
                          aa,    ,88                                    
                           "Y8bbdP"  
*/
if ( ! defined( 'ABSPATH' ) ) exit;
function avgbotmenu() {add_menu_page ('AvgBOT Panel','AvgBOT','manage_options','avgbotSettings','AvgBot',plugins_url('files/avgicon.png', __FILE__),'90'); add_submenu_page('avgbotSettings','AvgBOT General Settings', 'General Settings','manage_options', 'avgbotSettings', 'avgbotSettings'); add_submenu_page('avgbotSettings','AvgBOT Meta Settings', 'Meta Settings','manage_options', 'avgbotMETAsettings', 'avgbotMETAsettings'); add_submenu_page('avgbotSettings','AvgBOT Movie Importer', 'Movies Importer','manage_options', 'avgbotMovies', 'avgbotMovies'); add_submenu_page('avgbotSettings','AvgBOT Series Importer', 'Series Importer','manage_options', 'avgbotSeries', 'avgbotSeries'); add_submenu_page('avgbotSettings','AvgBOT Video Importer', 'Video Importer','manage_options', 'avgbotVideos', 'avgbotVideos'); }
add_action( 'admin_menu', 'avgbotmenu' );
function avgbotSettings() {	include 'avgbot-settings.php'; }
function avgbotMETAsettings() {	include 'avgbot-meta-settings.php'; }
function avgbotMovies() { include 'avgbot-movies.php'; }
function avgbotSeries() { include 'avgbot-series.php'; }
function avgbotVideos() { include 'avgbot-videos.php'; }
function avgBot() {	include 'avgbot-header.php'; }
add_action ('admin_init','avgbotGsettings');
function avgbotGsettings(){ register_setting ('avgbotgenplugin','avgbot-player-url'); register_setting ('avgbotgenplugin','avgbot-token'); register_setting ('avgbotgenplugin','avgbot-iframe-height'); register_setting ('avgbotplugin','avgbot-useiframe'); register_setting ('avgbotplugin','avgbot-iframelabel'); register_setting ('avgbotplugin','avgbot-usetimelabel'); register_setting ('avgbotplugin','avgbot-timelabel'); register_setting ('avgbotplugin','avgbot-usecontentlabel'); register_setting ('avgbotplugin','avgbot-contentlabel'); register_setting ('avgbotplugin','avgbot-usetagslabel'); register_setting ('avgbotplugin','avgbot-tagslabel'); register_setting ('avgbotplugin','avgbot-useimglabel'); register_setting ('avgbotplugin','avgbot-imglabel'); }
function startAvgBot($site_url){$response = wp_remote_get($site_url); if ( is_array( $response ) && ! is_wp_error( $response ) ) {$body = $response['body']; return $body;}}
function sanitize_avgbot_array_text($array_avgbot_string) { if( is_string($array_avgbot_string) ){ $array_avgbot_string = sanitize_text_field($array_avgbot_string); }elseif( is_array($array_avgbot_string) ){ foreach ( $array_avgbot_string as $key => &$value ) { if ( is_array( $value ) ) { $value = sanitize_avgbot_array_text($value); } else { $value = sanitize_text_field( $value ); } } } return $array_avgbot_string; }
add_filter( 'query_vars', 'avgbotwatch_query_vars' );
function avgbotwatch_query_vars( $query_vars ){ $query_vars[] = 'avgbotvid'; $query_vars[] = 'avgbottype'; return $query_vars;}
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'avgbot_flush_rewrites' );
function avgbot_flush_rewrites() {avgbot_rewrite_rule(); flush_rewrite_rules(); }
function avgbot_rewrite_tag() { add_rewrite_tag('%avgbottype%', '([^&]+)'); add_rewrite_tag('%avgbotvid%', '([^&]+)');}
add_action('init', 'avgbot_rewrite_tag', 10, 0);
function avgbot_rewrite_rule() { add_rewrite_rule('^avgwatch/([^/]*)/([^/]*)/?','index.php?avgbottype=$matches[1]&avgbotvid=$matches[2]','top'); }
add_action('init', 'avgbot_rewrite_rule', 10, 0);
function avgbot_pre_get_posts( $query ) { if ( is_admin() || ! $query->is_main_query() ){	return;} $token = get_option('avgbot-token'); $playerUrl = get_option('avgbot-player-url'); $avgtype = get_query_var( 'avgbottype' ); $avgvid = get_query_var( 'avgbotvid' ); $AvgUrl = $playerUrl.'/token/'.$token.'/'.$avgtype.'/'.$avgvid; if( !empty( $avgtype ) && !empty( $avgvid ) ){ wp_redirect( $AvgUrl ); exit(); } }
add_action( 'pre_get_posts', 'avgbot_pre_get_posts', 1 );
