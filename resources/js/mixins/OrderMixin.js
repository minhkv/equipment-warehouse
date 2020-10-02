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
        },
        duplicate(order) {
            localStorage.guestName = order.guest_name;
            localStorage.department = order.department;
            localStorage.longTerm = order.long_term;
            localStorage.reason = order.reason;
            let selectedTemplates = order.order_request_infos.map(requestInfo => {
                return {
                    id: requestInfo.template.id,
                    name: requestInfo.template.name,
                    amount: requestInfo.amount,
                    maxAmount: requestInfo.template.equipments.length,
                    image: requestInfo.template.image
                };
            });
            localStorage.selectedTemplates = JSON.stringify(selectedTemplates);
            window.location.replace(this.orderCreateUrl);
        },
    }
}