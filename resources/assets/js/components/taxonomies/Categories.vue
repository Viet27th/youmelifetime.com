<template>
    <div>
        <div class="row mt-4">
            <div class="col-4">
                <p class="text-danger" v-for="error in notification_error_cate_create">{{error}}</p>
                <div class="form-group">
                    <label for="term" class="h5 font-weight-bold">Tên danh mục:</label>
                    <input type="text" class="form-control" id="term" placeholder="Category name"
                           v-model="term">
                    <i class="text-secondary">The name is how it appears on your site.</i>
                </div>
                <div class="form-group">
                    <label for="slug" class="h5 font-weight-bold">Slug</label>
                    <input type="text" class="form-control" id="slug" placeholder="Slug"
                           v-model="slug">
                    <i class="text-secondary">The “slug” is the URL-friendly version of the name. It is usually all
                        lowercase and contains only letters, numbers, and hyphens.</i>
                </div>
                <div class="form-group">
                    <label for="cate-parent" class="h5 font-weight-bold">Parent Category</label>
                    <select class="form-control" id="cate-parent" v-model="parent_id">
                        <option value="" selected disabled>==Select Parent==</option>
                        <option value="">None</option>
                        <option v-for="(cate,index) in categories_list" v-if="index !== 0" :value="cate.id">{{cate.term}}</option>
                    </select>
                    <i class="text-secondary">Categories, unlike tags, can have a hierarchy. You might have a Jazz
                        category, and under that have children categories for Bebop and Big Band. Totally optional.</i>
                </div>
                <div class="form-group">
                    <label for="cate-description" class="h5 font-weight-bold">Description</label>
                    <textarea class="form-control" id="cate-description" rows="3" v-model="description"></textarea>
                    <i class="text-secondary">The description is not prominent by default; however, some themes may show
                        it.</i>
                </div>
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
                <div class="mt-3">
                    <button v-if="dpBtnAddCategory" class="btn btn-primary" @click="taxonomyStore">Add New Category</button>
                    <div v-if="dpBtnUpdateCategory">
                        <button class="btn btn-primary" @click="taxonomyUpdate">Update</button>
                        <button class="btn btn-danger" @click="taxonomyCancelUpdate">Cancel</button>
                    </div>
                </div>
            </div>

            <div class="col-8">
                <div class="form-row mb-4">
                    <select class="custom-select custom-select-sm col-2 mr-2" v-model="bulkAction">
                        <option selected value="">Bulk Action</option>
                        <option value="delete">Delete</option>
                    </select>
                    <button class="btn btn-primary btn-sm mr-5" type="button" @click="bulkActionFunc">Apply</button>
                </div>

                <table class="table">
                    <thead>
                    <tr class="tbl-row">
                        <th class="">
                            <label class="checkbox mb-0">
                                <input id="" type="checkbox" class="" v-model="cBox_cmd" @click="commandCheckBox">
                            </label>
                        </th>
                        <th class="tbl-col-name">Name</th>
                        <th class="tbl-col-description">Description</th>
                        <th>Slug</th>
                        <th class="text-center">Count</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="tbl-row" v-for="(cateInfo,index) in categories_list">
                        <td class="">
                            <label class="checkbox" v-if="index !== 0">
                                <input type="checkbox" name="tax_check[]" :value="cateInfo.id" class=""
                                       v-model="cBox_affected">
                            </label>
                        </td>
                        <td class="tbl-col-name">
                            <p class="mb-1 tbl-col-name--text" v-if="index !== 0">
                                <a href="" class="text-info" @click.prevent="taxonomyEdit(cateInfo.id)">{{cateInfo.term}}</a>
                            </p>
                            <p class="mb-1 tbl-col-name--text" v-else>
                                <a href="" class="text-info" @click.prevent="">{{cateInfo.term}}</a>
                            </p>

                            <ul class="tbl-col-action list-unstyled mb-0" v-if="index !== 0">
                                <li class="d-inline mr-3"><a href="" rel="nofollow"
                                                             @click.prevent="taxonomyEdit(cateInfo.id)">Chỉnh sửa</a>
                                </li>
                                <li class="d-inline mr-3">
                                    <a href="" rel="nofollow" class="text-danger" @click.prevent="taxonomyDelete([cateInfo.id])">Xóa</a>
                                </li>
                            </ul>
                        </td>
                        <td class="tbl-col-description">{{cateInfo.description}}</td>
                        <td class="tbl-col-slug has-text-info has-text-weight-semibold">{{cateInfo.slug}}</td>
                        <td class="text-center">
                            <span class="badge badge-danger">{{cateInfo.blogs_count}}</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!---->
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
    </div>
