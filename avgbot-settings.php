<?php if ( ! defined( 'ABSPATH' ) ) exit;  ?>
<div id="ajax-response"></div>

<p><h4>Insert the Player Url And Token which you have already taken from avgbot.com</h4></p>

<form method="post" class="validate" action="options.php">
<?php settings_fields ('avgbotgenplugin'); ?>
<?php do_settings_sections ('avgbotgenplugin'); ?>
<table class="form-table">
	<tbody>

<tr class="user-first-name-wrap">
	<th><label for="avgbot-player-url">Player URL  (No / at the end):</label></th>
	<td><input type="text" name="avgbot-player-url" value="<?php echo get_option('avgbot-player-url'); ?>" class="regular-text" placeholder="http://player.avg"></td>
</tr>

<tr class="user-first-name-wrap">
	<th><label for="avgbot-token">Token CODE :</label></th>
	<td><input type="text" name="avgbot-token" value="<?php echo get_option('avgbot-token'); ?>" class="regular-text" placeholder="xyz123"></td>
</tr>
<tr class="user-first-name-wrap">
	<th><label for="avgbot-iframe-height">iFrame Player Height :</label></th>
	<td><input type="text" name="avgbot-iframe-height" value="<?php echo get_option('avgbot-iframe-height'); ?>" class="regular-text" placeholder="315">
	<span class="description">Width is also 100% for being Responsive, but what will be the height of your iframe in px?</span></td>
</tr>

</tbody></table>


<p class="submit"><input type="submit" class="button button-primary" value="Save All"></p>
</form>
<div class="card">
	<p><h3>Attention please!!!</h3> Don't forget to <code><strong>!! Refresh !!</strong> your <u>permalink settings</u>!</code> After every <code>Player URL</code> changes on this settings..<br><p>
	</div>