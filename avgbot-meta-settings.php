<?php if ( ! defined( 'ABSPATH' ) ) exit;  ?>
<div class="wrap">
  <h1>AvgBot Meta Settings for using anytype theme</h1>
  <hr>
<h2>* Theme Iframe Settings</h2>
<form method="post" class="validate" action="options.php">
<?php settings_fields ('avgbotplugin'); ?>
<?php do_settings_sections ('avgbotplugin'); ?>
<table class="form-table">
	<tbody>

<tr class="user-display-name-wrap">
	<th><label for="avgbot-useiframe">Will you use iframe label on your theme?</label></th>
	<td>
		<select name="avgbot-useiframe">
	<option value="no" <?php echo get_option('avgbot-useiframe') == 'no' ? 'selected' :null; ?>>No</option>
	<option value="yes" <?php echo get_option('avgbot-useiframe') == 'yes' ? 'selected' :null; ?>>Yes</option>
	</select><span class="description">Is your theme use a custom label for iframe?</span>
	</td>
</tr>
<tr class="user-first-name-wrap">
	<th><label for="avgbot-iframelabel">Name of Custom Iframe Label</label></th>
	<td><input type="text" name="avgbot-iframelabel" value="<?php echo get_option('avgbot-iframelabel'); ?>" class="regular-text"><span class="description">If yes what is the name of your custom iframe label name?</span></td>
</tr>

</tbody></table>
		<br class="clear">
<h2>* Theme Time Settings</h2>
<table class="form-table">
	<tbody>

<tr class="user-display-name-wrap">
	<th><label for="avgbot-usetimelabel">Will you use time label?</label></th>
	<td>
		<select name="avgbot-usetimelabel">
	<option value="no" <?php echo get_option('avgbot-usetimelabel') == 'no' ? 'selected' :null; ?>>No</option>
	<option value="yes" <?php echo get_option('avgbot-usetimelabel') == 'yes' ? 'selected' :null; ?>>Yes</option>
	</select><span class="description">Is your theme use a custom label for video time?</span>
	</td>
</tr>
<tr class="user-first-name-wrap">
	<th><label for="avgbot-timelabel">Name of Custom Time Label</label></th>
	<td><input type="text" name="avgbot-timelabel" value="<?php echo get_option('avgbot-timelabel'); ?>" class="regular-text"><span class="description">If yes what is the name of your custom time label name?</span></td>
</tr>

</tbody></table>
		<br class="clear">
<h2>* Theme Video Description Settings</h2>
<table class="form-table">
	<tbody>

<tr class="user-display-name-wrap">
	<th><label for="display_name">Do you wanna use custom label for descriptions?</label></th>
	<td>
		<select name="avgbot-usecontentlabel">
	<option value="no" <?php echo get_option('avgbot-usecontentlabel') == 'no' ? 'selected' :null; ?>>No</option>
	<option value="yes" <?php echo get_option('avgbot-usecontentlabel') == 'yes' ? 'selected' :null; ?>>Yes</option>
	</select><span class="description">If you wanna use custom label for descriptions please select yes!</span>
	</td>
</tr>
<tr class="user-description-wrap">
	<th><label for="description">Name of Custom Description Label</label></th>
	<td><input type="text" name="avgbot-contentlabel" value="<?php echo get_option('avgbot-contentlabel'); ?>" class="regular-text"><span class="description">If yes what is the name of your custom description label name?</span></td>
</select><span class="description">Is your theme use a custom label for video description?</span>
</tr>

</tbody></table>
<br class="clear">
<h2>* Theme Tag Settings</h2>
<table class="form-table">
	<tbody>

<tr class="user-display-name-wrap">
	<th><label for="display_name">Do you wanna use custom label for tags?</label></th>
	<td>
		<select name="avgbot-usetagslabel">
	<option value="no" <?php echo get_option('avgbot-usetagslabel') == 'no' ? 'selected' :null; ?>>No</option>
	<option value="yes" <?php echo get_option('avgbot-usetagslabel') == 'yes' ? 'selected' :null; ?>>Yes</option>
	</select><span class="description">If you wanna use custom label for tags please select yes!</span>
	</td>
</tr>
<tr class="user-description-wrap">
	<th><label for="description">Name of Custom Tags Label</label></th>
	<td><input type="text" name="avgbot-tagslabel" value="<?php echo get_option('avgbot-tagslabel'); ?>" class="regular-text"><span class="description">If yes what is the name of your custom tags label name?</span></td>
</select><span class="description">Is your theme use a custom label for video tags?</span>
</tr>

</tbody></table>
<br class="clear">
<h2>* Theme Image Settings</h2>
<table class="form-table">
	<tbody>

<tr class="user-display-name-wrap">
	<th><label for="display_name">Do you wanna use custom label for images?</label></th>
	<td>
		<select name="avgbot-useimglabel">
	<option value="no" <?php echo get_option('avgbot-useimglabel') == 'no' ? 'selected' :null; ?>>No</option>
	<option value="yes" <?php echo get_option('avgbot-useimglabel') == 'yes' ? 'selected' :null; ?>>Yes</option>
	</select><span class="description">If you wanna use custom label for images please select yes!</span>
	</td>
</tr>
<tr class="user-description-wrap">
	<th><label for="description">Name of Custom Tags Label</label></th>
	<td><input type="text" name="avgbot-imglabel" value="<?php echo get_option('avgbot-imglabel'); ?>" class="regular-text"><span class="description">If yes what is the name of your custom images label name?</span></td>
</select><span class="description">Is your theme use a custom label for video images?</span>
</tr>

</tbody></table>
<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save All"></p>
</form>
</div>