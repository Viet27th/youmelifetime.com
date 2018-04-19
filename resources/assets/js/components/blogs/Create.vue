<template>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="title" class="font-weight-bold text-secondary h5">Title:</label>
                <input type="text" class="form-control" id="title" name="title" v-model="title"
                       placeholder="Enter title" autofocus>
            </div>
            <div><strong class="text-danger d-block" v-for="(error,index) in notification_error_blog_create" v-if="index === 0">{{error}}</strong></div>
            <div class="form-group d-none">
                <label for="slug" class="font-weight-bold text-secondary h5">Slug:</label>
                <input type="text" class="form-control" id="slug" name="slug" v-model="slug"
                       placeholder="Slug" readonly>
            </div>
            <!--section post info-->
            <div class="row">
                <div class="col-3">
                    <div class="card mb-3">
                        <div class="card-header font-weight-bold">
                            Publish
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <i class="fab fa-d-and-d text-info mr-1 align-middle"></i>
                                    <span class="font-weight-bold align-middle">Status:</span>
                                </div>
                                <div class="col-12">
                                    <select class="form-control form-control-sm" name="status" title=""
                                            v-model="status">
                                        <option v-for="(value,key) in status_list" :value="key">{{value}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <i class="fa fa-calendar text-info mr-1 align-middle"></i>
                                    <span class="font-weight-bold align-middle">Date:</span>
                                </div>
                                <div class="col-12">
                                    <div class="input-group input-group-sm mb-3">
                                        <vue-flatpickr v-model="option_date"
                                                       id="date-flatpickr"
                                                       class="form-control"
                                                       :config="config"
                                                       name="option_date">Dieu
                                        </vue-flatpickr>
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <button type="button" class="btn btn-primary float-right btn-sm w-100" @click="submitBlogData">Publish</button>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card mb-3">
                        <div class="card-header font-weight-bold">
                            Category
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled" style="max-height: 195px; overflow: scroll">
                                <li v-for="value in categories_list">
                                    <input class="cursor-pointer" type="checkbox" name="categories[]" title=""
                                           v-model="categories" :value="value.id">
                                    <span class="font-weight-bold ml-2">{{value.term}}</span>
                                </li>
                            </ul>
                            <p class="text-primary font-weight-bold mb-2 cursor-pointer">+Add new Category</p>
                            <div>
                                <div class="d-flex align-items-center">
                                    <input class="form-control form-control-sm" type="text"
                                           placeholder="Enter Category"
                                           v-model="input_create_new_category"
                                           @keyup.enter="addNewCategory">
                                    <i class="fa fa-plus-circle ml-2 align-middle text-primary cursor-pointer"
                                       style="font-size: 20px;" @click="addNewCategory"></i>
                                </div>
                                <small class="text-danger" v-for="value in notification_error_cate_create">{{value}}
                                </small>
                                <div class="form-group mt-2">
                                    <label for="cate-parent">Category parent:</label>
                                    <select class="form-control form-control-sm" id="cate-parent"
                                            v-model="select_category_parent">
                                        <option value="" selected>--None--</option>
                                        <option v-for="value in categories_list" :value="value.id">
                                            {{value.term}}
                                        </option>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-outline-secondary btn-sm mt-2"
                                        @click="addNewCategory">Add new Category
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card mb-3">
                        <div class="card-header font-weight-bold">
                            Tag
                        </div>
                        <div class="card-body">
                        <span v-for="(value,key) in tags" class="badge badge-pill badge-dark cursor-pointer mr-2"
                              @click="removeTag(key)">
                            {{value}}
                            <i class="fa fa-times ml-1" style="font-size: 10px;"></i>
                        </span>
                            <select class="d-none" name="tags[]" multiple title="">
                                <option v-for="tag in tags" :value="tag" selected>{{tag}}</option>
                            </select>
                            <div class="d-flex align-items-center mt-2">
                                <input id="inputTags" class="form-control form-control-sm" type="text" placeholder=""
                                       v-model.trim="input_create_new_tags"
                                       v-on:keydown.enter.prevent="appendTags">
                                <button type="button" class="btn btn-outline-secondary btn-sm ml-2"
                                        v-on:click="appendTags">
                                    Add
                                </button>
                            </div>
                            <small>Separate tags with commas</small>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card mb-3">
                        <div class="card-header font-weight-bold">
                            Featured Image
                        </div>
                        <div class="card-body">
                            <div>
                                <img v-if="dpFeatureImage" :src="feature_image" alt="" title=""
                                     class="img-thumbnail">
                                <input type="text" class="d-none" title="" name="feature_image" :value="feature_image">
                                <input type="text" class="d-none" title="" name="feature_image_id" :value="feature_image_id">
                                <input type="text" class="d-none" title="" name="feature_image_alt"
                                       :value="feature_image_alt">
                                <input type="text" class="d-none" title="" name="feature_image_title"
                                       :value="feature_image_title">
                            </div>
                            <span v-if="dpTextSetFeature" class="text-primary font-weight-bold mb-0 cursor-pointer"
                                  @click="setFeatureImg">+Set featured image</span>
                            <span v-if="dpTextDeleteFeature"
                                  class="text-primary font-weight-bold mb-0 cursor-pointer text-danger"
                                  @click="deleteFeature">+Delete featured image</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--end post info-->
            <div class="mt-4 mb-4">
                <button type="button" class="btn btn-primary" style="font-size: 17px;" @click="callTemplateMedia">
                    <i class="fa fa-picture-o mr-2"></i>Media
                </button>
            </div>
            <div v-show="displayMedia === true" id="wrap-media" @click="closeTemplateMedia">
                <!-- use @click.stop="" to stop propagation click event to parent element-->
                <div style="width: 80vw; height: 95vh; background-color: #fff; padding: 9px; border-radius: 4px; box-shadow: 6px 7px 5px rgba(0,0,0,.4); overflow: hidden"
                     @click.stop="">
                    <div class="clearfix">
                        <i class="fa fa-times float-right pl-2 pt-2 pb-2 pr-0 cursor-point" style="font-size: 20px;"
                           @click="closeTemplateMedia"></i>
                    </div>
                    <div id="media"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="content" class="font-weight-bold text-secondary h5">Content:</label>
                <editor-content id="content" name="content" api-key='97wox5dvs8m4p65eizkud76wbmqujy54w9v0iiigx0ffirxe'
                                v-model="content" :init="init">Dieu
                </editor-content>
            </div>

            <div class="form-group">
                <label for="description" class="font-weight-bold text-secondary h5">Description:</label>
                <textarea id="description" class="form-control" rows="3" name="description"
                          v-model="description">
                    Dieu
                </textarea>
            </div>
        </div>
    </div>
</template>

<script>
  import Editor from '@tinymce/tinymce-vue'
  import VueFlatpickr from 'vue-flatpickr-component'
  import 'flatpickr/dist/flatpickr.css'
  import * as axios from 'axios'
  import dp from '../../custom_methods'
  import { taxonomyRoute,blogRoute } from '../../router-map'
  //use Bus vuejs
  import { EventBus } from '../../event-bus.js'

  export default {
    name: 'create',
    components: {
      'EditorContent': Editor,
      'EditorDescription': Editor,
      'VueFlatpickr': VueFlatpickr,
    },
    data () {
      return {
        domain: document.location.origin,
        //======config initialized tinymce
        init: {
          height: 500,
          //https://stackoverflow.com/questions/3796942/get-tinymce-to-use-full-image-url-instead-of-relative-one
          //three attribute to Tinymce can't auto fix (cut) url of image when insert to Database
          relative_urls : false,
          remove_script_host : false,
          convert_urls : true,
        },
        //======configuration Flatpickr
        option_date: null,
        config: {
          wrap: true, // set wrap to true only when using 'input-group'
          altFormat: 'M	j, Y',
          altInput: true,
          dateFormat: 'Y-m-d',
          minDate: 'today'
        },
        //======= set variable for this blog
        title: '',
        slug: '',
        content: '',
        description: '',
        status_list: {
          publish: 'Publish',
          pending_review: 'Pending Review',
          draft: 'Draft'
        },
        status: 'publish',
        categories_list: [
          //array obj {id: 1, term: 'category 1'}
        ],
        categories: [
          // '1','2'
        ],
        tags: [
          // 'tag a'
        ],
        feature_image: '',
        feature_image_id: '',
        feature_image_alt: '',
        feature_image_title: '',

        select_category_parent: '', //create a new category
        input_create_new_category: '', //create a new category
        notification_error_cate_create: [],//create a new category
        input_create_new_tags: '', //append new tags
        notification_error_blog_create: [],
        //=======variable for display
        displayMedia: false,
        dpTextSetFeature: true,
        dpTextDeleteFeature: false,
        dpFeatureImage: false,
      }
    },
    watch: {
      title: function () {
        this.slug = dp.toSlug(this.title)
      },

    },
    mounted: function () {
      this.$nextTick(function () {
        //=========== add event keydown Esc to close Media
        document.addEventListener('keydown', (event) => {
          if (event.keyCode === 27 || event.key === 'Escape') {
            this.closeTemplateMedia()
          }
        })
        //=========== receiver event from component Media.vue use Bus
        EventBus.$on('insert-img-to-content', () => {
          this.closeTemplateMedia()
        })
        //=========It is exactly action insert feature image
        EventBus.$on('insert-feature-image', (arrFileIsSelected) => {
          // If press and hold Shift to select file ->arrFileIsSelected is array objects, only get first object in array.
          this.feature_image = this.domain + '/storage/' + arrFileIsSelected[0].path
          this.feature_image_id = arrFileIsSelected[0].id
          this.feature_image_alt = arrFileIsSelected[0].alt
          this.feature_image_title = arrFileIsSelected[0].title
          this.dpFeatureImage = true
          this.dpTextSetFeature = false
          this.dpTextDeleteFeature = true
          this.closeTemplateMedia()
        })
        //=========
        this.getCateList()
      })
    },
    methods: {
      //=========
      callTemplateMedia: function () {
        this.displayMedia = true
        //when button Media is clicked, media.vue is show, image always refresh
        let Media = Vue.extend(require('../media/Media'))
        let componentMedia = new Media({
          data: {
            height_for_wrap: 'max-height: 350px;',
            displayBtnInsertContent: true
          }
        }).$mount()
        document.getElementById('media').appendChild(componentMedia.$el)
      },
      //=========
      closeTemplateMedia: function () {
        this.displayMedia = false
        let mediaNodeDom = document.getElementById('media')
        while (mediaNodeDom.firstChild) {
          mediaNodeDom.removeChild(mediaNodeDom.firstChild)
        }
        //use loop while above or document.getElementById('media').innerHTML = '' to remove all Node within "media Node"
      },
      //=========
      addNewCategory: function () {
        if (this.input_create_new_category) {
          axios({
            method: 'post',
            url: taxonomyRoute.admin_taxonomy_store,
            data: {
              taxonomy: 'category',
              term: this.input_create_new_category.trim(),
              slug: dp.toSlug(this.input_create_new_category),
              parent_id: this.select_category_parent
            }
          })
            .then(responsive => {
              if (responsive.data['error']) {
                this.notification_error_cate_create = responsive.data['error']
              }
              else {
                this.input_create_new_category = ''
                this.select_category_parent = ''
                this.notification_error_cate_create = ''
                this.getCateList()
              }
            })
            .catch(error => {})
        }
      },
      //=========
      getCateList: function () {
        axios({
          method: 'get',
          url: taxonomyRoute.admin_taxonomy_get_categories_list
        })
          .then(responsive => {
            this.categories_list = responsive.data
          })
          .catch(error => {
            console.log(error)
          })
      },
      //=========It only call template Media.vue, insert image execute within mounted method above
      setFeatureImg: function () {
        this.displayMedia = true
        //when button Media is clicked, media.vue is show, image always refresh
        let Media = Vue.extend(require('../media/Media'))
        let componentMedia = new Media({
          data: {
            height_for_wrap: 'max-height: 350px;',
            displayBtnInsertFeatureImg: true
          }
        }).$mount()
        document.getElementById('media').appendChild(componentMedia.$el)
      },
      //=========
      deleteFeature: function () {
        this.feature_image = ''
        this.feature_image_id = ''
        this.feature_image_alt = ''
        this.feature_image_title = ''
        this.dpFeatureImage = false
        this.dpTextSetFeature = true
        this.dpTextDeleteFeature = false
      },
      //=========
      removeTag: function (key) {
        this.tags.splice(key, 1)
      },
      //=========
      appendTags: function () {
        if (this.input_create_new_tags) {
          let provisional = this.input_create_new_tags.split(',')
          provisional.forEach((tag) => {
            this.tags.push(tag.trim())
          })
          this.tags = _.uniqWith(this.tags, _.isEqual) //remove object is duplicate
          this.input_create_new_tags = ''
        }
      },
      //=========
      submitBlogData: function () {
        axios({
          method: 'post',
          url: blogRoute.admin_blog_store,
          data: {
            title: this.title,
            slug: this.slug,
            content: this.content,
            description: this.description,
            option_date: this.option_date,
            status: this.status,
            categories: this.categories,
            tags: this.tags,
            feature_image: this.feature_image,
            feature_image_id: this.feature_image_id,
            feature_image_alt: this.feature_image_alt,
            feature_image_title: this.feature_image_title,
          }
        })
          .then(responsive => {
            if(responsive.data.error){
              this.notification_error_blog_create = responsive.data.error;
              window.notification({
                data: {
                  message: responsive.data.error,
                  dpBtnOk: true
                }
              })
            }
            else {
              //controller return post id => responsive.data is a id
              this.notification_error_blog_create = [];
              window.location = blogRoute.admin_blog_edit + responsive.data
            }
          })
          .catch(error => {
            console.log(error)
          })
      }
    },
  }
</script>

<style scoped>
    #wrap-media {
        position: fixed;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        z-index: 1000;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        animation: xoay 0.9s;
    }

    @keyframes xoay {
        0% {
            transform: scale(0, 0)
        }
        100% {
            transform: scale(1, 1)
        }
    }
</style>