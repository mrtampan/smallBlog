<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script src="../global.js"></script>
<div class="w-full max-w-lg mx-auto mt-8" x-data="datanya()">
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
        Judul
      </label>
      <input x-model="judul" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Dejavu">
    </div>
  </div>
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
        Isi
      </label>
      <textarea id="editor1" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="lalalala"></textarea>
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
      <button x-on:click="submitForm" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" >Simpan Post</button>
    </div>
  </div>
  
</div>
<script>
 CKEDITOR.replace( 'editor1' );
function datanya() {
    return {
        judul: '',
        submitForm() {
            const formData = new FormData();
            var imgBase64;
            console.log(this.$refs.gambar.files[0]);
            console.log(CKEDITOR.instances.editor1.getData());
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
                    formData.append('linking', this.judul.split(' ').join('-'));
                    fetch(baseUrl + './add_post.php', {
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
        }
    }
}

// function submitForm() {
// const formData = new FormData();
// var imgBase64;
// console.log(this.judul);
// let reader = new FileReader();
//     if(gambare.files[0]) {
//         reader.onload = () => {
//         imgBase64 = reader.result;
//         console.log(reader.result);
//         //your request
//       }
//       reader.readAsDataURL(gambare[0]);
//     }

//   formData.append('judul', judule);
//   formData.append('isi', CKEDITOR.instances.editor1.getData());
//   formData.append('gambar', imgBase64);
//   fetch(baseUrl + './add_post.php', {
//     method: 'POST',
//     body: formData
//   })
//   .then((response) => response.json())
//   .then((result) => {
//     console.log('Success:', result);
//     window.location.href = baseUrl + '/admin?pages=';
//   })
//   .catch((error) => {
//     console.error('Error:', error);
//   });
// }

</script>