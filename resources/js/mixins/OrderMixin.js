export default {
    methods: {
        getTotalLostAmount(order) {
            let total = 0;
            order.order_request_infos.forEach(requestInfo => {
                requestInfo.order_infos.forEach(orderInfo => {
                    if(orderInfo.status == 0) {
                        total ++;
                    }
                });
            });
            return total;
        },
        getTotalErrorAmount(order) {
            let total = 0;
            order.order_request_infos.forEach(requestInfo => {
                requestInfo.order_infos.forEach(orderInfo => {
                    if(orderInfo.condition_received == 0) {
                        total ++;
                    }
                });
            });
            return total;
        },
        checkOrderError(order) {
            return this.getTotalErrorAmount(order) + this.getTotalLostAmount(order) > 0;
        }
    }
}