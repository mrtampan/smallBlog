
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

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 1.25rem;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}
.toggle-icon {
  color: #818181;
  font-size:30px;
  cursor:pointer;

}
</style>
<nav class="flex items-center justify-between flex-wrap bg-gray-900 p-6">
  <div class="flex items-center flex-shrink-0 text-white mr-6">
    <a href="./?pages=" class="font-semibold text-xl tracking-tight">Admin Small Blog</a>
  </div>
  <div class="w-auto flex-grow flex items-center">
    <div class="text-sm flex-grow">

    </div>
    <div>
    <span class="toggle-icon" style="" onclick="openNav()">&#9776;</span>
    </div>
  </div>
</nav>

<div id="mySidenav" class="sidenav bg-gray-900">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="?pages=kategori">Kategori</a>
  <a href="?pages=keluar" class="inline-block text-sm mx-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-black-500 hover:bg-white mt-4 lg:mt-0">Logout</a>
</div>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>