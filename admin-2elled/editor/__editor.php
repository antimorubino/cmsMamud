<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>

<script src="editor/tinymce/tinymce.min.js"></script>
<script>
  tinymce.init({
    selector: '.editor',
    language: 'it',
    plugins : 'code image imagetools link lists media paste print preview table',
    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | numlist bullist | outdent indent',
    file_picker_callback: function(callback, value, meta) {

        callback('elFinder/elfinder.html', {text: 'My text'});

    }

  });
</script>
