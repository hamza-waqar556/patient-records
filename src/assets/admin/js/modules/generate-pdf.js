jQuery(document).ready(function ($) {
  $("#generate-pdf-button").on("click", function (e) {
    e.preventDefault();

    var member = $("#_search_member").val();
    var mhwin_id = $("#_search_mhwin_id").val();
    var post_data = $("#_post_data").val();
    var post_id = $("#_current_post_id").val();


    $.ajax({
      url: AIOB.ajax_url, // Using localized variable from your Enqueue class
      method: "POST",
      data: {
        action: "generate_pdf",
        nonce: AIOB.nonce,
        member: member,
        mhwin_id: mhwin_id,
        post_data: post_data,
        post_id: post_id,
      },
      success: function (response) {
        if (response.success) {
          alert("Email sent successfully.");
        } else {
          alert("Error: " + response.data);
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX error:", error);
      },
    });
  });
});
