<template>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card card position-relative">
          <div class="card-body">
            <div style="margin-bottom:10px">
              <h4 class="card-title">Categories child list</h4>
              <router-link class="btn btn-sm btn-primary bg-primary" to="/product-child-categories/store">
               <i class="mdi mdi-add"></i> Tambah Data
             </router-link>
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="getDataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Master code</th>
                    <th>code</th>
                    <th>name</th>
                    <th>Create</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="items in getdata" :key="items.id">
                    <td>{{ items.id }}</td>
                    <td>{{ items.category_master_code }}</td>
                    <td>{{ items.code }}</td>
                    <td>{{ items.name }}</td>
                    <td>{{ items.updated_at }}</td>
                    <td>
                      <div class="">
                        <button @click="modalUpdate(items)" class="btn btn-sm btn-warning btn-icon-text" title="edit data">
                          <i class="mdi mdi-pencil"></i>
                        </button>
                        <button @click="modalDelete(items)" class="btn btn-sm btn-danger btn-icon-text" title="delete data">
                          <i class="mdi mdi-delete-forever"></i>
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
        <!-- modal add address -->
          <modal-component modal_title="Update Child Categories" v-show="showModalUpdate" @close-modal="showModalUpdate = false" @modal-post="update">
            <div class="form-group">
              <label for="exampleInputName1">Master Category</label>
              <Select2 v-model="updatedata.category_master_code" :options="masterCategoriesdata" placeholder="select categories"/>
            </div>
            <div class="form-group">
              <label for="exampleInputName1">Code</label>
              <input type="text" class="form-control" v-model="updatedata.code">
            </div>
            <div class="form-group">
              <label for="exampleInputName1">Name</label>
              <input type="text" class="form-control" v-model="updatedata.name">
            </div>
          </modal-component>
          <!-- modal add address -->
          <!-- modal delete address -->
          <modal-component modal_title="Delete Categories" v-show="showModalDelete" @close-modal="showModalDelete = false" @modal-post="destroy">
            <div class="">
              <p>Are you sure to delete "{{ deletedata.name }}"? You cannot restore a deleted category.</p>
            </div>
          </modal-component>
          <!-- modal delete address -->
      </div>
  </div>
</template>

<script>
    import Select2 from 'v-select2-component';
    export default {
      components: {
        Select2
      },
      mounted() {
           console.log('product categories load');
      },
      data(){
        return {
          showModalUpdate : false,
          showModalDelete : false,
          masterCategoriesdata : [],
          notification: {},
          getdata : {},
          updatedata : {},
          deletedata : {},
        }
      },
      created() {
          this.getData();  //load data users

          this.mastercategory(); // get master category
      },
       methods: {
           mastercategory() {
             axios.get(location.origin + '/admin/product-categories')
             .then(response => {

               // regenerate data structur
                 const arrayObj = response.data.data.map(item => {
                     return {
                       id: item.code,
                       text: item.name
                     };
                   });

                 this.masterCategoriesdata = arrayObj;
             })
             .catch(errors => {
               console.log(errors);
             })
           },

          getData() {
            axios.get(location.origin + '/admin/product-child-categories')
            .then(response => {
                this.getdata = response.data.data;
                this.reloadTable();
            })
            .catch(errors => {
              console.log(errors);
                //Handle Errors
            })
         },
         modalUpdate(data){
           this.showModalUpdate = true;
           this.updatedata = data;
         },

         modalDelete(data){
           this.showModalDelete = true;
           this.deletedata = data;
         },

         update(){

           axios.post(location.origin + '/admin/product-child-categories/update', this.updatedata)
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
           axios.post(location.origin + '/admin/product-child-categories/destroy/' + this.deletedata.id, this.deletedata)
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
        }
      }
    }
</script>
