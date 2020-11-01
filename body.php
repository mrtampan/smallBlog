<div x-data="datanya()" x-init="initku()">
<?php include "loading.php"; ?>

  <div class="mx-auto container mt-5" >
  <template x-if="enableData">
    <div class="flex flex-wrap justify-center" x-html="element">
      <!-- <template x-if="listData" x-for="(list, index) in listData" :key="index">
      <a class="mb-5 mx-5 max-w-sm rounded overflow-hidden border" x-bind:href="'pos/' + listData[index].linking">
      <img class="w-full h-64 bg-cover text-center overflow-hidden lozad" x-bind:src="listData[index].img">
        <div class="w-full bg-white p-4 flex flex-col justify-between leading-normal">
          <div class="h-full">
            <div class="text-gray-900 font-bold text-lg mb-2" x-text="listData[index].judul"></div>
          </div>
        </div>
      </a>
      </template> -->
    </div>
    </template>
    <ul class="flex list-reset rounded items-center justify-center font-sans mt-5 mb-3" x-html="pagehtml()"></ul>
  </div>
  <?php include "foot.php"; ?>
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
    enableData: false,
    element: '',
    initku (param1 = 1) {
        let paramsrc = "";
        let parampage = "";
        paramsrc = "<?php echo $searchString; ?>";
        parampage = "<?php echo $pageString; ?>";
        if(paramsrc === null || paramsrc === undefined){
          paramsrc = "";
        }

        param1 = parampage;
        if(parampage === null || parampage === undefined || parampage === ""){
          param1 = 1
        }

        fetch(baseUrl + '/admin/get_data.php?pages=' + param1 + '&search=' + paramsrc, {
          method: 'GET'
        })
        .then((response) => response.json())
        .then((result) => {
          
          // this.loadShow = false;
          this.listData = result.data;
          this.pagin = result;
          this.totalPage = result.totalPage;
          this.page = result.page;
          
          this.renderedhtml();

        })
        .catch((error) => {
          console.error('Error:', error);
          swal("Server tidak meresponse, Tolong refresh browser");
        });

    },
    previousPage(){
      this.loadShow = true;
      let paramsrc = "<?php echo $searchString; ?>";
      let ahref = document.createElement('a');
      let att = document.createAttribute('href');
      if(paramsrc === null || paramsrc === undefined || paramsrc === ""){
        att.value = baseUrl + "/?page=" + this.pagin.prevPage;
      }else {
        att.value = baseUrl + "/?page=" + this.pagin.prevPage + "&search=" + paramsrc;
      }
      ahref.setAttributeNode(att);
      ahref.click();
    },
    nextPage(){
      this.loadShow = true;
      let paramsrc = "<?php echo $searchString; ?>";
      let ahref = document.createElement('a');
      let att = document.createAttribute('href');
      if(paramsrc === null || paramsrc === undefined || paramsrc === ""){
        att.value = baseUrl + "/?page=" + this.pagin.nextPage;
      }else {
        att.value = baseUrl + "/?page=" + this.pagin.nextPage + "&search=" + paramsrc;
      }
      ahref.setAttributeNode(att);
      ahref.click();
    },
    changePage(param) {
      this.loadShow = true;
      let paramsrc = "<?php echo $searchString; ?>";
      let ahref = document.createElement('a');
      let att = document.createAttribute('href');
      if(paramsrc === null || paramsrc === undefined || paramsrc === ""){
        att.value = baseUrl + "/?page=" + param;
      }else {
        att.value = baseUrl + "/?page=" + param + "&search=" + paramsrc;
      }
      ahref.setAttributeNode(att);
      ahref.click();
    },
    pagehtml(){
      let ready = '';
      ready += '<li><button class="block hover:text-white hover:bg-blue-500 text-blue border border-grey-light px-3 py-2" x-on:click="previousPage()">Previous</button></li>';
      for (let i = 0; i < this.totalPage; i++){
        if(i + 1 == this.page){
          ready += '<li><button class="block bg-blue-500 text-white hover:text-white hover:bg-blue-500 text-blue border border-grey-light px-3 py-2" x-on:click="changePage(' + (i+1) + ')">' + (i+1) + '</button></li>';
        }else {
          ready += '<li><button class="block hover:text-white hover:bg-blue-500 text-blue border border-grey-light px-3 py-2" x-on:click="changePage(' + (i+1) + ')">' + (i+1) + '</button></li>';
        }
        
      }
      ready += '<li><button class="block hover:text-white border border-grey-light hover:bg-blue-500 text-blue px-3 py-2" x-on:click="nextPage()">Next</button></li>';
      return ready;
    },
    async renderedhtml(){
        
        this.element = '';
        let counting = 0;
        for(let i = 0; i < this.listData.length; i++){
          let createLink = document.createElement('a');
          createLink.href = `pos/${this.listData[i].linking}`;
          createLink.className = 'w-full mb-5 mx-5 max-w-sm rounded overflow-hidden border loadingGray';
          
          let createImg = document.createElement('img');
          createImg.setAttribute('src', this.listData[i].img);
          createImg.className =  'w-full h-64 bg-cover text-center overflow-hidden';
          
          let div1 = document.createElement('div');
          div1.className = 'w-full bg-white p-4 flex flex-col justify-between leading-normal';
          
          let div2 = document.createElement('div');
          div2.className = 'h-full';
          
          let div3 = document.createElement('div');
          div3.className = 'text-gray-900 font-bold text-lg mb-2';
          div3.innerText = this.listData[i].judul;
          
          div1.appendChild(div2);
          div2.appendChild(div3);
          
          await this.combineElement(createLink, createImg, div1).then((result) => {
            this.element += result.outerHTML;
          });

          counting++;

        }
        
        if(this.listData.length === counting){
          this.enableData = true;
          this.loadShow = false;
        }

    },
    combineElement(link, image, div){
      return new Promise((resolve) => {
          setTimeout(() => {
            image.onload = resolve();

          }, 100);
      }).then(() => {
        link.appendChild(image);
        link.appendChild(div);
        return link;

      });

    },
    viewPost(param){
      let ahref = document.createElement('a');
      let att = document.createAttribute('href');
      att.value = param + '.html';
      ahref.setAttributeNode(att);
      ahref.click();
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