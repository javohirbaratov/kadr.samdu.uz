$(document).ready(function () {
  // GLOBE VARIABLES
  const form = document.querySelector("#form");
  if (form) {
    const submitBtn = document.querySelector("#submit");
    const input = form.querySelectorAll("input");
    // CONFIG FUNCTION
    input.forEach(function (e) {
      e.addEventListener("keyup", validition);
      e.addEventListener("blur", validition);
    });

    // FUNCTION
    function validition() {
      this.classList.add("was-validation");
      if (form.checkValidity() == true) {
        submitBtn.disabled = false;
      } else {
        submitBtn.disabled = true;
      }
    }

    function loadingStart() {
      submitBtn.classList.add("loading");
      setTimeout(() => {
      }, 2000);
    }

    function loadingStop() {
      setTimeout(() => {
        submitBtn.classList.remove("loading");
      }, 1000);
    }

    submitBtn.addEventListener("click", function submit(e) {
      e.preventDefault();
      loadingStart();
      $.ajax({
        url: "logincheck.php",
        method: "get",
        data: $(form).serialize(),
        success: function (data) {
          console.log(data);  
            var obj = jQuery.parseJSON(data);
          if (obj.xatolik==0) {
            toast.create({
              title: "Muvaffaqiyatli.",
              text: "Tizimga kirishingiz mumkin!",
              type: "success",
              icon: "assets/img/icon/success.svg",
            });
            setTimeout(() => {
              location.reload();
            }, 3500);
          } else {
            $('#_csrf').val(obj._csrf);
            toast.create({
              title: "Xatolik.",
              text: "Login yoki parol xatolik!",
              type: "error",
              icon: "assets/img/icon/error.svg",
            });
          }
          loadingStop();
        },
        error: function () {
          toast.create({
            title: "Xatolik.",
            text: "Ulanishda xatolik!",
            type: "error",
            icon: "assets/img/icon/error.svg",
          });
          loadingStop();
        },
      });
    });
  }
  $("input[readonly]").click(function(){
    $(this).select();
  })
  const humburgerBtn = document.querySelector(".humburger-btn");
  const header = document.querySelector("header");
  const contaner = document.querySelectorAll(".container");
  const sidebarCloseBtn = document.querySelector("#sidebarCloseBtn");
  const sidebarBack = document.querySelector(".sidebar-back");
  if (humburgerBtn) {
    humburgerBtn.addEventListener("click", sidebarToggle);
    sidebarCloseBtn.addEventListener("click", sidebarToggle);
    sidebarBack.addEventListener("click", sidebarToggle);
  }

  function sidebarToggle() {
    header.classList.toggle("sidebar-toggle");
    contaner.forEach(function (e) {
      e.classList.toggle("sidebar-toggle");
    })
    $(sidebarBack).toggle();
  }

  const sidebar = document.querySelector(".site-header__sidebar");
  if (sidebar) {
    const sidebarInner = document.querySelector(".site-header__sidebar--inner");
    const sidebarHeight = sidebar.clientHeight;
    sidebarInner.style.height = sidebarHeight - 60 + "px";
    $(".site-header__sidebar--inner").niceScroll(".site-header__sidebar--nav", {
      cursorcolor: "#bbbb",
    });
  }

  const dropdownBtn = document.querySelectorAll(".dropdown-btn");
  dropdownBtn.forEach(function (e) {
    e.addEventListener("click", function () {
      let dropdownData = this.getAttribute("drop-target");
      let dropBody = document.querySelector(
        `div[drop-id="${dropdownData}"]`
      );
      dropdownHide(dropBody);
      dropBody.classList.toggle("show");
    });
  });
  function dropdownHide(item) {
    let attr = item.getAttribute("drop-id");
    const dropdownBody = document.querySelectorAll(".dropdown-body");
    dropdownBody.forEach(function(e){
      if(e.getAttribute("drop-id") != attr) {
        e.classList.remove("show");
      }
    })
  }
  window.addEventListener("click", function (e) {
    if (!e.target.matches(".dropdown-btn")) {
      let dropdowns = document.querySelectorAll(".dropdown-body");
      dropdowns.forEach(function (e) {
        if (e.classList.contains("show")) e.classList.toggle("show");
      });
    }
  });
  
  function headerSearchInputToggle() {
    this.parentElement.classList.toggle("faild");
    if(window.innerWidth < 728) {
      if(this.type != "search") {
        this.type = "search";
      }else {
        this.type = "text";
      }
    }
    this.nextElementSibling.classList.toggle("hide");
  }

  $(".collapse-btn").click(function() {
    $(this).parent(".collapse").toggleClass("show");
  })
})