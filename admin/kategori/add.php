<div class="w-full max-w-lg mx-auto mt-8" x-data="datanya()">
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
        Nama Kategori
      </label>
      <input x-model="nama" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Dejavu">
    </div>
  </div>
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <button x-on:click="submitForm" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" >Simpan Post</button>
    </div>
  </div>
  
</div>
<script>
function datanya() {
    return {
        nama: '',
        submitForm() {
            const formData = new FormData();
            formData.append('judul', this.judul);
                    formData.append('nama', this.nama);
                    formData.append('token', localStorage.getItem("token"));
                    fetch(baseUrl + '/admin/kategori/add_kat.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then((response) => response.json())
                    .then((result) => {
                        console.log('Success:', result);
                        alert(result.message);
                        window.location.href = baseUrl + '/admin?pages=kategori';
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
        }
    }
}


</script>