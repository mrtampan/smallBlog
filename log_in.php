<head>
<!-- <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js" defer></script> -->
<script src="global.js"></script>
</head>
<div class="w-full max-w-sm mx-auto rounded overflow-hidden shadow-lg p-5" x-data="datanya()">
<div class="text-center font-bold mt-3 text-xl text-teal-500" style=""> Login </div>
<div class="md:flex md:items-center mb-6 mt-6" >
    <div class="md:w-1/3">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        Username
      </label>
    </div>
    <div class="md:w-2/3">
      <input x-model="username" x-on:keyup.enter="submitLogin" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" placeholder="Jane Doe">
    </div>
  </div>
  <div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-username">
        Password
      </label>
    </div>
    <div class="md:w-2/3">
      <input x-model="password" x-on:keyup.enter="submitLogin" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="password" placeholder="******************">
    </div>
  </div>
  <div class="md:flex md:items-center">
    <div class="md:w-1/3"></div>
    <div class="md:w-2/3">
      <button x-on:click="submitLogin" class="shadow bg-green-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
        Login
      </button>
    </div>
  </div>
</div>

<script>
function datanya () {
  return {
    username: '',
    password: '',
    submitLogin () {
      const formData = new FormData();
      // const baseUrl = window.location.origin + '/smallBlog';

      formData.append('username', this.username);
      formData.append('password', this.password);

      fetch(baseUrl + '/proses_login.php', {
        method: 'POST',
        body: formData
      })
      .then((response) => response.json())
      .then((result) => {
        console.log('Success:', result);
        console.log(result.success);
        if(result.success){
          localStorage.setItem("token", result.token);
          window.location.href = baseUrl + '/admin?pages=';
        }else {
          alert("Email dan Password salah")
        }
      })
      .catch((error) => {
        console.error('Error:', error);
      });
    }
  }
}


</script>