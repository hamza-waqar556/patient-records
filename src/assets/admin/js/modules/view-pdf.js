// Define the ViewPdf class
import MHWINFetcher from "./ajax-mhwin-id.js";

class ViewPdf {
    constructor(options = {}) {
        // Assign selectors with defaults
        this.previewButtonSelector = options.previewButtonSelector || '#preview';
        this.postIdSelector = options.postIdSelector || '#_current_post_id';
        this.memberSelector = options.memberSelector || '#_search_member';
        this.mhwinIdSelector = options.mhwinIdSelector || '#_search_mhwin_id';
        this.postDataSelector = options.postDataSelector || '#_post_data';
        this.viewUrl = options.viewUrl || AIOB.view_url;

        // Initialize the class
        this.init();
    }

    // Initialize method to bind events
    init() {
        const self = this;
        $(document).ready(function() {
            $(self.previewButtonSelector).on('click', function(e) {
                e.preventDefault();
                self.handlePreview();
            });
        });
    }

    // Method to handle the preview action
    handlePreview() {
        const postId = $(this.postIdSelector).val();
        const member = $(this.memberSelector).val();
        const mhwinId = $(this.mhwinIdSelector).val();
        const postData = $(this.postDataSelector).val();

        const form = $('<form>', {
            action: this.viewUrl,
            method: 'POST',
            target: '_blank'
        });

        form.append($('<input>', {
            type: 'hidden',
            name: 'post_id',
            value: postId
        }));

        form.append($('<textarea>', {
            name: 'post_data',
            style: 'display:none;'
        }).text(postData));

        $('body').append(form);
        form.submit();
        form.remove();
    }
}

// Instantiate the ViewPdf class
$(document).ready(() => {
    new ViewPdf();
});
