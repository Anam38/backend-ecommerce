<template>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card card position-relative">
          <div class="card-body">
            <div style="margin-bottom:10px">
              <h4 class="card-title">Product Categories list</h4>
              <router-link class="btn btn-sm btn-primary bg-primary" to="/product-categories/store">
               <i class="mdi mdi-add"></i> Tambah Data
             </router-link>
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="getDataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>code</th>
                    <th>name</th>
                    <th>Create</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="items in getdata" :key="items.id">
                    <td>{{ items.id }}</td>
                    <td>{{ items.code }}</td>
                    <td>{{ items.name }}</td>
                    <td>{{ items.updated_at }}</td>
                    <td>
                      <div class="">
                        <button @click="modalInfo(items)" class="btn btn-sm btn-info btn-icon-text" title="promo banner">
                          <i class="ti-eye"></i>
                        </button>
                        <button @click="modalUpdate(items)" class="btn btn-sm btn-warning btn-icon-text" title="edit data">
                          <i class="ti-pencil-alt"></i>
                        </button>
                        <button @click="modalDelete(items)" class="btn btn-sm btn-danger btn-icon-text" title="delete data">
                          <i class="ti-trash"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="">
        <!-- modal info -->
        <modal-component modal_title="Info" modal_footer="false" v-show="showModalInfo" @close-modal="showModalInfo = false">
          <div v-if="img">
            <img style="width:100%;" :src="img" alt="">
          </div>
          <div v-else>
            <p style="text-align:center;" class="card-title">This promo doesn't have image</p>
          </div>
        </modal-component>
        <!-- modal info -->
        <!-- modal add address -->
          <modal-component modal_title="Update Categories" v-show="showModalUpdate" @close-modal="showModalUpdate = false" @modal-post="update">
            <div class="form-group">
              <label for="exampleInputName1">Code</label>
              <input type="text" class="form-control" v-model="updatedata.code">
            </div>
            <div class="form-group">
              <label for="exampleInputName1">Name</label>
              <input type="text" class="form-control" v-model="updatedata.name">
            </div>
            <div class="form-group">
              <label for="img">File upload <code>*opsional</code></label>
              <input type="file" name="img" id="upload" @change="getFile" ref="file" class="file-upload-default">
              <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" id="upload-value" disabled="" placeholder="Upload Image" />
                <span class="input-group-append">
                  <button class="file-upload-browse btn btn-primary" @click="openFile" type="button">choose</button>
                </span>
              </div>
            </div>
            <div class="form-group">
              <div v-if="img">
                <img style="width:100%;" :src="img" alt="">
              </div>
              <div v-else>
                <p style="text-align:center;" class="card-title">This promo doesn't have image</p>
              </div>
            </div>
          </modal-component>
          <!-- modal add address -->
          <!-- modal delete address -->
          <modal-component modal_title="Delete Categories" v-show="showModalDelete" @close-modal="showModalDelete = false" @modal-post="destroy">
            <div class="">
              <p>Are you sure to delete "{{ deletedata.name }}"? You cannot restore a deleted address.</p>
            </div>
          </modal-component>
          <!-- modal delete address -->
      </div>
  </div>
</template>

<script>
    export default {
      mounted() {
           console.log('product categories load');
      },
      data(){
        return {
          showModalInfo : false,
          showModalUpdate : false,
          showModalDelete : false,
          notification: {},
          getdata : {},
          infocategory : {},
          updatedata : {},
          deletedata : {},
          img : ''
        }
      },
      created() {
          this.getData();  //load data users
      },
       methods: {
          getData() {
            axios.get(location.origin + '/api/product-categories')
            .then(response => {
                this.getdata = response.data.data;
                this.reloadTable();
            })
            .catch(errors => {
              console.log(errors);
                //Handle Errors
            })
         },

         modalInfo(data){
           this.showModalInfo = true;
           this.infocategory = data
           this.img = (data.img) ? location.origin + data.img.split('public')[1] : null;

         },

         modalUpdate(data){
           document.getElementById('upload-value').value = ' ';
           this.showModalUpdate = true;
           this.updatedata = data;
           this.img = (data.img) ? location.origin + data.img.split('public')[1] : null;
         },

         modalDelete(data){
           this.showModalDelete = true;
           this.deletedata = data;
           console.log(data);
         },

         openFile(){
             var link = document.getElementById('upload');
             link.click()
         },

         getFile(event){
           document.getElementById('upload-value').value = event.target.value;
           this.updatedata.new_img = this.$refs.file.files[0];
         },

         update(){
           const formData = this.parseData(this.updatedata);

           axios.post(location.origin + '/api/product-categories/update', formData)
               .then((response) => {

                 this.showModalUpdate = false;

                 if (response.data.success) {

                   this.notification = {status : 'success', message : 'store data success.'}

                   this.getData()

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

         destroy: function(){
           axios.post(location.origin + '/api/product-categories/destroy/' + this.deletedata.id, this.deletedata)
               .then(response => {

                 this.showModalDelete = false;

                 if (response.data.success) {
                   this.notification = {status : 'success', message : 'delete data success.'}
                   // load data
                   this.getData();
                 }else {
                   this.notification = {status : 'warning', message : 'delete data failed.'}
                 }

                   notification({
                     status: this.notification.status,
                     timeout: 3000,
                     close: false,
                     msg: this.notification.message
                   });
           });
         },
         reloadTable() {
            // this.getData();
            $(document).ready( function() {
                $('#getDataTable').DataTable();
            })
        },

        parseData(data){
          var formData = new FormData();
          for (const [index,item] in Object.keys(data)) {
            formData.append(Object.keys(data)[index], Object.values(data)[index]);
          }
          return formData;
        }
      }
    }
</script>
