<template>
<v-row class="white rounded-lg">
    <v-col cols="8">
    <v-col cols="12">
    Product Name : {{item.product_name}}
    </v-col>
    <v-col cols="12">
    Quantity : {{item.quantity}}
    </v-col>
    </v-col>
    <v-col cols="2" class="d-flex align-center">
          <v-btn color="red" @click="deleteItem(item.product_id)"><v-icon color="white"> mdi-delete  </v-icon></v-btn>
    </v-col>
</v-row>
</template>

<script>
import { mapMutations } from 'vuex';
export default{
    props:{
        item:{
            type: Object,
            required: true
        }
    },

    methods:{
        ...mapMutations('Order/Edit', {
           deleteItem: 'deleteItem',
        }),
    }
}
</script>