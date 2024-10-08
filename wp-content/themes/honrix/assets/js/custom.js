(function ($) {
  "use strict";

  // Spinner
  var spinner = function () {
    setTimeout(function () {
      if ($("#spinner").length > 0) {
        $("#spinner").removeClass("show");
      }
    }, 1);
  };
  spinner();

  // Initiate the wowjs
  new WOW().init();

  $(".hrix-site-header .product-category-btn").on("click", function (e) {
    if ($(window).width() > 991) {
      if ($(this).hasClass("active")) {
        $(this).removeClass("active");
        var arrow = $(this).find(".fa-chevron-down");
        arrow.removeClass("fa-chevron-down");
        arrow.addClass("fa-chevron-right");
        $(".hrix-site-header .product-category-menus").removeClass("active");
      } else {
        $(this).addClass("active");
        var arrow = $(this).find(".fa-chevron-right");
        arrow.removeClass("fa-chevron-right");
        arrow.addClass("fa-chevron-down");
        $(".hrix-site-header .product-category-menus").addClass("active");
      }
    }
  });

  // mobile navbar toggler
  $(".hrix-navbar-toggler").on("click", function (e) {
    if ($(".hrix-mobile-navigation-menu").hasClass("show-menu")) {
      $(".hrix-mobile-navigation-menu").removeClass("show-menu");
    } else {
      $(".hrix-mobile-navigation-menu").addClass("show-menu");
    }
  });

  //mobile menu section selector
  $(".hrix-mobile-menu-selector").on("click", function (e) {
    $(".hrix-mobile-categories").removeClass("active");
    $(".hrix-mobile-category-selector").removeClass("active");
    $(".hrix-mobile-menu").addClass("active");
    $(".hrix-mobile-menu-selector").addClass("active");
  });

  $(".hrix-mobile-menu-selector").on("keyup", function (e) {
    if (e.key === "Enter" || e.keyCode === 13) {
      $(".hrix-mobile-categories").removeClass("active");
      $(".hrix-mobile-category-selector").removeClass("active");
      $(".hrix-mobile-menu").addClass("active");
      $(".hrix-mobile-menu-selector").addClass("active");
    }
  });

  //mobile category section selector
  $(".hrix-mobile-category-selector").on("click", function (e) {
    $(".hrix-mobile-menu").removeClass("active");
    $(".hrix-mobile-menu-selector").removeClass("active");
    $(".hrix-mobile-categories").addClass("active");
    $(".hrix-mobile-category-selector").addClass("active");
  });
  $(".hrix-mobile-category-selector").on("keyup", function (e) {
    if (e.key === "Enter" || e.keyCode === 13) {
      $(".hrix-mobile-menu").removeClass("active");
      $(".hrix-mobile-menu-selector").removeClass("active");
      $(".hrix-mobile-categories").addClass("active");
      $(".hrix-mobile-category-selector").addClass("active");
    }
  });

  //mobile menu & category section close
  $(".hrix-mobile-navigation-menu span.close").on("click", function (e) {
    $(".hrix-mobile-navigation-menu").removeClass("show-menu");
  });

  $(".hrix-mobile-navigation-menu span.close").on("keyup", function (e) {
    if (e.key === "Enter" || e.keyCode === 13) {
      $(".hrix-mobile-navigation-menu").removeClass("show-menu");
    }
  });

  //minicart close
  $(".hrix-header-minicart-context .close").on("click", function (e) {
    $(".hrix-header-minicart-context").removeClass("show-cart");
  });

  $(".hrix-header-minicart-context .close").on("keyup", function (e) {
    if (e.key === "Enter" || e.keyCode === 13) {
      $(".hrix-header-minicart-context").removeClass("show-cart");
    }
  });

  // Dropdown on mouse hover
  const $dropdown = $(".dropdown");
  const $dropdownToggle = $(".dropdown-toggle");
  const $dropdownMenu = $(".dropdown-menu");
  const showClass = "show";

  $(window).on("load resize", function () {
    if (this.matchMedia("(min-width: 992px)").matches) {
      if (window.innerWidth > 991) {
        $(".hrix-header-mini-cart > a").on("click", function (e) {
          if (window.innerWidth > 991) {
            e.preventDefault();
            $(".hrix-header-minicart-context").addClass("show-cart");
          }
        });
      }
    }

    if (this.matchMedia("(min-width: 992px)").matches) {
      $dropdown.hover(
        function () {
          const $this = $(this);
          $this.addClass(showClass);
          $this.find($dropdownToggle).first().attr("aria-expanded", "true");
          $this.find($dropdownMenu).first().addClass(showClass);
        },
        function () {
          const $this = $(this);
          $this.removeClass(showClass);
          $this.find($dropdownToggle).first().attr("aria-expanded", "false");
          $this.find($dropdownMenu).first().removeClass(showClass);
        }
      );
    } else if (this.matchMedia("(max-width: 991px)").matches) {
      $dropdownToggle.click(function (event) {
        event.preventDefault();
        const $this = $(this).parent();
        if ($this.find($dropdownMenu).first().hasClass(showClass)) {
          $this.removeClass(showClass);
          $this.find($dropdownToggle).first().attr("aria-expanded", "false");
          $this.find($dropdownMenu).first().removeClass(showClass);
        } else {
          $this.addClass(showClass);
          $this.find($dropdownToggle).first().attr("aria-expanded", "true");
          $this.find($dropdownMenu).first().addClass(showClass);
        }
      });
    } else {
      $dropdown.off("mouseenter mouseleave");
    }
  });
})(jQuery);

