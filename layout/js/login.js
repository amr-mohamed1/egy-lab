
    $(document).ready(function(){
      $("#sign-up-btn").click(function () {
        $(".container").addClass("sign-up-mode");
    });   
      $("#sign-in-btn").click(function () {
        $(".container").removeClass("sign-up-mode");
    });   
    $('.ui.dropdown')
    .dropdown()
  ;
})
