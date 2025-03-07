/**
 * meta-options-selector.js
 *
 * This class updates the displayed checkboxes based on the selected option
 * and marks checkboxes as checked if they were saved previously.
 */
class MetaOptionsSelector {
  /**
   * Constructor.
   * @param {string} selectSelector - The jQuery selector for the select element.
   * @param {string} containerSelector - The container for the checkboxes.
   * @param {Object} metaOptions - JSON object representing available options.
   * @param {Object} savedCheckboxes - Flat array of saved checkbox values.
   */
  constructor(selectSelector, containerSelector, metaOptions, savedCheckboxes) {
    this.selectElement = $(selectSelector);
    this.container = $(containerSelector);
    this.metaOptions = metaOptions;
    this.savedCheckboxes = savedCheckboxes || {};
    console.log("Saved Checkboxes:", this.savedCheckboxes);
    this.checkboxPrefix = "_checkboxes"; // Must match PHP field names
    this.init();
  }

  /**
   * Initialize event handlers and update options on page load.
   */
  init() {
    // When the select value changes, update the checkboxes.
    this.selectElement.on("change", () => this.updateOptions());
    // Update on page load.
    this.updateOptions();
  }

  /**
   * Render checkboxes based on the selected key and saved data.
   */
  updateOptions() {
    const selectedKey = this.selectElement.val();
    let html = "";
    // Since savedCheckboxes is a flat array, we use it directly.
    const saved = this.savedCheckboxes;
    // Loop through metaOptions to find data for the selected key.
    for (let i = 0; i < this.metaOptions.length; i++) {
      if (this.metaOptions[i].hasOwnProperty(selectedKey)) {
        const items = this.metaOptions[i][selectedKey];
        html += `<div id="${selectedKey}" class="tab-content active"><ul>`;
        items.forEach((item) => {
          const inputName = `${this.checkboxPrefix}[${selectedKey}][${item.index}]`;
          const inputId = `${this.checkboxPrefix}-${selectedKey}-${item.index}`;
          // Mark checkbox as checked if the saved flat array has a value at the index equal to the current item value.
          const isChecked = saved[item.index] === item.value ? "checked" : "";
          html += `
            <li>
              <input type="checkbox" name="${inputName}" id="${inputId}" value="${item.value}" ${isChecked}>
              <label for="${inputId}">${item.value}</label>
            </li>
          `;
        });
        html += "</ul></div>";
        break;
      }
    }
    this.container.html(html);
  }
}

$(document).ready(() => {
  // Ensure the select element ID matches the one rendered by PHP.
  new MetaOptionsSelector(
    "#_checkbox_select",
    ".tabs-wrapper",
    metaOptions,
    savedCheckboxes
  );
});
