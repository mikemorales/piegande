import axios from "axios";

export class BaseService {

    http = axios.create({
        timeout: 50000, headers: {
            'Content-Type': 'application/json;charset=UTF-8', 'X-Requested-With': 'XMLHttpRequest',
        },
        baseURL: 'http://piegrande.test/',
    });
    url;

    //NO SE USA EN MI PROYECTO
    constructor(endPoint) {
        this.url = `${endPoint}`;
    }

    getMany(params = {}) {
        //console.log(params);
        return this.http.get(`${this.url}`, {params}).then(response => response.data).catch(err => err.message);
    }

    getOne(id) {
        return this.http.get(`${this.url}/${id}`).then(response => response.data).catch(err => err.message);
    }

    saveOne(object, options = {}) {
        let config = {};
        let {
            isForm = false, onUploadProgress = (e) => {
            }
        } = options;
        if (isForm === true) {
            config = {
                headers: {'Content-Type': 'multipart/form-data'}, onUploadProgress
            }
        }
        return this.http.post(`${this.url}`, object, config).then(response => response.data).catch(err => err.message);
    }

    updateOne(id, object, options = {}) {
        let config = {};
        let {
            isForm = false,
            onUploadProgress = (e) => {
            }
        } = options;

        if (isForm === true) {
            object.append("_method", 'PATCH');
            config = {
                method: "POST", headers: {'Content-Type': 'multipart/form-data', 'enctype': 'multipart/form-data'}, onUploadProgress
            }
            return this.http({method: "post", url: `${this.url}/${id}`, data: object, headers: config.headers}).then(response => response.data).catch(err => err.message);
        } else {
            return this.http.patch(`${this.url}/${id}/`, object, config).then(response => response.data).catch(err => err.message);
        }

    }

    deleteOne(id) {
        return this.http.delete(`${this.url}/${id}`).then(response => response.data).catch(err => err.message);
    }

}
