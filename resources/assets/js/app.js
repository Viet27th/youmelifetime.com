/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('blog-create',require('./components/blogs/Create'))
Vue.component('blog-edit',require('./components/blogs/Edit'))
Vue.component('media-content',require('./components/media/Media'))
Vue.component('blogs-content',require('./components/blogs/Blogs'))
Vue.component('categories-content',require('./components/taxonomies/Categories'))
Vue.component('tags-content',require('./components/taxonomies/Tags'))
Vue.component('comments-content',require('./components/comments/Comments'))

const app = new Vue({
  el: '#app',
})

//Vue.extend() just create a component similar with syntax Vue.component() but there are some differences
//new NotificationComponent().$mount() create a node DOM. then u can use it append to current DOM tree
const NotificationComponent = Vue.extend(require('./components/Notification'))

//yourData is obj, example: {data: {message: 'Xoá file?', actionOk:() => {do something}, dpBtnCancel: true,dpBtnOk: true}}
window.notification = (yourData) => {
  //when app.js is translate, new NotificationComponent is translate. Option method within Notification.vue is run cause NotificationComponent instance is created
  //new 1 component thì phương thức created trong file vue đó sẽ chạy.
  return new NotificationComponent(yourData);
}
