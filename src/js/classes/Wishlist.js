import { getCookie, updateCookie } from "../utils";

export default class Wishlist {
  constructor() {
    this.wishlist = getCookie("wishlist") || [];

    this.init();
  }

  init() {
    this.buttons = document.querySelectorAll("#wishlist-button");

    this.buttons.forEach((button) =>
      button.addEventListener("click", (event) => {
        event.preventDefault();
        this.toggle(event.currentTarget.dataset.id);
        this.updateButtonIcon(event.currentTarget);
      })
    );
  }

  toggle(id) {
    if (!this.wishlist.includes(id)) {
      this.wishlist.push(id);
    } else {
      this.wishlist = this.wishlist.filter((item) => item !== id);
    }
    this.update();
  }

  update() {
    updateCookie(
      `wishlist=${JSON.stringify(
        this.wishlist
      )}; path=/; max-age=" + (60 * 60 * 24 * 30)`
    );
  }

  updateButtonIcon(button) {
    const id = button.dataset.id;

    if (this.wishlist.includes(id)) {
      button.querySelector("i").classList.remove("fa-regular");
      button.querySelector("i").classList.add("fa-solid");
    } else {
      button.querySelector("i").classList.remove("fa-solid");
      button.querySelector("i").classList.add("fa-regular");
    }
  }
}
