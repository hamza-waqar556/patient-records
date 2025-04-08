/**
 * Replace keywords "client" or "consumer" (with optional "the") in a string with the member (in uppercase).
 * @param {string} text - The original text.
 * @param {string} member - The member value.
 * @returns {string} - The updated text.
 */
function replaceKeywords(text, member) {
  if (!member) return text;
  return text.replace(/\b(the\s+)?(client|consumer)\b/gi, member);
  // return text.replace(/\b(the\s+)?(client|consumer)\b/gi, member.toUpperCase());
}

/**
 * Normalize text by trimming, converting to lowercase, and collapsing whitespace.
 * @param {string} text - The text to normalize.
 * @returns {string} - Normalized text.
 */
function normalizeText(text) {
  return text.trim().toLowerCase().replace(/\s+/g, " ");
}

class MetaOptionsSelector {
  /**
   * Constructor for MetaOptionsSelector.
   * @param {HTMLElement} container - The container element for one repeater group.
   */
  constructor(container) {
    this.container = $(container);
    // Find the select element controlling the checkboxes.
    this.selectElement = this.container.find("select[name*='checkbox_select']");
    // Find the member input field in this group.
    this.memberInput = this.container.find(".member-input");
    // Find the container where checkboxes are rendered and get its prefix.
    this.tabsWrapper = this.container.find(".tabs-wrapper");
    // The checkbox prefix is provided by PHP (e.g. "progress_reports[0][checkboxes]").
    this.checkboxPrefix =
      this.tabsWrapper.attr("data-checkbox-prefix") ||
      "progress_reports[0][checkboxes]";
    // Retrieve saved checkboxes from data attribute (if any).
    this.savedCheckboxes = this.tabsWrapper.data("saved") || [];
    // Ensure savedCheckboxes is an array (if it’s an object, convert it to an array).
    if (
      !Array.isArray(this.savedCheckboxes) &&
      typeof this.savedCheckboxes === "object" &&
      this.savedCheckboxes !== null
    ) {
      this.savedCheckboxes = Object.values(this.savedCheckboxes);
    }
    this.member = this.memberInput.val() || "";

    // Bind events: update checkboxes on member input or select change.
    this.memberInput.on("input", () => {
      this.member = this.memberInput.val();
      this.updateOptions();
    });
    this.selectElement.on("change", () => this.updateOptions());

    // Initial render of checkboxes.
    this.updateOptions();
  }

  /**
   * Update the checkboxes based on the selected option and current member value.
   */
  updateOptions() {
    const selectedKey = this.selectElement.val();
    let html = "";
    // Normalize saved checkbox values for comparison.
    const normalizedSavedValues = this.savedCheckboxes.map(normalizeText);
    // Use the global metaOptions variable (provided via PHP) to get items for the selected key.
    for (let i = 0; i < metaOptions.length; i++) {
      if (metaOptions[i].hasOwnProperty(selectedKey)) {
        const items = metaOptions[i][selectedKey];
        html += `<div id="${selectedKey}" class="tab-content active"><ul>`;
        items.forEach((item) => {
          const replacedValue = replaceKeywords(item.value, this.member);
          // Build input name as a flat array: e.g. progress_reports[0][checkboxes][1]
          const inputName = `${this.checkboxPrefix}[${item.index}]`;
          // Build input ID for uniqueness.
          const inputId = `${this.checkboxPrefix.replace(
            /[\[\]]/g,
            "-"
          )}-${selectedKey}-${item.index}`;
          // Check if the normalized replaced value is in the saved checkbox values.
          const isChecked =
            normalizedSavedValues.indexOf(normalizeText(replacedValue)) !== -1;

          // Check if heading is defined, and if not, set a default value.
          const heading = item.heading ? item.heading : "";

          html += `
            <li>
              <div style="display: block; font-size: 1.1rem; font-weight: 600; margin-bottom: 4px;">${heading}</div>
              <div>
                <input type="checkbox" name="${inputName}" id="${inputId}" value="${replacedValue}" ${
            isChecked ? "checked" : ""
          }>
                <label for="${inputId}">${replacedValue}</label>
              </div>
            </li>
          `;
        });
        html += "</ul></div>";
        break;
      }
    }
    // Replace the tabs wrapper content with the updated checkboxes.
    this.tabsWrapper.html(html);
  }
}

$(document).ready(() => {
  // Initialize MetaOptionsSelector for each existing group.
  $(".progress-report-group").each(function () {
    new MetaOptionsSelector(this);
  });

  // Repeater: Add New Group.
  $("#add-group").on("click", function () {
    // Clone the first group as a template.
    const $template = $(".progress-report-group").first().clone();
    const newIndex = $(".progress-report-group").length;
    $template.attr("data-index", newIndex);

    // Update names, IDs, labels, and data-checkbox-prefix for the new group.
    $template
      .find("input, select, textarea, label, .tabs-wrapper")
      .each(function () {
        let $el = $(this);
        $.each(
          ["id", "name", "for", "data-checkbox-prefix"],
          function (i, attr) {
            let attrVal = $el.attr(attr);
            if (attrVal) {
              attrVal = attrVal.replace(/\d+/, newIndex);
              $el.attr(attr, attrVal);
            }
          }
        );
      });

    $("#progress-report-repeater").append($template);
    new MetaOptionsSelector($template);
  });

  // Repeater: Remove Group.
  $("#progress-report-repeater").on("click", ".remove-group", function () {
    if ($(".progress-report-group").length > 1) {
      $(this).closest(".progress-report-group").remove();
    } else {
      alert("At least one group is required.");
    }
  });
});
