<template>
    <div v-if="auth">
      <header-component></header-component>
      <div class="container-fluid page-body-wrapper">
        <sidebarmenu-component></sidebarmenu-component>
        <div class="main-panel">
          <div class="content-wrapper">
            <router-view></router-view>
          </div>
          <footer-component></footer-component>
        </div>
      </div>
    </div>
    <div v-else>
      <auth-component></auth-component>
    </div>
</template>

<script>
    export default {
      mounted() {
      },
      data(){
        return {
            auth  : this.auth.token
            }
        },
        created() {
        },
    }
</script>
