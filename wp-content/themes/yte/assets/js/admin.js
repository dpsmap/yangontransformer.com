jQuery(document).ready(function($) {
    // Remove all .postbox classes from sidebar
    $('#my-meta-box-id').removeClass('postbox');
    $('#my-meta-box-id h2.hndle').css('padding', '0px');
    // Remove .postbox from specific metabox (page attributes)
    $('#pageparentdiv').removeClass('postbox-container');
});
