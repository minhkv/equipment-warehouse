export default {
    methods: {
        loadStorage(atts) {
            atts.forEach(att => {
                let value = this.getAtt(localStorage, att);
                if(value)
                    Vue.set(this.$data, att, value);
            });
        },
        storeStorage(atts) {
            atts.forEach(att => {
                let value = JSON.stringify(this.getAtt(this.$data, att));
                localStorage[att] = value;
            });
        },
        getAtt(item, att) {
            let value = '';
            let splitAtt = att.split('.');
            let parseStartCharacter = ['"', '[', '{'];
            if(splitAtt.length > 1) {
                return this.getNestedAtt(item, splitAtt);
            }
            if(item[att]) {
                if(typeof(item[att]) == 'string' && 
                parseStartCharacter.includes(item[att][0])) {
                    value = JSON.parse(item[att]);
                } else {
                    value = item[att];
                }
            }
            return value;
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