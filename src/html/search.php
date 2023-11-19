
<script>
$(document).ready(function() {
    $('#searchInput').on('input', function() {
        var searchTerm = $(this).val();

        if (searchTerm.length >= 1) {
            $.ajax({
                type: 'POST',
                url: 'SearchConfig.php',
                data: { searchTerm: searchTerm },
                success: function(response) {
                    $('#searchResults').html(response).show(); // Show the results
                }
            });
        } else {
            $('#searchResults').html('').hide(); // Hide the results when input is empty
        }
    });

    // Close the results when clicking outside the search area
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#searchForm').length) {
            $('#searchResults').hide();
        }
    });
});
</script>
