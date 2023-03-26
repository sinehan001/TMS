(function(){
    "use strict";

    var dropZone = document.getElementById('drop-zone');
    var barFill = document.getElementById('bar-fill');
    var barFillText = document.getElementById('bar-fill-text');
    var uploadsFinished = document.getElementById('uploads-finished');
    var processor = 'upload_file.php';

    var startUpload = function(files){
        barFill.style.width = 0;
        if(files.length==0) {
            console.log("No files to upload");
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No CSV file to upload'
            });
        }
        else {
        app.uploader({
            files: files,
            progressBar: barFill,
            pregressText: barFillText,
            processor: processor,

            finished: function(data){
                var currFile;
                var x;
                var uploadedElement;
                var uploadedAnchor;
                var uploadedStatus;

                for(x = 0; x < data.length; x++){
                    currFile = data[x];
                    // console.log(currFile);
                    uploadedElement = document.createElement('div');
                    uploadedElement.className = 'upload-console-upload';

                    uploadedAnchor = document.createElement('a');
                    uploadedAnchor.textContent = currFile.name;

                    uploadedStatus = document.createElement('span');

                    if(currFile.uploaded){
                        uploadedAnchor.href = currFile.destFolder + currFile.newFile;
                        uploadedStatus.textContent = 'Uploaded';
                        uploadedStatus.className = 'successUpload';
                    } else {
                        uploadedStatus.textContent = 'Failed';
                        uploadedStatus.className = 'failedUpload';
                    }

                    
                    uploadedElement.appendChild(uploadedAnchor);
                    uploadedElement.appendChild(uploadedStatus);

                    uploadsFinished.appendChild(uploadedElement);
                }

                uploadsFinished.className = '';
            },

            error: function(){
                console.log('there was some error');
            }
        });
    }
    };

    // Standard form upload
    document.getElementById('standard-upload').addEventListener('click', function(e){
        var standardUploadFiles = document.getElementById('standard-upload-file').files;
        e.preventDefault();

        startUpload(standardUploadFiles);
    });


    // Drop functionality
    dropZone.ondrop = function(e){
        e.preventDefault();
        this.className = 'upload-console-drop';

        startUpload(e.dataTransfer.files);
    };

    dropZone.ondragover = function(){
        this.className = 'upload-console-drop drop';
        return false;
    };

    dropZone.ondragleave = function(){
        this.className = 'upload-console-drop';
        return false;
    };
}());
$(document).ready(function (e) {
$("#send_data").click(function (event) {
    var standardUploadFiles = document.getElementById('standard-upload-file').files;
    if(standardUploadFiles.length==0) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'No CSV file to upload'
        });
    }
    else {
        window.location.href="process.php";
    }
    event.preventDefault();
});
$("#send_data_man").click(function (event) {
    var standardUploadFiles = document.getElementById('standard-upload-file').files;
    if(standardUploadFiles.length==0) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'No CSV file to upload'
        });
    }
    else {
        window.location.href="process1.php";
    }
    event.preventDefault();
});
});