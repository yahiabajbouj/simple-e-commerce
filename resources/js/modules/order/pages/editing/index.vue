<template>
<div>
  <v-container class="h-100vh">
 <v-row class="h-100vh d-flex justify-center align-center"  elevation="20">
  <v-col cols="10" class="rounded-lg fill-height deep-purple lighten-5 pa-8">
  <v-row>
    <v-col cols="7">
    <h4>{{status}} Order</h4>
    <v-form
    ref="order"
    v-model="valid"
    lazy-validation
  >
    <v-select
    :items="customers"
    label="Customer Name"
    item-value="id"
    item-text="first_name"
    :value="order.customer_id"
    @input="updateOrder({ attr: 'customer_id', value: $event })"
    :rules="[value => !!value || 'Required.']"
    ></v-select>

     <v-text-field
      label="Order Number"
      :rules="[value => !!value || 'Required.']"
      :value="order.order_number"
      @input="updateOrder({ attr: 'order_number', value: $event })"    
      hide-details="auto"
      type="number"
      class="mb-7"
    ></v-text-field>
    
     
      <v-menu
      ref="menu"
      v-model="menu"
      :close-on-content-click="false"
      transition="scale-transition"
      offset-y
      min-width="auto"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-text-field
          v-model="order.order_date"
          label="Order Date"
          prepend-icon="mdi-calendar"
          readonly
          v-bind="attrs"
          v-on="on"
          :rules="[value => !!value || 'Required.']"
        ></v-text-field>
      </template>
      <v-date-picker
        :active-picker.sync="activePicker"
        :value="order.order_date"
        @input="updateOrder({ attr: 'order_date', value: $event })"  
        :rules="[value => !!value || 'Required.']"
        @change="save"
     
      ></v-date-picker>
    </v-menu>

      <v-col class="d-flex justify-center">
        <v-btn color="blue" class="white--text" @click="submit">{{status}}</v-btn>
      </v-col>
 
    </v-form>
    </v-col>

    <v-col cols="4">
    <h5> Items </h5>
    <v-form
        ref="Items"
        v-model="valid"
        lazy-validation
        class="mb-4"
    >

    <v-select
        :items="products"
        label="Products Name"
        v-model="item.product"
        item-value="id"
        item-text="product_name"
        :rules="[value => !!value || 'Required.']"
    ></v-select>
    <v-text-field
      type="number"
      label="Quantity"
      hide-details="auto"
      v-model="item.quantity"
      :rules="[value => !!value || 'Required.']"
    ></v-text-field>
    <p v-show="itemErore" class="red--text"> you should add onr item less </p> 
    <v-col class="d-flex justify-center">
        <v-btn color="cyan" class="white--text" @click="storeItems">add</v-btn>
    </v-col>
    </v-form>
    <item-card v-for="item in items" :key="item.product_id" :item="item"/>
    </v-col>
  </v-row>

  </v-col>
  
 </v-row>
 </v-container>

</div>
</template>

<script>
import { mapGetters, mapMutations, mapActions } from 'vuex';
import itemCard from '../../components/itemCard.vue';
export default{
    props:{
        id:{
            default: undefined,
        }
    },
    components:{
        itemCard
    },
    data(){
        return{
            activePicker: null,
            valid: true,
            status: null,
            menu: false,
            item: {},
            itemErore: false,
        };
    },
    methods:{
        ...mapMutations('Order/Edit', {
            updateOrder: 'updateOrder',
            addItem: 'addItem',

        }),
        ...mapActions('Order/Edit', {
            updateOrderAction: 'updateOrder',
            storeOrder: 'storeOrder',
            getOrder: 'getOrder',
            resetStore: 'resetStore',
            getCustomers: 'getCustomers',
            getProducts: 'getProducts',
            deleteItem: 'deleteItem',
        }),
        submit(){
            if(this.$refs.order.validate()){
                if(this.items.length == 0){
                    this.itemErore = true;
                    return ;
                }
                if(this.id){
                    this.updateOrderAction(this.id).then(res=>{
                        this.$router.push("/order")
                    }).catch(err=>{
                        console.log(err)
                    });
                }else{
                    this.storeOrder().then(res=>{
                        this.$router.push("/order")
                    }).catch(err=>{
                        console.log(err)
                    });
                }
            }
        },

        storeItems(){
            if(this.$refs.Items.validate()){
                this.addItem(this.item);
                // this.item = {};
            }
        },
        save (date) {
            this.$refs.menu.save(date)
        },
    },
    computed:{
        ...mapGetters('Order/Edit', {
            order: 'getOrder',
            customers: 'getCustomers',
            products: "getProducts",
            items: "getItems"
        })
    },
    mounted(){
        this.getCustomers();
        this.getProducts();
        if(this.id){
            this.getOrder(this.id);
            this.status = 'Edit';
        }else{
            this.status = 'Add';
        }
    },
    watch: {
      menu (val) {
        val && setTimeout(() => (this.order.order_date = 'YEAR'))
      },
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