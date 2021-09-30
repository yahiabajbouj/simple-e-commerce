import * as ep from './endpoints';
import api from '../../../plagin/axios';


export default class OrderService {
	static getOrders(params) {
		return api
			.get(ep.ORDER, {
				params: params,
			})
			.then((res) => {
				return res.data;
			});
    }

	static getOrder(id) {
		return api.get(ep.ORDER_ID(id)).then((res) => {
				return res.data;
		});
    }
	
    static storeOrder(payloal) {
		return api.post(ep.ORDER, payloal);
	}

	static editOrder(id, payloal) {
		return api.put(ep.ORDER_ID(id), payloal);
	}

    static deleteOrder(id) {
		return api.delete(ep.ORDER_ID(id));
    }

	//Suppliers
	static getCustomers(){
		return api
		.get(ep.CUSTOMERS, {
			params: {
				paginate: false
			},
		})
		.then((res) => {
			return res.data.content;
		});
	}

	// Products
	static getProducts() {
		return api
			.get(ep.PRODUCT, {
				params: {
					paginate: 0
				},
			})
			.then((res) => {
				return res.data.content;
			});
    }	
}
