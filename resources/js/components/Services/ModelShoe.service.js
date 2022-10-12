import {BaseService} from "./base.service";

class ModelShoeService extends BaseService {

    constructor() {
        super('api/model-shoe')
    }

}

export const modelShoeService = new ModelShoeService();
