import ProductService from '../../api/service';

function getState() {
	return {
        loader: false,
        products: [],
        pagesCount: undefined,
        columns: [
                { text: 'Product Name', align: 'center', sortable: true, value: 'product_name'},
                { text: 'Unit Price',    align: 'center',sortable: true, value: 'unit_price' },
                { text: 'Actions',  align: 'center', value: 'actions' },
        ],
    };
}
export default {
	namespaced: true,
	state: getState,
	getters: {
        getLoader(state){
            return state.loader;
        },
        getProducts(state){
            return state.products;
        },
        getColumns(state){
            return state.columns;
        },
        getPageCount(state){
            return state.pagesCount;
        }	
    },
	mutations: {
        setLoader(state, payloal){
            state.loader = payloal
        },
        setProducts(state, payloal){
            state.products = payloal.content.data;
            state.pagesCount = Math.ceil(payloal.content.total / payloal.content.per_page);
        },
        deleteProduct(state, id){
            let product = state.products.find(el=> {el.id == id});
            let index = state.products.indexOf(product);
            state.products.splice(index, 1);
        }
	},
	actions: {
        async getProducts({commit}, payloal){
            commit('setLoader', true);
            let page = {page:payloal};
            let res = await ProductService.getProducts(page).then(res=>{
                commit('setProducts', res);
            }).catch(err=>{
                console.warn(err);
            })
            .finally(()=>{
                commit('setLoader', false);
            });
        },

        deleteProduct({commit}, id){
            commit('setLoader', true);
            ProductService.deleteProduct(id).then(res=>{
                commit('deleteProduct', id);
            }).catch(err=>{
                console.warn(err);
            })
            .finally(()=>{
                commit('setLoader', false);
            });
        },
	},
};
