$(document).ready(function() {
    $('#searchForm').on('submit', function(e) {
        e.preventDefault();
        var searchTerm = $('#searchInput').val();
        $.ajax({
            url: 'searchUser.php',
            type: 'POST',
            data: {search: searchTerm},
            dataType: 'json', // Expecting JSON response
            success: function(response) {
                if (response.status === 'success') {
                    var users = response.users;
                    $('#results').empty();
                    $('#userDropdown').empty(); // Clear previous options

                    users.forEach(function(user, index) {
                        var option = $('<option></option>').val(user.email).text(user.name + " - " + user.email);
                        $('#userDropdown').append(option);
                        if (index === 0) { // Automatically select the first user
                            $('#results').append(`<p><strong>Selected User:</strong> ${user.name} - ${user.email}</p>`);
                            $('#userDropdown').val(user.email); // Set selected option in dropdown
                        }
                    });
                } else {
                    $('#results').html('No results found.');
                    $('#userDropdown').empty(); // Clear previous options
                }
            },
            error: function() {
                alert('Error searching user.');
            }
        });
    });
});
