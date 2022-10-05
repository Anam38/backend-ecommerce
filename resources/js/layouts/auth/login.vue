<template>
  <div class="col-lg-6 mx-auto">
    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
        <div class="brand-logo">
          <img :src="logo" alt="logo">
        </div>
        <h4>Login</h4>
        <form class="pt-3" @submit.prevent="login">
          <div class="form-group">
            <input type="text" class="form-control form-control-lg" placeholder="Username" v-model="logindata.name">
          </div>
          <div class="form-group">
            <input type="password" class="form-control form-control-lg" placeholder="Password" v-model="logindata.password">
          </div>
          <div class="mt-3">
            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">LOGIN</button>
          </div>
        </form>
      </div>
  </div>
</template>

<script>
import Auth from '../../middleware/Auth.js';

  export default {
    data(){
      return{
        logo : location.origin + '/templates/images/logo.svg',
        logindata : {}
      }
    },
    methods: {
          login() {
              axios.post(location.origin + '/admin/admin/login', this.logindata)
                  .then((response) => {
                    if (response.data.success) {
                      console.log(response);
                      Auth.login(response.data.data.token , response.data.data.user); //set local storage
                      // this.$router.push({name: 'home'});
                    }
              })
              .catch(error => {
                const errmsg = '';
                if (error.response.data.message = 'the given data was invalid') {
                  for (var items in error.response.data.errors) {
                    if (error.response.data.errors.name[0] == 'These credentials do not match our records.') {
                      this.errmsg = 'username atau kata sandi salah' ;
                    }else {
                      this.errmsg = "Inputan " + items + " tidak boleh kosong";
                    }

                    notification({
                      status: "warning",
                      timeout: 3000,
                      close: false,
                      msg: this.errmsg
                    })
                  }

                }
                console.log(error)
              })
              .finally(() => this.loading = false);
          }
      }
  }
</script>
