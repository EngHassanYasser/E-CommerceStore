<div class="form-group">
    
    <label>Image</label>

    <input type="file" name="image" class="form-control" id="imageInput">
    <div class="mt-3 position-relative" style="width:200px;">

        <img id="imagePreview" src="{{ asset($basePath . '/' . $image) }}"
            style="
                width:200px;
                height:200px;
                object-fit:cover;
                border:1px solid #ccc;
                border-radius:10px;
                 display: {{ $image ? 'block' : 'none' }};
            ">

        <button type="button" id="removeImageBtn"
            style="
                position:absolute;
                top:5px;
                right:5px;
                width:30px;
                height:30px;
                border:none;
                border-radius:50%;
                background:red;
                color:white;
                cursor:pointer;
                display:none;
            ">
            X
        </button>

    </div>

</div>
<script>
    const imageInput = document.getElementById('imageInput');

    const imagePreview = document.getElementById('imagePreview');

    const removeImageBtn = document.getElementById('removeImageBtn');


    imageInput.addEventListener('change', function() {

        const file = this.files[0];

        if (file) {

            const reader = new FileReader();

            reader.onload = function(e) {

                imagePreview.setAttribute('src', e.target.result);

                imagePreview.style.display = 'block';

                removeImageBtn.style.display = 'block';
            }

            reader.readAsDataURL(file);
        }

    });

    removeImageBtn.addEventListener('click', function() {

        imageInput.value = '';

        imagePreview.setAttribute('src', '');

        imagePreview.style.display = 'none';

        removeImageBtn.style.display = 'none';

    });
</script>
