import {BaseService} from "./base.service";

class SizeService extends BaseService {

    constructor() {
        super('api/size')
    }

}

export const sizeService = new SizeService();
