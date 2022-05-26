<template>
  <validation-observer ref="postForm">
    <b-row>
      <b-col cols="9">
        <div class="card">
          <div class="card-body">
            <b-row>
              <b-col cols="12">
                <b-form-group
                  id="title"
                  label="Title:"
                  label-for="title-input"
                >
                  <validation-provider
                    #default="{ errors }"
                    name="title"
                    vid="title"
                  >
                    <b-form-input
                      id="title-input"
                      v-model="post.title"
                      placeholder="Enter Title Here"
                      size="lg"
                      style="font-weight: bold; font-size: 20px"
                      required
                      type="text"
                    />
                    <small class="text-danger">{{ errors[0] }}</small>
                  </validation-provider>
                </b-form-group>

              </b-col>
              <b-col
                cols="12"
                class="mt-3"
              >
                <b-form-group
                  id="textarea"
                  label="Short Note:"
                  label-for="textarea-input"
                >
                  <validation-provider
                    #default="{ errors }"
                    name="short_note"
                    vid="short_note"
                  >
                    <b-form-textarea
                      id="textarea-input"
                      v-model="post.short_note"
                      placeholder="Enter a short description about this blog"
                      rows="3"
                      max-rows="6"
                    />
                    <small class="text-danger">{{ errors[0] }}</small>
                  </validation-provider>
                </b-form-group>

              </b-col>
              <b-col
                cols="12"
                class="mt-3"
              >
                <validation-provider
                  #default="{ errors }"
                  name="description"
                  vid="description"
                >
                  <quill-editor
                    v-model="post.description"
                    :options="snowOption"
                    counter="500"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-col>
            </b-row>
          </div>
        </div>
      </b-col>
      <b-col cols="3">
        <div
          v-if="applicationStatus==='approved'"
          class="card"
        >
          <div class="card-body">
            <h4>Accept Ad to this Post</h4>
            <hr>
            <validation-provider
              #default="{ errors }"
              name="accept_ad"
              vid="accept_ad"
              class="d-inline-flex"
            >
              don't show&nbsp;&nbsp;
              <b-form-checkbox
                v-model="post.accept_ad"
                checked="true"
                class="custom-control-primary"
                name="check-button"
                switch
              />
              &nbsp;&nbsp;show
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <h4>Publish</h4>
            <hr>
            <div class="">
              <button
                class="btn btn-outline-secondary"
                @click.prevent="draftPost"
              >
                Save Draft
              </button>
              <button
                class="btn btn-outline-primary"
                @click.prevent="previewPost"
              >
                Preview
              </button>
              <button
                class="btn btn-outline-success"
                @click.prevent="publishPost"
              >
                Publish
              </button>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <h4>Categories</h4>
            <hr>
            <validation-provider
              #default="{ errors }"
              name="category"
              vid="category_id"
            >
              <v-select
                v-model="post.category_id"
                :options="categories"
                label="name"
                :reduce="(option) => option.id"
                placeholder="Enter Category Name"
                @search="blogCategories"
              />
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider>
          </div>
        </div>
        <div class="card border rounded p-2">
          <h4 class="mb-1">
            Featured Image
          </h4>
          <b-media
            no-body
            vertical-align="center"
            class="flex-column"
          >
            <b-media-aside>
              <b-img
                ref="refPreviewEl"
                :src="post.image"
                height="200"
                width="320"
                class="rounded mr-2 mb-1 mb-md-0"
              />
            </b-media-aside>
            <b-media-body>
              <small class="text-muted">Required image resolution 800x400, image size 10mb.</small>
              <b-card-text class="my-50">
                <b-link id="blog-image-text">
                  <!--                C:\fakepath\{{ blogFile ? blogFile.name : 'banner.jpg' }}-->
                </b-link>
              </b-card-text>
              <div class="d-inline-block">
                <validation-provider
                  #default="{ errors }"
                  name="image"
                  vid="image"
                >
                  <b-form-file
                    ref="refInputEl"
                    v-model="post.image"
                    accept=".jpg, .jpeg, .png, .gif"
                    placeholder="Choose file"
                    @input="inputImageRenderer"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </div>
            </b-media-body>
          </b-media>
        </div>
        <div class="card">
          <div class="card-body">
            <h4>Tags</h4>
            <hr>
            <validation-provider
              #default="{ errors }"
              name="tags"
              vid="tags"
            >
              <v-select
                v-model="post.tags"
                :options="tags"
                label="name"
                :reduce="tags => tags.name"
                multiple=""
                placeholder="Enter Tags"
                :selectable="() => post.tags.length < 5"
                taggable
              />
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider>
          </div>
        </div>
      </b-col>

    </b-row>
  </validation-observer>
</template>
<script>

