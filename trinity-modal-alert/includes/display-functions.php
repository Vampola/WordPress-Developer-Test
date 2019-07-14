<?php

function trinity_modal_content_page() {
    $options = get_option('tt_modal');

    if(is_page($options[page_modal]) && !empty($options[page_modal]) && $options[enablePage] == true) {

        echo '        
        <div id="tallModal" class="modal modal-wide fade">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">'. $options['modal-title'] .'</h4>
            </div>
            <div class="modal-body">
                <p>'. $options['modal-desc'] .'</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        ';        
    }
}

add_action( 'wp_footer', 'trinity_modal_content_page');


function trinity_modal_content_post() {
    $options = get_option('tt_modal');

    if(is_single($options[post_modal]) && !empty($options[post_modal]) && $options[enablePost] == true) {
        echo '        
        <div id="tallModal" class="modal modal-wide fade">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">'. $options['modal-title'] .'</h4>
            </div>
            <div class="modal-body">
                <p>'. $options['modal-desc'] .'</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        ';       
    }
}

add_action( 'wp_footer', 'trinity_modal_content_post');
