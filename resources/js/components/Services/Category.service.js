import {BaseService} from "./base.service";

class CategoryService extends BaseService {

    constructor() {
        super('api/category')
    }

}

export const categoryService = new CategoryService();
