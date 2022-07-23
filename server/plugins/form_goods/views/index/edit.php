<?php
Yii::$app->loadViewComponent('diy-form/form-goods-edit');
?>

<div id="app" v-cloak="">
    <div class="app-edit">
        <form-goods-edit pos="plugin">
            <template slot="goods">
                <div></div>
            </template>
        </form-goods-edit>
    </div>
</div>
</div>
<script>
    const app = new Vue({
        el: '#app',
    });
</script>