// var countDownDate = new Date("Jan 5, 2024 15:37:25").getTime();
var countDownDate = new Date(hrix_special_product.date).getTime();

// Update the count down every 1 second
var x = setInterval(function () {
  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Output the result in an element with id="demo"
  document.querySelector(
    "." + hrix_special_product.id + " .hrix-timer .days"
  ).innerHTML = days < 10 ? "0" + days : days;
  document.querySelector(
    "." + hrix_special_product.id + " .hrix-timer .hours"
  ).innerHTML = hours < 10 ? "0" + hours : hours;
  document.querySelector(
    "." + hrix_special_product.id + " .hrix-timer .minutes"
  ).innerHTML = minutes < 10 ? "0" + minutes : minutes;
  document.querySelector(
    "." + hrix_special_product.id + " .hrix-timer .seconds"
  ).innerHTML = seconds < 10 ? "0" + seconds : seconds;

  // If the count down is over, write some text
  if (distance < 0) {
    clearInterval(x);
    document.querySelector(
      "." + hrix_special_product.id + " .hrix-timer"
    ).innerHTML = "";
  }
}, 1000);
