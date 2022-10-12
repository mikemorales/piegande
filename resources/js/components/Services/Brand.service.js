import {BaseService} from "./base.service";

class BrandService extends BaseService {

    constructor() {
        super('api/brand')
    }

}

export const brandService = new BrandService();
