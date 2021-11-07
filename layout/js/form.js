const bigTest = document.getElementById("committeeQs");
const one = document.getElementById("allCommitteeQs");
const two = document.getElementById("sciCommitteeQs");
const sciQ1 = document.getElementById("sciQ1");
const sciQ2 = document.getElementById("sciQ3");
const subBtn = document.getElementById("sub-btn");
const all = document.getElementById("all");
const teaser = document.getElementById("teaser");

let today = new Date();
let recDay = new Date(2020, 10, 22, 18, 0, 0);

if (today <= recDay) {
  subBtn.setAttribute("type", "submit");
  teaser.classList.add("d-none");
  all.classList.remove("d-none");
}

subBtn.hidden = true;

const check = (bruh) => {
  switch (bruh) {
    case 0:
      subBtn.hidden = false;
      bigTest.classList.remove("d-none");
      one.classList.remove("d-none");
      two.classList.add("d-none");

      break;

    case 1:
      subBtn.hidden = false;
      bigTest.classList.remove("d-none");
      one.classList.remove("d-none");
      two.classList.remove("d-none");


      break;

    default:
      subBtn.hidden = true;
      bigTest.classList.add("d-none");
      one.classList.add("d-none");
      two.classList.add("d-none");

      break;
  }
};
