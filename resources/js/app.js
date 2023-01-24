import {Dropzone} from "dropzone";

Dropzone.autoDiscover = false;

if (document.getElementById('dropzone')) {
    const dropzone = new Dropzone('#dropzone', {
        dictDefaultMessage: 'Sube aquí tu imagen',
        acceptedFiles: '.png,.jpg,.jpeg,.gif',
        addRemoveLinks: true,    //Permite al usuario eliminar la imagen
        dictRemoveFile: 'Borrar Archivo',
        maxFiles: 1,
        uploadMultiple: false,
    
        init: function(){
            if(document.querySelector('[name="image"]').value.trim()){
                const imagePublic = {}
                imagePublic.size = 1234;
                imagePublic.name = document.querySelector('[name="image"]').value;
    
                this.options.addedfile.call(this, imagePublic);
                this.options.thumbnail.call(this, imagePublic, `/uploads/${imagePublic.name}`);
    
                imagePublic.previewElement.classList.add('dz-success', 'dz-complete')
    
            }
        }
    });
    
    dropzone.on('success', function(file, response){
        document.querySelector('[name="image"]').value = response.image;
    });
    dropzone.on('removedfile', function(){
        document.querySelector('[name="image"]').value = "";
    });
}







