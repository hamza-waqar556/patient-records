class PdfDownloader {
  constructor(options = {}) {
    // Selectors with default values.
    this.$downloadButton = $(
      options.downloadButtonSelector || "#_download_pdf"
    );
    this.$currentPostId = $(
      options.currentPostIdSelector || "#_current_post_id"
    );
    this.$postData = $(options.postDataSelector || "#_post_data");
    this.$member = $(options.memberSelector || "#_search_member");
    this.$mhwinId = $(options.mhwinIdSelector || "#_search_mhwin_id");

    // Options passed from PHP.
    this.nonce = options.nonce || "";
    this.ajaxUrl = options.ajaxUrl || "";

    // Bind events.
    this.bindEvents();
  }

  bindEvents() {
    this.$downloadButton.on("click", this.handleClick.bind(this));
  }

  handleClick(e) {
    e.preventDefault();
    const current_post_id = this.$currentPostId.val();
    const post_data = this.$postData.val();
    const member = this.$member.val();
    const mhwin_id = this.$mhwinId.val();

    // Build the URL for the download endpoint.
    const url =
      this.ajaxUrl +
      "?action=download_pdf&nonce=" +
      this.nonce +
      "&post_id=" +
      current_post_id +
      "&member=" +
      encodeURIComponent(member) +
      "&mhwin_id=" +
      encodeURIComponent(mhwin_id) +
      "&post_data=" +
      encodeURIComponent(post_data);

    window.location.href = url;
  }
}

$(document).ready(() => {
  new PdfDownloader({ nonce: AIOB.download_pdf_nonce, ajaxUrl: AIOB.ajax_url });
});

// Export the class globally.
export default PdfDownloader;
