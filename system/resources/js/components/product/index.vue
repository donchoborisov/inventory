<template>
<div>
    <div class="row">
      <router-link to="/store-product" class="btn btn-primary">Add Product</router-link>
    </div>
     <br>
     <input type="text" class="form-control" style="width:300px;" v-model="searchTerm" placeholder="Search">
     
     <br>
    <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Product list</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Photo</th>
                        <th>Category</th>
                         <th>Buying Price</th>
                         <th>Selling Price</th>
                         <th>Root</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="product in filstersearch" :key="product.id">
                        <td>{{ product.product_name}}</td>
                        <td>{{ product.product_code}}</td>
                        
                        <td><img :src="product.image" id="em_photo"></td>
                        <td>{{ product.category_name}}</td>
                       <td>{{ product.buying_price}}</td>
                        <td>{{ product.selling_price}}</td>
                      <td>{{ product.root}}</td>
                        <td>
                            <router-link :to="{name:'edit-product', params:{id:product.id} }" class="btn btn-sm btn-primary">Edit</router-link>
                            <a @click="deleteProduct(product.id)" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                      </tr>
                  
                    
                  
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
</div>

</template>
<script type="text/javascript">
export default{
  created(){
    if(!User.loggedIn()){
      this.$router.push({name:'/'})
    }
  },
  data(){
      return{
          products:[],
          searchTerm:''
      }

  },
  computed:{

    filstersearch(){
      return this.products.filter(product =>{
        return product.product_name.match(this.searchTerm)
      })

    }
  },

  methods:{
      allProduct(){
          axios.get('/api/product/')
          .then(({data}) => (this.products = data))
          .catch()
      },
      deleteProduct(id){
          const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    axios.delete('/api/product/' + id )
    .then(()=>{
      this.products = this.products.filter(product => {
        return product.id != id
      })
    })
    .catch(()=>{
      this.$router.push({name:'product'})
    })

    swalWithBootstrapButtons.fire(
      'Deleted!',
      'Your data has been deleted.',
      'success'
    )
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})


      }
  },
  created(){
      this.allProduct();
  }
}



</script>
<style type="text/css">
#em_photo{
    height:40px;
    width:40px;
}

</style>