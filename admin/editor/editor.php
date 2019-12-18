<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.min.css"/>
<!-- elFinder (load latest nightly) -->
<script src="editor/tinymce/tinymceElfinder.js"></script>
<script src="editor/elFinder/js/elfinder.min.js"></script>
<script src="editor/tinymce/tinymce.min.js"></script>
<script>

    const mceElf = new tinymceElfinder({
      // connector URL (Set your connector)
      url: 'editor/elFinder/php/connector.minimal.php',
      // upload target folder hash for this tinyMCE
      uploadTargetHash: 'l1_lw', // Hash value on elFinder of writable folder
      // elFinder dialog node id
      nodeId: 'elfinder' // Any ID you decide
    });

    tinymce.init({
        selector: '.editor',
        language: 'it',
        plugins : 'code codebb image imagetools link lists media paste print preview table',
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | numlist bullist | outdent indent | image media',
        relative_urls: false,
        remove_script_host: false,
        forced_root_block : '',
        file_picker_callback: mceElf.browser
        //images_upload_handler: mceElf.uploadHandler
    });
</script>
