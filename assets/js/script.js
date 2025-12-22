document.addEventListener("DOMContentLoaded", function () {
  console.log('app.js chargé');


  const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
  );
  const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
  );
});


/*  Button Go Top */
const btnGoTop = document.querySelector(".btn-gotop");
const navbar = document.querySelector(".navbar");
const sticky = navbar.offsetTop;

window.addEventListener("scroll", () => {
  if (window.scrollY > 100) {
    btnGoTop.style.display = "block";
    navbar.classList.add("fixed-top");
  } else {
    btnGoTop.style.display = "none";
    navbar.classList.remove("fixed-top");
  }
});

btnGoTop.addEventListener("click", () => {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
});

var popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
var popoverList = [...popoverTriggerList].map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl);
});
