
<div class="" x-data="datanya()" x-init="initku(1)">
<div class="float-right"><button x-on:click="addPost" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-4">Tambah Kategori</button></div>
<div class="clear-both"></div>
<table class="table-auto mx-auto p-4 mt-3 border">
  <thead>
    <tr>
      <th class="px-4 py-2">id Kategori</th>
      <th class="px-4 py-2">nama</th>
      <th class="px-4 py-2">aksi</th>
    </tr>
  </thead>
  <tbody class="border">
    <template x-if="listData" x-for="(list, index) in listData" :key="index">
      <tr>
      <td class="border px-4 py-2" x-text="listData[index].id_kategori"></td>
      <td class="border px-4 py-2" x-html="listData[index].nama"></td>
      <td class="border px-4 py-2"><button x-on:click="deletePost(listData[index].id_kategori)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold p-4 mx-2 rounded">Delete</button></td>
      </tr>
    </template>
  </tbody>
</table>
<ul class="flex list-reset rounded items-center justify-center font-sans mt-3" x-html="pagehtml()">
</ul>
</div>

<script>
function datanya() {
  return {
    colours: [
            '#FF0000',
            '#00FF00',
            '#0000FF'
    ],
    listData: null,
    pagin: null,
    totalPage: null,
    initku (param1) {

      fetch(baseUrl + '/admin/kategori/get_data.php?pages=' + param1, {
        method: 'GET'
      })
      .then((response) => response.text())
      .then((result) => {
        
        this.listData = JSON.parse(result).data;
        this.pagin = JSON.parse(result);
        this.totalPage = JSON.parse(result).totalPage;
        this.page = JSON.parse(result).page;
        console.log(this.listData);
        console.log(this.colours);
      })
      .catch((error) => {
        console.error('Error:', error);
      });
    },
    addPost(){
      let ahref = document.createElement('a');
      let att = document.createAttribute('href');
      att.value = "?pages=add-kat";
      ahref.setAttributeNode(att);
      ahref.click();
    },
    previousPage(){
      this.initku(this.pagin.prevPage);
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
    deletePost(param1){
      let konfirmasi = confirm("Apakah Kamu yakin ingin menghapus?");
      if(konfirmasi == true){
        const formData = new FormData();

        formData.append('id_kategori', param1);
        formData.append('token', localStorage.getItem("token"));

        fetch(baseUrl + '/admin/kategori/delete_kat.php', {
          method: 'POST',
          body: formData
        })
        .then((response) => response.json())
        .then((result) => {
          alert(result.message);
          console.log(result);
          window.location.href = baseUrl + '/admin?pages=kategori';
        })
        .catch((error) => {
          console.error('Error:', error);
        });
      }
    }
  }
}
</script>