<?php
include('../vendor/autoload.php');
include('header.php');
?>

<style>
.fade.in {
    opacity: 1
}
</style>

<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="uploadm/css/jquery.fileupload.css" />
<link rel="stylesheet" href="uploadm/css/jquery.fileupload-ui.css" />
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript>
    <link rel="stylesheet" href="uploadm/css/jquery.fileupload-noscript.css" />
</noscript>
<noscript>
    <link rel="stylesheet" href="uploadm/css/jquery.fileupload-ui-noscript.css"/>
</noscript>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Inserisci immagini</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="galleria.php">Galleria</a></li>
        <li class="breadcrumb-item active">Inserisci immagini</li>
      </ol>
    </nav>
    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-3">
        <div class="card-body">

            <form id="fileupload" action="uploadm/server/php/index.php" method="POST" enctype="multipart/form-data">
              <!-- Redirect browsers with JavaScript disabled to the origin page -->
              <noscript
                ><input
                  type="hidden"
                  name="redirect"
                  value="https://blueimp.github.io/jQuery-File-Upload/"
              /></noscript>
              <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
              <div class="row fileupload-buttonbar">
                <div class="col-lg-7">
                  <!-- The fileinput-button span is used to style the file input field as button -->
                  <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple />
                  </span>
                  <button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start upload</span>
                  </button>
                  <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel upload</span>
                  </button>
                  <button type="button" class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete selected</span>
                  </button>
                  <input type="checkbox" class="toggle" />
                  <!-- The global file processing state -->
                  <span class="fileupload-process"></span>
                </div>
                <!-- The global progress state -->
                <div class="col-lg-5 fileupload-progress fade">
                  <!-- The global progress bar -->
                  <div
                    class="progress progress-striped active"
                    role="progressbar"
                    aria-valuemin="0"
                    aria-valuemax="100"
                  >
                    <div
                      class="progress-bar progress-bar-success"
                      style="width:0%;"
                    ></div>
                  </div>
                  <!-- The extended global progress state -->
                  <div class="progress-extended">&nbsp;</div>
                </div>
              </div>
              <!-- The table listing the files available for upload/download -->
              <table role="presentation" class="table table-striped">
                <tbody class="files"></tbody>
              </table>
            </form>

            <a href="imp-img.php" class="btn btn-success">
                <span>Procedi</span>
            </a>

            <!-- The template to display files available for upload -->
            <script id="template-upload" type="text/x-tmpl">
              {% for (var i=0, file; file=o.files[i]; i++) { %}
                  <tr class="template-upload fade">
                      <td>
                          <span class="preview"></span>
                      </td>
                      <td>
                          {% if (window.innerWidth > 480 || !o.options.loadImageFileTypes.test(file.type)) { %}
                              <p class="name">{%=file.name%}</p>
                          {% } %}
                          <strong class="error text-danger"></strong>
                      </td>
                      <td>
                          <p class="size">Processing...</p>
                          <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                      </td>
                      <td>
                          {% if (!o.options.autoUpload && o.options.edit && o.options.loadImageFileTypes.test(file.type)) { %}
                            <button class="btn btn-success edit" data-index="{%=i%}" disabled>
                                <i class="glyphicon glyphicon-edit"></i>
                                <span>Edit</span>
                            </button>
                          {% } %}
                          {% if (!i && !o.options.autoUpload) { %}
                              <button class="btn btn-primary start" disabled>
                                  <i class="glyphicon glyphicon-upload"></i>
                                  <span>Start</span>
                              </button>
                          {% } %}
                          {% if (!i) { %}
                              <button class="btn btn-warning cancel">
                                  <i class="glyphicon glyphicon-ban-circle"></i>
                                  <span>Cancel</span>
                              </button>
                          {% } %}
                      </td>
                  </tr>
              {% } %}
            </script>
            <!-- The template to display files available for download -->
            <script id="template-download" type="text/x-tmpl">
              {% for (var i=0, file; file=o.files[i]; i++) { %}
                  <tr class="template-download fade">
                      <td>
                          <span class="preview">
                              {% if (file.thumbnailUrl) { %}
                                  <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                              {% } %}
                          </span>
                      </td>
                      <td>
                          {% if (window.innerWidth > 480 || !file.thumbnailUrl) { %}
                              <p class="name">
                                  {% if (file.url) { %}
                                      <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                                  {% } else { %}
                                      <span>{%=file.name%}</span>
                                  {% } %}
                              </p>
                          {% } %}
                          {% if (file.error) { %}
                              <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                          {% } %}
                      </td>
                      <td>
                          <span class="size">{%=o.formatFileSize(file.size)%}</span>
                      </td>
                      <td>
                          {% if (file.deleteUrl) { %}
                              <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                                  <i class="glyphicon glyphicon-trash"></i>
                                  <span>Delete</span>
                              </button>
                              <input type="checkbox" name="delete" value="1" class="toggle">
                          {% } else { %}
                              <button class="btn btn-warning cancel">
                                  <i class="glyphicon glyphicon-ban-circle"></i>
                                  <span>Cancel</span>
                              </button>
                          {% } %}
                      </td>
                  </tr>
              {% } %}
            </script>
            <script
              src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"
              integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f"
              crossorigin="anonymous"
            ></script>
            <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
            <script src="uploadm/js/vendor/jquery.ui.widget.js"></script>
            <!-- The Templates plugin is included to render the upload/download listings -->
            <script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
            <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
            <script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
            <!-- The Canvas to Blob plugin is included for image resizing functionality -->
            <script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
            <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
            <script
              src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
              integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
              crossorigin="anonymous"
            ></script>
            <!-- blueimp Gallery script -->
            <script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
            <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
            <script src="uploadm/js/jquery.iframe-transport.js"></script>
            <!-- The basic File Upload plugin -->
            <script src="uploadm/js/jquery.fileupload.js"></script>
            <!-- The File Upload processing plugin -->
            <script src="uploadm/js/jquery.fileupload-process.js"></script>
            <!-- The File Upload image preview & resize plugin -->
            <script src="uploadm/js/jquery.fileupload-image.js"></script>
            <!-- The File Upload audio preview plugin -->
            <script src="uploadm/js/jquery.fileupload-audio.js"></script>
            <!-- The File Upload video preview plugin -->
            <script src="uploadm/js/jquery.fileupload-video.js"></script>
            <!-- The File Upload validation plugin -->
            <script src="uploadm/js/jquery.fileupload-validate.js"></script>
            <!-- The File Upload user interface plugin -->
            <script src="uploadm/js/jquery.fileupload-ui.js"></script>
            <!-- The main application script -->
            <script src="uploadm/js/main.js"></script>
            <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
            <!--[if (gte IE 8)&(lt IE 10)]>
              <script src="js/cors/jquery.xdr-transport.js"></script>
            <![endif]-->


        </div>
    </div>

</div>
<?php include('footer.php'); ?>
