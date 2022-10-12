import {BaseService} from "./base.service";

class ProductService extends BaseService {

    constructor() {
        super('api/product')
    }
    getByCategory(categoryId) {
        return this.http.get(`api/get-by-category/${categoryId}`).then(response => response.data).catch(err => err.message);
    }
}

export const productService = new ProductService();
