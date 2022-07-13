<template>
  <div class="modal-custome">
    <div class="modal-custome-content">
      <div class="modal-custome-header">
        <span class="modal-custome-close" @click="$emit('close-modal')">&times;</span>
        <h2 class="title">{{ modal_title }}</h2>
      </div>
      <form class="forms-sample" @submit.prevent="$emit('modal-post')">
        <div class="modal-custome-body">
          <!-- content -->
          <slot />
        </div>
        <div class="modal-custome-footer" v-if="modal_footer == 'true'">
          <button type="button" @click="$emit('close-modal')" class="btn btn-light">Cancel</button>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
  export default {
    props: {
      modal_title: {
        type : String,
        default : "Modal Title"
      },
      modal_footer: {
        type : String,
        default : 'true'
      }
    }
  }
</script>
<style scoped>
/* The Modal (background) */
  .modal-custome {
    position: fixed; /* Stay in place */
    z-index: 99; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }

  /* Modal Content */
  .modal-custome-content {
    position: relative;
    margin: auto;
    padding: 0;
    width: 600px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
  }

  /* Add Animation */
  @-webkit-keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
  }

  @keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
  }

  /* The Close Button */
  .modal-custome-close {
    color: black;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .modal-custome-close:hover,
  .modal-custome-close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
  }

  .modal-custome-header {
    padding: 2px 16px;
    text-align: center;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
  }
  .modal-custome-header .title{
    padding: 20px
  }

  .modal-custome-body {
    padding: 2px 40px;
    background: white;
  }
  .modal-custome-body .form-group {
      margin-bottom: 10px;
  }

  .modal-custome-footer {
    padding: 20px 16px;
    text-align: center;
    padding-bottom: 25px;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
  }
</style>
