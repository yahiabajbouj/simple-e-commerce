import ProductService from '../../api/service';

function getState() {
	return {
        product: {},
        suppliers: [],
    };
}
export default {
	namespaced: true,
	state: getState,
	getters: {
        getProduct(state){
            return state.product;
        },
        getSuppliers(state){
            return state.suppliers;
        }
	},
	mutations: {
        setProduct(state, payloal){
            let newData =  {supplier_id: payloal.content.supplier.id, product_name: payloal.content.product_name, unit_price:payloal.content.unit_price};
            state.product = newData;
        },       
        updateProduct(state, payloal){
            state.product[payloal.attr] = payloal.value;
        },
        resetStore(state){
            Object.assign(state, getState());
        },
        setSuppliers(state, suppliers){
            state.suppliers = suppliers;
        }
	},
	actions: {
        getProduct({commit}, id){
            ProductService.getProduct(id).then(res=>{
                commit('setProduct', res);
            })
        },
        updateProduct({state}, id){
            return ProductService.editProduct(id, state.product);
        },
        storeProduct({state}){
            return ProductService.storeProduct(state.product);
        }, 

        // Suppliers
        getSuppliers({commit}, id){
            ProductService.getSuppliers().then(res=>{
                commit('setSuppliers', res);
            })
        },

        resetStore({commit}){
            commit('resetStore');
        },
	},
};
