<nav class="navbar w-100 position-relative d-flex align-items-center" id="mainNav" style="background-color: #0EB4BD; height: 60px;">
    @yield("navbar_content")

    @auth
        <div class="position-absolute end-0 d-flex align-items-center">
            <p class="m-0 p-0 me-3" style="color: black; font-family: 'Inter', sans-serif;">
                @php
                    $user = Auth::user();
                    $nomeDisplay = $user->docente->nome_docente
                        ?? $user->name
                        ?? "Nome não encontrado";
                @endphp
                {{ $nomeDisplay }}
            </p>
            <img class="m-0 p-0 me-4" src="{{ asset('images/logout.svg') }}" alt="Image_logout" id="image_logout" data-bs-toggle="modal" data-bs-target="#logOutModal">
        </div>
    @endauth
</nav>


<div id="wrapper">
  <div class="overlay"></div>
   
       <!-- Sidebar -->
   <nav class="navbar-inverse fixed-top" id="sidebar-wrapper" role="navigation">
    <ul class="nav sidebar-nav">
      <div class="sidebar-header">
        <div class="d-flex sidebar-brand">
          <div class="w-75">
            <p style="color: white">
              @php
                $user = Auth::user();
                $nomeDisplay = $user->docente->nome_docente
                  ?? $user->name
                  ?? "Nome não encontrado";
              @endphp
                  {{ $nomeDisplay }}
            </p>
          </div>
          <div class="w-25">
            <img class="m-0 p-0 me-4" src="{{ asset('images/logout.svg') }}" alt="Image_logout" id="image_logout_side" data-bs-toggle="modal" data-bs-target="#logOutModal" style="width: 25px">
          </div>
          
        </div>
      </div>
      <div class="d-flex flex-column gap-5 mt-5 ps-4">
        @yield("sidebar_content")
      </div>
      
      
     </ul>
 </nav>
       <!-- /#sidebar-wrapper -->

       <!-- Page Content -->
       <div id="page-content-wrapper">
           <button type="button" class="hamburger animated fadeInLeft is-closed" id="hambImg" data-toggle="offcanvas">
               <span class="hamb-top"></span>
         <span class="hamb-middle"></span>
       <span class="hamb-bottom"></span>
           </button>
           
       </div>
       <!-- /#page-content-wrapper -->

  </div>





<div class="modal" id="logOutModal" tabindex="-1" aria-labelledby="logOutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0">
        <div class="modal-header border-0">
          <h5 class="modal-title mx-auto" id="logOutModalLabel">Pretende sair da sua conta?</h5>
        </div>
        <div class="modal-footer d-flex justify-content-center border-0">
          <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;" id="logOut-button">Sair</button>
          <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
</div>


<style>
  #mainNav {
    display: block !important;
  }

  #hambImg {
    display: none !important;
  }

  #wrapper{
    display: none !important;
  }

  /* Adicione uma consulta de mídia para esconder a navegação e mostrar o ícone do menu em telas menores ou iguais a 1000px */
  @media screen and (max-width: 1000px) {
    #mainNav {
      display: none !important;
    }
    .overlay {
      display: none;
    }

    #hambImg {
      display: block !important;
    }

  }

  

/*-------------------------------*/
/*           Wrappers            */
/*-------------------------------*/

#wrapper {
    padding-left: 0;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

#wrapper.toggled {
    padding-left: 350px;
}

#sidebar-wrapper {
    z-index: 1000;
    left: 220px;
    width: 0;
    height: 100%;
    margin-left: -220px;
    overflow-y: auto;
    overflow-x: hidden;
    background: rgb(41, 41, 41); !important
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

#sidebar-wrapper::-webkit-scrollbar {
  display: none;
}

#wrapper.toggled #sidebar-wrapper {
    width: 350px;
}

#page-content-wrapper {
    width: 100%;
    padding-top: 70px;
}

#wrapper.toggled #page-content-wrapper {
    position: absolute;
    margin-right: -220px;
}

/*-------------------------------*/
/*     Sidebar nav styles        */
/*-------------------------------*/


