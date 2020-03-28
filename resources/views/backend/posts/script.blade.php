<script>
    $('ul.pagination').addClass('no-margin pagination-sm');
    $(document).on('blur', '#slug', function(){
        var TitleInput = $('#title').val().toLowerCase().trim();
        TitleInput = TitleInput.replace(/[^a-z0-9-]+/g, '-');
        var SlugInput = $('#slug').val(TitleInput);
    });
    var simplemde1 = new SimpleMDE({ element: $("#excerpt")[0] });
    var simplemde2 = new SimpleMDE({ element: $("#body")[0] });
    $('#published_at').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        showClear: true
    });
    $(document).on('click', '#draft-btn', function(e){
        e.preventDefault();
        $('#post-time').val('');
        $('#post-form').submit();
    });
</script>
