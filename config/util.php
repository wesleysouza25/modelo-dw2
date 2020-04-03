<?php

function modalMessage($titulo, $texto, $urllocal, $urlvoltar) {
    echo "<link rel='stylesheet' type='text/css' href='../config/bootstrap-3.4.1-dist/css/bootstrap.min.css'>";
    echo "<div class='' tabindex='-1' role='dialog'>" .
    "<div class='modal-dialog' role='document'>" .
    "<div class='modal-content'>" .
    "<div class='modal-header'>" .
    " <h5 class='modal-title'>$titulo</h5>" .
    "<button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>" .
    "  <span aria-hidden='true'>&times;</span>" .
    "</button>" .
    " </div>" .
    " <div class='modal-body'>" .
    "  <p>$texto</p>" .
    "</div>" .
    "<div class='modal-footer'>" .
    " <a href='$urllocal'><button type='button' class='btn btn-secondary' data-dismiss='modal'>Voltar</button></a>" .
    " <a href='$urlvoltar'><button type='button' class='btn btn-primary'>Principal</button></a>" .
    "</div>" .
    "</div>" .
    "</div>" .
    "</div>";
}
