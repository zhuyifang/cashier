<template>
  <q-layout view="hHh lpR fFf">
    <div class="text-right fixed-top q-pa-sm" style="z-index:1001">
      <q-btn dense flat round icon="lens" size="8.5px" color="red"/>
      <q-btn dense flat round icon="lens" size="8.5px" color="yellow"/>
      <q-btn dense flat round icon="lens" size="8.5px" color="green"/>
    </div>

    <q-page-container>
      <q-splitter
        v-model="splitterModel"
        class="main-splitter"
        style="height: 100vh"
      >
        <template v-slot:before>
          <div class="text-center absolute-top text-positive q-py-md" style="z-index: 1">
            <q-icon size="32px" name="broadcast_on_home"/>
            <div>零售宝</div>
            <div class="text-grey-4" style="font-size: 26px">22:22</div>
            <div class="text-grey-4" style="font-size: 10px">11月12日 星期五</div>
            <q-separator color="grey-9 q-my-sm"/>
          </div>
          <q-tabs
            v-model="tab"
            vertical
            class="text-grey-3 bg-grey-10 text-center"
            style="padding-top: 131px"
            active-bg-color="white"
            active-color="blue"
            indicator-color="blue"
          >
            <q-route-tab icon="point_of_sale" label="收银台" to="/workbench" exact/>
            <q-route-tab icon="receipt" label="单据" to="/order" exact/>
            <q-route-tab icon="assignment_ind" label="会员" to="/member" exact/>
            <q-route-tab icon="local_shipping" label="入库" to="/inStork" exact/>
            <q-route-tab icon="delivery_dining" label="外卖" to="/takeout" exact/>
            <q-route-tab icon="restart_alt" label="交班" to="/exchange" exact/>
            <q-route-tab class="absolute-bottom" icon="settings" label="设置" to="/setting" exact/>
          </q-tabs>
        </template>
        <template v-slot:after>
          <router-view/>
        </template>
      </q-splitter>
    </q-page-container>
  </q-layout>
</template>

<script>
import {defineComponent, ref} from 'vue'


export default defineComponent({
  name: 'MainLayout',

  components: {},

  setup() {
    return {
      tab: ref('mails'),
      splitterModel: ref(20)
    }
  }
})
</script>
<style lang="scss" scoped>
.main-splitter {
  ::v-deep(.q-splitter__before) {
    width: 80px !important;
  }
}
</style>
