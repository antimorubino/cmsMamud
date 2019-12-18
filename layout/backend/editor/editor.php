<!-- jquery -->

<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>

<!-- elfinder -->

<link rel="stylesheet" type="text/css" media="screen" href="editor/elfinder/css/elfinder.min.css"/>
<script type="text/javascript" src="editor/elfinder/js/elfinder.js"></script>
<script type="text/javascript" src="editor/elfinder/js/i18n/elfinder.it.js"></script>

<!-- tiny -->
<script type="text/javascript" src="editor/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
tinymce.init({
    language: "it",
    selector: ".editor",
    theme: "modern",
    file_browser_callback : elFinderBrowser,
    convert_urls : false,
    relative_urls: false,
	entity_encoding : "raw",
	force_br_newlines : true, force_p_newlines : false, forced_root_block : '',

    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons code",

	style_formats: [
                {title: 'Titoletti', inline: 'span', classes: 'titoletti'},
        ],

    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]

});


function elFinderBrowser (field_name, url, type, win) {
  tinymce.activeEditor.windowManager.open({
    file: 'editor/elfinder/elfinder.html',// use an absolute path!
    title: 'elFinder 2.0',
    width: 900,
    height: 450,
    resizable: 'yes'
  }, {
    setUrl: function (url) {
      win.document.getElementById(field_name).value = url;
    }
  });
  return false;
}

</script>
