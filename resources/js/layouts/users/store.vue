<template>
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">form Add User</h4>
        <form class="forms-sample" @submit.prevent="store">
          <div class="form-group">
            <label for="exampleInputName1">Name</label>
            <input type="text" class="form-control" placeholder="Name" v-model="storedata.name">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail3">Email address</label>
            <input type="email" class="form-control" placeholder="Email" v-model="storedata.email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword4">Password</label>
            <input type="password" class="form-control" placeholder="Password" v-model="storedata.password">
          </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          <router-link to="/users" class="btn btn-light">Cancel</router-link>
        </form>
      </div>
    </div>
  </div>
  </div>
</template>

<script>
    export default {
      mounted() {
           console.log('users add')
      },
      data(){
        return {
        storedata : {}
        }
      },
      methods: {
            store() {
                axios.post(location.origin + '/admin/users/store', this.storedata)
                    .then((response) => {
                      if (response.data.success) {

                        notification({
                            status: "success",
                            timeout: 3000,
                            close: false,
                            msg: "Add data success."
                        });

                        this.$router.push({name: 'usersLoad'});
                      }
                })
                .catch(error => {
                  if (error.response.data.message = 'the given data was invalid') {
                    for (var items in error.response.data.errors) {
                      notification({
                        status: "warning",
                        timeout: 3000,
                        close: false,
                        msg: "Inputan " + items + " tidak boleh kosong"
                      })
                    }

                  }
                  console.log(error.response)
                })
                .finally(() => this.loading = false);
            }
        }
    }
</script>
