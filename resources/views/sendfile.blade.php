<!doctype html>
<html lang="{{ app()->getLocale() }}" data-reactroot="">
@include('includes.head')

<body>
<div id="root">
        <div class="main-content">
            <div class="upload-container" id="uploadContainer">
                <h1 class="title">Personnalisez le textile avec l'image de votre choix</h1>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {!! Form::open([
                'enctype' => 'multipart/form-data',
                'id' => 'uploadForm',
                ]) !!}

                <label for="fileInput" class="dropzone" id="dropzoneContainer">
                    <div class="no-data-img" id="noDataImgContainer">
                        <img src="/img/upload.svg" alt="Upload">
                        <p>Glissez et déposez votre fichier ici, <br> ou appuyez pour télécharger votre fichier</p>
                        <br>
                        <p>Poids max : 10Mo, Format : JPG, PNG</p>
                    </div>
                    <div class="data-img" id="dataImgContainer" style="display: none;">
                        <p id="filename" style="display: none;"></p>
                        <p id="filesize" style="display: none;"></p>
                        <img id="previewImage" class="preview-image" alt="" style="display: none;">
                    </div>
                </label>
                {!! Form::file('file', [
                'id' => 'fileInput',
                'style' => 'display: none;',
                ]) !!}

                {!! Form::submit('Envoyer sur la borne', [
                'class' => 'send-button',
                'style' => 'display: none;'
                ]) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</body>


<script>
    var dropzone = document.getElementById('dropzoneContainer');
    var fileInput = document.getElementById('fileInput');
    var uploadForm = document.getElementById('uploadForm');

    dropzone.addEventListener('dragover', function(event) {
        event.preventDefault();
        dropzone.classList.add('dragover');
    });

    dropzone.addEventListener('dragleave', function(event) {
        event.preventDefault();
        dropzone.classList.remove('dragover');
    });

    dropzone.addEventListener('drop', function(event) {
        event.preventDefault();
        dropzone.classList.remove('dragover');

        var file = event.dataTransfer.files[0];
        handleFile(file);
    });

    dropzone.addEventListener('click', function(event) {
        event.preventDefault();
        fileInput.click();
    });

    fileInput.addEventListener('change', function(event) {
        var file = event.target.files[0];
        handleFile(file);
    });

    function handleFile(file) {
        if (file.type === 'image/jpeg' || file.type === 'image/png') {
            var filenameElement = document.getElementById('filename');
            filenameElement.textContent = file.name;
            filenameElement.style.display = 'block';

            var filesizeElement = document.getElementById('filesize');
            filesizeElement.textContent = formatSize(file.size);
            filesizeElement.style.display = 'block';

            var previewImage = document.getElementById('previewImage');
            var reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';

                var noDataImgContainer = document.getElementById('noDataImgContainer');
                noDataImgContainer.style.display = 'none';

                var dataImgContainer = document.getElementById('dataImgContainer');
                dataImgContainer.style.display = 'block';
            };
            reader.readAsDataURL(file);
            fileInput.files = event.target.files || event.dataTransfer.files;

            var submitButton = document.querySelector('input[type="submit"]');
            submitButton.style.display = 'block';
        } else {
            alert("Seulement les images au format JPG, PNG sont acceptées");
        }
    }

    function formatSize(bytes) {
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (bytes === 0) return '0 Bytes';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
    }
</script>





<style>
    .title {
        font-size: 1.5rem;
        margin-bottom: 25px;
        text-align: center;
    }

    .no-data-img {
        text-align: center;
    }

    .no-data-img img {
        width: 50px;
        margin: auto;
    }

    .no-data-img p {
        text-align: center;
    }

    .data-img {
        text-align: center;
    }

    .data-img img {
        width: 150px;
        margin: auto;
    }

    .upload-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        width: 80vw;
        margin: auto;
    }

    .upload-container .send-button {
        margin-top: 10px;
        padding: 10px 20px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }

    .upload-container .send-button:hover {
        background-color: #45a049;
    }

    .upload-container .send-button:active {
        background-color: #297c2d;
    }

    .dropzone {
        min-width: 300px;
        min-height: 150px;
        padding: 25px;
        width: auto;
        height: auto;
        border: 2px dashed #ccc;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .dropzone.dragover {
        background-color: #f0f0f0;
    }

    button {
        margin-top: 10px;
    }

    .preview-image {
        max-width: 100%;
        max-height: 200px;
        margin-top: 10px;
    }
</style>

</html>