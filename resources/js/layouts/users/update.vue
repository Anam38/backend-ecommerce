<template>
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">form Edit User Data</h4>
        <form class="forms-sample" @submit.prevent="update">
          <div class="form-group">
            <label for="exampleInputName1">Name</label>
            <input type="text" class="form-control" v-model="updatedata.name">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail3">Email address</label>
            <input type="email" class="form-control" v-model="updatedata.email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword4">Old Password</label>
            <input type="password" class="form-control" placeholder="Old Password" v-model="updatedata.old_password">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword4"> New Password</label>
            <input type="password" class="form-control" placeholder="New Password" v-model="updatedata.new_password">
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
           console.log('users update get')
      },
      data(){
        return {
        updatedata : {},
        notification : {}
        }
      },
      created() {
          axios.get(location.origin + '/admin/users/update/' + this.$route.params.id)
              .then(response => {
                  this.updatedata = response.data.data[0];
          });
      },
      methods: {
          update() {
              axios.post(location.origin + '/admin/users/update', this.updatedata)
                  .then((response) => {
                    if (response.data.success) {
                      this.notification = {status : 'success', message : 'update data success.'}

                      // redirect to list user page
                      this.$router.push({name: 'usersLoad'});

                    }else if(!response.data.success) {
                      this.notification = {status : 'warning', message : response.data.message}
                    }

                    notification({
                      status: this.notification.status,
                      timeout: 3000,
                      close: false,
                      msg: this.notification.message
                    });

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
                  console.log(error)
              })
              .finally(() => this.loading = false);
          }
      }
    }
</script>
