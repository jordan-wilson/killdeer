
    // Initiate the sortable blocks
    $(function() {
        $('.layout_sortable_cell').each(function() {
            $(this).sortable({
                //tolerance: 'pointer',
                //cursorAt: { left: 5 }, 
                //revert: 200,
                //helper: 'clone',
                //containment: '.layout_container',
                scrollSensitivity: 5,
                scrollSpeed: 5,
                forcePlaceholderSize: true,
                placeholder: 'ui-sortable-placeholder',
                connectWith: '.layout_sortable_cell',
                items: '.layout_block:not(.layout_block_locked)',
                create: function(event, ui) {
                    // if there is a limit to the number of blocks this cell can hold
                    if ( $(this).hasClass('layout_limit_cell') ) {
                        if ( $('input[name="limit"]', this).length ) {
                            // add the limit as a data variable
                            $(this).data('limit', $('input[name="limit"]', this).val());
                            
                            // check limit now, and during sortable 'update' and 'stop' events
                            layout_cell_check_limit( this, ui );
                            $(this).bind( 'sortupdate', function(event, ui) { layout_cell_check_limit( this, ui ); });
                            $(this).bind( 'sortstop', function(event, ui) { layout_cell_check_limit( this, ui ); });
                        }
                    }
                }
            });
            $(this).disableSelection();
        });
    });
    
    // check if the cell has reached its limit
    function layout_cell_check_limit( sort, ui ) {
    
        if ( $(sort).data('limit') ) {
            // get length of child blocks
            var count = $(sort).children('.layout_block').length;
            var limit = $(sort).data('limit');
            
            // sends a block back if adding it would exceed the limit
            if ( count > limit ) {
                $(ui.sender).sortable('cancel');
            }
            
            // enable adding blocks
            if ( count < limit ) {
                $('.layout_block_add_disabled a:eq(0)', $(sort).parent()).show();
                $('.layout_block_add_disabled a:eq(1)', $(sort).parent()).remove();
                $('.layout_block_add_disabled', $(sort).parent()).attr('class', 'layout_block_add');
            }
            
            // disable adding blocks
            else {
                $('.layout_block_add a:eq(0)', $(sort).parent()).hide();
                $('.layout_block_add', $(sort).parent()).append('<a onclick="return false">NO MORE BLOCKS</a>');
                $('.layout_block_add', $(sort).parent()).attr('class', 'layout_block_add_disabled');
            }
        }
    }
    