.sidebar-nav {
    position: absolute;
    top: 0;
    width: 220px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.sidebar-nav li {
    position: relative; 
    line-height: 20px;
    display: inline-block;
    width: 100%;
}

.sidebar-nav li:hover{
  border-radius: 10px;
  margin-left: 10px;
  margin-right: 10px;
  width: 300px;
  
}
.sidebar-nav li:hover:before,
.sidebar-nav li.open:hover:before {
    width: 100%;
    -webkit-transition: width .2s ease-in;
      -moz-transition:  width .2s ease-in;
       -ms-transition:  width .2s ease-in;
            transition: width .2s ease-in;

}

.sidebar-nav li a {
    display: block;
    color: #ddd;
    text-decoration: none;
    font-size: 25px;
    width: 350px;
    padding: 10px 15px 10px 30px;    
}

.sidebar-nav li a:hover,
.sidebar-nav li a:active,
.sidebar-nav li a:focus,
.sidebar-nav li.open a:hover,
.sidebar-nav li.open a:active,
.sidebar-nav li.open a:focus{
    color: #fff;
    text-decoration: none;
    background-color: transparent;
}
.sidebar-header {
    text-align: center;
    font-size: 20px;
    position: relative;
    width: 100%;
    display: inline-block;
}
.sidebar-brand {
    height: 65px;
    position: relative;
    background-color:#0EB4BD !important; 
    width: 350px;
    padding-top: 1em;
  
}
.sidebar-brand a {
    color: #ddd;
}


/*-------------------------------*/
/*       Hamburger-Cross         */
/*-------------------------------*/

.hamburger {
  position: fixed;
  top: 20px;  
  z-index: 999;
  display: block;
  width: 32px;
  height: 32px;
  margin-left: 15px;
  background: transparent;
  border: none;
}
.hamburger:hover,
.hamburger:focus,
.hamburger:active {
  outline: none;
}
.hamburger.is-closed:before {
  content: '';
  display: block;
  width: 100px;
  font-size: 14px;
  color: #fff;
  line-height: 32px;
  text-align: center;
  opacity: 0;
  -webkit-transform: translate3d(0,0,0);
  -webkit-transition: all .35s ease-in-out;
}
.hamburger.is-closed:hover:before {
  opacity: 1;
  display: block;
  -webkit-transform: translate3d(-100px,0,0);
  -webkit-transition: all .35s ease-in-out;
}

.hamburger.is-closed .hamb-top,
.hamburger.is-closed .hamb-middle,
.hamburger.is-closed .hamb-bottom,
.hamburger.is-open .hamb-top,
.hamburger.is-open .hamb-middle,
.hamburger.is-open .hamb-bottom {
  position: absolute;
  left: 0;
  height: 4px;
  width: 100%;
}
.hamburger.is-closed .hamb-top,
.hamburger.is-closed .hamb-middle,
.hamburger.is-closed .hamb-bottom {
  background-color: #1a1a1a;
}
.hamburger.is-closed .hamb-top { 
  top: 5px; 
  -webkit-transition: all .35s ease-in-out;
}
.hamburger.is-closed .hamb-middle {
  top: 50%;
  margin-top: -2px;
}
.hamburger.is-closed .hamb-bottom {
  bottom: 5px;  
  -webkit-transition: all .35s ease-in-out;
}

.hamburger.is-closed:hover .hamb-top {
  top: 0;
  -webkit-transition: all .35s ease-in-out;
}
.hamburger.is-closed:hover .hamb-bottom {
  bottom: 0;
  -webkit-transition: all .35s ease-in-out;
}
.hamburger.is-open .hamb-top,
.hamburger.is-open .hamb-middle,
.hamburger.is-open .hamb-bottom {
  background-color: #1a1a1a;
}
.hamburger.is-open .hamb-top,
.hamburger.is-open .hamb-bottom {
  top: 50%;
  margin-top: -2px;  
}
.hamburger.is-open .hamb-top { 
  -webkit-transform: rotate(45deg);
  -webkit-transition: -webkit-transform .2s cubic-bezier(.73,1,.28,.08);
}
.hamburger.is-open .hamb-middle { display: none; }
.hamburger.is-open .hamb-bottom {
  -webkit-transform: rotate(-45deg);
  -webkit-transition: -webkit-transform .2s cubic-bezier(.73,1,.28,.08);
}
.hamburger.is-open:before {
  content: '';
  display: block;
  width: 100px;
  font-size: 14px;
  color: #fff;
  line-height: 32px;
  text-align: center;
  opacity: 0;
  -webkit-transform: translate3d(0,0,0);
  -webkit-transition: all .35s ease-in-out;
}
.hamburger.is-open:hover:before {
  opacity: 1;
  display: block;
  -webkit-transform: translate3d(-100px,0,0);
  -webkit-transition: all .35s ease-in-out;
}

</style>

<script>
  $(document).ready(function () {
  var trigger = $('.hamburger'),
      overlay = $('.overlay'),
    isClosed = false;

    trigger.click(function () {
      hamburger_cross();      
    });

    function hamburger_cross() {

      if (isClosed == true) {          
        overlay.hide();
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        isClosed = false;
      } else {   
        overlay.show();
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        isClosed = true;
      }
  }
  
  $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
  });  
});

  $(window).resize(function(){
    checkWindowSize()
  });

  function checkWindowSize() {
      var hambImg = $('#hambImg');
      var windowWidth = $(window).width();

      // You can perform actions based on the window size
      if (windowWidth > 1000) {
          // Small screen size, for example, hide the "hambImg" element
          hambImg.removeClass("is-open");
          hambImg.addClass("is-closed");
          $('#wrapper').removeClass("toggled");
      } else {
        $('#wrapper').removeClass("toggle");
        hambImg.addClass("is-closed");
        hambImg.removeClass("is-open");
      }
  }
</script>
