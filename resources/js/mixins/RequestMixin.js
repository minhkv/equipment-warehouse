export default {
    methods: {
        sendRequest(url, method, data, callback) {
            let app = this;
            axios({
                url: url,
                method: method,
                data: data
            })
            .then(function(res) {
                callback(res.data);
            })
            .catch(function(error) { 
                console.log(error);
            });
        },
        sendRequestWithFile(url, method, data, callback) {
            let app = this;
            axios({
                url: url,
                method: method,
                data: data,
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
            .then(function(res) {
                callback(res.data);
            })
            .catch(function(error) { 
                console.log(error);
            });
        }
    }
}