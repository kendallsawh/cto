<script>
    $(document).ready(function(){
        // Delegated event handling for dynamically added elements
        $(document).on('change', '.docGroupDropdown', function() {
            //console.log("Dropdown changed");
            var selectedValue = $(this).val();
            var selectedText = $(this).find("option:selected").text();
            var $accordionItem = $(this).closest('.accordion-item'); // Find the closest accordion-item

            if(selectedValue) {
                // Hide the selected option
                $(this).find("option[value='" + selectedValue + "']").addClass('d-none');

                var filterSpan = $('<span class="filter-span badge rounded-pill bg-secondary"  id="filter-' + selectedValue + '">' + selectedText + ' <button class="remove-filter btn btn-secondary  btn-sm" data-filter="' + selectedValue + '"><i class="bi bi-x-circle"></i></button></span> ');
                $accordionItem.find('.activeFilters').append(filterSpan);

                // Reset dropdown
                $(this).val('');

                applyFilters($accordionItem);
            }
        });

        $(document).on('click', '.remove-filter', function() {
            //console.log("Filter removed");
            var filterValue = $(this).data('filter');
            var $accordionItem = $(this).closest('.accordion-item');
            $accordionItem.find("#filter-" + filterValue).remove();
            $accordionItem.find(".docGroupDropdown option[value='" + filterValue + "']").removeClass('d-none').show(); // Unhide the option

            applyFilters($accordionItem);
        });

        function applyFilters($accordionItem) {
            var selectedFilters = $accordionItem.find('.remove-filter').map(function() {
                                    return Number($(this).data('filter')); // Convert each to number
                                    }).get();
            //console.log("Selected Filters: ", selectedFilters);
            $accordionItem.find('.list-group-item').each(function() {
                var docGroupId = Number($(this).data('doc-group-id'));
                //console.log("Doc Group ID: ", docGroupId, " - Should Hide: ", !selectedFilters.includes(docGroupId));
                //console.log("Comparing DocGroupID:", docGroupId, "with SelectedFilters:", selectedFilters);
                if(selectedFilters.length === 0 || selectedFilters.includes(docGroupId)) {
                    //console.log("Showing:", $(this).text().trim());
                    $(this).css('display', 'flex'); // Show the item

                } else {
                    $(this).removeClass('d-flex');
                    $(this).css('display', 'none');
                    // Hide the item
                    //console.log("Hiding:", $(this).text().trim());
                }
            });
        }
    });
    </script>
