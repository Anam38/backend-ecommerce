<template>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card card position-relative">
          <div class="card-body">
            <div style="margin-bottom:10px">
              <h4 class="card-title">Deploy Token</h4>
             </router-link>
            </div>
            <form class="forms-sample">
              <div class="row">
                <div class="col-sm-4">
                  <span>Token</span>
                  <p class="card-description">A unique secrets used for interactions with frontend urls.</p>
                </div>
                <div class="col-sm-8">
                  <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info" ref="input" readonly v-model="getdata.option_value">
                    <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" @click="copy" type="button">Copy</button>
                    </span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <span>Generate</span>
                  <p class="card-description">If a service becomes compromised, you should regenerate the token and re-configure.</p>
                </div>
                <div class="col-sm-8">
                  <button type="button" @click="generate" class="btn btn-primary mb-2">Generate</button>
                </div>
              </div>
            </form>
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
          getdata : {}
        }
      },
      created() {
        this.get();
      },
       methods: {

         get() {
             axios.get(location.origin + '/admin/integration/frontend/get')
                 .then((response) => {
                   if (response.data.success) {
                     this.getdata = response.data.data;
                   }
             })
             .catch(error => {
               console.log(error.response)
             });
         },

         generate() {
             axios.get(location.origin + '/admin/integration/frontend/generate')
                 .then((response) => {
                   if (response.data.success) {
                     notification({
                         status: "success",
                         timeout: 3000,
                         close: false,
                         msg: "Generate success."
                     });

                     this.get();
                   }
             })
             .catch(error => {
               console.log(error.response)
             });
         },

        copy() {
          var Url = this.$refs.input;
          Url.innerHTML = window.location.href;
          console.log(Url.innerHTML)
          Url.select();
          document.execCommand("copy");

          notification({
              status: "success",
              timeout: 3000,
              close: false,
              msg: "text copied."
          });
        }

      }
    }
</script>
