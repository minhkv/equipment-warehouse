export default {
    methods: {
        loadStorage(atts) {
            atts.forEach(att => {
                let value = JSON.parse(this.getAtt(localStorage, att));
                if(value)
                    this.$data[att] = value;
            });
        },
        storeStorage(atts) {
            atts.forEach(att => {
                let value = JSON.stringify(this.getAtt(this.$data, att));
                localStorage[att] = value;
            });
        },
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