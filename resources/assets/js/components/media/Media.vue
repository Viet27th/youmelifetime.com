<template>
    <div>
        <div class="d-flex flex-column align-items-center"
             style="border: 3px dashed rgba(0, 0, 0, 0.9); padding: 15px;">
            <i class="fa fa-cloud-upload" aria-hidden="true" style="font-size: 90px;"></i>
            <span>drag and drop</span>
            <span>or</span>
            <div>
                <input type="file" name="files[]" id="file" multiple/>
                <button class="btn btn-primary" type="button" @click="uploadFiles">Upload</button>
            </div>

        </div>

        <div class="row mt-2">
            <div class="col-8">
                <div class="row" style="overflow: scroll;"
                     :style="height_for_wrap ? height_for_wrap:'max-height: 60vh'">
                    <div class="col-3 mb-2" v-for="(data,index) in files">
                        <a href="" rel="nofollow" class="d-block h-100"
                           @click.prevent="callFileDetail(data,index,$event)">
                            <img :src="domain+'/storage/'+data.path" :alt="data.alt" :title="data.title"
                                 class="single-file img-thumbnail h-100 w-100 object-fit-cover"
                                 style="height: 127px !important;">
                        </a>
                    </div>
                </div>
                <button v-if="displayBtnInsertContent" type="button"
                        class="btn btn-primary d-block ml-auto mr-auto mt-3"
                        @click="emitGlobalBusInsertContent">Insert into post
                </button>
                <button v-if="displayBtnInsertFeatureImg" type="button"
                        class="btn btn-primary d-block ml-auto mr-auto mt-3"
                        @click="emitGlobalBusInsertFeatureImg">Insert Feature Image
                </button>
            </div>
            <div class="col-4">
                <div id="file_details" style="overflow: scroll;"
                     :style="height_for_wrap ? height_for_wrap:'max-height: 60vh'">
                    <div>
                        <img :src="path" alt="..." title="" class="img-thumbnail">
                    </div>
                    <ul class="pl-0 pt-2 list-unstyled">
                        <li>
                            <div class="form-group">
                                <label for="original_name">-Original name:</label>
                                <input type="text" class="form-control" id="original_name" placeholder="Original name"
                                       v-model="original_name">
                            </div>
                        </li>
                        <li>-Extension: {{extension}}</li>
                        <li>-Size: {{size}} bytes</li>
                        <li>-Dimensions: {{dimensions}}
                            <a href="" class="text-danger" @click.prevent="">
                                <i class="fa fa-crop ml-2" aria-hidden="true"></i>
                                Crop
                            </a>
                            <small class="text-primary d-block">- Lưu ý sau khi cắt ảnh nên chèn lại ảnh vào bài viết để
                                đúng tỉ lệ mới, chống méo .
                            </small>
                        </li>
                        <li>-Created at: {{created_at}}</li>
                        <li>
                            <div class="form-group">
                                <label for="alt">Alt text:</label>
                                <input type="text" class="form-control" id="alt" placeholder="Alt" v-model="alt_text">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <textarea class="form-control" id="title" rows="3" v-model="title"></textarea>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <label for="caption">Caption:</label>
                                <textarea class="form-control" id="caption" rows="3" v-model="caption"></textarea>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" rows="3"
                                          v-model="description"></textarea>
                            </div>
                        </li>
                        <li>Author: {{author}}</li>
                        <li>
                            <p class="text-primary mb-0 cursor-pointer" @click="updateFile(id)">Update</p>
                        </li>
                        <li>
                            <p class="text-danger cursor-pointer" @click.prevent="callNotification(id,path)">Delete
                                Permanently</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import { EventBus } from '../../event-bus.js'
  import { mediaRoute } from '../../router-map'
  import * as axios from 'axios'

  export default {
    name: 'media',
    props: {},
    data () {
      return {
        domain: document.location.origin,
        height_for_wrap: '',
        //
        files: [],
        //variable for display
        displayBtnInsertContent: false,
        displayBtnInsertFeatureImg: false,
        //when user click or press Shift + click files is selected, value of files is save into 'arrFileIsSelected'
        arrFileIsSelected: [],
        //biến logic cho việc ấn giữ Shift và click chọn file
        oldFileIndex: '',
        //show details for file when user click
        id: '',
        path: 'http://via.placeholder.com/350x150',
        original_name: '',
        extension: '',
        size: '',
        dimensions: '',
        created_at: '',
        alt_text: '',
        title: '',
        caption: '',
        description: '',
        author: ''
      }
    },
    mounted: function () {
      this.$nextTick(function () {
        // Code that will run only after the
        // entire view has been rendered
        this.getFile()
      })
    },
    methods: {
      //========Khi sử dụng Vue.extend phải sử dụng Bus để truyền biến và truyền event giữa  các component (Non Parent-Child Communication)
      emitGlobalBusInsertContent: function () {
        // Send the event on a channel (insert-img-to-content) with a payload (the click count.)
        EventBus.$emit('insert-img-to-content')
        //
        this.arrFileIsSelected.forEach((item) => {
          let width = item.dimensions_width / 2
          let height = item.dimensions_height / 2
          tinymce.get('content').insertContent(`<img width="${width}" height="${height}" src="${this.domain}/storage/${item.path}" alt="${item.alt}" title="${item.title}">`)
        })
      },
      //=========
      emitGlobalBusInsertFeatureImg: function () {
        EventBus.$emit('insert-feature-image', this.arrFileIsSelected)
      },
      //=========
      getFile: function () {
        axios({
          method: 'get',
          url: mediaRoute.admin_media_get_all_file,  //'http://youmelifetime.com/admin/media/get-all-file'
          onDownloadProgress: function (progressEvent) {
            // Do whatever you want with the native progress event
            console.log(progressEvent)
          },
        })
          .then(response => {
            this.files = response.data
          })
          .catch(error => {
            console.log(error)
          })
      },
      //========
      uploadFiles: function () {
        let form = new FormData()
        let files = document.querySelector('#file').files
        for (let i = 0; i < files.length; i++) {
          let file = files[i]
          // Add the file to the request.
          form.append('dp_data[]', file)
        }
        axios({
          method: 'post',
          url: mediaRoute.admin_media_store,  //'http://youmelifetime.com/admin/media/store',
          data: form,
          onUploadProgress: function (progressEvent) {
            let percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total)
            console.log('Progress:-' + percentCompleted)
          }
        })
          .then(response => {
            document.querySelector('#file').value = null
            this.getFile()
            document.querySelectorAll('.file-selected').forEach(function (item) {
              item.classList.remove('file-selected')
              item.parentNode.classList.remove('wrapper-file-selected')
            })
            this.arrFileIsSelected = []
          })
          .catch(error => {
            console.log(error)
          })
      },
      //=========show details of file when user click and append this files data to 'arrFileIsSelected'
      callFileDetail: function (data, index, event) {

        if (event.shiftKey) {
          if (this.oldFileIndex === '' || this.oldFileIndex === index) {
            this.oldFileIndex = index
            this.arrFileIsSelected = []
            this.arrFileIsSelected.push(data)
            //css for file is selected
            document.querySelectorAll('.file-selected').forEach(function (item) {
              item.classList.remove('file-selected')
              item.parentNode.classList.remove('wrapper-file-selected')
            })
            event.target.classList.add('file-selected')
            event.target.parentNode.classList.add('wrapper-file-selected')
          }
          else {
            if (this.oldFileIndex > index) {
              this.arrFileIsSelected = []
              document.querySelectorAll('.file-selected').forEach(function (item) {
                item.classList.remove('file-selected')
                item.parentNode.classList.remove('wrapper-file-selected')
              })
              for (let i = index; i <= this.oldFileIndex; i++) {
                this.arrFileIsSelected.push(this.files[i])
                document.querySelectorAll('.single-file')[i].classList.add('file-selected')
                document.querySelectorAll('.single-file')[i].parentNode.classList.add('wrapper-file-selected')
              }
              // console.log(JSON.stringify(this.arrFileIsSelected))
            }
            else if (this.oldFileIndex < index) {
              this.arrFileIsSelected = []
              document.querySelectorAll('.file-selected').forEach(function (item) {
                item.classList.remove('file-selected')
                item.parentNode.classList.remove('wrapper-file-selected')
              })
              for (let i = this.oldFileIndex; i <= index; i++) {
                this.arrFileIsSelected.push(this.files[i])
                document.querySelectorAll('.single-file')[i].classList.add('file-selected')
                document.querySelectorAll('.single-file')[i].parentNode.classList.add('wrapper-file-selected')
              }
            }
          }
        }
        else if (event.metaKey || event.ctrlKey || event.altKey) {
          //có thể xảy ra lỗi nhỏ khi người dùng ấn shift chọn ảnh xong ấn luôn alt hoặc ctrl để chọn ảnh. sẽ có ảnh bị double.
          // Có thể fix bằng cách sau khi pust(data) dùng Lodash xoá 2 object giống hệt nhau trong mảng 'arrFileIsSelected' trước khi insert vào tinymce
          this.arrFileIsSelected.push(data)
          document.querySelectorAll('.single-file')[index].classList.add('file-selected')
          document.querySelectorAll('.single-file')[index].parentNode.classList.add('wrapper-file-selected')
        }
        else {
          this.oldFileIndex = index
          this.arrFileIsSelected = []
          this.arrFileIsSelected.push(data)
          //css for file is selected
          document.querySelectorAll('.file-selected').forEach(function (item) {
            item.classList.remove('file-selected')
            item.parentNode.classList.remove('wrapper-file-selected')
          })
          event.target.classList.add('file-selected')
          event.target.parentNode.classList.add('wrapper-file-selected')
          //show details file
          this.id = data.id
          this.path = this.domain + '/storage/' + data.path
          this.original_name = data.original_name
          this.extension = data.extension
          this.size = data.size
          this.dimensions = data.dimensions_width + 'x' + data.dimensions_height
          this.created_at = data.created_at
          this.alt_text = data.alt
          this.title = data.title
          this.caption = data.caption
          this.description = data.description
          this.author = data.upload_by
          //scroll div show details file
          let objDiv = document.getElementById('file_details')
          objDiv.scrollTop = 0
        }
      },
      //=========Call Notification and send a call back do something
      callNotification: function (id, path) {
        if (id) {
          window.notification({
            data: {
              message: 'Delete file?',
              actionOk: () => {
                axios({
                  method: 'delete',
                  url: mediaRoute.admin_media_delete_file,
                  data: {
                    id: id,
                    path: path
                  }
                })
                  .then(responsive => {
                    //delete css file
                    document.querySelectorAll('.file-selected').forEach(function (item) {
                      item.classList.remove('file-selected')
                      item.parentNode.classList.remove('wrapper-file-selected')
                    })
                    //
                    this.id = ''
                    this.path = 'http://via.placeholder.com/350x150'
                    this.original_name = ''
                    this.extension = ''
                    this.size = ''
                    this.dimensions = ''
                    this.created_at = ''
                    this.alt_text = ''
                    this.title = ''
                    this.caption = ''
                    this.description = ''
                    this.author = ''
                    //
                    this.getFile()
                  })
                  .catch(error => {
                    console.log(error)
                  })
              },
              dpBtnCancel: true,
              dpBtnOk: true
            }
          })
        }
      },
      //=========
      updateFile: function (fileId) {
        if (fileId) {
          axios({
            method: 'put',
            url: mediaRoute.admin_media_update_file,
            data: {
              id: fileId,
              original_name: this.original_name,
              alt: this.alt_text,
              title: this.title,
              caption: this.caption,
              description: this.description
            }
          })
            .then(responsive => {
              this.getFile()
              if(this.arrFileIsSelected[0]) {
                this.arrFileIsSelected[0].original_name = this.original_name
                this.arrFileIsSelected[0].alt = this.alt_text
                this.arrFileIsSelected[0].title = this.title
                this.arrFileIsSelected[0].description = this.description
              }
              window.notification({
                data: {
                  message: 'Done!',
                  dpBtnOk: true
                }
              })
            })
            .catch(error => {
              console.log(error)
              window.notification({
                data: {
                  message: error,
                  dpBtnOk: true
                }
              })
            })
        }

      }
    }
  }
</script>

<style scoped lang="scss">
    .wrapper-file-selected {
        position: relative;
        .file-selected {
            border: 3px solid rgba(16, 116, 201, 0.9);
        }
        &::after {
            font-family: FontAwesome;
            content: '\F05D';
            position: absolute;
            top: -5px;
            color: #217cd5;
            right: 6px;
            font-size: 27px;
        }
    }
</style>