export default {
    methods: {
        getAtt(item, att) {
            let splitAtt = att.split('.');
            if(splitAtt.length > 1) {
                return this.getNestedAtt(item, splitAtt);
            }
            return item[att];
        },
        getNestedAtt(item, atts) {
            let value, i = 0;
            atts.forEach(att => {
                if(i == 0) {
                    value = item[att];
                } else {
                    value = value[att];
                }
                i++;
            });
            return value;
        },
    }
}