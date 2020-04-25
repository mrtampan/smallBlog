<div class="mx-auto p-4" x-data="datanya()" x-init="initku(1)">
<div class="flex flex-wrap">

  <template x-if="listData" x-for="(list, index) in listData" :key="index">
  <div class="w-1/4 mb-4 lg:flex px-3" x-on:click="viewPost(listData[index].linking)">
  <img class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" x-bind:src="listData[index].img" alt="Sunset in the mountains">
    <div class="w-full border-r border-b border-l border-gray-400 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
      <div class="mb-8">
        <div class="text-gray-900 font-bold text-xl mb-2" x-text="listData[index].judul"></div>
        <p class="text-gray-700 text-base" x-html="listData[index].isi"></p>
      </div>
    </div>
  </div>
  </template>
</div>
<ul class="flex list-reset rounded items-center justify-center font-sans mt-5" x-html="pagehtml()"></ul>
</div>
<script src="global.js"></script>
<script>
function datanya() {
  return {
    listData: null,
    pagin: null,
    page: null,
    totalPage: null,
    initku (param1) {
      fetch(baseUrl + '/admin/get_data.php?pages=' + param1, {
        method: 'GET'
      })
      .then((response) => response.text())
      .then((result) => {
        
        this.listData = JSON.parse(result).data;
        this.pagin = JSON.parse(result);
        this.totalPage = JSON.parse(result).totalPage;
        this.page = JSON.parse(result).page;
        console.log(this.listData);
      })
      .catch((error) => {
        console.error('Error:', error);
      });
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
    }
  }
}
</script>