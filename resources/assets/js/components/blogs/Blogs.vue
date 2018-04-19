<template>
    <div>
        <div class="clearfix pt-4 pb-4">
            <a :href="blogCreateRoute" type="button" class="btn btn-primary btn-lg float-left">Thêm bài viết mới</a>
            <div class="float-right">
                <form id="filter-post" action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Recipient's username">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                 <i class="fa fa-search" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="mb-3">
            <ul class="list-unstyled list-action">
                <li class="d-inline mr-3">
                    <a href="" :class="[(statusFilter === 'all') ? 'font-weight-bold' : '']"
                       @click.prevent="getAllPost('all')">Tất cả bài viết
                        <span class="badge badge-pill badge-danger">{{allPostCount}}</span>
                    </a>
                </li>
                <li class="d-inline mr-3">
                    <a href="" :class="[(statusFilter === 'publish') ? 'font-weight-bold' : '']"
                       @click.prevent="getAllPost('publish')">Đã đăng
                        <span class="badge badge-pill badge-danger">{{publishPostCount}}</span>
                    </a>
                </li>
                <li class="d-inline mr-3">
                    <a href="" :class="[(statusFilter === 'draft') ? 'font-weight-bold' : '']"
                       @click.prevent="getAllPost('draft')">Lưu nháp
                        <span class="badge badge-pill badge-danger">{{draftPostCount}}</span>
                    </a>
                </li>
                <li class="d-inline mr-3">
                    <a href="" :class="[(statusFilter === 'pending_review') ? 'font-weight-bold' : '']"
                       @click.prevent="getAllPost('pending_review')">Chờ xét duyệt
                        <span class="badge badge-pill badge-danger">{{pendingReviewPostCount}}</span>
                    </a>
                </li>
                <li class="d-inline mr-3">
                    <a href="" :class="[(statusFilter === 'trash') ? 'font-weight-bold' : '']"
                       @click.prevent="getAllPost('trash')">Thùng rác
                        <span class="badge badge-pill badge-danger">{{trashPostCount}}</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="form-row mb-4">
            <select class="custom-select custom-select-sm col-2 mr-2">
                <option selected>Bulk Action</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <button class="btn btn-primary btn-sm mr-5" type="button">Apply</button>

            <select class="custom-select custom-select-sm col-2 mr-2">
                <option selected>Select</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <select class="custom-select custom-select-sm col-2 mr-2">
                <option selected>Select</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <button class="btn btn-primary btn-sm" type="button">Filter</button>
        </div>

        <div class="row">
            <div class="col-12">
                <table id="post-table" class="table">
                    <thead>
                    <tr>
                        <th>
                            <label class="checkbox mb-0">
                                <input type="checkbox" class="input-table">
                            </label>
                        </th>
                        <th class="tbl-title font-weight-bold">Tiêu đề</th>
                        <th class="tbl-author font-weight-bold">Tác giả</th>
                        <th class="tbl-category font-weight-bold">Category</th>
                        <th class="tbl-tag font-weight-bold">Tags</th>
                        <th class="tbl-comment font-weight-bold">
                            <i class="fa fa-comment" aria-hidden="true"></i>
                        </th>
                        <th class="tbl-date font-weight-bold text-center">Ngày gửi</th>
                        <th class="tbl-visibility font-weight-bold text-center">Hiển thị</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="post in posts_info">
                        <td>
                            <label class="checkbox">
                                <input type="checkbox" class="input-table">
                            </label>
                        </td>
                        <td class="tbl-title">
                            <a :href="blogEditRoute + post.id" class="has-text-info">{{post.title}}</a>

                            <ul class="ul-post-actions list-unstyled mb-0"
                                v-if="isTrash">
                                <li class="d-inline mr-3"><a href="" @click.prevent="restorePost(post.id)">Khôi phục</a>
                                </li>
                                <li class="d-inline mr-3"><a href="" class="text-danger"
                                                             @click.prevent="forceDeletePost(post.id)">Xóa</a></li>
                            </ul>

                            <ul class="ul-post-actions list-unstyled mb-0"
                                v-else>
                                <li class="d-inline mr-3"><a :href="blogEditRoute + post.id">Chỉnh sửa</a></li>
                                <li class="d-inline mr-3"><a href="" class="text-danger"
                                                             @click.prevent="softDeletePost(post.id)">Xóa tạm</a></li>
                                <li class="d-inline mr-3"><a
                                        :href="domain + '/' + post.taxonomies[0].slug + '/' + post.slug"
                                        target="_blank">Xem bài viết</a></li>
                            </ul>
                        </td>
                        <td class="tbl-author">
                            <a href="" class="has-text-info">{{post.user.name}}</a>
                        </td>
                        <td class="tbl-category">
                            <a href="" class="has-text-info" v-for="tax in post.taxonomies"
                               v-if="tax.taxonomy ==='category'">
                                {{tax.term}},
                            </a>
                        </td>
                        <td class="tbl-tag">
                            <p class="has-text-grey-dark">.........</p>
                        </td>
                        <td class="tbl-comment">
                           <a :href="commentsBlogRoute + post.id">Link</a>
                        </td>
                        <td class="tbl-date has-text-centered">
                            <p class="text-center mb-0">{{post.status}}</p>
                            <p class="text-center">{{post.updated_at}}</p>
                        </td>
                        <td class="tbl-visibility has-text-centered text-center">
                            <i class="fa fa-eye text-danger" aria-hidden="true" v-if="post.status !== 'publish'"></i>
                            <i class="fa fa-eye text-success" aria-hidden="true" v-else></i>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <nav>
                    <ul class="pagination d-flex justify-content-center" v-if="totalPage > 1">
                        <li class="page-item"><a class="page-link" href="" @click.prevent="(numberOfPage > 0) ? getAllPost(statusFilter, numberOfPage-1) : ''">Previous</a></li>
                        <li class="page-item" :class="[(n === numberOfPage) ? 'active' : '']" v-for="n in totalPage">
                            <a class="page-link" href="" @click.prevent="getAllPost(statusFilter, n)">{{n}}</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#" @click.prevent="(numberOfPage >= totalPage) ? '' : getAllPost(statusFilter, numberOfPage+1)">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>


