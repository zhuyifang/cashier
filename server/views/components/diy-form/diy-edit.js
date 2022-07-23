let {log, warn, error, table} = console;
var diyEdit = {
    data() {
        return {
            loading: false,
            allComponents: [],
            components: [],
            overrun: null,
            activeId: '',
        }
    },
    methods: {
        selectComponent(e) {
            if (this.overrun && !this.overrun.is_diy_module_overrun
                && this.components.length >= this.overrun.diy_module_overrun) {
                this.$message.error('最多添加' + this.overrun.diy_module_overrun + '个组件');
                return;
            }
            if (e.single) {
                for (let i in this.components) {
                    if (this.components[i].id === e.id) {
                        this.$message.error('该组件只允许添加一个。');
                        return;
                    }
                }
            }
            let currentIndex = this.components.length;
            for (let i in this.components) {
                if (this.components[i].active) {
                    currentIndex = parseInt(i) + 1;
                    break;
                }
            }
            const component = {
                id: e.id,
                data: null,
                active: false,
                key: randomString(),
                permission_key: e.key ? e.key : ''
            };

            this.components.splice(currentIndex, 0, component);
            this.$nextTick(function () {
                this.activeId = e.id;
                let document = this.$el.querySelector('#child').childNodes[currentIndex];
                this.showComponentEdit(component, currentIndex);
                this.$el.querySelector('#ggg').scrollTop = document.offsetTop - 200;
            });
        },
        showComponentEdit(component, index) {
            for (let i in this.components) {
                this.components[i].active = i == index;
            }
            this.activeId = component.id;
        },
        deleteComponent(index) {
            this.components.splice(index, 1);
        },
        copyComponent(index) {
            console.log(1111111);
            if (this.overrun && !this.overrun.is_diy_module_overrun
                && this.components.length >= this.overrun.diy_module_overrun) {
                this.$message.error('最多添加' + this.overrun.diy_module_overrun + '个组件');
                return;
            }
            for (let i in this.allComponents) {
                for (let j in this.allComponents[i].list) {
                    if (this.allComponents[i].list[j].id === this.components[index].id) {
                        if (this.allComponents[i].list[j].single) {
                            this.$message({message: '该组件只允许添加一个。', type: 'error', center: true});
                            return;
                        }
                    }
                }
            }
            let json = JSON.stringify(this.components[index]);
            let copy = JSON.parse(json);
            if(copy.data instanceof Object){
                copy.data.key = (new Date).getTime();
            }
            copy.active = false;
            copy.key = randomString();
            this.components.splice(index + 1, 0, copy);
        },
        moveUpComponent(index) {
            this.swapComponents(index, index - 1);
        },
        moveDownComponent(index) {
            this.swapComponents(index, index + 1);
        },
        swapComponents(index1, index2) {
            this.components[index2] = this.components.splice(index1, 1, this.components[index2])[0];
        },
    }
};

