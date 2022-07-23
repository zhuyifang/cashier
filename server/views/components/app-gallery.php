<?php
/**
 * @copyright ©2018 Lu Wei
 * @author Lu Wei
 * @link http://www.luweiss.com/
 * Created by IntelliJ IDEA
 * Date Time: 2018/11/14 13:49
 */
?>
<style>
.app-gallery .app-gallery-list {
    -webkit-flex-wrap: wrap;
    flex-wrap: wrap;
}

.app-gallery .app-gallery-item {
    width: 100px;
    height: 100px;
    border: 1px solid #e3e3e3;
    border-radius: 6px;
    margin-right: 10px;
    margin-bottom: 10px;
    position: relative;
}

.app-gallery .app-gallery-delete {
    position: absolute;
    right: -8px;
    top: -8px;
    padding: 4px 4px;
}

.app-gallery .app-gallery-img {
    max-width: 100%;
    max-height: 100%;
}

</style>
<template id="app-gallery">
    <div class="app-gallery">
        <!--<el-button @click="test">test</el-button>-->

        <template>

        </template>
        <div class="app-gallery-list" flex>
            <template v-if="cursor === 'move'">
                <draggable v-model="list" :options="{preventOnFilter:false}"
                           style="width:100%;cursor: move;flex-wrap: wrap;display: flex"
                           flex="dir:left"
                           v-if="list && list.length" id="child">
                    <template v-for="(item, index) in defaultList">
                        <div style="component.active" class="app-gallery-item" flex="main:center cross:center"
                             :style="reversedStyle">
                            <el-button
                                    v-if="showDelete && item[urlKey ? urlKey : 'url'] != defaultImage && item[urlKey ? urlKey : 'url']"
                                    class="app-gallery-delete"
                                    size="mini" type="danger" icon="el-icon-close" circle
                                    @click="deleted(item, index)"></el-button>
                            <img class="app-gallery-img" :src="item[urlKey ? urlKey : 'url']">
                        </div>
                    </template>
                </draggable>
            </template>
            <template v-else>
                <template v-for="(item, index) in defaultList">
                    <div class="app-gallery-item" flex="main:center cross:center" :style="reversedStyle">
                        <el-button
                                v-if="showDelete && item[urlKey ? urlKey : 'url'] != defaultImage && item[urlKey ? urlKey : 'url']"
                                class="app-gallery-delete"
                                size="mini" type="danger" icon="el-icon-close" circle
                                @click="deleted(item, index)"></el-button>
                        <img class="app-gallery-img" :src="item[urlKey ? urlKey : 'url']">
                    </div>
                </template>
            </template>
        </div>
    </div>
</template>
<script>
    Vue.component('app-gallery', {
        template: '#app-gallery',
        props: {
            list: Array,
            urlKey: String,
            width: String,
            height: String,
            showDelete: Boolean,
            url: String,
            cursor: {
                type: String,
                default: 'auto'
            }
        },
        data() {
            return {
                defaultImage: 'statics/img/mall/default-pic.png'
            };
        },
        created() {
        },
        computed: {
            reversedStyle() {
            return (this.height ? `height: ${this.height}; ` : '') + (this.width ? `width: ${this.width}; ` : '');
        },
        defaultList() {
            if (typeof this.url != 'undefined') {
                return [{
                    url: this.url ? this.url : this.defaultImage
                }];
            } else {
                if(this.cursor === 'move'){
                    this.$emit('update:list', this.list);
                }
                return this.list;
            }
        }
    },
    methods: {
        test() {
            console.log(this);
        },
        deleted(item, index) {
            this.$emit('deleted', item, index);
        },
    },
});
</script>