<script>
  import { blogRoute } from '../../router-map'
  import {commentRoute} from '../../router-map'
  import * as axios from 'axios'

  export default {
    name: '',
    data () {
      return {
        domain: document.location.origin,
        blogCreateRoute: blogRoute.admin_blog_create,
        blogEditRoute: blogRoute.admin_blog_edit,
        commentsBlogRoute: commentRoute.admin_comments_blog,
        //posts info and count posts
        posts_info: [],

        allPostCount: '',
        publishPostCount: '',
        pendingReviewPostCount: '',
        draftPostCount: '',
        trashPostCount: '',
        totalPage: '',
        //check if show post in trash
        isTrash: false,
        //check filter 'all' or 'trash' or 'publish' or 'pending_review' or 'draft'
        statusFilter: 'all',
        //check current page number = ? 1 or 2 or 3 ...
        numberOfPage: '',
        //check total current result on current page
        totalCurrentPostPerPage: ''
      }
    },
    mounted: function () {
      this.$nextTick(function () {
        // Code that will run only after the
        // entire view has been rendered
        this.getAllPost()
      })
    },
    watch : {
      //if have 0 post per current page, auto direct to previous
      totalCurrentPostPerPage: function (newValue, oldValue) {
        if(newValue === 0 && this.numberOfPage >=2) {
          this.getAllPost(this.statusFilter, this.numberOfPage -1 )
        }
      }
    },
    methods: {
      getAllPost: function (filter = 'all', page = 1) {
        if (filter === 'trash') {
          this.isTrash = true
        }
        else {
          this.isTrash = false
        }

        this.statusFilter = filter
        this.numberOfPage = page
        axios({
          method: 'post',
          url: blogRoute.admin_blog_get_all_post,
          data: {
            filterQuery: filter,
            currentPage: page,
            postPerPage: 2
          }
        })
          .then(responsive => {
            this.allPostCount = responsive.data.allPostsCount
            this.publishPostCount = responsive.data.publishPostsCount
            this.pendingReviewPostCount = responsive.data.pendingReviewPostsCount
            this.draftPostCount = responsive.data.draftPostsCount
            this.trashPostCount = responsive.data.trashPostsCount
            this.totalPage = responsive.data.totalPage

            this.posts_info = responsive.data.postsList

            this.totalCurrentPostPerPage = this.posts_info.length
          })
          .catch(error => {
            console.log(error)
          })
      },

      softDeletePost: function (postId) {
        axios({
          method: 'delete',
          url: blogRoute.admin_blog_soft_delete,
          data: {
            id: postId,
          }
        })
          .then(responsive => {
            this.getAllPost(this.statusFilter, this.numberOfPage)
          })
          .catch(error => {
            console.log(error)
          })
      },
      forceDeletePost: function (postId) {
        window.notification({
          data: {
            message: 'Xoá bài viết?',
            actionOk: () => {
              axios({
                method: 'post',
                url: blogRoute.admin_blog_force_delete,
                data: {
                  id: postId
                }
              })
                .then(responsive => {
                  this.getAllPost(this.statusFilter, this.numberOfPage)
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
      restorePost: function (postId) {
        axios({
          method: 'post',
          url: blogRoute.admin_blog_restore,
          data: {
            id: postId
          }
        })
          .then(responsive => {
            this.getAllPost(this.statusFilter, this.numberOfPage)
          })
          .catch(error => {
            console.log(error)
          })
      }
    },

  }
</script>

<style scoped lang="scss">
    .list-action {
        > li {
            span {
                vertical-align: text-bottom;
            }
            > a {
                color: rgba(0, 0, 0, .7);
            }
        }
        > li:not(:last-child)::after {
            content: '';
            border-right: 1px solid #ab9d9d;
            position: relative;
            left: 9px;
        }
    }

    tr {
        .tbl-title {
            max-width: 500px;
            > a {
                color: #7d1e1e;
            }
            .ul-post-actions {
                visibility: hidden;
                > li {
                    font-size: 13px;
                    &:hover {
                        text-decoration: underline;
                    }
                }
                > li:not(:last-child)::after {
                    content: '';
                    border-right: 1px solid rgba(0, 0, 0, .9);
                    position: relative;
                    left: 9px;
                }
            }
        }
        .tbl-category {
            max-width: 195px;
        }
        &:hover .tbl-title .ul-post-actions {
            visibility: visible;
        }
    }


</style>