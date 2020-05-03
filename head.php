<style>
.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  right: 0;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav > a {
  padding: 8px 8px 8px 20px;
  text-decoration: none;
  font-size: 1.25rem;
  color: white;
  display: block;
  transition: 0.3s;
}

.sidenav > div {
  padding: 8px 8px 8px 20px;
  text-decoration: none;
  font-size: 1.25rem;
  color: white;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: white;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}
.toggle-icon {
  color: white;
  font-size:20px;
  cursor:pointer;

}
</style>
<nav class="flex items-center justify-between flex-wrap bg-teal-500 p-6">
  <div class="flex items-center flex-shrink-0 text-white mr-6">
    <span class="font-semibold text-xl tracking-tight"><a href="./">Small Blog</a></span>
  </div>
  <div class="w-auto flex-grow flex items-center">
    <div class="text-sm flex-grow">
    </div>
    <div>
    <span class="toggle-icon" onclick="openNav()">&#9776;</span>
    </div>
  </div>
</nav>



<script>
// var headVariable = {
//   searchfrm: ''
// }
// function cari(e) {
//   if(e.keyCode === 13){
//     location.reload();
//     localStorage.setItem("searching", document.getElementById("search").value);
//   }
// }

function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>