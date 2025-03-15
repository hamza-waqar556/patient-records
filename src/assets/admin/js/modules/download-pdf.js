class PdfDownloader {
  constructor(options = {}) {
    this.$downloadButton = $(
      options.downloadButtonSelector || "#_download_pdf"
    );
    this.$currentPostId = $(
      options.currentPostIdSelector || "#_current_post_id"
    );
    this.$member = $(options.memberSelector || "#_search_member");
    this.$mhwinId = $(options.mhwinIdSelector || "#_search_mhwin_id");
    this.$postData = $(options.postDataSelector || "#_post_data");
    this.ajaxUrl = options.ajaxUrl || "";
    this.bindEvents();
  }

  bindEvents() {
    this.$downloadButton.on("click", this.handleClick.bind(this));
  }

  handleClick(e) {
    e.preventDefault();
    e.stopPropagation();
    const data = {
      action: "download_pdf",
      post_id: this.$currentPostId.val(),
      member: this.$member.val(),
      mhwin_id: this.$mhwinId.val(),
      post_data: this.$postData.val(),
    };

    $.ajax({
      url: this.ajaxUrl,
      type: "POST",
      data: data,
      xhrFields: { responseType: "blob" },
      success: function (response, status, xhr) {
        const blob = new Blob([response], { type: "application/pdf" });
        const url = window.URL.createObjectURL(blob);
        const link = document.createElement("a");

        // Attempt to extract the filename from the response headers.
        const disposition = xhr.getResponseHeader("Content-Disposition");
        let filename = "download.pdf";
        if (disposition && disposition.indexOf("attachment") !== -1) {
          const filenameRegex = /filename="([^"]+)"/;
          const matches = filenameRegex.exec(disposition);
          if (matches && matches[1]) {
            filename = matches[1];
          }
        }
        link.href = url;
        link.download = filename;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        window.URL.revokeObjectURL(url);
      },
      error: function () {
        alert("Failed to download the PDF");
      },
    });

    return false;
  }
}

$(document).ready(() => {
  new PdfDownloader({ ajaxUrl: AIOB.ajax_url });
});
