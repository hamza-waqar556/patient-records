class MHWINFetcher {
  constructor() {
    this.init();
    this.bindAutoFill();
  }

  init() {
    // Existing functionality for fetching MHWIN IDs on keyup...
    $("#_search_member").on("keyup", () => {
      const member = $("#_search_member").val();
      if (member.length > 0) {
        this.fetchMhwinIds(member);
      } else {
        $("#_search_mhwin_id").html(
          '<option value="">Select MHWIN ID</option>'
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
          // Build new options with post_id as value and MHWIN ID as text.
          let options = '<option value="">Select MHWIN ID</option>';
          $.each(response.data, (index, option) => {
            options +=
              '<option value="' +
              option.post_id +
              '">' +
              option.mhwin_id +
              "</option>";
          });
          $("#_search_mhwin_id").html(options);
        }
      },
    });
  }

  bindAutoFill() {
    // When the Auto Fill button is clicked, send the hidden post data via AJAX.
    $("#auto-fill-button").on("click", (e) => {
      e.preventDefault();
      const $btn = $(e.currentTarget);
      $btn.prop("disabled", true).css({
        cursor: "not-allowed",
        opacity: "0.5",
      });

      const selectedPostId = $("#_search_mhwin_id").val();
      const currentPostId = $("#_current_post_id").val();

      $.ajax({
        url: AIOB.ajax_url,
        type: "POST",
        dataType: "json",
        data: {
          action: "autofill_post_data",
          selected_post_id: selectedPostId,
          current_post_id: currentPostId,
          security: AIOB.autofill_nonce,
        },
        success: (response) => {
          if (response.success) {
            console.log("Received post data:", response.data);
            // Do additional processing if needed.
            setTimeout(() => {
              location.reload();
            }, 5000);
          }
        },
      });
    });
  }
}

export default MHWINFetcher;

// Initialize the class when the document is ready.
$(document).ready(() => {
  new MHWINFetcher();
});
