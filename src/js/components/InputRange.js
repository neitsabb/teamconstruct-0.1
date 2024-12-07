import { formatNumber } from "../utils";

export default class InputRange {
  constructor(input) {
    this.input = input;

    const rangeMin = input.querySelector("#range-min");
    const rangeMax = input.querySelector("#range-max");
    const rangeProgress = input.querySelector("#range-progress");
    const minValueDisplay = input.querySelector("#min-value");
    const maxValueDisplay = input.querySelector("#max-value");

    rangeMin.addEventListener("input", () =>
      this.updateRange(
        rangeMin,
        rangeMax,
        rangeProgress,
        minValueDisplay,
        maxValueDisplay
      )
    );
    rangeMax.addEventListener("input", () =>
      this.updateRange(
        rangeMin,
        rangeMax,
        rangeProgress,
        minValueDisplay,
        maxValueDisplay
      )
    );

    this.updateRange(
      rangeMin,
      rangeMax,
      rangeProgress,
      minValueDisplay,
      maxValueDisplay
    );
  }

  updateRange = (
    rangeMin,
    rangeMax,
    rangeProgress,
    minValueDisplay,
    maxValueDisplay
  ) => {
    const minValue = parseInt(rangeMin.value);
    const maxValue = parseInt(rangeMax.value);

    if (minValue >= maxValue) {
      rangeMin.value = maxValue - 1;
    }

    if (maxValue <= minValue) {
      rangeMax.value = minValue + 1;
    }

    const minPercent = (rangeMin.value / rangeMin.max) * 100;
    const maxPercent = (rangeMax.value / rangeMax.max) * 100;

    rangeProgress.style.left = `${minPercent}%`;
    rangeProgress.style.right = `${100 - maxPercent}%`;

    minValueDisplay.textContent = formatNumber(rangeMin.value);
    maxValueDisplay.textContent = formatNumber(rangeMax.value);
  };
}
