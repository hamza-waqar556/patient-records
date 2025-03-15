class Form1Controls {
  constructor() {
    this.init();
  }

  // headings form Community Living Supports Objectives
  comData = [
    "Meal Preparation/Kitchen Skills",
    "Laundry",
    "Housekeeping Skills",
    "Behavioral Interventions Needed",
    "Total Shopping",
    "Money Management",
    "Community/Socialization Skills",
    "Attending Medical Appointments",
    "Medication Instruction Skills",
    "Health & Safety/Medical Complexity",
    "Symptoms/Stress Management Skills",
  ];

  // headings for Personal Care Objectives
  perData = [
    "Eating/Feeding",
    "Toileting",
    "Showering/Bathing/Personal Hygiene",
    "Dressing",
    "Mobility/Transferring",
    "Medication Knowledge/Administration",
    "Complex Care",
  ];

  init() {
    this.repeatComFields();
    this.repeatPerFields();
  }

  // for repeat Community fields (c)
  repeatComFields() {
    const $comContainer = $("#for-community");

    this.comData.forEach((label, i) => {
      const fieldHTML = `
                <div class="">
                        <h4>
                        C${i + 1} ${label}
                        </h4>
                        <div class="input-rows">
                            <div class="input-wrapper w-25">
                                <label for="c${i + 1}-am">
                                    AM
                                </label>
                                <input type="text" name="c${i + 1}-am" id="c${
        i + 1
      }-am" placeholder="AM">
                            </div>
                            <div class="input-wrapper w-25">
                                <label for="c${i + 1}-am-min">
                                    mins
                                </label>
                                <input type="text" name="c${
                                  i + 1
                                }-am-min" id="c${
        i + 1
      }-am-min" placeholder="Mins">
                            </div>
                            <div class="input-wrapper w-25">
                                <label for="c${i + 1}-pm">
                                    PM
                                </label>
                                <input type="text" name="c${i + 1}-pm" id="c${
        i + 1
      }-pm" placeholder="PM">
                            </div>
                            <div class="input-wrapper w-25">
                                <label for="c${i + 1}-pm-min">
                                    mins
                                </label>
                                <input type="text" name="c${
                                  i + 1
                                }-pm-min" id="c${
        i + 1
      }-pm-min" placeholder="Mins">
                            </div>
                        </div>
                        <div class="input-rows">
                            <div class="input-wrapper w-25">
                                <label for="c${i + 1}-mn">
                                    MN
                                </label>
                                <input type="text" name="c${i + 1}-mn" id="c${
        i + 1
      }-mn" placeholder="MN">
                            </div>
                            <div class="input-wrapper w-25">
                                <label for="c${i + 1}-mn-min">
                                    mins
                                </label>
                                <input type="text" name="c${
                                  i + 1
                                }-mn-min" id="c${
        i + 1
      }-mn-min" placeholder="Mins">
                            </div>
                            <div class="input-wrapper w-half">
                                <label for="c${i + 1}-description">
                                    Description
                                </label>
                                <input type="text" name="c${
                                  i + 1
                                }-description" id="c${
        i + 1
      }-description" placeholder="Description">
                            </div>
                        </div>
                    </div>
                `;
      $comContainer.append(fieldHTML);
    });
  }

  // for repeat Personal fields (p)
  repeatPerFields() {
    const $perContainer = $("#for-personal");

    this.perData.forEach((label, i) => {
      const fieldHTML = `
                <div class="">
                    <h4>
                    P${i + 1} ${label}
                    </h4>
                    <div class="input-rows">
                        <div class="input-wrapper w-25">
                            <label for="p${i + 1}-am">
                                AM
                            </label>
                            <input type="text" name="p${i + 1}-am" id="p${
        i + 1
      }-am" placeholder="AM">
                        </div>
                        <div class="input-wrapper w-25">
                            <label for="p${i + 1}-am-min">
                                mins
                            </label>
                            <input type="text" name="p${i + 1}-am-min" id="p${
        i + 1
      }-am-min" placeholder="Mins">
                        </div>
                        <div class="input-wrapper w-25">
                            <label for="p${i + 1}-pm">
                                PM
                            </label>
                            <input type="text" name="p${i + 1}-pm" id="p${
        i + 1
      }-pm" placeholder="PM">
                        </div>
                        <div class="input-wrapper w-25">
                            <label for="p${i + 1}-pm-min">
                                mins
                            </label>
                            <input type="text" name="p${i + 1}-pm-min" id="p${
        i + 1
      }-pm-min" placeholder="Mins">
                        </div>
                    </div>
                    <div class="input-rows">
                        <div class="input-wrapper w-25">
                            <label for="p${i + 1}-mn">
                                MN
                            </label>
                            <input type="text" name="p${i + 1}-mn" id="p${
        i + 1
      }-mn" placeholder="MN">
                        </div>
                        <div class="input-wrapper w-25">
                            <label for="p${i + 1}-mn-min">
                                mins
                            </label>
                            <input type="text" name="p${i + 1}-mn-min" id="p${
        i + 1
      }-mn-min" placeholder="Mins">
                        </div>
                        <div class="input-wrapper w-half">
                            <label for="p${i + 1}-description">
                                Description
                            </label>
                            <input type="text" name="p${
                              i + 1
                            }-description" id="p${
        i + 1
      }-description" placeholder="Description">
                        </div>
                    </div>
                </div>
                `;
      $perContainer.append(fieldHTML);
    });
  }
}

$(document).ready(function () {
  new Form1Controls();
});

export default Form1Controls;
