class MHWINFetcher {
  constructor() {
    this.init();
  }

  init() {
    // Listen to keyup on the member input field.
    $("#_search_member").on("keyup", () => {
      const member = $("#_search_member").val();
      if (member.length > 0) {
        this.fetchMhwinIds(member);
      } else {
        $("#_search_mhwin_id").html(
          '<option value=""><?php _e("Select MHWIN ID", "textdomain"); ?></option>'
        );
      }
    });
  }

  fetchMhwinIds(member) {
    $.ajax({
      url: AIOB.ajax_url,
      type: "POST",
      dataType: "json",
      data: {
        action: "fetch_mhwin_ids",
        member: member,
        security: AIOB.nonce_mhwin,
      },
      success: (response) => {
        if (response.success) {
          // Build new options for the MHWIN ID select field.
          let options =
            '<option value=""><?php _e("Select MHWIN ID", "textdomain"); ?></option>';
          $.each(response.data, (index, mhwin) => {
            options += '<option value="' + mhwin + '">' + mhwin + "</option>";
          });
          $("#_search_mhwin_id").html(options);
        }
      },
    });
  }
}

export default MHWINFetcher;

// Initialize the class when the document is ready.
$(document).ready(() => {
  new MHWINFetcher();
});
