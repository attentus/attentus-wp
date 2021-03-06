/*
 * Copyright (C) 2021 by attentus GmbH
 * All Rights Reserved
 * https://www.attentus.com
 * info@attentus.com
 *
 * This source code is proprietary and confidential. Unauthorized
 * copying of this file via any medium is strictly prohibited.
 *
 * @package attentus WP
 * @author Kolja Nolte <nolte@attentus.com>
 */

jQuery(document).ready(function () {
	jQuery.ajax({
		url:     ajaxurl,
		method:  'get',
		data:    {
			action: 'get_theme_version',
			nonce:  ''
		},
		success: function (returned) {
			jQuery('#theme-version').html(returned.data.theme_version);
		}
	});
});