<style>
.dropdown:hover .dropdown-menu {
  display: block;
}
</style>
<div x-data="datanya()" x-init="initku(1)">
<?php include "loading.php"; ?>
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
        <li class=""><a x-text="listKategori[index].nama" x-on:click="fetchDataKategori(listKategori[index].nama)" class="rounded-t hover:bg-pink-500 py-2 px-4 block whitespace-no-wrap" ></a></li>
      </template>
    </ul>
  </div>
  <div ><input x-model="searchprm" x-on:keyup="cari()" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"  type="text" placeholder="Cari">
  </div>
</div>

  <div class="mx-auto p-4" >
    <div class="flex flex-wrap justify-center">
      <template x-if="listData" x-for="(list, index) in listData" :key="index">
      <div class="md:w-1/4 mb-4 lg:flex px-3" x-on:click="viewPost(listData[index].linking)">
      <img class="w-screen border-b border-t border-l border-r border-gray-400 h-64 lg:h-auto lg:w-48 bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" x-bind:src="listData[index].img" alt="Sunset in the mountains">
        <div class="w-full border-r border-b border-l border-gray-400 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
          <div class="mb-8">
            <div class="text-gray-900 font-bold text-xl mb-2" x-text="listData[index].judul"></div>
            <p class="text-gray-700 text-base" x-html="listData[index].isi.substr(0,50)"></p>
          </div>
        </div>
      </div>
      </template>
    </div>
    <ul class="flex list-reset rounded items-center justify-center font-sans mt-5" x-html="pagehtml()"></ul>
  </div>
</div>
<script src="global.js"></script>
<script>
function datanya() {
  return {
    loadShow: true,
    listData: null,
    pagin: null,
    page: null,
    totalPage: null,
    searchprm: null,
    listKategori: null,
    initku (param1, param2) {
        let paramsrc = "";
        if(param2 === null || param2 === undefined){
          paramsrc = "";
        }else {
          paramsrc = param2;
        }
        fetch(baseUrl + '/admin/get_data.php?pages=' + param1 + '&search=' + paramsrc, {
          method: 'GET'
        })
        .then((response) => response.text())
        .then((result) => {
          
          this.loadShow = false;
          this.listData = JSON.parse(result).data;
          this.pagin = JSON.parse(result);
          this.totalPage = JSON.parse(result).totalPage;
          this.page = JSON.parse(result).page;
          console.log(this.listData);
        })
        .catch((error) => {
          console.error('Error:', error);
        });
        // Hapus Searching
        localStorage.removeItem('searching');
        // End Searching

        this.getKategori();
    },
    previousPage(){
      this.initku(this.pagin.prevPage);
      console.log("cukk");
    },
    nextPage(){
      this.initku(this.pagin.nextPage);
    },
    pagehtml(){
      let ready = '';
      ready += '<li><button class="block hover:text-white hover:bg-blue-500 text-blue border border-grey-light px-3 py-2" x-on:click="previousPage()">Previous</button></li>';
      for (let i = 0; i < this.totalPage; i++){
        if(i + 1 == this.page){
          ready += '<li><button class="block bg-blue-500 text-white hover:text-white hover:bg-blue-500 text-blue border border-grey-light px-3 py-2" x-on:click="initku(' + (i+1) + ')">' + (i+1) + '</button></li>';
        }else {
          ready += '<li><button class="block hover:text-white hover:bg-blue-500 text-blue border border-grey-light px-3 py-2" x-on:click="initku(' + (i+1) + ')">' + (i+1) + '</button></li>';
        }
        
      }
      ready += '<li><button class="block hover:text-white border border-grey-light hover:bg-blue-500 text-blue px-3 py-2" x-on:click="nextPage()">Next</button></li>';
      return ready;
    },
    viewPost(param){
      let ahref = document.createElement('a');
      let att = document.createAttribute('href');
      att.value = param + '.html';
      ahref.setAttributeNode(att);
      ahref.click();
    },
    cari() {
      this.loadShow = true;
      this.initku(1, this.searchprm)
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
    fetchDataKategori(param1) {
      this.loadShow = true;
      fetch(baseUrl + '/admin/get_data_kategori.php?kategori=' + param1, {
          method: 'GET'
        })
        .then((response) => response.text())
        .then((result) => {
          this.loadShow = false;
          this.listData = JSON.parse(result).data;
        })
        .catch((error) => {
          console.error('Error:', error);
        });      
    }
  }
}
</script>