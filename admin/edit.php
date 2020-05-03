<script src="https://cdn.ckeditor.com/4.4.5/standard-all/ckeditor.js"></script>

<?php
if($_GET['edit']){
?>
<div class="w-full max-w-lg mx-auto mt-8" x-data="datanya()" x-init="initku()">
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
        Judul
      </label>
      <input x-model="judul" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Dejavu" >
    </div>
  </div>
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
        Isi
      </label>
      <textarea id="editor1" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="lalalala">
      </textarea>
    </div>
  </div>
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
        Gambar Posting
      </label>
      <input x-ref="gambar" x-on:change="fileName = $refs.gambar.files[0].name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="file">
    </div>
  </div>
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
        Kategori
      </label>
      <div class="inline-block relative w-64">
        <select x-model="selectKategori" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
        <option>Pilih Kategori</option>
        <template x-if="listKategori" x-for="(list, index) in listKategori" :key="index">
          <option x-text="listKategori[index].nama" x-bind:value="listKategori[index].id_kategori"></option>
        </template>  
        </select>
      </div>
    </div>
  </div>
  <input style="display:none; " x-model="gambarlama"  />
  <input style="display:none; " x-model="linking"  />
  <input style="display:none; " x-model="id_post"  />
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <button x-on:click="submitForm" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" >Simpan Post</button>
    </div>
  </div>
</div>
<?php }else { ?>
<h1>404 not found</h1>
<?php } ?>
<script>
 CKEDITOR.replace( 'editor1',
 {
    script: true,
    allowedContent :true,
    extraPlugins: 'codesnippet',
    codeSnippet_theme: 'magula'
});
function datanya() {
    return {
        judul: '',
        isi: '',
        linking: '',
        gambarlama: '',
        id_post:'',
        selectKategori: '',
        listKategori: '',
        submitForm() {

            const formData = new FormData();
            console.log(this.$refs.gambar.value);
            if(this.$refs.gambar.value != ""){
                var imgBase64;
                console.log(this.$refs.gambar.files[0]);
                let reader = new FileReader();
                reader.onload = () => {
                imgBase64 = reader.result;
                console.log(reader.result);
                //your request
                }
                reader.readAsDataURL(this.$refs.gambar.files[0]);
                let prosesReader = new Promise ((resolve, reject) => {
                    setTimeout(() => {
                        console.log(imgBase64 + 'cuk');
                        formData.append('judul', this.judul);
                        formData.append('isi', CKEDITOR.instances.editor1.getData());
                        formData.append('gambar', imgBase64);
                        formData.append('linking', this.linking);
                        formData.append('idPost', this.id_post);
                        formData.append('id_kategori', this.selectKategori);
                        formData.append('token', localStorage.getItem("token"));
                        fetch(baseUrl + './edit_post.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then((response) => response.json())
                        .then((result) => {
                            console.log('Success:', result);
                            alert(result.message);
                            window.location.href = baseUrl + '/admin?pages=';
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                        });
                        resolve("done!");
                    }, 500);
                })
                prosesReader.then(function(result){
                    console.log('Berhasil upload gambar');
                })
            }else{
                formData.append('judul', this.judul);
                formData.append('isi', CKEDITOR.instances.editor1.getData());
                formData.append('gambar', this.gambarlama);
                formData.append('linking', this.linking);
                formData.append('idPost', this.id_post);
                formData.append('id_kategori', this.selectKategori);
                formData.append('token', localStorage.getItem("token"));
                fetch(baseUrl + './edit_post.php', {
                    method: 'POST',
                    body: formData
                })
                .then((response) => response.json())
                .then((result) => {
                    console.log('Success:', result);
                    alert(result.message);
                    window.location.href = baseUrl + '/admin?pages=';
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            }
        },
        initku() {

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
          let oneEdit = new Promise((resolve, reject) => {
            setTimeout(() => {
              fetch(baseUrl + '/admin/get_edit.php?edit=' + "<?php echo $_GET['edit']; ?>", {
                method: 'GET'
              })
              .then((response) => response.text())
              .then((result) => {
                
                this.judul= JSON.parse(result).judul;
                CKEDITOR.instances.editor1.setData(JSON.parse(result).isi);
                this.linking= JSON.parse(result).linking;
                this.gambarlama = JSON.parse(result).img;
                this.id_post= JSON.parse(result).id_post;
                this.selectKategori = JSON.parse(result).id_kategori;
              })
              .catch((error) => {
                console.error('Error:', error);
              });
              resolve("done!!");
            }, 200);
          })
          oneEdit.then(function(result){
            console.log('Berhasil ngambil Edit');
          })

        }
    }
}


</script>