<el-form-item label="字段属性">
    <app-radio v-model="data.is_required" :label="1" turn>必填</app-radio>
    <app-radio v-model="data.is_required" :label="0" turn>不必填</app-radio>
</el-form-item>
<el-form-item label="是否显示">
    <app-radio v-model="data.has_show" :label="1" turn>显示</app-radio>
    <app-radio v-model="data.has_show" :label="0" turn>不显示</app-radio>
</el-form-item>
<el-form-item label="内容标题" required>
    <el-input v-model="data.title"
              size="small"
              placeholder="请输入内容标题"
              maxlength="21"
              show-word-limit
    ></el-input>
</el-form-item>