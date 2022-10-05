<template>
  <div>
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
          <div class="card card position-relative">
            <div class="card-body">
              <div style="margin-bottom:10px">
                <h4 class="card-title">PASSWORD CLIENT</h4>
               </router-link>
              </div>
              <form class="forms-sample">
                <div class="row">
                  <div class="col-sm-4">
                    <span>Client ID</span>
                    <p class="card-description">A unique id.</p>
                  </div>
                  <div class="col-sm-8">
                    <div class="input-group col-xs-12">
                      <input type="text" class="form-control file-upload-info" id="input1" readonly v-model="getOauthPassworddata.id">
                      <span class="input-group-append">
                        <button class="file-upload-browse btn btn-primary" @click="copy('input1')" type="button">Copy</button>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <span>Client Secret</span>
                    <p class="card-description">A unique secrets used for attempt password user</p>
                  </div>
                  <div class="col-sm-8">
                    <div class="input-group col-xs-12">
                      <input type="text" class="form-control file-upload-info" id="input2" readonly v-model="getOauthPassworddata.secret">
                      <span class="input-group-append">
                        <button class="file-upload-browse btn btn-primary" @click="copy('input2')" type="button">Copy</button>
                      </span>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
          <div class="card card position-relative">
            <div class="card-body">
              <div style="margin-bottom:10px">
                <h4 class="card-title">CREDENTIAL CLIENT</h4>
               </router-link>
              </div>
              <form class="forms-sample">
                <div class="row">
                  <div class="col-sm-4">
                    <span>Client ID</span>
                    <p class="card-description">A unique id.</p>
                  </div>
                  <div class="col-sm-8">
                    <div class="input-group col-xs-12">
                      <input type="text" class="form-control file-upload-info" id="input3" readonly v-model="getOauthClientdata.id">
                      <span class="input-group-append">
                        <button class="file-upload-browse btn btn-primary" @click="copy('input3')" type="button">Copy</button>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <span>Client Secret</span>
                    <p class="card-description">A unique secrets used for attempt password user</p>
                  </div>
                  <div class="col-sm-8">
                    <div class="input-group col-xs-12">
                      <input type="text" class="form-control file-upload-info" id="input4" readonly v-model="getOauthClientdata.secret">
                      <span class="input-group-append">
                        <button class="file-upload-browse btn btn-primary" @click="copy('input4')" type="button">Copy</button>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <span>Generate Token</span>
                    <p class="card-description">If a service becomes compromised, you should regenerate the token and re-configure.</p>
                  </div>
                  <div class="col-sm-8">
                    <button type="button" @click="generate" class="btn btn-primary mb-2">Generate Token</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>
</template>

<script>
    export default {
      mounted() {
      },
      data(){
        return {
          getOauthClientdata : {},
          getOauthPassworddata : {},
          paramGenerate : {
            grant_type : 'client_credentials',
            scope : '',
          }
        }
      },
      created() {
        this.get();
      },
       methods: {

         get() {
             axios.get(location.origin + '/admin/integration/backend/get')
                 .then((response) => {
                   if (response.data.success) {
                     this.getOauthClientdata = response.data.data.clients;
                     this.getOauthPassworddata = response.data.data.password;
                   }
             })
             .catch(error => {
               console.log(error.response)
             });
         },

         generate() {
             this.paramGenerate.client_id = this.getOauthClientdata.id
             this.paramGenerate.client_secret = this.getOauthClientdata.secret

             axios.post(location.origin + '/oauth/token', this.paramGenerate)
                 .then((response) => {
                   if (response.status == 200) {
                     notification({
                         status: "success",
                         timeout: 3000,
                         close: false,
                         msg: "Generate success."
                     });

                     // postToken
                     this.postToken(response.data);
                   }
             })
             .catch(error => {
               console.log(error.response)
             });
         },

         postToken(data) {
           axios.post(location.origin + '/admin/integration/backend', data)
               .then((response) => {
                 if (response.status == 200) {
                   notification({
                       status: "success",
                       timeout: 3000,
                       close: false,
                       msg: "Post Token success."
                   });
                 }
           })
           .catch(error => {
             console.log(error.response)
           });
         },

        copy(ref) {
          var Url = document.getElementById(ref);
          Url.innerHTML = window.location.href;
          Url.select();
          document.execCommand("copy");

          notification({
              status: "success",
              position: "topRight",
              backgroundColor: "#4B49AC",
              theme: "dark",
              timeout: 3000,
              close: false,
              msg: "text copied."
          });
        }

      }
    }
</script>
