<template>
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">form Add Child Category</h4>
        <form class="forms-sample" @submit.prevent="store" id="formStore">
          <div class="form-group">
            <label for="exampleInputName1">Master Category</label>
            <Select2 v-model="storedata.category_master_code" :options="masterCategoriesdata" placeholder="select categories"/>
          </div>
          <div class="form-group">
            <label for="exampleInputName1">Code</label>
            <input type="text" class="form-control" placeholder="Input Unix Code" v-model="storedata.code">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail3">Name</label>
            <input type="text" class="form-control" placeholder="Name Promo" v-model="storedata.name">
          </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          <router-link to="/product-child-categories" class="btn btn-light">Cancel</router-link>
        </form>
      </div>
    </div>
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
           console.log('product categories add')
      },
      data(){
        return {
        storedata : {},
        notification : {},
        masterCategoriesdata : []
        }
      },
      created() {
        // get master category
        this.mastercategory();
      },
      methods: {
            mastercategory() {
              axios.get(location.origin + '/api/product-categories')
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

            store() {
                axios.post(location.origin + '/api/product-child-categories/store', this.storedata)
                    .then((response) => {
                      if (response.data.success) {

                        this.notification = {status : 'success', message : 'store data success.'}

                        this.$router.push({name: 'product-child-categoriesLoad'});

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
        }
    }
</script>