</template>

<script>
  import myMethods from '../../custom_methods'
  import { taxonomyRoute } from '../../router-map'
  import { EventBus } from '../../event-bus'
  import * as axios from 'axios'

  export default {
    name: 'categories',
    data () {
      return {
        domain: document.location.origin,
        //  Information of taxonomy.
        taxonomy: 'category',
        term: '',
        slug: '',
        parent_id: '',
        description: '',
        feature_image: '',
        feature_image_alt: '',
        feature_image_title: '',
        feature_image_id: '',
        //
        cBox_cmd: false,
        cBox_affected: [],

        //=======variable for display
        displayMedia: false,
        dpTextSetFeature: true,
        dpTextDeleteFeature: false,
        dpFeatureImage: false,
        dpBtnAddCategory: true,
        dpBtnUpdateCategory: false,
        //
        categories_list: [],
        //notification
        notification_error_cate_create: '',
        //current id of taxonomy which is selected to edit and update
        currentTaxId: '',
        //
        bulkAction: ''
      }
    },
    mounted: function () {
      this.$nextTick(function () {
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
        //=========Add event keydown Esc to close Media
        document.addEventListener('keydown', (event) => {
          if (event.keyCode === 27 || event.key === 'Escape') {
            this.closeTemplateMedia()
          }
        })
        //=========
        this.getCateList()
        //
      })
    },
    watch: {
      cBox_affected: function () {
        let len = document.querySelectorAll("[name='tax_check[]']").length
        if (this.cBox_affected.length < len)
          this.cBox_cmd = false
        else if (this.cBox_affected.length === len)
          this.cBox_cmd = true
      },
      term: function () {
        this.slug = myMethods.toSlug(this.term)
      }
    },
    methods: {
      //=========
      commandCheckBox: function () {
        this.cBox_cmd = !this.cBox_cmd
        //Note: event Click fire func commandCheckBox then v-model change value cBox_cmd=> if check value cBox_cmd within func of Click event without assign value before for cBox_cmd is incorrect
        if (this.cBox_cmd) {
          document.querySelectorAll('[name="tax_check[]"]').forEach((element) => {
            this.cBox_affected.push(element.value)
          })
        }
        else
          this.cBox_affected = []
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
      closeTemplateMedia: function () {
        this.displayMedia = false
        let mediaNodeDom = document.getElementById('media')
        while (mediaNodeDom.firstChild) {
          mediaNodeDom.removeChild(mediaNodeDom.firstChild)
        }
        //use loop while above or document.getElementById('media').innerHTML = '' to remove all Node within "media Node"
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
      //=========
      taxonomyStore: function () {
        axios({
          method: 'post',
          url: taxonomyRoute.admin_taxonomy_store,
          data: {
            taxonomy: this.taxonomy,
            term: this.term,
            slug: this.slug,
            parent_id: this.parent_id,
            description: this.description,
            feature_image: this.feature_image,
            feature_image_alt: this.feature_image_alt,
            feature_image_title: this.feature_image_title,
            feature_image_id: this.feature_image_id,
          }
        })
          .then(responsive => {
            if (responsive.data['error']) {
              this.notification_error_cate_create = responsive.data['error']
            }
            else {
              this.term = ''
              this.slug = ''
              this.parent_id = ''
              this.description = ''
              this.feature_image = ''
              this.feature_image_alt = ''
              this.feature_image_title = ''
              this.feature_image_id = ''

              this.dpFeatureImage = false
              this.dpTextSetFeature = true
              this.dpTextDeleteFeature = false

              this.notification_error_cate_create = ''
              this.getCateList()
            }
          })
          .catch(error => {
            console.log(error)
          })
      },
      //=========
      taxonomyDelete: function(idTaxonomy) {
        window.notification({
          data: {
            message: ['Xoá danh mục?', 'Tất cả bài viết sẽ chuyển về danh mục mặc định'],
            actionOk: () => {
              axios({
                method: 'delete',
                url: taxonomyRoute.admin_taxonomy_delete,
                data: {
                  ids: idTaxonomy,
                  taxonomy: 'category'
                },
              })
                .then(responsive => {
                  this.getCateList()
                  //xoá đi 2 giá trị có trong mảng nhưng đã ko còn tồn tại ->ko gây  sai lệch độ dài -> 'cBox_cmd' sai
                  this.cBox_affected = []
                })
                .catch(error => {
                  console.log(error)
                })
            },
            dpBtnCancel: true,
            dpBtnOk: true
          }
        })
      },
      //=========
      taxonomyEdit: function (idTaxonomy) {
        this.currentTaxId = idTaxonomy
        axios({
          method: 'get',
          url: taxonomyRoute.admin_taxonomy_edit + idTaxonomy,
          data: {}
        })
          .then(responsive => {
            this.taxonomy = responsive.data.taxonomy
            this.term = responsive.data.term
            this.slug = responsive.data.slug
            this.parent_id = responsive.data.parent_id
            this.description = responsive.data.description
            this.feature_image = responsive.data.feature_image
            this.feature_image_alt = responsive.data.feature_image_alt
            this.feature_image_title = responsive.data.feature_image_title
            this.feature_image_id = responsive.data.feature_image_id
            if(this.feature_image) {
              this.dpFeatureImage = true
              this.dpTextDeleteFeature = true
              this.dpTextSetFeature = false
            }
            else {
              this.dpFeatureImage = false
              this.dpTextDeleteFeature = false
              this.dpTextSetFeature = true
            }
            this.dpBtnUpdateCategory = true
            this.dpBtnAddCategory = false
          })
          .catch(error => {
            console.log(error)
          })
      },
      //=========
      taxonomyUpdate: function () {
        axios({
          method: 'put',
          url: taxonomyRoute.admin_taxonomy_update + this.currentTaxId,
          data: {
            taxonomy: this.taxonomy,
            term: this.term,
            slug: this.slug,
            parent_id: this.parent_id,
            description: this.description,
            feature_image: this.feature_image,
            feature_image_alt: this.feature_image_alt,
            feature_image_title: this.feature_image_title,
            feature_image_id: this.feature_image_id,
          }
        })
          .then(responsive => {
            if (responsive.data['error']) {
              this.notification_error_cate_create = responsive.data['error']
            }
            else {
              this.term = ''
              this.slug = ''
              this.parent_id = ''
              this.description = ''
              this.feature_image = ''
              this.feature_image_alt = ''
              this.feature_image_title = ''
              this.feature_image_id = ''

              this.dpFeatureImage = false
              this.dpTextSetFeature = true
              this.dpTextDeleteFeature = false

              this.dpBtnUpdateCategory = false
              this.dpBtnAddCategory = true

              this.notification_error_cate_create = ''
              this.getCateList()
            }
          })
          .catch(error => {
            console.log(error)
          })
      },
      //=========
      taxonomyCancelUpdate: function () {
        this.currentTaxId = ''

        this.term = ''
        this.slug = ''
        this.parent_id = ''
        this.description = ''
        this.feature_image = ''
        this.feature_image_alt = ''
        this.feature_image_title = ''
        this.feature_image_id = ''

        this.dpFeatureImage = false
        this.dpTextSetFeature = true
        this.dpTextDeleteFeature = false

        this.dpBtnUpdateCategory = false
        this.dpBtnAddCategory = true

        this.notification_error_cate_create = ''
      },
      //=========
      bulkActionFunc: function () {
        if(this.bulkAction === 'delete'){
          this.taxonomyDelete(this.cBox_affected)
          this.bulkAction = ''
        }
      }
    }
  }
</script>

<style scoped lang="scss">
    .tbl-row {
        &:hover .tbl-col-name .tbl-col-action {
            visibility: visible;
        }
        .tbl-col-name {
            .tbl-col-name--text {
                font-size: 16px;
            }
            .tbl-col-action {
                font-size: 12px;
                visibility: hidden;
                > li:not(:last-child)::after {
                    content: '';
                    border-right: 1px solid rgba(0, 0, 0, .5);
                    position: relative;
                    left: 9px;
                    top: -2px;
                }
                > li:hover {
                    text-decoration: underline;
                }
            }
        }
    }

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