<template>
<div>
  <v-container class="h-100vh">
 <v-row class="h-100vh d-flex justify-center align-center"  elevation="20">
  <v-col cols="6" class="rounded-lg fill-height deep-purple lighten-5 pa-8">
  <h4>{{status}} Product</h4>
    <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >
     <v-text-field
      label="Product Name"
      :rules="[value => !!value || 'Required.']"
      :value="product.product_name"
      @input="updateProduct({ attr: 'product_name', value: $event })"    
      hide-details="auto"
    ></v-text-field>

     <v-text-field
      label="Unit Price"
      :rules="[value => !!value || 'Required.']"
      :value="product.unit_price"
      @input="updateProduct({ attr: 'unit_price', value: $event })"    
      hide-details="auto"
      type="number"
    ></v-text-field>
   
    <v-select
    :items="suppliers"
    label="Standard"
    item-value="id"
    item-text="company_name"
    :value="product.supplier_id"
    @input="updateProduct({ attr: 'supplier_id', value: $event })"
    :rules="[value => !!value || 'Required.']"
    ></v-select>

      <v-col class="d-flex justify-center">
        <v-btn color="blue" class="white--text" @click="submit">{{status}}</v-btn>
      </v-col>
 
    </v-form>
  </v-col>
 </v-row>
 </v-container>

</div>
</template>

<script>
import { mapGetters, mapMutations, mapActions } from 'vuex';
export default{
    props:{
        id:{
            default: undefined,
        }
    },
    data(){
        return{
            valid: true,
            status: null,
        };
    },
    methods:{
        ...mapMutations('Product/Edit', {
            updateProduct: 'updateProduct',
        }),
        ...mapActions('Product/Edit', {
            updateProductAction: 'updateProduct',
            storeProduct: 'storeProduct',
            getProduct: 'getProduct',
            resetStore: 'resetStore',
            getSuppliers: 'getSuppliers'
        }),
        submit(){
            if(this.$refs.form.validate()){
                if(this.id){
                    this.updateProductAction(this.id).then(res=>{
                        this.$router.push("/product")
                    }).catch(err=>{
                        console.warn(err)
                    });
                }else{
                    this.storeProduct().then(res=>{
                        this.$router.push("/product")
                    }).catch(err=>{
                        console.warn(err)
                    });
                }
            }
        },
    },
    computed:{
        ...mapGetters('Product/Edit', {
            product: 'getProduct',
            suppliers: 'getSuppliers'
        })
    },
    mounted(){
        this.getSuppliers();
        if(this.id){
            this.getProduct(this.id);
            this.status = 'Edit';
        }else{
            this.status = 'Add';
        }
    },
    destroyed(){
        this.resetStore();
    }
}
</script>

<style scoped>
.h-100vh {
  min-height: 90vh;
}
</style>