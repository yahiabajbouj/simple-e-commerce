import * as ep from './endpoints';
import api from '../../../plagin/axios';


export default class ProductService {
	static getProducts(params) {
		return api
			.get(ep.PRODUCT, {
				params: params,
			})
			.then((res) => {
				return res.data;
			});
    }

	static getProduct(id) {
		return api.get(ep.PRODUCT_ID(id)).then((res) => {
				return res.data;
		});
    }
	
    static storeProduct(payloal) {
		return api.post(ep.PRODUCT, payloal);
	}

	static editProduct(id, payloal) {
		return api.put(ep.PRODUCT_ID(id), payloal);
	}

    static deleteProduct(id) {
		return api.delete(ep.PRODUCT_ID(id));
    }

	//Suppliers
	static getSuppliers(){
		return api
		.get(ep.SUPPLIERS, {
			params: {
				paginate: false
			},
		})
		.then((res) => {
			return res.data.content;
		});
	}	
}
