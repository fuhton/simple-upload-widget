/*
* Description:
* Media uploader via WP 3.5
*
* @method suwUploader
* @param  void
* @return false
*/

function suwUploader() {
    var _custom_media = true,
    _orig_send_attachment = wp.media.editor.send.attachment;

    jQuery('input.suw-button-select').click(function(e) {
        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = jQuery(this);
        var input = jQuery(this).prev('.suw-input-field');
        _custom_media = true;
        wp.media.editor.send.attachment = function(props, attachment){
            if ( _custom_media ) {
                input.val(attachment.url);
            } else {
                return _orig_send_attachment.apply( this, [props, attachment] );
            };
        }

        wp.media.editor.open(button);
        return false;
    });

    jQuery('.add_media').on('click', function(){
        _custom_media = false;
    });
};


/*
* Description:
* jQuery call on above function
*
* @method void
* @param  void
* @return void
*/

jQuery(document).ready(function($){
    suwUploader();
});