if (window.innerWidth < 1300) {
  window.onscroll = function (ev) {
    var to_top = document.querySelector(".to-top");
    if (to_top) {
      if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
        document.querySelector(".to-top").style.bottom =
          document.querySelector(".site-copyright").offsetHeight + 5 + "px";
      } else {
        document.querySelector(".to-top").style.bottom = "15px";
      }
    }
  };
}

document
  .querySelector(".hrix-mobile-navigation-menu")
  .addEventListener("keydown", function (e) {
    var element = document.querySelector(".hrix-mobile-navigation-menu");
    var focusableElsAll = element.querySelectorAll(
      'a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"]'
    );

    var focusableEls = [];
    focusableElsAll.forEach(function (item) {
      if (
        element.currentStyle
          ? element.currentStyle.display !== "none"
          : getComputedStyle(item, null).display !== "none"
      ) {
        focusableEls = [...focusableEls, item];
      }
    });

    var firstFocusableEl = focusableEls[0];
    var lastFocusableEl = focusableEls[focusableEls.length - 1];
    if (e.key === "tap" || e.keyCode === 9) {
      if (e.shiftKey) {
        /* shift + tab */ if (document.activeElement === firstFocusableEl) {
          lastFocusableEl.focus();
          e.preventDefault();
        }
      } /* tab */ else {
        if (document.activeElement === lastFocusableEl) {
          firstFocusableEl.focus();
          e.preventDefault();
        }
      }
    }
  });

var node = document.querySelector(".hrix-header-minicart-context");
if (node) {
  node.addEventListener("keydown", function (e) {
    var element = document.querySelector(".hrix-header-minicart-context");
    var focusableEls = element.querySelectorAll(
      'a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"]'
    );

    var firstFocusableEl = focusableEls[0];
    var lastFocusableEl = focusableEls[focusableEls.length - 1];
    if (e.key === "tap" || e.keyCode === 9) {
      if (e.shiftKey) {
        /* shift + tab */ if (document.activeElement === firstFocusableEl) {
          lastFocusableEl.focus();
          e.preventDefault();
        }
      } /* tab */ else {
        if (document.activeElement === lastFocusableEl) {
          firstFocusableEl.focus();
          e.preventDefault();
        }
      }
    }
  });
}

if (window.innerWidth < 992) {
  window.onscroll = function (ev) {
    var mobile_sticky_footer = document.querySelector(
      ".hrix-mobile-bottom-menu"
    );
    var copyright = document.querySelector(".site-copyright");
    copyright.style.marginBottom = mobile_sticky_footer.offsetHeight + "px";
  };
}

jQuery(
  '<div class="quantity-nav position-relative"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>'
).insertAfter(".quantity input");
jQuery(".quantity").each(function () {
  var spinner = jQuery(this),
    input = spinner.find('input[type="number"]'),
    btnUp = spinner.find(".quantity-up"),
    btnDown = spinner.find(".quantity-down"),
    min = input.attr("min"),
    max = input.attr("max");

  btnUp.click(function () {
    var oldValue = parseFloat(input.val());
    if (max) {
      if (oldValue >= max) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue + 1;
      }
    } else {
      var newVal = oldValue + 1;
    }
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
  });

  btnDown.click(function () {
    var oldValue = parseFloat(input.val());
    if (oldValue <= min) {
      var newVal = oldValue;
    } else {
      var newVal = oldValue - 1;
    }
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
  });
});
