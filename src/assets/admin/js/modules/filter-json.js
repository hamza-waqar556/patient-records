class FilterJson {
  constructor() {
    this.jsonFilePath = "../../../data/service-options.json";
    this.originalData = null;
    this.currentCategories = {
      "form2-r1-cls": "r1-c1", // Default values
      "form2-r2-cls": "r2-c1",
      "form2-r3-cls": "r3-c1",
      "form2-r4-cls": "r4-c1",
    };
    this.init();
  }

  init() {
    this.loadInitialData();
    this.setupEventListeners();
  }

  setupEventListeners() {
    // Listen for category selection changes on ALL dynamically generated dropdowns
    $(document).on("change", '[id^="form2-r"][id$="-cls"]', (e) => {
      const dropdownId = e.target.id;
      this.currentCategories[dropdownId] = e.target.value;
      this.updateContent();
    });

    // Listen for member name input
    $(document).on("input", "#form2-member", () => {
      this.updateContent();
    });
  }

  loadInitialData() {
    $.getJSON(this.jsonFilePath)
      .done((data) => {
        this.originalData = data;
        this.updateContent();
      })
      .fail(() => console.error("Error loading JSON file."));
  }

  updateContent() {
    if (!this.originalData) return;

    const userInput = $("#form2-member").val().trim();
    const replaceWith = userInput || "the client"; // Default fallback

    const processedData = this.processData(this.originalData, replaceWith);
    this.renderContent(processedData);
  }

  processData(data, replacement) {
    return data.map((category) => {
      const key = Object.keys(category)[0];
      return {
        [key]: category[key].map((item) => ({
          ...item,
          value: item.value.replace(/the client|the consumer/gi, replacement),
        })),
      };
    });
  }

  renderContent(data) {

    console.log("renderContent data ", data);

    // Clear all tabs
    $(".tab-content").removeClass("active").find("ul").empty();

    Object.keys(this.currentCategories).forEach((dropdownId) => {
      const categoryKey = this.currentCategories[dropdownId].split("-").pop();
      const categoryData = data.find((item) => item[categoryKey])?.[
        categoryKey
      ];

      if (!categoryData) {
        console.warn(`No data found for category ${categoryKey}`);
        return;
      }

      // Populate the corresponding tab
      const activeTab = $(`#${this.currentCategories[dropdownId]}`);
      activeTab
        .addClass("active")
        .find("ul")
        .html(
          categoryData
            .map(
              (item, index) => `
                    <li>
                    <div style="display: block; font-size: 1rem; font-weight: 600; margin-bottom: 10px;"> ${item.heading} </div>
                      <div>
                        <input type="checkbox" 
                               name="${
                                 this.currentCategories[dropdownId]
                               }-check[]" 
                               id="${this.currentCategories[dropdownId]}-check${
                                index + 1
                              }"
                              value="${item.value}"
                              >
                        <label for="${
                          this.currentCategories[dropdownId]
                        }-check${index + 1}">
                            ${item.value}
                        </label>
                    </div>
              </li>
                `
            )
            .join("")
        );
    });
  }
}

export default FilterJson;
