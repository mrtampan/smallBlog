<html>
<head>
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<div class="mx-auto container mt-5" x-show="loadShow" >
<div class="flex flex-wrap justify-center">
      <div class="mx-5 mb-5 max-w-sm rounded overflow-hidden border" >
      <div id="gmbr" class="text-center overflow-hidden"></div>
        <div class="w-full bg-white p-4 flex flex-col justify-between leading-normal mb-5">
          <div class="h-full">
            <div id="jdul" class="text-gray-900 font-bold text-xl mb-2" ></div>
            <!-- <p id="txt" class="text-gray-700 text-base" ></p> -->
          </div>
        </div>
      </div>
      <div class="mx-5 mb-5 max-w-sm rounded overflow-hidden border" >
      <div id="gmbr" class="text-center overflow-hidden"></div>
        <div class="w-full bg-white p-4 flex flex-col justify-between leading-normal mb-5">
          <div class="h-full">
            <div id="jdul" class="text-gray-900 font-bold text-xl mb-2" ></div>
            <!-- <p id="txt" class="text-gray-700 text-base" ></p> -->
          </div>
        </div>
      </div>
      <div class="mx-5 mb-5 max-w-sm rounded overflow-hidden border" >
      <div id="gmbr" class="text-center overflow-hidden"></div>
        <div class="w-full bg-white p-4 flex flex-col justify-between leading-normal mb-5">
          <div class="h-full">
            <div id="jdul" class="text-gray-900 font-bold text-xl mb-2" ></div>
            <!-- <p id="txt" class="text-gray-700 text-base" ></p> -->
          </div>
        </div>
      </div>
      <div class="mx-5 mb-5 max-w-sm rounded overflow-hidden border" >
      <div id="gmbr" class="text-center overflow-hidden"></div>
        <div class="w-full bg-white p-4 flex flex-col justify-between leading-normal mb-5">
          <div class="h-full">
            <div id="jdul" class="text-gray-900 font-bold text-xl mb-2" ></div>
            <!-- <p id="txt" class="text-gray-700 text-base" ></p> -->
          </div>
        </div>
      </div>
</div>
</div>

</body>
</html>


<style>


@keyframes animate {
     0% {
     background-position: -468px 0
   }
   100% {
     background-position: 468px 0
   }

}

#gmbr,#jdul,#txt
{
  position:relative;
  background-color: #CCC;
  height: 6px;
  animation-name: animate; 
  animation-duration: 2s; 
  animation-iteration-count: infinite;
  animation-timing-function: linear;   
  background: -webkit-gradient(linear, left top, right top, color-stop(8%, #eeeeee), color-stop(18%, #dddddd), color-stop(33%, #eeeeee));
  background: -webkit-linear-gradient(left, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
  background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
  -webkit-background-size: 800px 104px;  
}


#gmbr{
  height: 256px;
  width: 380px;  
}

#jdul{
  height: 20px;  
}

#txt{
  height: 18px;
  width: 70%;
}


</style>