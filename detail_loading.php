<html>
<head>
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<div x-show="loadShow">
    <div class="grid grid-cols-4 rounded h-full justify-center">
        <div class="md:col-start-2 md:col-span-2 col-start-1 col-span-4 bg-gray-100 p-4">
            <h1 class="my-3" id="jdul"></h1>
            <div class="clear-both"></div>
            <div class="flex justify-center mb-3" >
            <div class="w-full" id="gmbr"> </div>
            </div>
            <br/>
            <div class="clear-both"></div>
            <div class="" id="txt"></div>
            <br/>
            <div class="" id="txt2"></div>
            <br/>
            <div class="" id="txt3"></div>
            <br/>
            <div class="" id="txt4"></div>
            <br/>
            <div class="" id="txt5"></div>
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

#gmbr,#jdul,#txt,#txt2,#txt3,#txt4,#txt5
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
  height: 35px;  
  width: 60%;
}

#txt{
  height: 18px;
  width: 90%;
}

#txt2{
  height: 18px;
  width: 100%;
}
#txt3{
  height: 18px;
  width: 87%;
}
#txt4{
  height: 18px;
  width: 100%;
}
#txt5{
  height: 18px;
  width: 90%;
}


</style>