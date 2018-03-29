(function () {
    'use strict';

    var dropFiles = $('#drop-files'),
        uploadField = $('#upload-field'),    
        uploadForm = $('#upload-form'),
        msgContainer = $('#msg-container');

    // Previne que o arquivo se abra no navegador
    dropFiles.on('dragover drop', function (e) {
        
        e.preventDefault();
        e.stopPropagation();

    }).on('drop', function (e) {

        msgContainer.html("");

        $.each(e.originalEvent.dataTransfer.files, function (key, file) {
            // Verifica o tipo do arquivo
            if (file.type === 'text/xml' || file.type === 'application/xml') {
                msgContainer.append('<div class="alert alert-success">' + file.name + ' pronto para ser importado.</div>');
            } else {
                console.log(e.originalEvent.dataTransfer.files);
                // e.originalEvent.dataTransfer.files.item(key).delete();
                msgContainer.append('<div class="alert alert-danger">' + file.name + ' não tem formato válido.</div>');                
            }
        });

        uploadField[0].files = e.originalEvent.dataTransfer.files;

        setTimeout(() => {
            msgContainer.hide('slow', function () {
                msgContainer.html("");
                msgContainer.show();
            });
        }, 2000);
    });

})();