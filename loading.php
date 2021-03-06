<style>
    .modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 1);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 200px;
  margin: 0px auto;
  padding: 20px 30px;
  /* background-color: #fff; */
  /* border-radius: 2px; */
  /* box-shadow: 0 2px 8px rgba(0, 0, 0, .33); */
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}


/*
 * the following styles are auto-applied to elements with
 * v-transition="modal" when their visiblity is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter, .modal-leave {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>

<div class="modal-mask" x-show="loadShow" transition="modal">
    <div class="modal-wrapper">
      <div class="modal-container">
        <img src="/assets/banana.gif" alt="banana dance" width="200px" height="250px"/>
        <div style="color:white;">Tunggu Sebentar....</div>
      </div>
    </div>
  </div>