import {
  BRow,
  BCol,
  BFormInput,
  BMedia,
  BMediaAside,
  BImg,
  BMediaBody,
  BCardText,
  BFormFile,
  BLink,
  BFormTextarea,
  BFormGroup,
  BFormCheckbox,
} from 'bootstrap-vue'
// eslint-disable-next-line
import 'quill/dist/quill.snow.css'
import 'vue-select/dist/vue-select.css'
import { quillEditor } from 'vue-quill-editor'

import VSelect from 'vue-select'
import { useInputImageRenderer } from '@core/comp-functions/forms/form-utils'
import { ref } from '@vue/composition-api'
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import { axiosIns } from '@axios'

export default {
  name: 'Create',
  components: {
    BRow,
    BCol,
    BFormInput,
    quillEditor,
    VSelect,
    BMedia,
    BMediaAside,
    BImg,
    BMediaBody,
    BCardText,
    BFormFile,
    BLink,
    BFormTextarea,
    BFormGroup,
    ValidationObserver,
    ValidationProvider,
    BFormCheckbox,
  },
  setup() {
    const refInputEl = ref(null)
    const refPreviewEl = ref(null)

    const { inputImageRenderer } = useInputImageRenderer(refInputEl, base64 => {
      refPreviewEl.value.src = base64
    })

    return {
      refInputEl,
      refPreviewEl,
      inputImageRenderer,
    }
  },
  data() {
    return {
      snowOption: {
        theme: 'snow',
      },
      selected: [],
      categories: [],
      tags: [],
      post: {
        title: null,
        short_note: null,
        description: null,
        category_id: null,
        tags: [],
        image: null,
        published: 0,
        accept_ad: false,
      },
      applicationStatus: false,
    }
  },
  created() {
    axiosIns.get('api/v1/profile/checkAds')
      .then(response => {
        this.applicationStatus = response.data.status
      })
  },
  mounted() {
    // this.blogCategories()
    this.blogTags()
  },
  methods: {
    previewPost() {
      this.draftPost(true)
    },
    draftPost(redirect = false) {
      const cleaned = this.clean(this.post)
      const addAcceptence = this.post.accept_ad ? 1 : 0
      const formData = new FormData()
      if (cleaned.title) formData.append('title', this.post.title)
      if (cleaned.short_note) formData.append('short_note', this.post.short_note)
      if (cleaned.description) formData.append('description', this.post.description)
      if (cleaned.category_id) formData.append('category_id', this.post.category_id)
      if (cleaned.tags.length > 0) formData.append('tags[]', this.post.tags)
      if (cleaned.image) formData.append('image', this.post.image)
      if (cleaned.accept_ad) formData.append('accept_ad', addAcceptence)
      if (cleaned.published) formData.append('published', this.post.published)

      this.$refs.postForm.validate().then(success => {
        if (success) {
          this.$store.dispatch('user/post/StorePost', formData)
            .then(response => {
              if (redirect === true) {
                window.open(`${process.env.MIX_SOURCES_APP_URL}/preview/${response.slug}?isPreview=true`)
              }
              this.$router.push({ name: 'user.get-post', params: { id: response.id, slug: response.slug } })
            })
            .catch(error => {
              this.$refs.postForm.setErrors(error.response.data.errors)
            })
        }
      })
    },
    publishPost() {
      const addAcceptence = this.post.accept_ad ? 1 : 0
      const formData = new FormData()
      formData.append('title', this.post.title)
      formData.append('short_note', this.post.short_note)
      formData.append('description', this.post.description)
      formData.append('category_id', this.post.category_id)
      formData.append('tags[]', this.post.tags)
      formData.append('image', this.post.image)
      formData.append('accept_ad', addAcceptence)
      formData.append('published', 1)
      const cleaned = this.clean(formData)
      this.$refs.postForm.validate().then(success => {
        if (success) {
          this.$store.dispatch('user/post/StorePost', cleaned)
            .then(() => {
              this.$router.push({ name: 'user.posts' })
            }).catch(error => {
              this.$refs.postForm.setErrors(error.response.data.errors)
            })
        }
      })
    },
    clean(obj) {
      for (const propName in obj) {
        if (obj[propName] === null || obj[propName] === undefined || obj[propName] === []) {
          delete obj[propName]
        }
      }
      return obj
    },
    blogCategories(data) {
      this.$store.dispatch('user/post/getBlogCategories', { params: { key: data } })
        .then(() => {
          this.categories = this.$store.getters['user/post/getCategories']
        })
    },
    blogTags(data) {
      this.$store.dispatch('user/post/getAllTags', { params: { key: data } })
        .then(() => {
          this.tags = this.$store.getters['user/post/getTags']
        })
    },
  },
}
</script>

<style lang="scss">
//@import '~@core/scss/vue/libs/quill.scss';
</style>

<style>
.ql-editor {
    min-height: 500px !important;
    background-color: #fff;
}
</style>
