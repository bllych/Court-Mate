const openBtn = document.getElementById("openModal");
const closeBtn1 = document.getElementById("closeModal1");
const closeBtn2 = document.getElementById("closeModal2");
const modal = document.getElementById("modal");

openBtn.addEventListener("click", () => {
  modal.classList.add("open");
});

closeBtn1.addEventListener("click", () => {
  modal.classList.remove("open");
});

closeBtn2.addEventListener("click", () => {
  modal.classList.remove("open");
});
