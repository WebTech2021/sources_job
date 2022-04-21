<template>
  <b-row>
    <b-col sm="12">
      <div class="card">
        <div class="card-header">
          <h3>Terms and Condition</h3>
        </div>
        <div class="card-body">
          <quill-editor
            v-model="settings.terms_condition"
            :options="snowOption"
            class="tos_editor"
            counter="500"
          />
        </div>
      </div>
    </b-col>
    <b-col sm="12">
      <div class="card">
        <div class="card-header">
          <h3>Blogger Dashboard Content</h3>
        </div>
        <div class="card-body">
          <quill-editor
            v-model="settings.blogger_dashboard"
            :options="snowOption"
            class="tos_editor"
            counter="500"
          />
        </div>
      </div>
    </b-col>
    <b-col sm="12">
      <div class="card">
        <div class="card-header">
          <h3>Apply for Ad Content</h3>
        </div>
        <div class="card-body">
          <quill-editor
            v-model="settings.apply_ad"
            :options="snowOption"
            class="tos_editor"
            counter="500"
          />
        </div>
      </div>
    </b-col>
    <div class="new-float">
      <button
        class="btn btn-primary my-float"
        @click.prevent="handleSubmit"
      >
        Submit
      </button>
    </div>
  </b-row>
</template>

<script>
import { BRow, BCol } from 'bootstrap-vue'
// eslint-disable-next-line
import 'quill/dist/quill.snow.css'
// eslint-disable-next-line
import 'quill/dist/quill.bubble.css'

import { quillEditor } from 'vue-quill-editor'

export default {
  name: 'Setting',
  components: {
    quillEditor, BRow, BCol,
  },
  data() {
    return {
      snowOption: {
        theme: 'snow',
      },
      settings: {
        terms_condition: '',
        blogger_dashboard: '',
        apply_ad: '',
      },
    }
  },
  created() {
    this.$store.dispatch('admin/settings')
      .then(() => {
        this.settings = this.$store.getters['admin/getSettingsData']
      })
  },
  methods: {
    handleSubmit() {
      this.$store.dispatch('admin/storeSettings', this.settings)
        .then(() => {
          this.$bvToast.toast('Updated Successfully', {
            title: 'Support and Guide',
            variant: 'success',
            solid: true,
          })
        })
    },
  },
}
</script>

<style scoped>

</style>
<style>

.new-float{
    position:fixed;
    width:60px;
    height:60px;
    bottom:40px;
    right:40px;
    color:#FFF;
    border-radius:50px;
    text-align:center;
    box-shadow: 2px 2px 3px #999;
}

.my-float{
    margin-top:22px;
}
</style>
