class MetaOptionsSelector {
  constructor(selectSelector, containerSelector, metaOptions) {
    console.log(metaOptions);

    this.selectElement = $(selectSelector);
    this.container = $(containerSelector);
    this.metaOptions = metaOptions;

    this.init();
  }

  init() {
    this.selectElement.on("change", () => this.updateOptions());
  }

  updateOptions() {
    const selectedKey = this.selectElement.val();
    let html = "";

    for (let i = 0; i < this.metaOptions.length; i++) {
      if (this.metaOptions[i].hasOwnProperty(selectedKey)) {
        const items = this.metaOptions[i][selectedKey];
        html += `<div id="${selectedKey}" class="tab-content active"><ul>`;

        items.forEach((item) => {
          const inputName = `check[${selectedKey}][${item.index}]`;
          const inputId = `check-${selectedKey}-${item.index}`;
          html += `
                        <li>
                            <input type="checkbox" name="${inputName}" id="${inputId}" value="${item.value}">
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
  new MetaOptionsSelector("#select_key", ".tabs-wrapper", metaOptions);
});
