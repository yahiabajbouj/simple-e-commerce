import OrderService from '../../api/service';

function getState() {
	return {
        loader: false,
        orders: [],
        pagesCount: undefined,
        columns: [
                { text: 'Number', align: 'center', sortable: true, value: 'order_number'},
                { text: 'Customer', align: 'center', sortable: true, value: 'customer.first_name' },
                { text: 'Date', align: 'center', sortable: true, value: 'order_date' },
                { text: 'Total',  align: 'center', sortable: true, value: 'total_amount' },
                { text: 'Aate',  align: 'center', value: 'actions' },
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
        getOrders(state){
            return state.orders;
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
        setOrders(state, payloal){
            state.orders = payloal.content.data;
            state.pagesCount = Math.ceil(payloal.content.total / payloal.content.per_page);
        },
        deleteOrder(state, id){
            let order = state.orders.find(el=> {el.id == id});
            let index = state.orders.indexOf(order);
            state.orders.splice(index, 1);
        }
	},
	actions: {
        async getOrders({commit}, payloal){
            commit('setLoader', true);
            let page = {page:payloal};
            let res = await OrderService.getOrders(page).then(res=>{
                commit('setOrders', res);
            }).catch(err=>{
                console.warn(err);
            })
            .finally(()=>{
                commit('setLoader', false);
            });
        },

        deleteOrder({commit}, id){
            commit('setLoader', true);
            OrderService.deleteOrder(id).then(res=>{
                commit('deleteOrder', id);
            }).catch(err=>{
                console.warn(err);
            })
            .finally(()=>{
                commit('setLoader', false);
            });
        },
	},
};
