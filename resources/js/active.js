<script type="text/javascript">
    $(document).ready(function() {
        $('.toggle').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            alert(status);
            var id = $(this).data('id'); 
            $.ajax({
                url: "{{ route('activeCategory') }}",
                method: 'GET',
                data: {
                    status: status,
                    id: id,
                },
                success: function(data) {
                    $('#' + result).html(data);
                },
            });
        })
    })
</script>