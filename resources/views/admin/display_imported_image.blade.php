<script>
    function previewFile(input) {
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            var img = document.getElementById('previewImage');
            img.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            var img = document.getElementById('previewImage');
            img.src = "{{ asset('doctorimage/' . $data->image) }}";
        }
    }
</script>
