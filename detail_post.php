<!-- <script> document.title ='". $judul ."';</script> -->
<script src="../global.js"></script>
<link rel="stylesheet"	href="/codesnip.css">
<div class="bg-gray-300 " x-data="datanya()" x-init="initku()">
<?php include "loading.php"; ?>
    
    <template x-if="enableData">
    <div class="grid grid-cols-4 rounded justify-center h-auto">
        <div class="md:col-start-2 md:col-span-2 col-start-1 col-span-4 bg-white p-4" x-html="oneHtmlData"></div>
        <!-- <div class="md:col-start-2 md:col-span-2 col-start-1 col-span-4 bg-white p-4">
            <h1 class="my-3 text-3xl font-bold" x-html="oneData.judul"></h1>
            <div class="clear-both"></div>
            <div class="flex justify-center mb-3"><img class="object-contain h-48 w-full loadingGray" x-bind:src="oneData.img" x-bind:alt="oneData.judul" /></div><div class="clear-both"></div>
            <div class="md:text-lg leading-relaxed" x-html="oneData.isi"></div>
        </div> -->
    </div>
    </template>
</div>

<script>
function datanya(){
    return  {
        loadShow: true,
        oneData: '',
        enableData: false,
        oneHtmlData: '',
        initku(){
            let linkingName =  "<?php echo $linking; ?>";

            fetch(baseUrl + '/get_post.php?linking="' + linkingName + '"', {
                method: 'GET'
             })
            .then((response) => response.json())
            .then((result) => {
            this.oneData = result;
            document.title = this.oneData.judul;
            this.renderedhtml();
            })
            .catch((error) => {
                console.error('Error:', error);
                swal("Server tidak meresponse, Tolong refresh browser");
            });
        },
        renderedhtml(){
            

            let h1 = document.createElement('h1');
            h1.className = 'my-3 text-3xl font-bold';
            h1.innerText = this.oneData.judul;

            let div1 = document.createElement('div');
            div1.className = 'clear-both';
            
            let div2 = document.createElement('div');
            div2.className = 'flex justify-center mb-3';
            
            let imgMain = document.createElement('img');
            imgMain.className = 'object-contain h-48 w-full loadingGray';
            imgMain.setAttribute('alt', this.oneData.judul);
            imgMain.src = this.oneData.img;
            
            let div3 = document.createElement('div');
            div3.className = 'clear-both';

            let div4 = document.createElement('div');
            div4.className = 'md:text-lg leading-relaxed';
            div4.innerHTML = this.oneData.isi;
            
            

            let loadImage = new Promise((resolve) => {
            setTimeout(() => {
                imgMain.onload = resolve();
            }, 500);
            });
            
            loadImage.then((result) => {
                
                div2.appendChild(imgMain);
                div2.appendChild(div3);
                
                this.oneHtmlData = h1.outerHTML + div2.outerHTML + div4.outerHTML;
                this.loadShow = false; 
                this.enableData = true;
            });
            
        }
    }
}

</script>
