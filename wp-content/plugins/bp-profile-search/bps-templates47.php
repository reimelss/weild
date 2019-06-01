<?php

function bps_escaped_form_data47 ()
{
	list ($form, $location) = bps_template_args ();

	$meta = bps_meta ($form);
	$fields = bps_parse_request (bps_get_request ('form', $form));
	wp_register_script ('bps-template', plugins_url ('bp-profile-search/bps-template.js'), array (), BPS_VERSION);

	$F = new stdClass;
	$F->id = $form;
	$F->title = bps_wpml ($form, '-', 'title', get_the_title ($form));
	$F->location = $location;
	$F->unique_id = bps_unique_id ('form_'. $form);

	$template_options = $meta['template_options'][$meta['template']];
	if (isset ($template_options['header']))
		$F->header = bps_wpml ($form, '-', 'header', $template_options['header']);
	if (isset ($template_options['toggle']))
		$F->toggle = ($template_options['toggle'] == 'Enabled');
	if (isset ($template_options['button']))
		$F->toggle_text = esc_attr (bps_wpml ($form, '-', 'toggle form', $template_options['button']));

	$dirs = bps_directories ();
	$F->action = $location == 'directory'?
		parse_url ($_SERVER['REQUEST_URI'], PHP_URL_PATH):
		$dirs[bps_wpml_id ($meta['action'])]->link;

	if (defined ('DOING_AJAX'))
		$F->action = parse_url ($_SERVER['HTTP_REFERER'], PHP_URL_PATH);

	$F->method = $meta['method'];
	$F->fields = array ();

	foreach ($meta['field_code'] as $k => $code)
	{
		if (empty ($fields[$code]))  continue;

		$f = $fields[$code];
		$mode = $meta['field_mode'][$k];
		if (!bps_Fields::set_display ($f, $mode))  continue;

		$f->label = $f->name;
		$custom_label = bps_wpml ($form, $f->code, 'label', $meta['field_label'][$k]);
		if (!empty ($custom_label))
		{
			$f->label = $custom_label;
			$F->fields[] = bps_set_hidden_field ($f->code. '_label', $f->label);
		}

		$custom_desc = bps_wpml ($form, $f->code, 'comment', $meta['field_desc'][$k]);
		if ($custom_desc == '-')
			$f->description = '';
		else if (!empty ($custom_desc))
			$f->description = $custom_desc;

		if ($f->display == 'integer')  $f->display = 'number';
		if ($f->display == 'integer-range')  $f->display = 'range';

		switch ($f->display)
		{
		case 'range':
		case 'date-range':
		case 'range-select':
			if (!isset ($f->value['min']))  $f->value['min'] = '';
			if (!isset ($f->value['max']))  $f->value['max'] = '';
			$f->min = $f->value['min'];
			$f->max = $f->value['max'];
			break;

		case 'textbox':
		case 'number':
		case 'date':
			if (!isset ($f->value))  $f->value = '';
			break;

		case 'distance':
			if (!isset ($f->value['location']))
				$f->value['distance'] = $f->value['units'] = $f->value['location'] = $f->value['lat'] = $f->value['lng'] = '';
			wp_enqueue_script ($f->script_handle);
			wp_enqueue_script ('bps-template');
			break;

		case 'selectbox':
			if (!isset ($f->value))  $f->value = '';
			break;

		case 'radio':
			if (!isset ($f->value))  $f->value = '';
			wp_enqueue_script ('bps-template');
			break;

		case 'multiselectbox':
		case 'checkbox':
			if (!isset ($f->value))  $f->value = '';
			break;
		}

		$f->values = (array)$f->value;

		$f->html_name = ($mode == '')? $f->code: $f->code. '_'. $mode;
		$f->unique_id = bps_unique_id ($f->html_name);

		do_action ('bps_field_before_search_form', $f);
		$f->code = ($mode == '')? $f->code: $f->code. '_'. $mode;		// to be removed
		$F->fields[] = $f;
	}

	$F->fields[] = bps_set_hidden_field (BPS_FORM, $form);
	do_action ('bps_before_search_form', $F);

	foreach ($F->fields as $f)
	{
		if (!is_array ($f->value))  $f->value = esc_attr (stripslashes ($f->value));
		if ($f->display == 'hidden')  continue;

		$f->label = esc_attr ($f->label);
		$f->description = esc_attr ($f->description);
		foreach ($f->values as $k => $value)  $f->values[$k] = esc_attr (stripslashes ($value));
		$options = array ();
		foreach ($f->options as $key => $label)  $options[esc_attr ($key)] = esc_attr ($label);
		$f->options = $options;
	}

	return $F;
}

