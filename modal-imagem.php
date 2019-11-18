
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>




  <!-- Modal Trigger -->
  <a class="btn-small waves-effect waves-light blue modal-trigger" id="modalbtn" href="#modal1">Imagem</a>

  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <div id="imgespaco"></div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close btn-small waves-effect waves-light blue">Fechar</a>
    </div>
  </div>

<script>
$(document).ready(function(){

    $('.modal').modal();
    $('#modalbtn').hide();

     $('input[type="file"]').on('change', function() {

        $('#modalbtn').fadeIn();
        var files = this.files;
        $(files).each(function(index, file) {
          // Still don't know why you want this...
          var fakepath = 'C:\\fakepath\\';
          $('#imgcolocada').remove();
          $('#imgespaco').append('' +
            // build  a fake path string for each File
            '<p class="path"></p>' +
            // all that is really needed to display the image
            '<img id="imgcolocada" src="'+URL.createObjectURL(file)+'">' +
           '');
          $('#imgcolocada').attr('class', 'form-control');
        });



      });

    


  });
</script>


