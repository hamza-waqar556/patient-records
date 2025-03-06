import FilterJson from "./filter-json.js";

class Form2Controls {
  constructor() {
    this.container = document.getElementById("form2RepeaterFields");
    this.init();
  }

  init() {
    new FilterJson();
    this.addFields(); // Generate fields on page load
  }

  addFields() {
    for (let i = 1; i <= 4; i++) {
      const fieldSet = `
               <div class="">
                <div class="input-rows">
                    <div class="input-wrapper w-33">
                        <label for="form2-r${i}-staff">
                            Staff Initials
                        </label>
                        <input type="text" name="form2-r${i}-staff" id="form2-r${i}-staff" placeholder="Staff Initials">
                    </div>
                    <div class="select-wrapper w-33">
                        <label for="form2-r${i}-cls">
                            CLS/PC
                        </label>
                        <select name="form2-r${i}-cls" id="form2-r${i}-cls">
                            <option value="r${i}-c1">c1</option>
                            <option value="r${i}-c2">c2</option>
                            <option value="r${i}-c3">c3</option>
                            <option value="r${i}-c4">c4</option>
                            <option value="r${i}-c5">c5</option>
                            <option value="r${i}-c6">c6</option>
                            <option value="r${i}-c7">c7</option>
                            <option value="r${i}-c8">c8</option>
                            <option value="r${i}-c9">c9</option>
                            <option value="r${i}-c10">c10</option>
                            <option value="r${i}-c11">c11</option>
                            <option value="r${i}-p1">p1</option>
                            <option value="r${i}-p2">p2</option>
                            <option value="r${i}-p3">p3</option>
                            <option value="r${i}-p4">p4</option>
                            <option value="r${i}-p5">p5</option>
                            <option value="r${i}-p6">p6</option>
                            <option value="r${i}-p7">p7</option>
                        </select>
                    </div>
                    <div class="select-wrapper w-33">
                        <label for="form2-r${i}-task-id">
                            Task ID
                        </label>
                        <select name="form2-r${i}-task-id" id="form2-r${i}-task-id">
                            <option value="H">H</option>
                            <option value="M">M</option>
                            <option value="R">R</option>
                            <option value="ED">ED</option>
                            <option value="TC">TC</option>
                            <option value="PA">PA</option>
                            <option value="VP">VP</option>
                            <option value="LOA">LOA</option>
                            <option value="HOH">HOH</option>
                            <option value="I">I</option>
                        </select>
                    </div>
                </div>
                <div class="tabs-container">
                    <div id="r${i}-c1" class="tab-content active">
                        <ul>
                        </ul>
                    </div>
                    <div id="r${i}-c2" class="tab-content">
                        <ul>
                        </ul>
                    </div>
                    <div id="r${i}-c3" class="tab-content">
                        <ul>
                        </ul>
                    </div>
                    <div id="r${i}-c4" class="tab-content">
                        <ul>
                        </ul>
                    </div>
                    <div id="r${i}-c5" class="tab-content">
                        <ul>
                        </ul>
                    </div>
                    <div id="r${i}-c6" class="tab-content">
                        <ul>
                        </ul>
                    </div>
                    <div id="r${i}-c7" class="tab-content">
                        <ul>
                        </ul>
                    </div>
                    <div id="r${i}-c8" class="tab-content">
                        <ul>
                        </ul>
                    </div>
                    <div id="r${i}-c9" class="tab-content">
                        <ul>
                        </ul>
                    </div>
                    <div id="r${i}-c10" class="tab-content">
                        <ul>
                        </ul>
                    </div>
                    <div id="r${i}-c11" class="tab-content">
                        <ul>
                        </ul>
                    </div>
                    <div id="r${i}-p1" class="tab-content">
                        <ul>
                        </ul>
                    </div>
                    <div id="r${i}-p2" class="tab-content">
                        <ul>
                        </ul>
                    </div>
                    <div id="r${i}-p3" class="tab-content">
                        <ul>
                        </ul>
                    </div>
                    <div id="r${i}-p4" class="tab-content">
                        <ul>
                        </ul>
                    </div>
                    <div id="r${i}-p5" class="tab-content">
                        <ul>
                        </ul>
                    </div>
                    <div id="r${i}-p6" class="tab-content">
                        <ul>
                        </ul>
                    </div>
                    <div id="r${i}-p7" class="tab-content">
                        <ul>
                        </ul>
                    </div>
                </div>
                <div class="input-rows">
                    <div class="input-wrapper w-full">
                        <label for="r${i}-add-note">
                            Add Note
                        </label>
                        <textarea name="r${i}-add-note" id="r${i}-add-note" rows="4"
                            placeholder="Add Note"></textarea>
                    </div>
                </div>
                <div class="input-rows">
                    <div class="select-wrapper w-half">
                        <label for="r${i}-staff-type">
                            Staff Type
                        </label>
                        <select name="r${i}-staff-type" id="r${i}-staff-type">
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                            <option value="MN">MN</option>
                        </select>
                    </div>
                    <div class="select-wrapper w-half">
                        <label for="r${i}-progress-code">
                            Progress Code
                        </label>
                        <select name="r${i}-progress-code" id="r${i}-progress-code">
                            <option value="IP">IP</option>
                            <option value="DP">DP</option>
                            <option value="SP">SP</option>
                        </select>
                    </div>

                </div>
                <div class="button-wrapper w-full">
                    <button id="form2-r${i}-btn" type="submit">Submit</button>
                </div>
            </div>
            `;
      this.container.insertAdjacentHTML("beforeend", fieldSet);
    }
  }
}

$(document).ready(function () {
  new Form2Controls();
});

export default Form2Controls;
