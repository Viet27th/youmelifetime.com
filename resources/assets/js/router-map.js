const base = 'http://youmelifetime.com'
export const user = {}

export const mediaRoute = {
  admin_media_store: base + '/admin/media/store',
  admin_media_get_all_file: base + '/admin/media/get-all-file',
  admin_media_delete_file: base + '/admin/media/delete-file',
  admin_media_update_file: base + '/admin/media/update-file',
}
export const taxonomyRoute = {
  admin_taxonomy_store: base + '/admin/taxonomy/store',
  admin_taxonomy_get_categories_list: base + '/admin/taxonomy/get-categories-list',
  admin_taxonomy_get_tags_list: base + '/admin/taxonomy/get-tags-list',
  admin_taxonomy_edit: base + '/admin/taxonomy/edit/',
  admin_taxonomy_update: base + '/admin/taxonomy/update/',
  admin_taxonomy_delete: base + '/admin/taxonomy/delete'
}
export const blogRoute = {
  admin_blog_store: base + '/admin/blog/store',
  admin_blog_edit: base + '/admin/blog/edit/',
  admin_blog_update: base + '/admin/blog/update/',
  admin_blog_create: base + '/admin/blog/create',
  admin_blog_get_all_post: base + '/admin/blog/get-all-post',
  admin_blog_soft_delete: base + '/admin/blog/soft-delete',
  admin_blog_force_delete: base + '/admin/blog/force-delete',
  admin_blog_restore: base + '/admin/blog/restore',
  admin_blog: base + '/admin/blog',
}
export const commentRoute = {
  admin_comments_blog: base + '/admin/comments/blog/'
}