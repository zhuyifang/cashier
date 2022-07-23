<el-form-item label="是否显示">
    <app-radio v-model="data.has_show" :label="1" turn>显示</app-radio>
    <app-radio v-model="data.has_show" :label="0" turn>隐藏</app-radio>
</el-form-item>