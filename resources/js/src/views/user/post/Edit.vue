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
              <b-col cols="12">
                <b-form-group
                  id="slug"
                  label="Slug:"
                  label-for="slug-input"
                >
                  <validation-provider
                    #default="{ errors }"
                    name="slug"
                    vid="slug"
                  >
                    <b-form-input
                      id="slug-input"
                      v-model="post.slug"
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
                class="custom-control-primary"
                name="check-button"
                switch
              />
              &nbsp;&nbsp;show
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider></div>
        </div>
        <div class="card">
          <div class="card-body">
            <h4>Publish</h4>
            <hr>
            <div class="d-flex justify-content-between">
              <button
                class="btn btn-outline-secondary"
                @click.prevent="draftPost()"
              >
                {{ post.published === 'Published' ? 'Save Draft' : 'Update Post' }}
              </button>
              <button
                class="btn btn-outline-primary"
                @click.prevent="previewPost"
              >
                Preview
              </button>
            </div>
            <div class="d-flex justify-content-between mt-2">
              <button
                class="btn btn-outline-danger"
                @click.prevent="TrashPost"
              >
                Delete Post
              </button>
              <button
                v-if="post.published !== 'Published'"
                class="btn btn-success"
                @click.prevent="publishPost"
              >
                Publish
              </button>
              <button
                v-else
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
                :reduce="categories => categories.id"
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
                    accept=".jpg, .png, .gif"
                    placeholder="Choose file"
                    @input="inputImageRenderer"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </div>
            </b-media-body>
          </b-media>
        </div>
        <!--        <div class="card">-->
        <!--          <div class="card-body">-->
        <!--            <h4>Tags</h4>-->
        <!--            <hr>-->
        <!--            <validation-provider-->
        <!--              #default="{ errors }"-->
        <!--              name="tags"-->
        <!--              vid="tags"-->
        <!--            >-->
        <!--              <v-select-->
        <!--                v-model="post.tags"-->
        <!--                :options="tags"-->
        <!--                label="name"-->
        <!--                :reduce="tags => tags.name"-->
        <!--                multiple=""-->
        <!--                placeholder="Enter Tags"-->
        <!--                :selectable="() => post.tags.length < 5"-->
        <!--                taggable-->
        <!--              />-->
        <!--              <small class="text-danger">{{ errors[0] }}</small>-->
        <!--            </validation-provider></div>-->
        <!--        </div>-->
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
  name: 'Edit',
  components: {
    BRow, BCol, BFormInput, quillEditor, VSelect, BMedia, BMediaAside, BImg, BMediaBody, BCardText, BFormFile, BLink, BFormTextarea, BFormGroup, ValidationObserver, ValidationProvider, BFormCheckbox,
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
    this.getBlog()
    this.blogCategories(this.post.category)
    this.blogTags()
    axiosIns.get('api/v1/profile/checkAds')
      .then(response => {
        this.applicationStatus = response.data.status
      })
  },
  methods: {
    getBlog() {
      this.$store.dispatch('user/post/getPost', this.$route.params.id)
        .then(() => {
          this.post = this.$store.getters['user/post/getPostDetails']
        })
    },
    draftPost(redirect = false) {
      const cleaned = this.clean(this.post)
      const addAcceptence = this.post.accept_ad ? 1 : 0
      const formData = new FormData()
      // formData.id = this.$route.params.id
      formData.append('_method', 'PUT')
      if (this.$route.params.id) formData.append('id', this.$route.params.id)
      if (cleaned.title) formData.append('title', this.post.title)
      if (cleaned.short_note) formData.append('short_note', this.post.short_note)
      if (cleaned.description) formData.append('description', this.post.description)
      if (cleaned.category_id) formData.append('category_id', this.post.category_id)
      if (cleaned.tags.length > 0) formData.append('tags[]', this.post.tags)
      if (cleaned.image) formData.append('image', this.post.image)
      if (cleaned.slug) formData.append('slug', this.post.slug)
      if (cleaned.accept_ad) formData.append('accept_ad', addAcceptence)
      if (cleaned.published) formData.append('published', 0)
      this.$refs.postForm.validate().then(success => {
        if (success) {
          this.$store.dispatch('user/post/updatePost', { id: this.$route.params.id, formData })
            .then(response => {
              if (redirect === true) {
                window.open(`${process.env.MIX_SOURCES_APP_URL}/preview/${response.slug}`)
              }
              this.$bvToast.toast('Saved to Draft', {
                title: 'Post Information',
                variant: 'info',
                solid: true,
              })
            }).catch(error => {
              this.$refs.postForm.setErrors(error.response.data.errors)
            })
        }
      })
    },
    publishPost() {
      const addAcceptence = this.post.accept_ad ? 1 : 0
      const cleaned = this.clean(this.post)
      const formData = new FormData()
      // formData.id = this.$route.params.id
      formData.append('_method', 'PUT')
      if (this.$route.params.id) formData.append('id', this.$route.params.id)
      if (cleaned.title) formData.append('title', this.post.title)
      if (cleaned.short_note) formData.append('short_note', this.post.short_note)
      if (cleaned.description) formData.append('description', this.post.description)
      if (cleaned.category_id) formData.append('category_id', this.post.category_id)
      if (cleaned.tags.length > 0) formData.append('tags[]', this.post.tags)
      if (cleaned.image) formData.append('image', this.post.image)
      if (cleaned.slug) formData.append('slug', this.post.slug)
      formData.append('accept_ad', addAcceptence)
      if (cleaned.published) formData.append('published', 1)
      this.$refs.postForm.validate().then(success => {
        if (success) {
          this.$store.dispatch('user/post/updatePost', { id: this.$route.params.id, formData })
            .then(() => {
              this.$router.push({ name: 'user.posts' })
            }).catch(error => {
              this.$refs.postForm.setErrors(error.response.data.errors)
            })
        }
      })
    },
    previewPost() {
      this.draftPost(true)
    },
    TrashPost() {
      this.$swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ml-1',
        },
        buttonsStyling: false,
      }).then(result => {
        if (result.value) {
          this.$store.dispatch('user/post/deletePost', this.$route.params.id)
            .then(() => {
              this.$router.push({ name: 'user.posts' })
            }).catch(error => {
              this.$refs.postForm.setErrors(error.response.data.errors)
            })
          this.$swal({
            icon: 'success',
            title: 'Deleted!',
            text: 'Your file has been deleted.',
            customClass: {
              confirmButton: 'btn btn-success',
            },
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
.ql-editor{
    min-height: 500px !important;
    background-color: #fff;
}
</style>
