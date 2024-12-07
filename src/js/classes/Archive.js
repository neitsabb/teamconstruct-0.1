import InputRange from "../components/InputRange";

export default class Archive {
  constructor() {
    console.log("Single page");

    this.initInputRanges();
    this.initSorting();

    this.toggleFilters();
  }

  initInputRanges() {
    document
      .querySelectorAll("#range-container")
      .forEach((input) => new InputRange(input));
  }

  initSorting() {
    const sortSelect = document.querySelector('select[name="sort"]');

    if (sortSelect) {
      sortSelect.addEventListener("change", (event) => {
        const sortValue = event.target.value;
        const currentUrl = new URL(window.location.href);

        currentUrl.searchParams.set("sort", sortValue);

        window.location.href = currentUrl.toString();
      });
    }
  }

  toggleFilters() {
    const filterToggle = document.querySelector("#filter-toggle");
    const filterContainer = document.querySelector("#filter-estate");

    if (filterToggle && filterContainer) {
      filterToggle.addEventListener("click", () => {
        if (filterContainer.classList.contains("open")) {
          filterContainer.style.height = "0";
          filterToggle.classList.add("rotate-90");
        } else {
          filterContainer.style.height = filterContainer.scrollHeight + "px";
          filterToggle.classList.remove("rotate-90");
        }

        filterContainer.classList.toggle("open");
      });
    }
  }
}
