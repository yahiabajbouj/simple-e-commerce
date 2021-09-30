import OrderService from '../../api/service';

function getState() {
	return {
        order: {},
        customers: [],
        products: [],
        items: []
    };
}
export default {
	namespaced: true,
	state: getState,
	getters: {
        getOrder(state){
            return state.order;
        },
        getCustomers(state){
            return state.customers;
        }, 
        getProducts(state){
            return state.products;
        },
        getItems(state){
            return state.items;
        },
        sendData(state){
            return {
                ...state.order,
                items: state.items,
            };
        }
	},
	mutations: {
        setOrder(state, payloal){
            state.order = { order_date: payloal.content.order_date, order_number: payloal.content.order_number,  customer_id: payloal.content.customer_id };
            let products = payloal.content.products.map(el => {
                return{
                    product_name: el.product_name,
                    product_id: el.pivot.product_id,
                    quantity: el.pivot.quantity
                }
            });
            state.items = products;
        },       
        updateOrder(state, payloal){
            state.order[payloal.attr] = payloal.value;
        },
        resetStore(state){
            Object.assign(state, getState());
        },
        setCustomers(state, customers){
            state.customers = customers;
        },
        setProducts(state, products){
            state.products = products;
        },
        addItem(state, newItem){
            console.log(newItem);
            var product_name = state.products.find(it => it.id == newItem.product).product_name;
            var thisItem = undefined;
            let item = {
                product_name: product_name,
                product_id: newItem.product,
                quantity: newItem.quantity
            };
            thisItem = state.items.find(it => it.product_id == newItem.product);
            console.log(thisItem);
            if(!thisItem)
                state.items.push(item);
        },
        deleteItem(state, id){
            state.items = state.items.filter(it => it.product_id != id);
        }
	},
	actions: {
        getOrder({commit}, id){
            OrderService.getOrder(id).then(res=>{
                commit('setOrder', res);
            })
        },
        updateOrder({ getters }, id){
            return OrderService.editOrder(id, getters.sendData);
        },
        storeOrder({ getters }){
            return OrderService.storeOrder(getters.sendData);
        }, 

        // Customers
        getCustomers({commit}, id){
            OrderService.getCustomers().then(res=>{
                commit('setCustomers', res);
            })
        },
        getProducts({commit}){
            OrderService.getProducts().then(res=>{
                commit('setProducts', res);
            })
        },

        resetStore({commit}){
            commit('resetStore');
        },
	},
};
