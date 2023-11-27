    $(document).ready(function() {
        $('#searchInput1').on('input', function() {
            var searchTerm1 = $(this).val();

            if (searchTerm1.length >= 1) {
                $.ajax({
                    type: 'POST',
                    url: 'OriginalTableContent.php',
                    data: { searchTerm1: searchTerm1 },
                    success: function(response) {
                        $('#dataTable tbody ').html(response).show(); // Show the results in the table
                    }
                });
            } else {
                // Reload the original table content when input is empty
                $.ajax({
                    type: 'POST',
                    url: 'SearchDltConfig.php', // Create a new PHP file to get the original table content
                    success: function(response) {
                        $('#dataTable tbody').html(response).show();
                    }
                });
            }
        });

        // Close the results when clicking outside the search area
        // $(document).on('click', function(event) {
        //     if (!$(event.target).closest('#searchForm').length) {
        //         $('#dataTable tbody').html('').show(); // Hide the results and reload the original table content
        //     }
        // });
    });
