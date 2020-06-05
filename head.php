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

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>

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
<div x-data="datahead()" x-init="inithead()">
<div id="mySidenav" class="sidenav bg-teal-500">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="" >Home</a>
  <div class="dropdown inline-block relative">
    <button class="text-white rounded inline-flex items-center">
      <span class="mr-1">Kategori</span>
      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/> </svg>
    </button>
    <ul class="dropdown-menu hidden text-white pt-1">
      <template x-if="listKategori" x-for="(list, index) in listKategori" :key="index">
        <li class=""><a x-text="listKategori[index].nama" x-on:click="fetchKategori(listKategori[index].nama)" class="rounded-t hover:bg-pink-500 py-2 px-4 block whitespace-no-wrap" ></a>
      </li>
      </template>
    </ul>
  </div>
  <div class="flex items-center"><input x-model="searchprm" class="bg-gray-200 appearance-none w-full border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"  type="text" placeholder="Cari">
  <button x-on:click="cari()" class="bg-blue-500 w-full hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Cari</button>
  </div>
</div>
</div>


<script>
function datahead() {
  return {
    searchprm: '',
    listKategori: null,
    inithead() {
      console.log("cook");
      this.getKategori();
    },
    getKategori() {
        fetch(baseUrl + '/admin/get_kategori.php', {
          method: 'GET'
        })
        .then((response) => response.json())
        .then((result) => {
          
          this.listKategori= result.data;
          console.log(result.data);
        })
        .catch((error) => {
          console.error('Error:', error);
        });
    },
    cari() {
      let ahref = document.createElement('a');
      let att = document.createAttribute('href');
      att.value = baseUrl + "/?search=" + this.searchprm;
      ahref.setAttributeNode(att);
      ahref.click();
    },
    fetchKategori(param1) {
      let ahref = document.createElement('a');
      let att = document.createAttribute('href');
      att.value = baseUrl + "/?search=" + param1;
      ahref.setAttributeNode(att);
      ahref.click();
    },
  }
}
// var headVariable = {
//   searchfrm: ''
// }
// function cari(e) {
//   if(e.keyCode === 13){
//     location.reload();
//     localStorage.setItem("searching", document.getElementById("search").value);
//   }
// }

</script>