function bps_escaped_filters_data47 ()
{
	list ($request, $full) = bps_template_args ();

	$F = new stdClass;
	$action = parse_url ($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$action = add_query_arg (BPS_FORM, 'clear', $action);
	$F->action = $full? esc_url ($action): '';
	$F->fields = array ();

	$fields = bps_parse_request ($request);
	foreach ($fields as $f)
	{
		if (!isset ($f->filter))  continue;
		if (!bps_Fields::set_display ($f, $f->filter))  continue;

		if (empty ($f->label))  $f->label = $f->name;

		$f->min = isset ($f->value['min'])? $f->value['min']: '';
		$f->max = isset ($f->value['max'])? $f->value['max']: '';
		$f->values = (array)$f->value;

		do_action ('bps_field_before_filters', $f);
		$F->fields[] = $f;
	}

	do_action ('bps_before_filters', $F);
	usort ($F->fields, 'bps_sort_fields');

	foreach ($F->fields as $f)
	{
		$f->label = esc_attr ($f->label);
		if (!is_array ($f->value))  $f->value = esc_attr (stripslashes ($f->value));
		foreach ($f->values as $k => $value)  $f->values[$k] = stripslashes ($value);

		foreach ($f->options as $key => $label)  $f->options[$key] = esc_attr ($label);
	}

	return $F;
}

function bps_print_filter ($f)
{
	if (!empty ($f->options))
	{
		$values = array ();
		foreach ($f->options as $key => $label)
			if (in_array ($key, $f->values))  $values[] = $label;
	}

	switch ($f->filter)
	{
	case 'range':
	case 'age_range':
		if (!isset ($f->value['max']))
			return sprintf (esc_html__('min: %1$s', 'bp-profile-search'), $f->value['min']);
		if (!isset ($f->value['min']))
			return sprintf (esc_html__('max: %1$s', 'bp-profile-search'), $f->value['max']);
		return sprintf (esc_html__('min: %1$s, max: %2$s', 'bp-profile-search'), $f->value['min'], $f->value['max']);

	case '':
		if (isset ($values))
			return sprintf (esc_html__('is: %1$s', 'bp-profile-search'), $values[0]);
		return sprintf (esc_html__('is: %1$s', 'bp-profile-search'), $f->value);

	case 'contains':
		return sprintf (esc_html__('contains: %1$s', 'bp-profile-search'), $f->value);

	case 'like':
		return sprintf (esc_html__('is like: %1$s', 'bp-profile-search'), $f->value);

	case 'one_of':
		if (count ($values) == 1)
			return sprintf (esc_html__('is: %1$s', 'bp-profile-search'), $values[0]);
		return sprintf (esc_html__('is one of: %1$s', 'bp-profile-search'), implode (', ', $values));

	case 'match_any':
		if (count ($values) == 1)
			return sprintf (esc_html__('match: %1$s', 'bp-profile-search'), $values[0]);
		return sprintf (esc_html__('match any: %1$s', 'bp-profile-search'), implode (', ', $values));

	case 'match_all':
		if (count ($values) == 1)
			return sprintf (esc_html__('match: %1$s', 'bp-profile-search'), $values[0]);
		return sprintf (esc_html__('match all: %1$s', 'bp-profile-search'), implode (', ', $values));

	case 'distance':
		if ($f->value['units'] == 'km')
			return sprintf (esc_html__('is within: %1$s km of %2$s', 'bp-profile-search'), $f->value['distance'], $f->value['location']);
		return sprintf (esc_html__('is within: %1$s miles of %2$s', 'bp-profile-search'), $f->value['distance'], $f->value['location']);

	default:
		return "BP Profile Search: undefined filter <em>$f->filter</em>";
	}
}

function bps_autocomplete_script ($f)
{
	wp_enqueue_script ($f->script_handle);
	$autocomplete_options = apply_filters ('bps_autocomplete_options', "{types: ['geocode']}", $f);
	$geolocation_options = apply_filters ('bps_geolocation_options', "{timeout: 5000}", $f);
?>
	<input type="hidden" id="Lat_<?php echo $f->unique_id; ?>"
		name="<?php echo $f->code. '[lat]'; ?>"
		value="<?php echo $f->value['lat']; ?>">
	<input type="hidden" id="Lng_<?php echo $f->unique_id; ?>"
		name="<?php echo $f->code. '[lng]'; ?>"
		value="<?php echo $f->value['lng']; ?>">

	<script type="text/javascript">
		function bps_<?php echo $f->unique_id; ?>() {
			var input = document.getElementById('<?php echo $f->unique_id; ?>');
			var options = <?php echo $autocomplete_options; ?>;
			var autocomplete = new google.maps.places.Autocomplete(input, options);
			google.maps.event.addListener(autocomplete, 'place_changed', function() {
				var place = autocomplete.getPlace();
				document.getElementById('Lat_<?php echo $f->unique_id; ?>').value = place.geometry.location.lat();
				document.getElementById('Lng_<?php echo $f->unique_id; ?>').value = place.geometry.location.lng();
			});
		}
		jQuery(document).ready (bps_<?php echo $f->unique_id; ?>);

		function bps_locate_<?php echo $f->unique_id; ?>() {
			if (navigator.geolocation) {
				var options = <?php echo $geolocation_options; ?>;
				navigator.geolocation.getCurrentPosition(function(position) {
					document.getElementById('Lat_<?php echo $f->unique_id; ?>').value = position.coords.latitude;
					document.getElementById('Lng_<?php echo $f->unique_id; ?>').value = position.coords.longitude;
					bps_address_<?php echo $f->unique_id; ?>(position);
				}, function(error) {
					alert('ERROR ' + error.code + ': ' + error.message);
				}, options);
			} else {
				alert('ERROR: Geolocation is not supported by this browser');
			}
		}
		jQuery('#Btn_<?php echo $f->unique_id; ?>').click (bps_locate_<?php echo $f->unique_id; ?>);

		function bps_address_<?php echo $f->unique_id; ?>(position) {
			var geocoder = new google.maps.Geocoder;
			var latlng = {lat: position.coords.latitude, lng: position.coords.longitude};
			geocoder.geocode({'location': latlng}, function(results, status) {
				if (status === 'OK') {
					if (results[0]) {
						document.getElementById('<?php echo $f->unique_id; ?>').value = results[0].formatted_address;
					} else {
						alert('ERROR: Geocoder found no results');
					}
				} else {
					alert('ERROR: Geocoder status: ' + status);
				}
			});
		}
	</script>
<?php
}

function bps_unique_id ($id)
{
	static $k = array ();

	$k[$id] = isset ($k[$id])? $k[$id] + 1: 0;
	return $k[$id]? $id. '_'. $k[$id]: $id;
}
