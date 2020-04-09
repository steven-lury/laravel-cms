<script>
    $('ul.pagination').addClass('no-margin pagination-sm');
    $(document).on('blur', '#slug', function(){
        var TitleInput = $('#title').val().toLowerCase().trim();
        TitleInput = TitleInput.replace(/[^a-z0-9-]+/g, '-');
        var SlugInput = $('#slug').val(TitleInput);
    });

    $(document).on('ready', function(){
        $(".alert").show();
        setTimeout(function() { $(".alert").fadeOut(); }, 5000);
    });
</script>
