<template>
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">form Add Cato</h4>
        <form class="forms-sample" @submit.prevent="store" id="formStore">
          <div class="form-group">
            <label for="exampleInputName1">Code</label>
            <input type="text" class="form-control" placeholder="Input Unix Code" v-model="storedata.code">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail3">Name</label>
            <input type="text" class="form-control" placeholder="Name Promo" v-model="storedata.name">
          </div>
          <div class="form-group">
            <label for="img">File upload <code>*opsional</code></label>
            <input type="file" name="img" id="upload" @change="getFile" ref="file" class="file-upload-default">
            <div class="input-group col-xs-12">
              <input type="text" class="form-control file-upload-info" id="upload-value" disabled="" placeholder="Upload Image" v-model="storedata.img">
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-primary" @click="openFile" type="button">choose</button>
              </span>
            </div>
          </div>
          <p class="text-danger">*Remember</p>
          <p class="text-danger"> max size file 2,5MB</p>
          <p class="text-danger"> type file should .png, .jpg, .wepb</p>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          <router-link to="/product-categories" class="btn btn-light">Cancel</router-link>
        </form>
      </div>
    </div>
  </div>
  </div>
</template>
<script>
    export default {
      mounted() {
           console.log('product categories add')
      },
      data(){
        return {
        storedata : {},
        notification : {}
        }
      },
      methods: {
            openFile(){
                var link = document.getElementById('upload');
                link.click()

            },
            getFile(event){
              document.getElementById('upload-value').value = event.target.value;
              this.storedata.img = this.$refs.file.files[0];
            },

            store() {
                const formData = this.parseData(this.storedata);

                axios.post(location.origin + '/api/product-categories/store', formData)
                    .then((response) => {
                      if (response.data.success) {

                        this.notification = {status : 'success', message : 'store data success.'}

                        this.$router.push({name: 'product-categoriesLoad'});

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
                  console.log(error.response)
                })
                .finally(() => this.loading = false);
            },

            parseData(data){
              const formData = new FormData();
              for (let key in data) {
                  Array.isArray(data[key])
                      ? data[key].forEach(value => formData.append(key + '[]', value))
                      : formData.append(key, data[key]) ;
              }
              return formData;
            }
        }
    }
</script>
