<template>
    <div>
        <div class="xv-modal-background" @click="closeNotification">
            <div class="xv-modal-content" @click.stop="">
                <div class="xv-m-body">
                    <p class="mb-0" v-if="!Array.isArray(message)">{{message}} </p>
                    <p class="mb-0 h6" v-else v-for="mess in message">{{mess}}</p>
                </div>
                <div class="xv-m-footer">
                    <button v-if="dpBtnCancel" class="btn btn-danger btn-sm mr-2" style="width: 80px;"
                            @click="chooseIgnore">Cancel
                    </button>
                    <button v-if="dpBtnOk" class="btn btn-primary btn-sm" style="width: 80px;" @click="chooseAccept">
                        Ok
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'notification',
    data () {
      return {
        instance: '',
        //passed when calling
        message: 'Are u OK?',
        actionOk: function () {
          //do nothing is default when btn Ok is click
        },
        dpBtnCancel: false,
        dpBtnOk: false,
      }
    },
    //=========https://vuejs.org/v2/api/#vm-root
    // The root Vue instance of the current component tree. If the current instance has no parents this value will be itself.
    // từ file app.js, created được thực thi. Khi gọi root, component ko có component cha nên sẽ return lại chính nó. Khi $mount nó,phương thức mounted sẽ chạy
    created: function () {
      this.instance = this.$root.$mount()
    },
    mounted: function () {
      this.$nextTick(function () {
        //=========== add event keydown Esc to close Notification
        document.addEventListener('keydown', (event) => {
          if (event.keyCode === 27 || event.key === 'Escape') {
            this.closeNotification()
          }
          //delete file when press Enter
          else if (event.keyCode === 13) {
            this.actionOk()
            this.closeNotification()
          }
        })
        //=========Khi mounted chạy, gán giao diện của component này vào thẻ div có id app
        document.getElementById('app').appendChild(this.instance.$el)
      })
    },
    methods: {
      //=========
      closeNotification: function () {
        this.instance.$destroy()
        //https://www.w3schools.com/jsref/met_node_contains.asp
        //check if node app has child node this.instance.$el appended before
        if (document.getElementById('app').contains(this.instance.$el)) {
          document.getElementById('app').removeChild(this.instance.$el)
        }
      },
      //=========
      chooseAccept: function () {
        this.actionOk()
        this.closeNotification()
      },
      //=========
      chooseIgnore: function () {
        this.closeNotification()
      },
    },
    //=========
    destroyed: function () {
      console.log('Instance Notification is Destroyed')
    }
  }
</script>

<style scoped lang="scss">
    @keyframes xoay {
        0% {
            transform: scale(0, 0)
        }
        100% {
            transform: scale(1, 1)
        }
    }

    .xv-modal-background {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, .5);
        z-index: 100000;
        display: flex;
        justify-content: center;
        align-items: center;
        animation: xoay 0.5s;
        .xv-modal-content {
            background-color: white;
            border-radius: 5px;
            padding: 9px 27px;
            .xv-m-body {
                padding: 9px 0 11px 0;
                font-size: 18px;
            }
            .xv-m-footer {
                padding: 9px 0;
                text-align: right;
                border-top: 2px solid rgba(90, 119, 219, 0.5);
            }
        }
    }

    @media only screen and (max-width: 576px) {
        .xv-modal-content {
            width: 280px;
        }
    }

    @media only screen and (min-width: 577px) {
        .xv-modal-content {
            width: 400px;
        }
    }
</style>