
  
  //Code ko cho hiển thị DS lúc màn hình < 522
  document.addEventListener("DOMContentLoaded", function () {
    //tìm vị trí ở đâu mới cho click
    // var x = document.getElementsByClassName('hidden-menu');
  
    // window.addEventListener('click', function () {
    //     x[0].classList.remove('hidden');
    // })
    
    var x = document.getElementsByClassName("blockhover");

    x[0].addEventListener("click",function(){
        var y = document.getElementsByClassName("hidden-menu");
        y[0].classList.remove("hidden");
    })
  
  }, false)
  
  
  
  window.onscroll = function () {
    if ( document.documentElement.scrollTop > 400) {
      document.getElementById("myBtn").style.display = "block";
    } else {
      document.getElementById("myBtn").style.display = "none";
    }
  };
  
  //When the user clicks on the button, scroll to the top of the document
  function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
  }
  
  
  
  
  