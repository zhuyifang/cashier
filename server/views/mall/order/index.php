<?php
/**
 * @copyright ©2018 Lu Wei
 * @author Lu Wei
 * @link http://www.luweiss.com/
 * Created by IntelliJ IDEA
 * Date Time: 2018/11/29 15:59
 */
Yii::$app->loadViewComponent('app-order');
?>
<style>

</style>
<?php
$mchId = Yii::$app->user->identity->mch_id;
?>
<div id="app" v-cloak>
    <el-card shadow="never" style="border:0" body-style="background-color: #f3f3f3;padding: 10px 0 0;">
        <app-order :new-search="newSearch" :active-name="activeName" :is-goods-type="true" :is-show-profit="true" :is-show-order-plugin="mch_id == 0"></app-order>
    </el-card>
</div>

<script>
    new Vue({
        el: '#app',
        data() {
            return {
                mch_id: "<?= $mchId ?>",
                activeName: getQuery('status') === null ? '-1' : getQuery('status'),
                newSearch: {
                    time: null,
                    keyword: '',
                    keyword_1: '1',
                    date_start: '',
                    date_end: '',
                    platform: '',
                    status: '',
                    plugin: 'all',
                    send_type: -1,
                    type: '',
                    date_type: 'created_time',
                }
            };
        },
        created() {
            // 搜索条件从缓存中获取
            let search = localStorage.getItem('ORDER_SEARCH');
            if (search) {
                let newSearch = JSON.parse(search);
                Object.keys(this.newSearch).map((key) => {
                    if (newSearch[key]) {
                        this.newSearch[key] = newSearch[key]
                    }
                });
            }
        },
        methods: {
        }
    });
</script>