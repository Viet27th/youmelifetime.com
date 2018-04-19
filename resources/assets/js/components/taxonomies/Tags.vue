<template>
    <div>
        <div class="row mt-4">
            <div class="col-4">
                <p class="text-danger" v-for="error in notification_error_cate_create">{{error}}</p>
                <div class="form-group">
                    <label for="term" class="h5 font-weight-bold">Tên thẻ:</label>
                    <input type="text" class="form-control" id="term" placeholder="Tag name"
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
                    <label for="tag-description" class="h5 font-weight-bold">Description</label>
                    <textarea class="form-control" id="tag-description" rows="3" v-model="description"></textarea>
                    <i class="text-secondary">The description is not prominent by default; however, some themes may show
                        it.</i>
                </div>

                <div class="mt-3">
                    <button v-if="dpBtnAddTag" class="btn btn-primary" @click="taxonomyStore">Add New Tag</button>
                    <div v-if="dpBtnUpdateTag">
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
                    <tr class="tbl-row" v-for="tagInfo in tags_list">
                        <td class="">
                            <label class="checkbox">
                                <input type="checkbox" name="tax_check[]" :value="tagInfo.id" class=""
                                       v-model="cBox_affected">
                            </label>
                        </td>
                        <td class="tbl-col-name">
                            <p class="mb-1 tbl-col-name--text">
                                <a href="" class="text-info"
                                   @click.prevent="taxonomyEdit(tagInfo.id)">{{tagInfo.term}}</a>
                            </p>

                            <ul class="tbl-col-action list-unstyled mb-0">
                                <li class="d-inline mr-3"><a href="" rel="nofollow"
                                                             @click.prevent="taxonomyEdit(tagInfo.id)">Chỉnh sửa</a>
                                </li>
                                <li class="d-inline mr-3">
                                    <a href="" rel="nofollow" class="text-danger"
                                       @click.prevent="taxonomyDelete([tagInfo.id])">Xóa</a>
                                </li>
                            </ul>
                        </td>
                        <td class="tbl-col-description">{{tagInfo.description}}</td>
                        <td class="tbl-col-slug has-text-info has-text-weight-semibold">{{tagInfo.slug}}</td>
                        <td class="text-center">
                            <span class="badge badge-danger">{{tagInfo.blogs_count}}</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>

<script>
  import myMethods from '../../custom_methods'
  import { taxonomyRoute } from '../../router-map'

  export default {
    name: 'tags',
    data () {
      return {
        domain: document.location.origin,
        //  Information of taxonomy.
        taxonomy: 'tag',
        term: '',
        slug: '',
        description: '',
        //
        tags_list: [],
        //for display
        dpBtnAddTag: true,
        dpBtnUpdateTag: false,
        //notification
        notification_error_cate_create: '',
        //
        cBox_cmd: false,
        cBox_affected: [],
        //current id of taxonomy which is selected to edit and update
        currentTaxId: '',
        //
        bulkAction: ''
      }
    },
    mounted: function () {
      this.$nextTick(function () {
        this.getTagList()
      })
    },
    watch: {
      //
      cBox_affected: function () {
        //lưu  nhỏ: khi xoá đi các record thì độ dài của cBox_affected ko bị thay đổi vì
        //khi chọn 2 phần  tử để xoá, thýis.cBox_affected.length = 2. và sau khi xoá đi 2 phần tử và check thêm 1 phần tử nữa thì this.cBox_affected.length lúc này là 2 cái giá trị cũ còn trong đó cộng với cái mới check => sai độ dài của this.cBox_affected.length
        //để chạy đúng: sau khi chọn phần tử và xoá phải đưa this.cBox_affected = [] để độ dài của this.cBox_affected.length về 0 tức là xoá đi 2 giá trị có trong this.cBox_affected nhưng đã ko còn tồn tại nữa
        let len = document.querySelectorAll("[name='tax_check[]']").length
        if (this.cBox_affected.length < len)
          this.cBox_cmd = false
        else if (this.cBox_affected.length === len)
          this.cBox_cmd = true
      },
      //
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
      //=========
      getTagList: function () {
        axios({
          method: 'get',
          url: taxonomyRoute.admin_taxonomy_get_tags_list
        })
          .then(responsive => {
            this.tags_list = responsive.data
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
            description: this.description,
          }
        })
          .then(responsive => {
            if (responsive.data['error']) {
              this.notification_error_cate_create = responsive.data['error']
            }
            else {
              this.term = ''
              this.slug = ''
              this.description = ''

              this.notification_error_cate_create = ''
              this.getTagList()
            }
          })
          .catch(error => {
            console.log(error)
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
            this.description = responsive.data.description

            this.dpBtnAddTag = false
            this.dpBtnUpdateTag = true
          })
          .catch(error => {
            console.log(error)
          })
      },
      //=========parameter of function is array => in this case, argument 'idTaxonomy' must be array
      taxonomyDelete: function (idTaxonomy) {
        window.notification({
          data: {
            message: 'Xoá thẻ?',
            actionOk: () => {
              axios({
                method: 'delete',
                url: taxonomyRoute.admin_taxonomy_delete,
                data: {
                  ids: idTaxonomy,
                  taxonomy: 'tag'
                },
              })
                .then(responsive => {
                  this.getTagList()
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
      taxonomyUpdate: function () {
        axios({
          method: 'put',
          url: taxonomyRoute.admin_taxonomy_update + this.currentTaxId,
          data: {
            taxonomy: this.taxonomy,
            term: this.term,
            slug: this.slug,
            description: this.description,
          }
        })
          .then(responsive => {
            if (responsive.data['error']) {
              this.notification_error_cate_create = responsive.data['error']
            }
            else {
              this.term = ''
              this.slug = ''
              this.description = ''

              this.dpBtnUpdateTag = false
              this.dpBtnAddTag = true

              this.notification_error_cate_create = ''
              this.getTagList()
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
        this.description = ''

        this.dpBtnUpdateTag = false
        this.dpBtnAddTag = true

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
</style>