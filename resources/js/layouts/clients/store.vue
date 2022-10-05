<template>
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">form Add Client</h4>
        <form class="forms-sample" @submit.prevent="store">
          <div class="form-group">
            <label for="exampleInputName1">Username</label>
            <input type="text" class="form-control" placeholder="Username" v-model="storedata.username">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail3">Email address</label>
            <input type="email" class="form-control" placeholder="Email" v-model="storedata.email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword4">Password</label>
            <input type="password" class="form-control" placeholder="Password" v-model="storedata.password">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail3">Phone Number</label>
            <input type="number" class="form-control" placeholder="Phone Number" v-model="storedata.phone_number">
          </div>
          <div class="form-group row">
            <div class="col-sm-6">
              <label for="exampleInputEmail3">Date Of Birth</label>
              <div class="">
                <date-picker v-model="storedata.birth" color="indigo"
                  :min-date="new Date('01-01-1990')"
                  :max-date="new Date()"
                  :masks="masks"
                  :model-config="modelConfig" is-required>
                  <template v-slot="{ inputValue, inputEvents }">
                    <input
                      class="form-control disable_update"
                      :value="inputValue"
                      v-on="inputEvents"/>
                  </template>
                </date-picker>
              </div>
            </div>
            <div class="col-sm-6 row">
              <label for="exampleInputEmail3">Gender</label>
              <div class="row">
              <div class="col-sm-4">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios1" value="m" v-model="storedata.gender" checked="checked">
                    Male
                  <i class="input-helper"></i></label>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios2" value="f" v-model="storedata.gender">
                    Female
                  <i class="input-helper"></i></label>
                </div>
              </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          <router-link to="/client" class="btn btn-light">Cancel</router-link>
        </form>
      </div>
    </div>
  </div>
  </div>
</template>

<script>
    export default {
      mounted() {
           console.log('client add');
      },
      data(){
        return {
        storedata : {},
        modelConfig: {
          type: 'string',
          mask: 'DD-MM-YYYY', // Uses 'iso' if missing
        },
        masks: {
          input: 'DD-MM-YYYY',
        },
        }
      },
      created() {
      },
      methods: {
            store() {
                axios.post(location.origin + '/admin/clients/store', this.storedata)
                    .then((response) => {
                      if (response.data.success) {

                        notification({
                            status: "success",
                            timeout: 3000,
                            close: false,
                            msg: "Add data success."
                        });

                        this.$router.push({name: 'clientLoad'});
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
