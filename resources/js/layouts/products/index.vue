<template>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card card position-relative">
          <div class="card-body">
            <div style="margin-bottom:10px">
              <h4 class="card-title">Product list</h4>
              <router-link class="btn btn-sm btn-primary bg-primary" to="/products/store">
               <i class="mdi mdi-add"></i> Tambah Data
             </router-link>
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Weight</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Popular</th>
                    <th>New</th>
                    <th>Discount</th>
                    <th>Create</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="items in getdata" :key="items.id">
                    <td>{{ items.id }}</td>
                    <td>{{ items.name }}</td>
                    <td>{{ items.category_child_name }}</td>
                    <td>{{ items.weight }}</td>
                    <td>{{ items.stock }}</td>
                    <td>{{ items.price }}</td>
                    <td>
                      <button v-if="items.is_popular == 1" @click="fastUpdate(items, 'is_popular', 0)" class="btn btn-sm btn-danger btn-icon-text" title="Set to not Popular">Yes</button>
                      <button v-else @click="fastUpdate(items, 'is_popular', 1)" class="btn btn-sm btn-primary btn-icon-text" title="Set to Popular">No</button>
                    </td>
                    <td>
                      <button v-if="items.is_new == 1" @click="fastUpdate(items, 'is_new', 0)" class="btn btn-sm btn-danger btn-icon-text" title="Set to not New">Yes</button>
                      <button v-else @click="fastUpdate(items, 'is_new', 1)" class="btn btn-sm btn-primary btn-icon-text" title="Set to New">No</button>
                    </td>
                    <td v-if="items.discount">{{ items.discount }}%</td><td v-else>{{ items.discount }}</td>
                    <td>{{ items.updated_at }}</td>
                    <td>
                      <div class="">
                        <router-link :to="{ name: 'productUpdate', params: { id: items.id }}" class="btn btn-sm btn-info btn-icon-text" title="more info">
                          <i class="mdi mdi-account-card-details"></i>
                        </router-link>
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
      <!-- modal delete -->
      <modal-component modal_title="Delete Product" v-show="showModalDelete" @close-modal="showModalDelete = false" @modal-post="destroy(deletedata.id)">
        <div class="">
          <p>Are you sure to delete "{{ deletedata.name }}"? You cannot restore a deleted Product.</p>
        </div>
      </modal-component>
      <!-- modal delete -->
  </div>
</template>

<script>
    export default {
      mounted() {
           console.log('product load');
      },
      data(){
        return {
          showModalDelete: false,
          notification: {},
          getdata : {},
          fastupdate : {},
          deletedata : {},
        }
      },
      created() {
          this.getData();  //load data users
      },
       methods: {
          getData() {
            axios.get(location.origin + '/admin/products', {
                // params: this.tableProps
            })
            .then(response => {
                this.getdata = response.data.data;
                this.reloadTable();
            })
            // eslint-disable-next-line
            .catch(errors => {
              console.log(errors);
                //Handle Errors
            })
         },

         openModal: function(id) {
         },

         modalDelete( items ){
           this.showModalDelete = true;
           this.deletedata = items;
         },

         destroy: function(id){
           axios.post(location.origin + '/admin/products/destroy/' + id, this.deletedata)
               .then(response => {
                 this.showModalDelete = false;

                 if (response.data.success) {
                   this.notification = {status : 'success', message : 'delete data success.'}
                   // load data
                   this.getData()
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

         fastUpdate(data, modelPurpose, value)
         {
           this.fastupdate = data;
           this.fastupdate.old_img = JSON.parse(data.img);
           this.fastupdate.sizes = JSON.parse(data.size);
           this.fastupdate.variants = JSON.parse(data.variant);
           if (modelPurpose == 'is_popular') {
             this.fastupdate.is_popular = value;
           }else if (modelPurpose == 'is_new') {
             this.fastupdate.is_new = value;
           }

           axios.post(location.origin + '/admin/products/update', this.fastupdate)
               .then((response) => {
                 if (response.data.success) {
                     this.notification = {status : 'success', message : 'update data success.'}

                     // redirect to list user page
                     this.getData();

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

         reloadTable() {
            $(document).ready( function() {
                $('#dataTable').DataTable({
                  "pageLength": 100
                });
            })
        }
      }
    }
</script>
