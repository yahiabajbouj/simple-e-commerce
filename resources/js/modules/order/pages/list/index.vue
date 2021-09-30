<template>
  <div>
  <v-container>
  <v-row>
  <v-col cols="6">
  <h4>Orders</h4>
  </v-col>
   <v-col cols="6" class="d-flex justify-end">
      <v-btn color="blue" to="/order/create"><v-icon color="white"> mdi-plus-circle-outline   </v-icon></v-btn>
  </v-col>
  </v-row>
  <v-row>
   <v-col>
   <v-data-table
      :headers="columns"
      :items="orders"
      :page.sync="page"
      :items-per-page="15"
      hide-default-footer
      class="elevation-1"
      :loading="loader"
    >
    <template v-slot:item.actions="{ item }">
      <v-btn class="mr-2" color="red" @click="deleteOrder(item.id)"><v-icon color="white"> mdi-delete  </v-icon></v-btn>
      <v-btn color="cyan" :to="'/order/edit/'+item.id"><v-icon color="white"> mdi-circle-edit-outline   </v-icon></v-btn>
    </template>
    </v-data-table>
    <div class="text-center pt-2">
      <v-pagination
        v-model="page"
        :length="pageCount"
      ></v-pagination>
    </div>
   </v-col>
    </v-row>
  </v-container>
   
  </div>
</template>
<script>
import { mapGetters, mapMutations, mapActions } from 'vuex';
export default{
    data(){
        return{
            page: 1,
        };
    },
    methods:{
      ...mapActions('Order/List', {
            getOrders: 'getOrders',
            deleteOrder: "deleteOrder"
        }),
    },
    computed:{
        ...mapGetters('Order/List', {
            columns: 'getColumns',
            loader: 'getLoader',
            orders: 'getOrders',
            pageCount: 'getPageCount'
        }),
    },
    mounted(){
      this.getOrders(this.page);
    },
    watch:{
      page(){
        this.getOrders(this.page);
      }
    }
}
</script>