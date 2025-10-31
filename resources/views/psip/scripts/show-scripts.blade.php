<script type="text/javascript">
    var getUrl = "{{ route('activities.filltable') }}";
    function fetchDocTypeDivisions(activity_id) {
        $.ajax({
            type: 'POST',
            url: getUrl,
            data: { activity_id: activity_id, _token: '{{ csrf_token() }}' },
            success: function(response) {
                $('#tabledoc tbody').empty(); // Clear existing rows

                if (response.status === 'not_found') {
                    $('#tabledoc tbody').append('<tr><td colspan="2">No records found.</td></tr>');
                } else if (response.status === 'found') {
                    response.data.forEach(function(row) {
                        $('#tabledoc tbody').append(
                            '<tr>' +
                                '<td>' + row.doc_type_name + '</td>' +
                                '<td><span class="badge rounded-pill ' + (row.uploaded === 'Yes' ? 'bg-success' : 'bg-danger') + ' stacked-badge">' + row.uploaded + '</span></td>' +

                            '</tr>'
                        );
                    });
                }
            }
        });
    }

    function setUpdateDocId(doc_id,activity_id){
        //alert(doc_id)
        $('#update_doc_id').val(doc_id);
        $('#update_activity_doc_id').val(activity_id);
    }
    function setSurpesssActivityId(activity_id){
        //alert(activity_id)

        $('#surpress_activity').val(activity_id);
    }
    function setRemoveActivityId(activity_id){
        //alert(activity_id)

        $('#remove_activity').val(activity_id);
    }


</script>
<script>
    // Ensure the script runs only after the DOM is fully loaded
    $(document).ready(function() {
        // Event listener for edit button clicks
    $('.edit-activity-particular').on('click', function() {
            // Retrieve the ID of the selected activity particular
            let id = $(this).data('id');
            let particulars = $(this).data('particulars');
            let cost = $(this).data('cost');

            // Populate the modal's hidden input field with the selected activity particular ID
            $('#activity_particular_id').val(id);
            $('#particulars').val(particulars);
            $('#particulars_cost').val(cost);
        });
    });

</script>
<script>
    $(document).ready(function() {
    // Open modal via AJAX
    $(document).on('click', '.add-sub-activity', function() {
        let activityId = $(this).data('activity-id');
        $('#addParticularModal').remove();
        $('body').append('<div id="modal-container"></div>');

        $.get("/activities/" + activityId + "/add-particular-modal", function(response) {
            $('#modal-container').html(response);
            $('#addParticularModal').modal('show');
            $('#addParticularModal').attr('data-activity-id', activityId); // Store activity ID in modal
        });
    });

    // Add more sub-activity fields
    $(document).on('click', '#addMoreSubActivity', function() {
        $('#subActivityContainer').append('<div class="sub-activity-row">' +
            '<input type="text" name="particulars[]" class="form-control" placeholder="Sub-Activity Name" required>' +
            '<input type="number" name="particulars_cost[]" class="form-control" placeholder="Cost" required>' +
            '</div>');
    });

    // Submit sub-activity form via AJAX
    $(document).on('submit', '#addParticularForm', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();

        let activityId = $('#addParticularModal').attr('data-activity-id'); // Get correct activity ID


        $.post("/activities/" + activityId + "/store-particulars", formData, function(response) {
            if (response.success) {
                alert('Sub-activities added successfully');
                location.reload();
            }
        });
    });

});

</script>
