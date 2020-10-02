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
    }
}