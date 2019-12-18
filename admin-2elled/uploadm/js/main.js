/*
 * jQuery File Upload Demo
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * https://opensource.org/licenses/MIT
 */

/* global $ju */

var $ju = jQuery.noConflict();

$ju(function() {
  'use strict';

  // Initialize the jQuery File Upload widget:
  $ju('#fileupload').fileupload({
    // Uncomment the following to send cross-domain cookies:
    //xhrFields: {withCredentials: true},
    url: 'server/php/'
  });

  // Enable iframe cross-domain access via redirect option:
  $ju('#fileupload').fileupload(
    'option',
    'redirect',
    window.location.href.replace(/\/[^/]*$ju/, '/cors/result.html?%s')
  );

  if (window.location.hostname === 'blueimp.github.io') {
    // Demo settings:
    $ju('#fileupload').fileupload('option', {
      url: '//jquery-file-upload.appspot.com/',
      // Enable image resizing, except for Android and Opera,
      // which actually support image resizing, but fail to
      // send Blob objects via XHR requests:
      disableImageResize: /Android(?!.*Chrome)|Opera/.test(
        window.navigator.userAgent
      ),
      maxFileSize: 999000,
      acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$ju/i
    });
    // Upload server status check for browsers with CORS support:
    if ($ju.support.cors) {
      $ju.ajax({
        url: '//jquery-file-upload.appspot.com/',
        type: 'HEAD'
      }).fail(function() {
        $ju('<div class="alert alert-danger"/>')
          .text('Upload server currently unavailable - ' + new Date())
          .appendTo('#fileupload');
      });
    }
  } else {
    // Load existing files:
    $ju('#fileupload').addClass('fileupload-processing');
    $ju.ajax({
      // Uncomment the following to send cross-domain cookies:
      //xhrFields: {withCredentials: true},
      url: $ju('#fileupload').fileupload('option', 'url'),
      dataType: 'json',
      context: $ju('#fileupload')[0]
    })
      .always(function() {
        $ju(this).removeClass('fileupload-processing');
      })
      .done(function(result) {
        $ju(this)
          .fileupload('option', 'done')
          // eslint-disable-next-line new-cap
          .call(this, $ju.Event('done'), { result: result });
      });
  }
});
